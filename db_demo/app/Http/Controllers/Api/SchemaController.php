<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SchemaController extends Controller
{
    public function index()
    {
        $database = DB::getDatabaseName();

        // Define which tables you want to ignore
        $excludedTables = [
            'migrations',
            'failed_jobs',
            'password_reset_tokens',
            'cache',
            'cache_locks',
            'sessions',
            'jobs',
            'job_batches',

        ];

        // Get all tables
        $tables = DB::select("SHOW TABLES");

        // Extract table names
        $tableKey = 'Tables_in_' . $database;
        $tableNames = collect($tables)->pluck($tableKey)->toArray();

        // Identify pivot tables (tables with exactly 2 foreign keys and follow naming convention)
        $pivotTables = $this->identifyPivotTables($tableNames, $database, $excludedTables);

        $schema = [];
        $relationships = [];

        foreach ($tableNames as $table) {
            // Skip excluded tables
            if (in_array($table, $excludedTables)) {
                continue;
            }

            // Get columns
            $columns = DB::select("SHOW COLUMNS FROM `$table`");

            // Get foreign keys with additional details
            $foreignKeys = DB::select("
                SELECT
                    kcu.COLUMN_NAME as column_name,
                    kcu.REFERENCED_TABLE_NAME as referenced_table,
                    kcu.REFERENCED_COLUMN_NAME as referenced_column,
                    rc.DELETE_RULE as on_delete,
                    rc.UPDATE_RULE as on_update
                FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
                LEFT JOIN INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS rc
                    ON kcu.CONSTRAINT_NAME = rc.CONSTRAINT_NAME
                    AND kcu.TABLE_SCHEMA = rc.CONSTRAINT_SCHEMA
                WHERE kcu.TABLE_SCHEMA = ?
                    AND kcu.TABLE_NAME = ?
                    AND kcu.REFERENCED_TABLE_NAME IS NOT NULL
            ", [$database, $table]);

            // Determine if this is a pivot table
            $isPivot = in_array($table, $pivotTables);

            $schema[] = [
                'table' => $table,
                'columns' => $columns,
                'foreign_keys' => $foreignKeys,
                'is_pivot' => $isPivot,
            ];

            // Build relationships
            if ($isPivot) {
                // Many-to-Many relationship
                $fks = collect($foreignKeys);
                if ($fks->count() >= 2) {
                    $table1 = $fks[0]->referenced_table;
                    $table2 = $fks[1]->referenced_table;

                    $relationships[] = [
                        'type' => 'many_to_many',
                        'table1' => $table1,
                        'table2' => $table2,
                        'pivot_table' => $table,
                        'description' => "{$table1} ↔ {$table2}",
                    ];
                }
            } else {
                // One-to-Many relationships
                foreach ($foreignKeys as $fk) {
                    // Skip if this FK is part of a self-referencing relationship
                    $isSelfReferencing = $fk->referenced_table === $table;

                    $relationships[] = [
                        'type' => $isSelfReferencing ? 'self_referencing' : 'one_to_many',
                        'from_table' => $fk->referenced_table,
                        'to_table' => $table,
                        'foreign_key' => $fk->column_name,
                        'referenced_column' => $fk->referenced_column,
                        'on_delete' => $fk->on_delete ?? 'NO ACTION',
                        'on_update' => $fk->on_update ?? 'NO ACTION',
                        'description' => $isSelfReferencing
                            ? "{$table} (parent-child)"
                            : "{$fk->referenced_table} (1) → (∞) {$table}",
                    ];
                }
            }
        }

        return response()->json([
            'tables' => $schema,
            'relationships' => $relationships,
            'summary' => [
                'total_tables' => count($schema),
                'pivot_tables' => count($pivotTables),
                'entity_tables' => count($schema) - count($pivotTables),
                'total_relationships' => count($relationships),
            ],
        ]);
    }

    /**
     * Identify pivot/junction tables based on naming conventions and structure
     */
    private function identifyPivotTables(array $tableNames, string $database, array $excludedTables): array
    {
        $pivotTables = [];

        foreach ($tableNames as $table) {
            if (in_array($table, $excludedTables)) {
                continue;
            }

            // Get foreign keys
            $foreignKeys = DB::select("
                SELECT COLUMN_NAME
                FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND REFERENCED_TABLE_NAME IS NOT NULL
            ", [$database, $table]);

            $fkCount = count($foreignKeys);

            // Junction/Pivot table heuristics:
            // 1. Has at least 2 foreign keys (can have more fields)
            // 2. Has underscore in name OR ends with common junction suffixes
            if ($fkCount >= 2) {
                $pivotTables[] = $table;
            }
        }

        return $pivotTables;
    }
}


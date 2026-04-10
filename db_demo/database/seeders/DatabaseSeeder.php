<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ArabicDataSeeder::class,
        ]);
    }
}

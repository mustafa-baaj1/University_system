<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       DB::statement("
        CREATE OR REPLACE VIEW student_info_view AS
        SELECT students.id, students.name, students.email, students.phone, students.address,
        programs.name as program_name,child.name as department_name, parent.name as parent_name
        FROM students
        LEFT JOIN programs ON students.program_id = programs.id
        LEFT JOIN departments child ON programs.department_id = child.id
        LEFT JOIN departments parent ON child.parent_id = parent.id
       ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_info_view');
    }
};

<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\Office;
use App\Models\Program;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Submission;
use App\Models\TeacherAssignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArabicDataSeeder extends Seeder
{
    /**
     * Run the database seeds with Arabic data.
     */
    public function run(): void
    {
        // Clear existing data (optional - comment out if you want to keep existing data)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('submisions')->truncate();
        DB::table('enrollment')->truncate();
        DB::table('teachers_sections')->truncate();
        DB::table('assignments')->truncate();
        DB::table('sections')->truncate();
        DB::table('prerequisites')->truncate();
        DB::table('courses')->truncate();
        DB::table('students')->truncate();
        DB::table('programs')->truncate();
        DB::table('offices')->truncate();
        DB::table('instructors')->truncate();
        DB::table('classrooms')->truncate();
        DB::table('semesters')->truncate();
        DB::table('departments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Create Departments
        $dept1 = Department::create(['name' => 'كلية الهندسة', 'parent_id' => null]);
        $dept2 = Department::create(['name' => 'كلية العلوم', 'parent_id' => null]);
        $dept3 = Department::create(['name' => 'كلية الآداب', 'parent_id' => null]);
        $dept4 = Department::create(['name' => 'كلية إدارة الأعمال', 'parent_id' => null]);

        // Sub-departments
        $dept5 = Department::create(['name' => 'قسم الهندسة الكهربائية', 'parent_id' => $dept1->id]);
        $dept6 = Department::create(['name' => 'قسم الهندسة المدنية', 'parent_id' => $dept1->id]);
        $dept7 = Department::create(['name' => 'قسم علوم الحاسب', 'parent_id' => $dept2->id]);
        $dept8 = Department::create(['name' => 'قسم الرياضيات', 'parent_id' => $dept2->id]);
        $dept9 = Department::create(['name' => 'قسم اللغة العربية', 'parent_id' => $dept3->id]);
        $dept10 = Department::create(['name' => 'قسم اللغة الإنجليزية', 'parent_id' => $dept3->id]);
        $dept11 = Department::create(['name' => 'قسم المحاسبة', 'parent_id' => $dept4->id]);
        $dept12 = Department::create(['name' => 'قسم التسويق', 'parent_id' => $dept4->id]);

        // 2. Create Programs
        $programs = [
            ['name' => 'بكالوريوس هندسة كهربائية', 'type' => 'بكالوريوس', 'department_id' => $dept5->id],
            ['name' => 'بكالوريوس هندسة مدنية', 'type' => 'بكالوريوس', 'department_id' => $dept6->id],
            ['name' => 'بكالوريوس علوم حاسب', 'type' => 'بكالوريوس', 'department_id' => $dept7->id],
            ['name' => 'بكالوريوس رياضيات', 'type' => 'بكالوريوس', 'department_id' => $dept8->id],
            ['name' => 'بكالوريوس لغة عربية', 'type' => 'بكالوريوس', 'department_id' => $dept9->id],
            ['name' => 'بكالوريوس لغة إنجليزية', 'type' => 'بكالوريوس', 'department_id' => $dept10->id],
            ['name' => 'بكالوريوس محاسبة', 'type' => 'بكالوريوس', 'department_id' => $dept11->id],
            ['name' => 'بكالوريوس تسويق', 'type' => 'بكالوريوس', 'department_id' => $dept12->id],
            ['name' => 'ماجستير هندسة كهربائية', 'type' => 'ماجستير', 'department_id' => $dept5->id],
            ['name' => 'ماجستير علوم حاسب', 'type' => 'ماجستير', 'department_id' => $dept7->id],
        ];

        $createdPrograms = [];
        foreach ($programs as $program) {
            $createdPrograms[] = Program::create($program);
        }

        // 3. Create Courses
        $courses = [
            // Electrical Engineering Courses
            ['name' => 'دوائر كهربائية', 'code' => 'EE101', 'description' => 'مقدمة في الدوائر الكهربائية الأساسية', 'program_id' => $createdPrograms[0]->id],
            ['name' => 'إلكترونيات', 'code' => 'EE201', 'description' => 'مبادئ الإلكترونيات والترانزستورات', 'program_id' => $createdPrograms[0]->id],
            ['name' => 'آلات كهربائية', 'code' => 'EE301', 'description' => 'دراسة المحركات والمولدات الكهربائية', 'program_id' => $createdPrograms[0]->id],
            ['name' => 'أنظمة تحكم', 'code' => 'EE401', 'description' => 'نظم التحكم الآلي والذكية', 'program_id' => $createdPrograms[0]->id],

            // Civil Engineering Courses
            ['name' => 'ميكانيكا المواد', 'code' => 'CE101', 'description' => 'دراسة خصائص المواد الإنشائية', 'program_id' => $createdPrograms[1]->id],
            ['name' => 'هندسة الإنشاءات', 'code' => 'CE201', 'description' => 'تصميم وتحليل المنشآت', 'program_id' => $createdPrograms[1]->id],
            ['name' => 'هندسة الطرق', 'code' => 'CE301', 'description' => 'تصميم وبناء الطرق والجسور', 'program_id' => $createdPrograms[1]->id],

            // Computer Science Courses
            ['name' => 'برمجة الحاسب', 'code' => 'CS101', 'description' => 'مقدمة في البرمجة وأساسيات الحاسب', 'program_id' => $createdPrograms[2]->id],
            ['name' => 'هياكل البيانات', 'code' => 'CS201', 'description' => 'دراسة هياكل البيانات والخوارزميات', 'program_id' => $createdPrograms[2]->id],
            ['name' => 'قواعد البيانات', 'code' => 'CS301', 'description' => 'تصميم وإدارة قواعد البيانات', 'program_id' => $createdPrograms[2]->id],
            ['name' => 'ذكاء اصطناعي', 'code' => 'CS401', 'description' => 'مبادئ الذكاء الاصطناعي والتعلم الآلي', 'program_id' => $createdPrograms[2]->id],
            ['name' => 'أمن المعلومات', 'code' => 'CS402', 'description' => 'حماية المعلومات والشبكات', 'program_id' => $createdPrograms[2]->id],

            // Mathematics Courses
            ['name' => 'تفاضل وتكامل', 'code' => 'MATH101', 'description' => 'مبادئ التفاضل والتكامل', 'program_id' => $createdPrograms[3]->id],
            ['name' => 'جبر خطي', 'code' => 'MATH201', 'description' => 'المصفوفات والمتجهات', 'program_id' => $createdPrograms[3]->id],
            ['name' => 'إحصاء', 'code' => 'MATH301', 'description' => 'الإحصاء والاحتمالات', 'program_id' => $createdPrograms[3]->id],

            // Arabic Language Courses
            ['name' => 'النحو والصرف', 'code' => 'AR101', 'description' => 'قواعد اللغة العربية', 'program_id' => $createdPrograms[4]->id],
            ['name' => 'الأدب العربي', 'code' => 'AR201', 'description' => 'تاريخ الأدب العربي', 'program_id' => $createdPrograms[4]->id],

            // English Language Courses
            ['name' => 'قواعد اللغة الإنجليزية', 'code' => 'EN101', 'description' => 'English Grammar Fundamentals', 'program_id' => $createdPrograms[5]->id],
            ['name' => 'الأدب الإنجليزي', 'code' => 'EN201', 'description' => 'English Literature', 'program_id' => $createdPrograms[5]->id],

            // Accounting Courses
            ['name' => 'مبادئ المحاسبة', 'code' => 'ACC101', 'description' => 'أساسيات المحاسبة المالية', 'program_id' => $createdPrograms[6]->id],
            ['name' => 'محاسبة التكاليف', 'code' => 'ACC201', 'description' => 'تحليل التكاليف والإدارة', 'program_id' => $createdPrograms[6]->id],

            // Marketing Courses
            ['name' => 'مبادئ التسويق', 'code' => 'MKT101', 'description' => 'أساسيات التسويق والإعلان', 'program_id' => $createdPrograms[7]->id],
            ['name' => 'التسويق الرقمي', 'code' => 'MKT201', 'description' => 'التسويق عبر الإنترنت', 'program_id' => $createdPrograms[7]->id],
        ];

        $createdCourses = [];
        foreach ($courses as $course) {
            $createdCourses[] = Course::create($course);
        }

        // 4. Create Prerequisites
        DB::table('prerequisites')->insert([
            ['course_id' => $createdCourses[1]->id, 'prerequisite_id' => $createdCourses[0]->id], // Electronics requires Circuits
            ['course_id' => $createdCourses[2]->id, 'prerequisite_id' => $createdCourses[1]->id], // Machines requires Electronics
            ['course_id' => $createdCourses[3]->id, 'prerequisite_id' => $createdCourses[2]->id], // Control Systems requires Machines
            ['course_id' => $createdCourses[8]->id, 'prerequisite_id' => $createdCourses[7]->id], // Data Structures requires Programming
            ['course_id' => $createdCourses[9]->id, 'prerequisite_id' => $createdCourses[8]->id], // Databases requires Data Structures
            ['course_id' => $createdCourses[10]->id, 'prerequisite_id' => $createdCourses[9]->id], // AI requires Databases
            ['course_id' => $createdCourses[13]->id, 'prerequisite_id' => $createdCourses[12]->id], // Linear Algebra requires Calculus
            ['course_id' => $createdCourses[14]->id, 'prerequisite_id' => $createdCourses[13]->id], // Statistics requires Linear Algebra
        ]);

        // 5. Create Students
        $arabicNames = [
            'أحمد محمد علي', 'فاطمة حسن إبراهيم', 'محمد خالد عبدالله', 'سارة علي محمود',
            'علي أحمد يوسف', 'مريم حسن سعيد', 'خالد محمد ناصر', 'نورا أحمد فؤاد',
            'يوسف علي حسن', 'ليلى محمد كمال', 'عمر أحمد سعد', 'هند خالد طه',
            'محمود علي إبراهيم', 'رانيا حسن محمد', 'طارق أحمد ناجي', 'سلمى محمد علي',
            'باسم خالد فتحي', 'دينا أحمد صالح', 'وائل محمد رضا', 'ريم علي كريم',
            'حسام أحمد جمال', 'نادية خالد عثمان', 'إيهاب محمد شريف', 'هالة أحمد نور',
            'عمرو علي حامد', 'شيرين محمد فكري', 'أيمن خالد رشيد', 'منى أحمد زكي',
            'كريم محمد نبيل', 'هبة علي سامي', 'أشرف خالد حلمي', 'سوسن أحمد طارق',
        ];

        $createdStudents = [];
        $programIndex = 0;
        foreach ($arabicNames as $index => $name) {
            $createdStudents[] = Student::create([
                'name' => $name,
                'email' => 'student' . ($index + 1) . '@university.edu',
                'phone' => '05' . rand(10000000, 99999999),
                'address' => ['الرياض', 'جدة', 'الدمام', 'المدينة المنورة', 'الطائف'][rand(0, 4)] . '، المملكة العربية السعودية',
                'program_id' => $createdPrograms[$programIndex % count($createdPrograms)]->id,
            ]);
            $programIndex++;
        }

        // 6. Create Offices (must be created before instructors since instructors reference offices)
        $buildings = ['مبنى أ', 'مبنى ب', 'مبنى ج', 'مبنى د'];
        $numInstructors = 12; // Number of instructors we'll create
        $createdOffices = [];
        for ($i = 0; $i < $numInstructors; $i++) {
            $createdOffices[] = Office::create([
                'building' => $buildings[$i % count($buildings)],
                'room_number' => (100 + $i),
            ]);
        }

        // 7. Create Instructors
        $instructorNames = [
            'د. عبدالرحمن محمد العلي', 'د. فاطمة أحمد السعيد', 'د. خالد حسن المالكي',
            'د. سارة علي النجار', 'د. محمد يوسف القحطاني', 'د. نورا خالد الشمري',
            'د. أحمد محمود الدوسري', 'د. ليلى محمد العتيبي', 'د. عمر علي الحربي',
            'د. رانيا أحمد الزهراني', 'د. طارق خالد الغامدي', 'د. سلمى محمد البقمي',
        ];

        $createdInstructors = [];
        $deptIndex = 0;
        $departments = [$dept5, $dept6, $dept7, $dept8, $dept9, $dept10, $dept11, $dept12];
        foreach ($instructorNames as $index => $name) {
            $createdInstructors[] = Instructor::create([
                'name' => $name,
                'email' => 'instructor' . ($index + 1) . '@university.edu',
                'phone' => '05' . rand(10000000, 99999999),
                'address' => ['الرياض', 'جدة', 'الدمام'][rand(0, 2)] . '، المملكة العربية السعودية',
                'department_id' => $departments[$deptIndex % count($departments)]->id,
                'office_id' => $createdOffices[$index]->id,
            ]);
            $deptIndex++;
        }

        // 8. Create Semesters
        $currentYear = date('Y');
        $semesters = [
            ['name' => 'الفصل الدراسي الأول ' . $currentYear, 'start_date' => $currentYear . '-09-01', 'end_date' => $currentYear . '-12-31'],
            ['name' => 'الفصل الدراسي الثاني ' . ($currentYear + 1), 'start_date' => ($currentYear + 1) . '-01-15', 'end_date' => ($currentYear + 1) . '-05-15'],
            ['name' => 'الفصل الصيفي ' . ($currentYear + 1), 'start_date' => ($currentYear + 1) . '-06-01', 'end_date' => ($currentYear + 1) . '-08-15'],
        ];

        $createdSemesters = [];
        foreach ($semesters as $semester) {
            $createdSemesters[] = Semester::create($semester);
        }

        // 9. Create Classrooms
        $classrooms = [];
        $buildings = ['مبنى أ', 'مبنى ب', 'مبنى ج'];
        for ($i = 0; $i < 15; $i++) {
            $classrooms[] = Classroom::create([
                'building' => $buildings[$i % count($buildings)],
                'room_number' => (100 + $i),
                'capacity' => [30, 40, 50, 60, 80][rand(0, 4)],
            ]);
        }
        $createdClassrooms = $classrooms;

        // 10. Create Sections
        $sectionNames = ['القسم أ', 'القسم ب', 'القسم ج'];
        $createdSections = [];
        $semesterIndex = 0;
        $classroomIndex = 0;

        foreach ($createdCourses as $course) {
            $numSections = rand(1, 3);
            for ($i = 0; $i < $numSections; $i++) {
                $createdSections[] = Section::create([
                    'name' => $sectionNames[$i % count($sectionNames)],
                    'code' => $course->code . '-' . ($i + 1),
                    'course_id' => $course->id,
                    'classroom_id' => $createdClassrooms[$classroomIndex % count($createdClassrooms)]->id,
                    'semester_id' => $createdSemesters[$semesterIndex % count($createdSemesters)]->id,
                ]);
                $classroomIndex++;
            }
            $semesterIndex++;
        }

        // 11. Create Teacher Assignments
        foreach ($createdSections as $index => $section) {
            $numInstructors = rand(1, 2);
            $selectedInstructors = array_rand($createdInstructors, min($numInstructors, count($createdInstructors)));
            if (!is_array($selectedInstructors)) {
                $selectedInstructors = [$selectedInstructors];
            }
            foreach ($selectedInstructors as $instructorIndex) {
                TeacherAssignment::create([
                    'section_id' => $section->id,
                    'instructor_id' => $createdInstructors[$instructorIndex]->id,
                ]);
            }
        }

        // 12. Create Enrollments
        foreach ($createdSections as $section) {
            $numStudents = rand(15, 30);
            $selectedStudents = array_rand($createdStudents, min($numStudents, count($createdStudents)));
            if (!is_array($selectedStudents)) {
                $selectedStudents = [$selectedStudents];
            }
            foreach ($selectedStudents as $studentIndex) {
                Enrollment::create([
                    'student_id' => $createdStudents[$studentIndex]->id,
                    'section_id' => $section->id,
                    'status' => ['pending', 'approved', 'completed'][rand(0, 2)],
                ]);
            }
        }

        // 13. Create Assignments
        $assignmentTitles = [
            'واجب منزلي رقم 1', 'واجب منزلي رقم 2', 'مشروع نهائي', 'اختبار قصير',
            'تقرير بحثي', 'عرض تقديمي', 'تمرين عملي', 'واجب إضافي',
        ];

        $createdAssignments = [];
        foreach ($createdSections as $section) {
            $numAssignments = rand(2, 5);
            for ($i = 0; $i < $numAssignments; $i++) {
                $dueDate = now()->addDays(rand(7, 60));
                $createdAssignments[] = Assignment::create([
                    'section_id' => $section->id,
                    'title' => $assignmentTitles[$i % count($assignmentTitles)],
                    'description' => 'وصف تفصيلي للواجب: ' . $assignmentTitles[$i % count($assignmentTitles)],
                    'due_date' => $dueDate->format('Y-m-d'),
                    'max_score' => (string)rand(50, 100),
                ]);
            }
        }

        // 14. Create Submissions
        $statuses = ['pending', 'submitted', 'graded'];
        $feedbackOptions = ['ممتاز', 'جيد جداً', 'جيد', 'مقبول', 'يحتاج تحسين'];

        foreach ($createdAssignments as $assignment) {
            $section = Section::find($assignment->section_id);
            $enrolledStudents = Enrollment::where('section_id', $section->id)->get();

            if ($enrolledStudents->count() > 0) {
                $numSubmissions = rand(0, min(10, $enrolledStudents->count()));
                if ($numSubmissions > 0) {
                    $selectedEnrollments = $enrolledStudents->random(min($numSubmissions, $enrolledStudents->count()));

                    if (!is_iterable($selectedEnrollments)) {
                        $selectedEnrollments = [$selectedEnrollments];
                    }

                    foreach ($selectedEnrollments as $enrollment) {
                        $status = $statuses[rand(0, 2)];
                        $submittedAt = $status !== 'pending' ? now()->subDays(rand(0, 30)) : now();

                        Submission::create([
                            'assignment_id' => $assignment->id,
                            'student_id' => $enrollment->student_id,
                            'file' => $status !== 'pending' ? 'submission_' . $enrollment->student_id . '_' . $assignment->id . '.pdf' : '',
                            'submitted_at' => $submittedAt,
                            'status' => $status,
                            'feedback' => $status === 'graded' ? $feedbackOptions[rand(0, 4)] : '',
                            'feedback_comment' => $status === 'graded' ? 'تعليق على التقييم: عمل جيد يحتاج بعض التحسينات' : '',
                            'score' => $status === 'graded' ? (string)rand(60, 100) : '',
                        ]);
                    }
                }
            }
        }

        $this->command->info('تم إنشاء البيانات العربية بنجاح!');
        $this->command->info('الأقسام: ' . Department::count());
        $this->command->info('البرامج: ' . Program::count());
        $this->command->info('المقررات: ' . Course::count());
        $this->command->info('الطلاب: ' . Student::count());
        $this->command->info('المدرسون: ' . Instructor::count());
        $this->command->info('الفصول الدراسية: ' . Semester::count());
        $this->command->info('القاعات: ' . Classroom::count());
        $this->command->info('الأقسام الدراسية: ' . Section::count());
        $this->command->info('الواجبات: ' . Assignment::count());
    }
}


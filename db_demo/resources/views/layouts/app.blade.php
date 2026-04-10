<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'University Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
                <i class="fas fa-graduation-cap me-2"></i>University System
            </a>
            <div class="navbar-nav ms-auto">
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="d-flex min-vh-100">
        <!-- Sidebar -->
        <aside class="bg-white shadow-sm" style="width: 250px; min-height: 100vh;">
            <div class="p-3">
                <h6 class="text-muted text-uppercase small fw-bold mb-3">Management</h6>
                <nav class="nav flex-column">
                    <a href="{{ route('departments.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                        <i class="fas fa-building me-2"></i>Departments
                    </a>
                    <a href="{{ route('programs.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('programs.*') ? 'active' : '' }}">
                        <i class="fas fa-certificate me-2"></i>Programs
                    </a>
                    <a href="{{ route('courses.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        <i class="fas fa-book me-2"></i>Courses
                    </a>
                    <a href="{{ route('prerequisites.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('prerequisites.*') ? 'active' : '' }}">
                        <i class="fas fa-link me-2"></i>Prerequisites
                    </a>
                    <a href="{{ route('semesters.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('semesters.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar me-2"></i>Semesters
                    </a>
                    <a href="{{ route('classrooms.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('classrooms.*') ? 'active' : '' }}">
                        <i class="fas fa-door-open me-2"></i>Classrooms
                    </a>
                    <a href="{{ route('sections.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('sections.*') ? 'active' : '' }}">
                        <i class="fas fa-users me-2"></i>Sections
                    </a>
                </nav>

                <h6 class="text-muted text-uppercase small fw-bold mt-4 mb-3">People</h6>
                <nav class="nav flex-column">
                    <a href="{{ route('instructors.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('instructors.*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Instructors
                    </a>
                    <a href="{{ route('offices.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('offices.*') ? 'active' : '' }}">
                        <i class="fas fa-briefcase me-2"></i>Offices
                    </a>
                    <a href="{{ route('students.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate me-2"></i>Students
                    </a>
                    <a href="{{ route('students.info') }}"
                        class="nav-link py-2 {{ request()->routeIs('students.info') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate me-2"></i>Students Info
                    </a>
                </nav>

                <h6 class="text-muted text-uppercase small fw-bold mt-4 mb-3">Activities</h6>
                <nav class="nav flex-column">
                    <a href="{{ route('enrollments.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
                        <i class="fas fa-user-check me-2"></i>Enrollments
                    </a>
                    <a href="{{ route('teacher-assignments.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('teacher-assignments.*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie me-2"></i>Teacher Assignments
                    </a>
                    <a href="{{ route('assignments.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('assignments.*') ? 'active' : '' }}">
                        <i class="fas fa-tasks me-2"></i>Assignments
                    </a>
                    <a href="{{ route('submissions.index') }}"
                        class="nav-link py-2 {{ request()->routeIs('submissions.*') ? 'active' : '' }}">
                        <i class="fas fa-file-upload me-2"></i>Submissions
                    </a>
                </nav>

                <h6 class="text-muted text-uppercase small fw-bold mt-4 mb-3">Developer Tools</h6>
                <nav class="nav flex-column">
                    <a href="{{ route('schema') }}"
                        class="nav-link py-2 {{ request()->is('schema') ? 'active' : '' }}">
                        <i class="fas fa-database me-2"></i>Schema Visualizer
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Content Area -->
        <main class="flex-fill p-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

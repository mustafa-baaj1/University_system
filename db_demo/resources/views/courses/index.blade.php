@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Courses</h1>
            <p class="text-muted">List of all courses</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Course
        </button>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Program</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummyCourses = [
                            ['id' => 1, 'code' => 'CS101', 'name' => 'Introduction to Programming', 'description' => 'Basic programming concepts using Python', 'program' => 'Bachelor of Computer Science'],
                            ['id' => 2, 'code' => 'CS201', 'name' => 'Data Structures', 'description' => 'Arrays, linked lists, trees, graphs', 'program' => 'Bachelor of Computer Science'],
                            ['id' => 3, 'code' => 'CS301', 'name' => 'Database Systems', 'description' => 'Relational databases and SQL', 'program' => 'Bachelor of Computer Science'],
                            ['id' => 4, 'code' => 'BUS101', 'name' => 'Business Fundamentals', 'description' => 'Introduction to business concepts', 'program' => 'Bachelor of Business Administration'],
                            ['id' => 5, 'code' => 'ENG101', 'name' => 'Engineering Mechanics', 'description' => 'Statics and dynamics fundamentals', 'program' => 'Bachelor of Civil Engineering'],
                            ['id' => 6, 'code' => 'CS401', 'name' => 'Machine Learning', 'description' => 'ML algorithms and applications', 'program' => 'Master of Software Engineering'],
                        ];
                    @endphp
                    @foreach($dummyCourses as $course)
                    <tr>
                        <td>{{ $course['id'] }}</td>
                        <td><strong>{{ $course['code'] }}</strong></td>
                        <td>{{ $course['name'] }}</td>
                        <td>{{ $course['description'] }}</td>
                        <td>{{ $course['program'] }}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $course['id'] }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $course['id'] }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $course['id'] }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $course['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Course Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <dl class="row">
                                        <dt class="col-sm-3">ID</dt>
                                        <dd class="col-sm-9">{{ $course['id'] }}</dd>
                                        <dt class="col-sm-3">Code</dt>
                                        <dd class="col-sm-9">{{ $course['code'] }}</dd>
                                        <dt class="col-sm-3">Name</dt>
                                        <dd class="col-sm-9">{{ $course['name'] }}</dd>
                                        <dt class="col-sm-3">Description</dt>
                                        <dd class="col-sm-9">{{ $course['description'] }}</dd>
                                        <dt class="col-sm-3">Program</dt>
                                        <dd class="col-sm-9">{{ $course['program'] }}</dd>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $course['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Course</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Course Code</label>
                                            <input type="text" name="code" class="form-control" value="{{ $course['code'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Course Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $course['name'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="2" required>{{ $course['description'] }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Program</label>
                                            <select name="program_id" class="form-select" required>
                                                <option>Bachelor of Computer Science</option>
                                                <option>Bachelor of Business Administration</option>
                                                <option>Master of Software Engineering</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $course['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Course</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>{{ $course['name'] }}</strong>?</p>
                                        <p class="text-danger small">This action cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing 1 to 6 of 6 results</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="#">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Course Code</label>
                            <input type="text" name="code" class="form-control" placeholder="e.g., CS101" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter course name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Enter description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program</label>
                            <select name="program_id" class="form-select" required>
                                <option value="">-- Select Program --</option>
                                <option>Bachelor of Computer Science</option>
                                <option>Bachelor of Business Administration</option>
                                <option>Master of Software Engineering</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

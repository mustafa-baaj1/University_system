@extends('layouts.app')

@section('title', 'Sections')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Sections</h1>
            <p class="text-muted">List of all course sections</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Section
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
                        <th>Course</th>
                        <th>Classroom</th>
                        <th>Semester</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummySections = [
                            ['id' => 1, 'code' => 'CS101-01', 'name' => 'Section A', 'course' => 'Introduction to Programming', 'classroom' => 'Building A 101', 'semester' => 'Fall 2024'],
                            ['id' => 2, 'code' => 'CS101-02', 'name' => 'Section B', 'course' => 'Introduction to Programming', 'classroom' => 'Building A 102', 'semester' => 'Fall 2024'],
                            ['id' => 3, 'code' => 'CS201-01', 'name' => 'Section A', 'course' => 'Data Structures', 'classroom' => 'Building B 201', 'semester' => 'Fall 2024'],
                            ['id' => 4, 'code' => 'CS301-01', 'name' => 'Section A', 'course' => 'Database Systems', 'classroom' => 'Building B 203', 'semester' => 'Fall 2024'],
                        ];
                    @endphp
                    @foreach($dummySections as $section)
                    <tr>
                        <td>{{ $section['id'] }}</td>
                        <td><strong>{{ $section['code'] }}</strong></td>
                        <td>{{ $section['name'] }}</td>
                        <td>{{ $section['course'] }}</td>
                        <td>{{ $section['classroom'] }}</td>
                        <td>{{ $section['semester'] }}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $section['id'] }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $section['id'] }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $section['id'] }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $section['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Section Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <dl class="row">
                                        <dt class="col-sm-3">ID</dt>
                                        <dd class="col-sm-9">{{ $section['id'] }}</dd>
                                        <dt class="col-sm-3">Code</dt>
                                        <dd class="col-sm-9">{{ $section['code'] }}</dd>
                                        <dt class="col-sm-3">Name</dt>
                                        <dd class="col-sm-9">{{ $section['name'] }}</dd>
                                        <dt class="col-sm-3">Course</dt>
                                        <dd class="col-sm-9">{{ $section['course'] }}</dd>
                                        <dt class="col-sm-3">Classroom</dt>
                                        <dd class="col-sm-9">{{ $section['classroom'] }}</dd>
                                        <dt class="col-sm-3">Semester</dt>
                                        <dd class="col-sm-9">{{ $section['semester'] }}</dd>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $section['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Section</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Section Code</label>
                                            <input type="text" name="code" class="form-control" value="{{ $section['code'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Section Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $section['name'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Course</label>
                                            <select name="course_id" class="form-select" required>
                                                <option>Introduction to Programming</option>
                                                <option>Data Structures</option>
                                                <option>Database Systems</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Classroom</label>
                                            <select name="classroom_id" class="form-select" required>
                                                <option>Building A 101</option>
                                                <option>Building A 102</option>
                                                <option>Building B 201</option>
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
                    <div class="modal fade" id="deleteModal{{ $section['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Section</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>{{ $section['code'] }}</strong>?</p>
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
            <small class="text-muted">Showing 1 to 4 of 4 results</small>
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
                        <h5 class="modal-title">Create New Section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Section Code</label>
                            <input type="text" name="code" class="form-control" placeholder="e.g., CS101-01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Section Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., Section A" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <select name="course_id" class="form-select" required>
                                <option value="">-- Select Course --</option>
                                <option>Introduction to Programming</option>
                                <option>Data Structures</option>
                                <option>Database Systems</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Classroom</label>
                            <select name="classroom_id" class="form-select" required>
                                <option value="">-- Select Classroom --</option>
                                <option>Building A 101</option>
                                <option>Building A 102</option>
                                <option>Building B 201</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <select name="semester_id" class="form-select" required>
                                <option value="">-- Select Semester --</option>
                                <option>Fall 2024</option>
                                <option>Spring 2025</option>
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

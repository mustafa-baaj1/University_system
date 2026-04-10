@extends('layouts.app')

@section('title', 'Teacher Assignments')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Teacher Assignments</h1>
            <p class="text-muted">List of all teacher-section assignments</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Assignment
        </button>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Instructor</th>
                        <th>Section</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummyTeacherAssignments = [
                            [
                                'id' => 1,
                                'instructor' => 'Dr. John Smith',
                                'section' => 'CS101-01 (Introduction to Programming)',
                                'created_at' => 'Sep 01, 2024',
                            ],
                            [
                                'id' => 2,
                                'instructor' => 'Prof. Emily Johnson',
                                'section' => 'CS101-02 (Introduction to Programming)',
                                'created_at' => 'Sep 01, 2024',
                            ],
                            [
                                'id' => 3,
                                'instructor' => 'Dr. John Smith',
                                'section' => 'CS201-01 (Data Structures)',
                                'created_at' => 'Sep 01, 2024',
                            ],
                            [
                                'id' => 4,
                                'instructor' => 'Prof. Emily Johnson',
                                'section' => 'CS301-01 (Database Systems)',
                                'created_at' => 'Sep 01, 2024',
                            ],
                        ];
                    @endphp
                    @foreach ($dummyTeacherAssignments as $assignment)
                        <tr>
                            <td>{{ $assignment['id'] }}</td>
                            <td><strong>{{ $assignment['instructor'] }}</strong></td>
                            <td>{{ $assignment['section'] }}</td>
                            <td>{{ $assignment['created_at'] }}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $assignment['id'] }}">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $assignment['id'] }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $assignment['id'] }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal{{ $assignment['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Assignment Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">ID</dt>
                                            <dd class="col-sm-9">{{ $assignment['id'] }}</dd>
                                            <dt class="col-sm-3">Instructor</dt>
                                            <dd class="col-sm-9">{{ $assignment['instructor'] }}</dd>
                                            <dt class="col-sm-3">Section</dt>
                                            <dd class="col-sm-9">{{ $assignment['section'] }}</dd>
                                            <dt class="col-sm-3">Created At</dt>
                                            <dd class="col-sm-9">{{ $assignment['created_at'] }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $assignment['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="#">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Teacher Assignment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Instructor</label>
                                                <select name="instructor_id" class="form-select" required>
                                                    <option>Dr. John Smith</option>
                                                    <option>Prof. Emily Johnson</option>
                                                    <option>Dr. Michael Brown</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Section</label>
                                                <select name="section_id" class="form-select" required>
                                                    <option>CS101-01</option>
                                                    <option>CS101-02</option>
                                                    <option>CS201-01</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $assignment['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="#">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Teacher Assignment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this assignment?</p>
                                            <p class="text-danger small">This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
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
                        <h5 class="modal-title">Create New Teacher Assignment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Instructor</label>
                            <select name="instructor_id" class="form-select" required>
                                <option value="">-- Select Instructor --</option>
                                <option>Dr. John Smith</option>
                                <option>Prof. Emily Johnson</option>
                                <option>Dr. Michael Brown</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Section</label>
                            <select name="section_id" class="form-select" required>
                                <option value="">-- Select Section --</option>
                                <option>CS101-01</option>
                                <option>CS101-02</option>
                                <option>CS201-01</option>
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

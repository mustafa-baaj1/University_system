@extends('layouts.app')

@section('title', 'Enrollments')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Enrollments</h1>
            <p class="text-muted">List of all student enrollments</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Enrollment
        </button>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Section</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummyEnrollments = [
                            ['id' => 1, 'student' => 'Ahmed Ali', 'section' => 'CS101-01', 'status' => 'active', 'created_at' => 'Sep 05, 2024'],
                            ['id' => 2, 'student' => 'Sara Hassan', 'section' => 'CS101-02', 'status' => 'active', 'created_at' => 'Sep 05, 2024'],
                            ['id' => 3, 'student' => 'Mohammed Khalil', 'section' => 'CS201-01', 'status' => 'active', 'created_at' => 'Sep 06, 2024'],
                            ['id' => 4, 'student' => 'Fatima Omar', 'section' => 'CS301-01', 'status' => 'pending', 'created_at' => 'Sep 07, 2024'],
                            ['id' => 5, 'student' => 'Youssef Ibrahim', 'section' => 'CS101-01', 'status' => 'active', 'created_at' => 'Sep 08, 2024'],
                        ];
                    @endphp
                    @foreach($dummyEnrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment['id'] }}</td>
                        <td><strong>{{ $enrollment['student'] }}</strong></td>
                        <td>{{ $enrollment['section'] }}</td>
                        <td>
                            <span class="badge {{ $enrollment['status'] === 'active' ? 'bg-success' : 'bg-warning' }}">
                                {{ $enrollment['status'] }}
                            </span>
                        </td>
                        <td>{{ $enrollment['created_at'] }}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $enrollment['id'] }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $enrollment['id'] }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $enrollment['id'] }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $enrollment['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Enrollment Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <dl class="row">
                                        <dt class="col-sm-3">ID</dt>
                                        <dd class="col-sm-9">{{ $enrollment['id'] }}</dd>
                                        <dt class="col-sm-3">Student</dt>
                                        <dd class="col-sm-9">{{ $enrollment['student'] }}</dd>
                                        <dt class="col-sm-3">Section</dt>
                                        <dd class="col-sm-9">{{ $enrollment['section'] }}</dd>
                                        <dt class="col-sm-3">Status</dt>
                                        <dd class="col-sm-9"><span class="badge {{ $enrollment['status'] === 'active' ? 'bg-success' : 'bg-warning' }}">{{ $enrollment['status'] }}</span></dd>
                                        <dt class="col-sm-3">Created At</dt>
                                        <dd class="col-sm-9">{{ $enrollment['created_at'] }}</dd>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $enrollment['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Enrollment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Student</label>
                                            <select name="student_id" class="form-select" required>
                                                <option>Ahmed Ali</option>
                                                <option>Sara Hassan</option>
                                                <option>Mohammed Khalil</option>
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
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="active" {{ $enrollment['status'] === 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="pending" {{ $enrollment['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
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
                    <div class="modal fade" id="deleteModal{{ $enrollment['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Enrollment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this enrollment?</p>
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
            <small class="text-muted">Showing 1 to 5 of 5 results</small>
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
                        <h5 class="modal-title">Create New Enrollment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Student</label>
                            <select name="student_id" class="form-select" required>
                                <option value="">-- Select Student --</option>
                                <option>Ahmed Ali</option>
                                <option>Sara Hassan</option>
                                <option>Mohammed Khalil</option>
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
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Select Status --</option>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
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

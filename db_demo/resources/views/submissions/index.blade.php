@extends('layouts.app')

@section('title', 'Submissions')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Submissions</h1>
            <p class="text-muted">List of all assignment submissions</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Submission
        </button>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Assignment</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Submitted At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummySubmissions = [
                            ['id' => 1, 'student' => 'Ahmed Ali', 'assignment' => 'Programming Assignment 1', 'status' => 'graded', 'score' => '95', 'submitted_at' => 'Nov 14, 2024 10:30 AM'],
                            ['id' => 2, 'student' => 'Sara Hassan', 'assignment' => 'Programming Assignment 1', 'status' => 'pending', 'score' => '-', 'submitted_at' => 'Nov 15, 2024 09:15 AM'],
                            ['id' => 3, 'student' => 'Mohammed Khalil', 'assignment' => 'Data Structures Project', 'status' => 'graded', 'score' => '140', 'submitted_at' => 'Nov 19, 2024 03:45 PM'],
                            ['id' => 4, 'student' => 'Fatima Omar', 'assignment' => 'Database Design', 'status' => 'pending', 'score' => '-', 'submitted_at' => 'Nov 25, 2024 11:20 AM'],
                        ];
                    @endphp
                    @foreach($dummySubmissions as $submission)
                    <tr>
                        <td>{{ $submission['id'] }}</td>
                        <td><strong>{{ $submission['student'] }}</strong></td>
                        <td>{{ $submission['assignment'] }}</td>
                        <td>
                            <span class="badge {{ $submission['status'] === 'graded' ? 'bg-success' : 'bg-warning' }}">
                                {{ $submission['status'] }}
                            </span>
                        </td>
                        <td>{{ $submission['score'] }}</td>
                        <td>{{ $submission['submitted_at'] }}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $submission['id'] }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $submission['id'] }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $submission['id'] }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $submission['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Submission Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">ID</dt>
                                        <dd class="col-sm-8">{{ $submission['id'] }}</dd>
                                        <dt class="col-sm-4">Student</dt>
                                        <dd class="col-sm-8">{{ $submission['student'] }}</dd>
                                        <dt class="col-sm-4">Assignment</dt>
                                        <dd class="col-sm-8">{{ $submission['assignment'] }}</dd>
                                        <dt class="col-sm-4">Status</dt>
                                        <dd class="col-sm-8"><span class="badge {{ $submission['status'] === 'graded' ? 'bg-success' : 'bg-warning' }}">{{ $submission['status'] }}</span></dd>
                                        <dt class="col-sm-4">Score</dt>
                                        <dd class="col-sm-8">{{ $submission['score'] }}</dd>
                                        <dt class="col-sm-4">Submitted At</dt>
                                        <dd class="col-sm-8">{{ $submission['submitted_at'] }}</dd>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $submission['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Submission</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="pending" {{ $submission['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="graded" {{ $submission['status'] === 'graded' ? 'selected' : '' }}>Graded</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Score</label>
                                            <input type="number" name="score" class="form-control" value="{{ $submission['score'] !== '-' ? $submission['score'] : '' }}" placeholder="Enter score">
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
                    <div class="modal fade" id="deleteModal{{ $submission['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Submission</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this submission?</p>
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
                        <h5 class="modal-title">Create New Submission</h5>
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
                            <label class="form-label">Assignment</label>
                            <select name="assignment_id" class="form-select" required>
                                <option value="">-- Select Assignment --</option>
                                <option>Programming Assignment 1</option>
                                <option>Data Structures Project</option>
                                <option>Database Design</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Select Status --</option>
                                <option value="pending">Pending</option>
                                <option value="graded">Graded</option>
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

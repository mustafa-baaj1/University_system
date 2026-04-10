@extends('layouts.app')

@section('title', 'Assignments')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Assignments</h1>
            <p class="text-muted">List of all course assignments</p>
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Section</th>
                        <th>Due Date</th>
                        <th>Max Score</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummyAssignments = [
                            ['id' => 1, 'title' => 'Programming Assignment 1', 'description' => 'Create a basic calculator program', 'section' => 'CS101-01', 'due_date' => 'Nov 15, 2024', 'max_score' => '100'],
                            ['id' => 2, 'title' => 'Data Structures Project', 'description' => 'Implement a binary search tree', 'section' => 'CS201-01', 'due_date' => 'Nov 20, 2024', 'max_score' => '150'],
                            ['id' => 3, 'title' => 'Database Design', 'description' => 'Design a database for library system', 'section' => 'CS301-01', 'due_date' => 'Nov 25, 2024', 'max_score' => '100'],
                            ['id' => 4, 'title' => 'Final Project', 'description' => 'Build a complete web application', 'section' => 'CS101-01', 'due_date' => 'Dec 15, 2024', 'max_score' => '200'],
                        ];
                    @endphp
                    @foreach($dummyAssignments as $assignment)
                    <tr>
                        <td>{{ $assignment['id'] }}</td>
                        <td><strong>{{ $assignment['title'] }}</strong></td>
                        <td>{{ $assignment['description'] }}</td>
                        <td>{{ $assignment['section'] }}</td>
                        <td>{{ $assignment['due_date'] }}</td>
                        <td>{{ $assignment['max_score'] }}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $assignment['id'] }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $assignment['id'] }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $assignment['id'] }}">
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
                                        <dt class="col-sm-3">Title</dt>
                                        <dd class="col-sm-9">{{ $assignment['title'] }}</dd>
                                        <dt class="col-sm-3">Description</dt>
                                        <dd class="col-sm-9">{{ $assignment['description'] }}</dd>
                                        <dt class="col-sm-3">Section</dt>
                                        <dd class="col-sm-9">{{ $assignment['section'] }}</dd>
                                        <dt class="col-sm-3">Due Date</dt>
                                        <dd class="col-sm-9">{{ $assignment['due_date'] }}</dd>
                                        <dt class="col-sm-3">Max Score</dt>
                                        <dd class="col-sm-9">{{ $assignment['max_score'] }}</dd>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        <h5 class="modal-title">Edit Assignment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ $assignment['title'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="2" required>{{ $assignment['description'] }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Section</label>
                                            <select name="section_id" class="form-select" required>
                                                <option>CS101-01</option>
                                                <option>CS201-01</option>
                                                <option>CS301-01</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Due Date</label>
                                            <input type="date" name="due_date" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Max Score</label>
                                            <input type="number" name="max_score" class="form-control" value="{{ $assignment['max_score'] }}" required>
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
                    <div class="modal fade" id="deleteModal{{ $assignment['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Assignment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>{{ $assignment['title'] }}</strong>?</p>
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
                        <h5 class="modal-title">Create New Assignment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter assignment title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Enter description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Section</label>
                            <select name="section_id" class="form-select" required>
                                <option value="">-- Select Section --</option>
                                <option>CS101-01</option>
                                <option>CS201-01</option>
                                <option>CS301-01</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Score</label>
                            <input type="number" name="max_score" class="form-control" placeholder="Enter maximum score" required>
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

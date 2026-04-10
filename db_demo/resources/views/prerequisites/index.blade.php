@extends('layouts.app')

@section('title', 'Prerequisites')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Prerequisites</h1>
            <p class="text-muted">Course prerequisite relationships</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Prerequisite
        </button>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Course</th>
                        <th>Prerequisite Course</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummyPrerequisites = [
                            ['id' => 1, 'course' => 'Data Structures (CS201)', 'prerequisite' => 'Introduction to Programming (CS101)', 'created_at' => 'Jan 20, 2024'],
                            ['id' => 2, 'course' => 'Database Systems (CS301)', 'prerequisite' => 'Data Structures (CS201)', 'created_at' => 'Jan 20, 2024'],
                            ['id' => 3, 'course' => 'Machine Learning (CS401)', 'prerequisite' => 'Data Structures (CS201)', 'created_at' => 'Jan 20, 2024'],
                        ];
                    @endphp
                    @foreach($dummyPrerequisites as $prerequisite)
                    <tr>
                        <td>{{ $prerequisite['id'] }}</td>
                        <td><strong>{{ $prerequisite['course'] }}</strong></td>
                        <td>{{ $prerequisite['prerequisite'] }}</td>
                        <td>{{ $prerequisite['created_at'] }}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $prerequisite['id'] }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $prerequisite['id'] }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $prerequisite['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Prerequisite Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">ID</dt>
                                        <dd class="col-sm-8">{{ $prerequisite['id'] }}</dd>
                                        <dt class="col-sm-4">Course</dt>
                                        <dd class="col-sm-8">{{ $prerequisite['course'] }}</dd>
                                        <dt class="col-sm-4">Prerequisite</dt>
                                        <dd class="col-sm-8">{{ $prerequisite['prerequisite'] }}</dd>
                                        <dt class="col-sm-4">Created At</dt>
                                        <dd class="col-sm-8">{{ $prerequisite['created_at'] }}</dd>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $prerequisite['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Prerequisite</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this prerequisite relationship?</p>
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
            <small class="text-muted">Showing 1 to 3 of 3 results</small>
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
                        <h5 class="modal-title">Create New Prerequisite</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <select name="course_id" class="form-select" required>
                                <option value="">-- Select Course --</option>
                                <option>Data Structures (CS201)</option>
                                <option>Database Systems (CS301)</option>
                                <option>Machine Learning (CS401)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prerequisite Course</label>
                            <select name="prerequisite_id" class="form-select" required>
                                <option value="">-- Select Prerequisite --</option>
                                <option>Introduction to Programming (CS101)</option>
                                <option>Data Structures (CS201)</option>
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

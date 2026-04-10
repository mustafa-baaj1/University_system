@extends('layouts.app')

@section('title', 'Offices')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Offices</h1>
            <p class="text-muted">List of all instructor offices</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Office
        </button>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Building</th>
                        <th>Room Number</th>
                        <th>Instructor</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummyOffices = [
                            ['id' => 1, 'building' => 'Faculty Building A', 'room_number' => '201', 'instructor' => 'Dr. John Smith', 'created_at' => 'Jan 15, 2024'],
                            ['id' => 2, 'building' => 'Faculty Building A', 'room_number' => '202', 'instructor' => 'Prof. Emily Johnson', 'created_at' => 'Jan 15, 2024'],
                            ['id' => 3, 'building' => 'Faculty Building B', 'room_number' => '301', 'instructor' => 'Dr. Michael Brown', 'created_at' => 'Jan 15, 2024'],
                            ['id' => 4, 'building' => 'Faculty Building B', 'room_number' => '302', 'instructor' => 'Prof. Sarah Davis', 'created_at' => 'Jan 15, 2024'],
                        ];
                    @endphp
                    @foreach($dummyOffices as $office)
                    <tr>
                        <td>{{ $office['id'] }}</td>
                        <td><strong>{{ $office['building'] }}</strong></td>
                        <td>{{ $office['room_number'] }}</td>
                        <td>{{ $office['instructor'] }}</td>
                        <td>{{ $office['created_at'] }}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $office['id'] }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $office['id'] }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $office['id'] }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $office['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Office Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">ID</dt>
                                        <dd class="col-sm-8">{{ $office['id'] }}</dd>
                                        <dt class="col-sm-4">Building</dt>
                                        <dd class="col-sm-8">{{ $office['building'] }}</dd>
                                        <dt class="col-sm-4">Room Number</dt>
                                        <dd class="col-sm-8">{{ $office['room_number'] }}</dd>
                                        <dt class="col-sm-4">Instructor</dt>
                                        <dd class="col-sm-8">{{ $office['instructor'] }}</dd>
                                        <dt class="col-sm-4">Created At</dt>
                                        <dd class="col-sm-8">{{ $office['created_at'] }}</dd>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $office['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Office</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Building</label>
                                            <input type="text" name="building" class="form-control" value="{{ $office['building'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Room Number</label>
                                            <input type="text" name="room_number" class="form-control" value="{{ $office['room_number'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Instructor</label>
                                            <select name="instructor_id" class="form-select" required>
                                                <option>Dr. John Smith</option>
                                                <option>Prof. Emily Johnson</option>
                                                <option>Dr. Michael Brown</option>
                                                <option>Prof. Sarah Davis</option>
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
                    <div class="modal fade" id="deleteModal{{ $office['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Office</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>{{ $office['building'] }} {{ $office['room_number'] }}</strong>?</p>
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
                        <h5 class="modal-title">Create New Office</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Building</label>
                            <input type="text" name="building" class="form-control" placeholder="Enter building name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Room Number</label>
                            <input type="text" name="room_number" class="form-control" placeholder="Enter room number" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instructor</label>
                            <select name="instructor_id" class="form-select" required>
                                <option value="">-- Select Instructor --</option>
                                <option>Dr. John Smith</option>
                                <option>Prof. Emily Johnson</option>
                                <option>Dr. Michael Brown</option>
                                <option>Prof. Sarah Davis</option>
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

@extends('layouts.app')

@section('title', 'Classrooms')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Classrooms</h1>
            <p class="text-muted">List of all classrooms</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Classroom
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
                        <th>Capacity</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dummyClassrooms = [
                            ['id' => 1, 'building' => 'Building A', 'room_number' => '101', 'capacity' => 30, 'created_at' => 'Jan 10, 2024'],
                            ['id' => 2, 'building' => 'Building A', 'room_number' => '102', 'capacity' => 30, 'created_at' => 'Jan 10, 2024'],
                            ['id' => 3, 'building' => 'Building B', 'room_number' => '201', 'capacity' => 40, 'created_at' => 'Jan 10, 2024'],
                            ['id' => 4, 'building' => 'Building B', 'room_number' => '203', 'capacity' => 35, 'created_at' => 'Jan 10, 2024'],
                            ['id' => 5, 'building' => 'Building C', 'room_number' => '301', 'capacity' => 50, 'created_at' => 'Jan 10, 2024'],
                        ];
                    @endphp
                    @foreach($dummyClassrooms as $classroom)
                    <tr>
                        <td>{{ $classroom['id'] }}</td>
                        <td><strong>{{ $classroom['building'] }}</strong></td>
                        <td>{{ $classroom['room_number'] }}</td>
                        <td>{{ $classroom['capacity'] }}</td>
                        <td>{{ $classroom['created_at'] }}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $classroom['id'] }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $classroom['id'] }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $classroom['id'] }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $classroom['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Classroom Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">ID</dt>
                                        <dd class="col-sm-8">{{ $classroom['id'] }}</dd>
                                        <dt class="col-sm-4">Building</dt>
                                        <dd class="col-sm-8">{{ $classroom['building'] }}</dd>
                                        <dt class="col-sm-4">Room Number</dt>
                                        <dd class="col-sm-8">{{ $classroom['room_number'] }}</dd>
                                        <dt class="col-sm-4">Capacity</dt>
                                        <dd class="col-sm-8">{{ $classroom['capacity'] }}</dd>
                                        <dt class="col-sm-4">Created At</dt>
                                        <dd class="col-sm-8">{{ $classroom['created_at'] }}</dd>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $classroom['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Classroom</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Building</label>
                                            <input type="text" name="building" class="form-control" value="{{ $classroom['building'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Room Number</label>
                                            <input type="text" name="room_number" class="form-control" value="{{ $classroom['room_number'] }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Capacity</label>
                                            <input type="number" name="capacity" class="form-control" value="{{ $classroom['capacity'] }}" required>
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
                    <div class="modal fade" id="deleteModal{{ $classroom['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Classroom</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>{{ $classroom['building'] }} {{ $classroom['room_number'] }}</strong>?</p>
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
                        <h5 class="modal-title">Create New Classroom</h5>
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
                            <label class="form-label">Capacity</label>
                            <input type="number" name="capacity" class="form-control" placeholder="Enter capacity" required>
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

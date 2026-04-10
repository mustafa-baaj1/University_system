@extends('layouts.app')

@section('title', 'Students')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Students</h1>
            <p class="text-muted">List of all students</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-2"></i>Create New Student
        </button>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>

                        <th>Image</th>
                        <th>Image Metadata</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Program</th>
                        <th>department</th>
                        <th>parent department</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($students as $student)
                        <tr>
                            <td> <img src="{{ $student->getFirstMediaUrl('student_images') }}" alt="Student Image"
                                    class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">

                            </td>
                            <td>
                                <span
                                    class="text-muted small">{{ $student->getFirstMedia('student_images')?->getCustomProperty('metadata') }}</span>
                                <span
                                    class="text-muted small">{{ $student->getFirstMedia('student_images')?->getCustomProperty('uploaded_at') }}</span>
                                <span
                                    class="text-muted small">{{ $student->getFirstMedia('student_images')?->getCustomProperty('sizes') }}</span>
                            </td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student['email'] }}</td>
                            <td>{{ $student['phone'] }}</td>
                            <td>{{ $student->program->name }}</td>
                            <td>{{ $student->program->department->name ?? 'N/A' }}</td>
                            <td>{{ $student->program->department->parent->name ?? 'N/A' }}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $student['id'] }}">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $student['id'] }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $student['id'] }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal{{ $student['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Student Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">ID</dt>
                                            <dd class="col-sm-9">{{ $student['id'] }}</dd>
                                            <dt class="col-sm-3">Name</dt>
                                            <dd class="col-sm-9">{{ $student['name'] }}</dd>
                                            <dt class="col-sm-3">Email</dt>
                                            <dd class="col-sm-9">{{ $student['email'] }}</dd>
                                            <dt class="col-sm-3">Phone</dt>
                                            <dd class="col-sm-9">{{ $student['phone'] }}</dd>
                                            <dt class="col-sm-3">Program</dt>
                                            <dd class="col-sm-9">{{ $student['program'] }}</dd>
                                            <dt class="col-sm-3">Address</dt>
                                            <dd class="col-sm-9">{{ $student['address'] }}</dd>
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
                        <div class="modal fade" id="editModal{{ $student['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('students.update', $student->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $student['name'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $student['email'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="tel" name="phone" class="form-control"
                                                    value="{{ $student['phone'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control"
                                                    value="{{ $student['address'] }}">
                                            </div>
                                            <label class="form-label">program </label>
                                            <select name="program_id" class="form-select">
                                                <option value="">{{ $student->program->name ?? 'None' }}
                                                </option>
                                                @foreach ($programs as $program)
                                                    <option value="{{ $program->id }}">{{ $program->name }}
                                                    </option>
                                                @endforeach


                                            </select>
                                            <div class="mb-3">
                                                <label class="form-label">Choose Image</label>
                                                <input type="file" name="image" class="form-control"
                                                    accept="image/*">
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
                        <div class="modal fade" id="deleteModal{{ $student['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="#">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <strong>{{ $student['name'] }}</strong>?</p>
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
                <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter student name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter phone number"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter address">
                        </div>
                        <label class="form-label">program </label>
                        <select name="program_id" class="form-select">
                            <option value="">{{ $student->program->name ?? 'None' }}
                            </option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}
                                </option>
                            @endforeach


                        </select>
                        <div class="mb-3">
                            <label class="form-label">Choose Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
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

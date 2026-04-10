@extends('layouts.app')

@section('title', 'Students Info')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Students information</h1>
            <p class="text-muted">List of all students information</p>
        </div>

    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>Program</th>
                        <th>department</th>
                        <th>parent department name</th>

                    </tr>
                </thead>
                <tbody>


                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $student['id'] }}</td>

                        <td>{{ $student->name }}</td>
                        <td>{{ $student['email'] }}</td>
                        <td>{{ $student['phone'] }}</td>
                        <td>{{ $student['program_name'] }}</td>
                        <td>{{ $student['department_name'] }}</td>
                        <td>{{ $student['parent_name'] }}</td>

                    </tr>
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


@endsection

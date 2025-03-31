@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Department</h2>
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="department_code">Department Code</label>
            <input type="text" name="department_code" id="department_code" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="department_name">Department Name</label>
            <input type="text" name="department_name" id="department_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="student_reg_number">Student Registration Number</label>
            <select name="student_reg_number" id="student_reg_number" class="form-control" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->StudentRegNumber }}">{{ $student->StudentRegNumber }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Department</button>
    </form>
</div>
@endsection

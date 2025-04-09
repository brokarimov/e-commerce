@extends('layouts.admin')

@section('content')

<div class="col-12">
    <a href="{{ route('user.index') }}" class="btn btn-primary mt-3 mb-2">Back</a>
    <h1>User Information</h1><br>
    <div class="col-4">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><label for="">Name</label></td>
                    <td>{{ $model->name }}</td>
                </tr>
                <tr>
                    <td><label for="">Email</label></td>
                    <td>{{ $model->email }}</td>
                </tr>
                <tr>
                    <td><label for="">Role</label></td>
                    <td>{{ $model->role }}</td>
                </tr>
                <tr>
                    <td><label for="">Status</label></td>
                    <td>
                        @if ($model->status == 1)
                        <span class="text-success">Active</span>
                        @else
                        <span class="text-danger">Inactive</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection
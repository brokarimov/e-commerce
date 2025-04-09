@extends('layouts.admin')

@section('content')

<div class="col-12">
    <a href="{{ route('product.index') }}" class="btn btn-primary mt-3 mb-2">Back</a>
    <h1>Product Information</h1><br>
    <div class="col-4">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><label for="">Name</label></td>
                    <td>{{ $model->name }}</td>
                </tr>
                <tr>
                    <td><label for="">Description</label></td>
                    <td>{{ $model->description }}</td>
                </tr>
                <tr>
                    <td><label for="">Category</label></td>
                    <td>
                        @foreach ($categories as $category)
                        @if ($category->id == $model->category_id)
                        {{ $category->name }}
                        @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td><label for="">Price</label></td>
                    <td>{{ $model->price }}</td>
                </tr>
                <tr>
                    <td><label for="">Count</label></td>
                    <td>{{ $model->count }}</td>
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
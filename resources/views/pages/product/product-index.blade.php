@extends('layouts.admin')

@section('content')

<div class="col-12">
    <h1>Product Management</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
        </svg>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <label for="">Name</label>
                        <input type="text" name="name" placeholder="Name" class="form-control">
                        @error('name')
                        <span class="text-danger">{{$message}}</span><br>
                        @enderror

                        <label for="">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description">
                        @error('description')
                        <span class="text-danger">{{$message}}</span><br>
                        @enderror

                        <label for="">Count</label>
                        <input type="text" name="count" class="form-control" placeholder="Count">
                        @error('count')
                        <span class="text-danger">{{$message}}</span><br>
                        @enderror

                        <label for="">Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Price">
                        @error('price')
                        <span class="text-danger">{{$message}}</span><br>
                        @enderror

                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control" placeholder="Image">
                        @error('image')
                        <span class="text-danger">{{$message}}</span><br>
                        @enderror

                        <label for="">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span><br>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="card mt-3">
        <div class="card-header">

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1>Products</h1>
                <form action="{{ route('product.search') }}" method="GET" class="d-flex">
                    <input
                        type="search"
                        name="name"
                        class="form-control mx-1"
                        placeholder="Search by name"
                        value="{{ request('name') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Count</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->name }}</td>
                        <td>{{ $model->count }}</td>
                        <td>{{ $model->price }}</td>
                        <td>
                            @if ($model->status == 1)
                            <a href="{{ route('product.status', $model->id) }}" class="btn btn-success">Inactive</a>
                            @else
                            <a href="{{ route('product.status', $model->id) }}" class="btn btn-danger">Active</a>

                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('product.delete', $model->id) }}" class="btn btn-outline-danger mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $model->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                    </svg>
                                </button>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $model->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $model->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel{{ $model->id }}">Edit Product</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('product.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">

                                                    <label for="">Name</label>
                                                    <input type="text" name="name" value="{{ $model->name }}" class="form-control">
                                                    @error('name')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                    @enderror

                                                    <label for="">Description</label>
                                                    <input type="text" name="description" value="{{ $model->description }}" class="form-control">
                                                    @error('description')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                    @enderror

                                                    <label for="">Count</label>
                                                    <input type="text" name="count" value="{{ $model->count }}" class="form-control">
                                                    @error('count')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                    @enderror

                                                    <label for="">Price</label>
                                                    <input type="text" name="price" value="{{ $model->price }}" class="form-control">
                                                    @error('price')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                    @enderror

                                                    <label for="">Image</label>
                                                    <input type="file" name="image" class="form-control" value="{{ old($model->image) }}">
                                                    @if ($model->image)
                                                    <img src="{{ asset($model->image) }}" width="100" class="mt-2">
                                                    @endif
                                                    @error('image')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                    @enderror

                                                    <label for="">Category</label>
                                                    <select name="category_id" class="form-control">
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $model->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                    @enderror

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('product.view', $model->id) }}" class="btn btn-outline-primary mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div>
                {{ $models->links()  }}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection
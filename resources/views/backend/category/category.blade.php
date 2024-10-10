@extends('backend.blank')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category Page</li>
    </ol>
</nav>

<div class="row">    
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title">Categories list</h6>
                </div>
                @if (session('deleted'))
                <div class="alert alert-success" role="alert">{{ session('deleted') }}</div>                
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Created_Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $categories as $key=> $category )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ asset('backend/category') }}/{{ $category->category_image }}" width="50" style="border-radius: 50%"></td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->created_at->DiffForHumans() }}</td>
                                <td><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#showData{{ $category->id }}">View</button></td>
                            </tr>
                                {{-- Modal for showing details --}}
                                <div class="modal fade" id="showData{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $category->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card flex-row">                                                        
                                                <div class="">
                                                    <img src="{{ asset('backend/category') }}/{{ $category->category_image }}" class="card-img-top" style="width: 120px; height:100%">
                                                </div>
                                                <div class="card-body">
                                                    
                                                    <p>{{ $category->slug }}</p>
                                                    
                                                <p class="card-text"><small class="text-muted">Last updated {{ $category->updated_at === NULL ? 'none' : $category->updated_at->DiffForHumans() }}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <a href="{{ route('category.delete',$category->id) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                                        </div>
                                    </div>
                                    </div>
                                </div>                                        
                                {{-- Modal for showing details end --}}                
                            @endforeach
                        </tbody>
                    </table>
                    @if ($categories->isEmpty())
                    <p class="m-auto position-absolute new-text-center" style="top: 50%; left:50%; transform:translate(-50%,0)">Category filed is empty</p>                                
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Create Category</h6>
                @if (session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <form class="forms-sample" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-1">
                        <label class="mt-2" for="name">Category Name</label>
                        <input type="text" class="form-control mb-2" name="name" placeholder="name">
                    </div>
                    @error('name')
                    <strong class="text-danger mb-2">{{ $message }}</strong>
                    @enderror
                   <div class="form-group mb-0">
                        <label>Category Image</label>
                        <input type="file" name="image" class="form-control mb-2" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img id="blah" width="100"/>
                        <br>
                    @error('image')
                    <strong class="text-danger mb-2">{{ $message }}</strong>
                    @enderror
                    </div>                    
                    <button type="submit" class="btn btn-primary mr-2 mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>    
@endsection
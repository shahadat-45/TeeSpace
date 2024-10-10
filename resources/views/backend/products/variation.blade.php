@extends('backend.blank')
@section('content')
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Product color list</h6>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>                   
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $key => $color)
                            <tr>
                                <th>{{ $key +1 }}</th>
                                <td>{{ $color->color_name }}</td>
                                <td>
                                    <div class="progress" style="width: 80px">
                                        <div class="progress-bar" role="progressbar" style="width: 100%; background-color: {{ $color->color_code ?? 'transparent' }} " aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><a href="{{ route('delete.color', $color->id ) }}"><button type="button" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </button></a></td>
                            </tr>                                    
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
		</div>
        <div class="col-lg-4 ml-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Add color</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.color') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="color_name">Color Name</label>
                            <input type="text" class="form-control" name="color_name">
                        </div>
                        <div class="form-group">
                            <label for="color_code">Color Code</label>
                            <input type="color" class="form-control" name="color_code">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Product Material list</h6>
                @if (session('material'))
                    <div class="alert alert-success">{{ session('material') }}</div>                   
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Material Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($material as $key => $material)
                            <tr>
                                <th>{{ $key +1 }}</th>
                                <td>{{ $material->material_name }}</td>
                                <td>
                                    <img src="{{ asset('backend') }}/material/{{ $material->image }}" width="80px" style="border-radius: 50%">
                                </td>
                                <td><a href="{{ route('delete.material', $material->id ) }}"><button type="button" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </button></a></td>
                            </tr>                                    
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
		</div>
        <div class="col-lg-4 ml-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Add Material</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.material') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="material_name">Material Name</label>
                            <input type="text" class="form-control" name="material_name">
                        </div>
                        <div class="form-group">
                            <label for="material_image"> Image</label>
                            <input type="file" class="form-control" name="material_image">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Product size table</h6>
                @if (session('size'))
                    <div class="alert alert-success">{{ session('size') }}</div>                   
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Size label</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($size as $key => $size)
                            <tr>
                                <th>{{ $key +1 }}</th>
                                <td>{{ $size->size }}</td>
                                <td><a href="{{ route('delete.size', $size->id) }}"><button type="button" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </button></a></td>
                            </tr>                                    
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
		</div>
        <div class="col-lg-4 ml-auto" id="size_table">
            <div class="card">
                <div class="card-header">
                    <h4>Add Size</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.size') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="size_name">Size label</label>
                            <input type="text" class="form-control" name="size_label">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
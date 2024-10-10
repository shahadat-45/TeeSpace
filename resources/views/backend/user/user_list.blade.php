@extends('backend.blank')
@section('content')
<div class="row">
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Users Table</h6>
            <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Joined Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)                                
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td><button type="button" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
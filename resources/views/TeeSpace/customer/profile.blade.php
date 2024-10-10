@extends('TeeSpace.blank')
@section('header_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
<style>
a {
    text-decoration: none;
    color: black;
}
.only__border{
    border: 1px solid rgb(0, 0, 0, 0.3);
}
.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
.edit_profile_image{
    transform: translateY(-50%);
    object-fit: cover;
    background-color: white;
    position: absolute;
    top: 240px;
    right: 65px;
    padding: 5px;
}
</style>
@endsection
@section('content')
<div class="container rounded bg-white mt-5 mb-5 only__border">
    <form action="{{ route('update.customer.profile') }}" method="POST" id="form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3 border-right" style="padding-bottom: 100px">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5" style="position: relative">
                        <img src="{{ asset('customer') }}/3270782-200.png" width="35px" height="35px" class="rounded-circle border-2 border-white edit_profile_image">
                        <input type="file" id="profile_image" name="profile_image" accept=".jpg, .jpeg, .png" class="position-absolute rounded-circle" style="top: 225px; overflow: hidden; width: 40px; opacity: 0; right: 64px;cursor: pointer;">
                    @if ($data->photo)
                    <img class="rounded-circle mt-5" id="blah" width="150px" height="150px" src="{{ asset('customer') }}/{{ $data->photo }}" style="object-fit: cover; margin-bottom: 20px">
                    @else    
                    <img class="rounded-circle mt-5" id="blah" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    @endif
                    <span class="font-weight-bold">{{ $data->full_name ?? '' }}</span>
                    <span class="text-black-50">{{ $data->email ?? '' }}</span>
                    <span> </span>
                </div>
                <ul class="dropdown-menu" style="display: block; position: static">
                    <li><a class="dropdown-item {{ request()->routeIs('customer.profile') ? 'active' : '' }}" href="{{ route('customer.profile') }}">My Orders</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('customer.wishlist') ? 'active' : '' }}" href="#">Wishlist</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('customer.profile.edit') ? 'active' : '' }}" href="{{ route('customer.profile.edit') }}">Update Profile</a></li>
                </ul>
        </div>
        @yield('profile')        
    </div>
</form>
</div>
</div>
</div>   
@endsection
@section('footer_script')
<script>
    document.getElementById("profile_image").onchange = function () {
        document.getElementById('form').submit();
    }
</script>
@endsection
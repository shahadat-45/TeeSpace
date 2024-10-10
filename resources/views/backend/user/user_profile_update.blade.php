@extends('backend.blank')
@section('content')
<div class="profile-page tx-13">
    @include('backend.user.user_profile_header')
    <div class="row profile-body">
        <!-- left wrapper start -->
        @include('backend.user.user_profile_left_wapper')
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-9 middle-wrapper">
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Update Profile</h6>
                            @if (session('updated'))
                                <div class="alert alert-success">{{ session('updated') }}</div>
                            @endif
                                <form action="{{ route('user.profile.update.post' , $users->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $users->name }}">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $users->phone ?? '' }}">
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Country</label>
                                                <input type="text" name="country"  class="form-control" value="{{ $users->country ?? '' }}">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">City</label>
                                                <input type="text" name="city" class="form-control" value="{{ $users->city ?? '' }}">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Zip</label>
                                                <input type="text" name="zip" class="form-control" value="{{ $users->zip ?? '' }}">
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Bio</label>
                                                <textarea name="bio" class="form-control" cols="30" rows="2" >{{ $users->bio ?? '' }}</textarea>                                                
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Email address</label>
                                                <input type="email" class="form-control" value="{{ $users->email ?? '' }}" name="email">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Password</label>
                                                <input type="password" class="form-control mb-2" name="password" placeholder="Password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                @if (session('pass_match'))
                                                    <span class="text-danger">{{ session('pass_match') }}</span>                                                    
                                                @endif
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Profile Photo</label>
                                                <input type="file" class="form-control mb-2" name="profile_pic" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                <img id="blah" width="100"/>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Cover Photo</label>
                                                <input type="file" class="form-control mb-2" name="cover_pic" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                                                <img id="blah2" width="100" />
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <button type="submit" class="btn btn-success submit">Update</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
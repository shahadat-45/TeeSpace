@extends('TeeSpace.customer.profile')
@section('profile')
<div class="col-md-5 border-right">
    <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Profile Settings</h4>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row mt-2">
            <div class="col-md-6"><label class="labels">Name</label><input type="text" name="name" class="form-control" placeholder="first name" value="{{ $data->full_name }}"></div>                    
        </div>
        <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" name="phone" class="form-control" placeholder="enter phone number" value="{{ $data->phone ?? '' }}"></div>
            <div class="col-md-12"><label class="labels">Address</label><input type="text" name="address" class="form-control" placeholder="enter address line 1" value="{{ $data->address ?? '' }}"></div>
            <div class="col-md-12"><label class="labels">State</label><input type="text" name="state" class="form-control" placeholder="enter address line 2" value=""></div>
            <div class="col-md-12"><label class="labels">Area</label><input type="text" name="area" class="form-control" placeholder="enter address line 2" value=""></div>
            <div class="col-md-12"><label class="labels">Email ID</label><input type="text" name="email" class="form-control" placeholder="enter email id" value="{{ $data->email }}"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label class="labels">Country</label>
                <select class="form-control" id="exampleFormControlSelect1" name="country">
                    <option selected="" disabled="">Country</option>
                    @foreach ($country as $country)                                
                    <option value="{{ $country->id }}" {{ $data->country == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
    </div>
</div>
<div class="col-md-4">
    <div class="p-3 pt-5">
        <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>                
        <div class="col-md-12"><label class="labels">Additional Details</label>
            <textarea name="bio" class="form-control" placeholder="additional details" cols="30" rows="10">{{ $data->bio ?? '' }}</textarea>
        </div>
    </div>
    <div class="card col-md-12" style="border: none">
        <div class="card-body">
            <h5 class="card-title">Change Password</h5>
            @if (session('pass_wrong'))
                <div class="alert alert-danger" role="alert">{{ session('pass_wrong') }}</div>
            @elseif (session('pass_match'))
                <div class="alert alert-danger" role="alert">{{ session('pass_match') }}</div>
            @endif
            <div class="form-group">
                <label for="old_pass" class="form-label">Old password</label>
                <input type="password" name="old_password" class="form-control" id="old_pass">
            </div>
            <div class="form-group">
                <label for="new_pass" class="form-label">New password</label>
                <input type="password" name="password" class="form-control" id="new_pass">
            </div>
            <div class="form-group">
                <label for="con_pass" class="form-label">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control" id="con_pass">
            </div>
        </div>
    </div>
</div>    
@endsection
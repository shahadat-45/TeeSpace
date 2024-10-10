@extends('backend.blank')
@section('content')
<div class="profile-page tx-13">
    @include('backend.user.user_profile_header')
    <div class="row profile-body">
        <!-- left wrapper start -->
        @include('backend.user.user_profile_left_wapper')
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-6 middle-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card rounded">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                                    <div class="ml-2">
                                        <p>Mike Popescu</p>
                                        <p class="tx-11 text-muted">1 min ago</p>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Unfollow</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy link</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus minima delectus nemo unde quae recusandae assumenda.</p>
                            <img class="img-fluid" src="https://via.placeholder.com/513x342" alt="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex post-actions">
                                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                    <i class="icon-md" data-feather="heart"></i>
                                    <p class="d-none d-md-block ml-2">Like</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                    <i class="icon-md" data-feather="message-square"></i>
                                    <p class="d-none d-md-block ml-2">Comment</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted">
                                    <i class="icon-md" data-feather="share"></i>
                                    <p class="d-none d-md-block ml-2">Share</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card rounded">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                                    <div class="ml-2">
                                        <p>Mike Popescu</p>
                                        <p class="tx-11 text-muted">5 min ago</p>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Unfollow</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy link</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <img class="img-fluid" src="https://via.placeholder.com/513x342" alt="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex post-actions">
                                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                    <i class="icon-md" data-feather="heart"></i>
                                    <p class="d-none d-md-block ml-2">Like</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                    <i class="icon-md" data-feather="message-square"></i>
                                    <p class="d-none d-md-block ml-2">Comment</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted">
                                    <i class="icon-md" data-feather="share"></i>
                                    <p class="d-none d-md-block ml-2">Share</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
        <!-- right wrapper start -->
        {{-- <div class="d-none d-xl-block col-xl-3 right-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card rounded">
                        <div class="card-body">
                            <h6 class="card-title">latest photos</h6>
                            <div class="latest-photos">
                                <div class="row">
                                    <div class="col-md-4">
                                        <figure>
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4">
                                        <figure>
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4">
                                        <figure>
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4">
                                        <figure>
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4">
                                        <figure>
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4">
                                        <figure>
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4">
                                        <figure class="mb-0">
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4">
                                        <figure class="mb-0">
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4">
                                        <figure class="mb-0">
                                            <img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 grid-margin">
                    <div class="card rounded">
                        <div class="card-body">
                            <h6 class="card-title">suggestions for you</h6>
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <div class="d-flex align-items-center hover-pointer">
                                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                                    <div class="ml-2">
                                        <p>Mike Popescu</p>
                                        <p class="tx-11 text-muted">12 Mutual Friends</p>
                                    </div>
                                </div>
                                <button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
                            </div>
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <div class="d-flex align-items-center hover-pointer">
                                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                                    <div class="ml-2">
                                        <p>Mike Popescu</p>
                                        <p class="tx-11 text-muted">12 Mutual Friends</p>
                                    </div>
                                </div>
                                <button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
                            </div>
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <div class="d-flex align-items-center hover-pointer">
                                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                                    <div class="ml-2">
                                        <p>Mike Popescu</p>
                                        <p class="tx-11 text-muted">12 Mutual Friends</p>
                                    </div>
                                </div>
                                <button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
                            </div>
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <div class="d-flex align-items-center hover-pointer">
                                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                                    <div class="ml-2">
                                        <p>Mike Popescu</p>
                                        <p class="tx-11 text-muted">12 Mutual Friends</p>
                                    </div>
                                </div>
                                <button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
                            </div>
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <div class="d-flex align-items-center hover-pointer">
                                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                                    <div class="ml-2">
                                        <p>Mike Popescu</p>
                                        <p class="tx-11 text-muted">12 Mutual Friends</p>
                                    </div>
                                </div>
                                <button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center hover-pointer">
                                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                                    <div class="ml-2">
                                        <p>Mike Popescu</p>
                                        <p class="tx-11 text-muted">12 Mutual Friends</p>
                                    </div>
                                </div>
                                <button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- right wrapper end -->
    </div>
</div>
@endsection
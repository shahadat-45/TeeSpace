<div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
    <div class="card rounded">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h6 class="card-title mb-0">About</h6>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="git-branch" class="icon-sm mr-2"></i> <span class="">Update</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View all</span></a>
                    </div>
                </div>
            </div>
            <p>{{ Auth::user()->bio }}</p>
            <div class="mt-3">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Joined:</label>
                <p class="text-muted">{{ Auth::user()->created_at->format('M-d-Y') }}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Lives:</label>
                <p class="text-muted">{{ Auth::user()->city ?? '' }}, {{ Auth::user()->country ?? '?' }}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                <p class="text-muted">{{ Auth::user()->email }}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Website:</label>
                <p class="text-muted">www.nobleui.com</p>
            </div>
            <div class="mt-3 d-flex social-links">
                <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon github">
                    <i data-feather="github" data-toggle="tooltip" title="github.com/nobleui"></i>
                </a>
                <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon twitter">
                    <i data-feather="twitter" data-toggle="tooltip" title="twitter.com/nobleui"></i>
                </a>
                <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon instagram">
                    <i data-feather="instagram" data-toggle="tooltip" title="instagram.com/nobleui"></i>
                </a>
            </div>
        </div>
    </div>
</div>
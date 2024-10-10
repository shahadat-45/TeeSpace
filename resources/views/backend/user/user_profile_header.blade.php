<div class="row">
    <div class="col-12 grid-margin">
        <div class="profile-header">
            <div class="cover">
                <div class="gray-shade"></div>
                <figure>
                    @if (Auth::user()->cover_pic)
                    <img src="{{ asset('backend') }}/user/{{ Auth::user()->cover_pic }}" style="object-fit: cover" alt="profile cover" height="272px">
                    @else
                    <img src="https://via.placeholder.com/1148x272" class="img-fluid" alt="profile cover">
                    @endif
                </figure>
                <div class="cover-body d-flex justify-content-between align-items-center">
                    <div>
                        @if (Auth::user()->profile_pic)
                        <img class="profile-pic" src="{{ asset('backend') }}/user/{{ Auth::user()->profile_pic }}" alt="profile">
                        @else
                        <img class="profile-pic" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="profile">
                        @endif
                        <a class="text-dark" href="{{ route('user.profile' , Auth::id()) }}"><span class="profile-name">{{ Auth::user()->name }}</span></a>
                        
                    </div>
                    <div class="d-none d-md-block">
                        <a href="{{ route('user.profile.update', Auth::id()) }}">
                        <button class="btn btn-primary btn-icon-text btn-edit-profile">
                            <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
                        </button></a>
                    </div>
                </div>
            </div>
            <div class="header-links">                              
            </div>
        </div>
    </div>
</div>
<!-- Main Header-->
<div class="main-header side-header hor-header top-header">
    <div class="container">
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="index.html"><img src="{{ asset('assets/img/brand/logo.png') }}" class="mobile-logo" alt="logo"></a>
                <a href="index.html"><img src="{{ asset('assets/img/brand/logo-light.png') }}" class="mobile-logo-dark" alt="logo"></a>
            </div>
        </div>
        <div class="main-header-right">
            <a class="header-brand2" href="index.html">
                <img src="{{ asset('assets/img/brand/logo.png') }}" class="logo-white top-header-logo1">
                <img src="{{ asset('assets/img/brand/logo-light.png') }}" class="logo-default top-header-logo2">
            </a>
            <div class="dropdown main-header-notification">
                <a class="nav-link icon" href="">
                    <i class="fe fe-bell header-icons"></i>
                    @php
                        use App\Models\Project;
                        use App\Models\Todolist;
                        $totalproject = Project::where('team_id', Auth::user()->team_id)->where('status', 0)->count();
                        $totaltask = Todolist::where('member_id', Auth::user()->id)->where('status', 0)->count();
                    @endphp
                    @role('leader developer')
                        @if ($totalproject > 0)
                            <span class="badge badge-danger nav-link-badge">{{ $totalproject }}</span>
                        @endif
                    @endrole

                    @hasrole('frontend developer|backend developer|mobile developer|UI/UX designer')
                        @if ($totaltask > 0)
                            <span class="badge badge-danger nav-link-badge">{{ $totaltask }}</span>
                        @endif
                    @endhasrole
                </a>
                <div class="dropdown-menu">
                    @php
                        // use App\Models\Project;
                        $project = Project::where('team_id', Auth::user()->team_id)->where('status', 0)->orderBy('id', 'desc')->take(5)->get();
                        $task = Todolist::selectRaw('projects.image, todolists.*')->join('projects', 'projects.id', '=', 'todolists.project_id')->where('todolists.member_id', Auth::user()->id)->where('todolists.status', 0)->orderBy('todolists.id', 'desc')->take(5)->get();
                    @endphp
                    @role('leader developer')
                        <div class="header-navheading">
                            <p class="main-notification-text">You have {{ $totalproject }} unread notification</p>
                        </div>
                        <div class="main-notification-list">
                            @foreach ($project as $data)
                                <a href="{{ route('leader.project.index') }}">
                                    <div class="media">
                                        <div class="main-img-user online"><img alt="avatar" src="{{ asset($data->image != null ? $data->image : 'assets/img/media/1.jpg') }}"></div>
                                        <div class="media-body">
                                            <p><strong>{{ $data->name }}</strong> is waiting to be accepted</p>
                                            <span>{{ Carbon\Carbon::parse($data->created_at)->format('j F Y') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endrole

                    @hasrole('frontend developer|backend developer|mobile developer|UI/UX designer')
                        <div class="header-navheading">
                            <p class="main-notification-text">You have {{ $totaltask }} unread notification</p>
                        </div>
                        <div class="main-notification-list">
                            @foreach ($task as $data)
                                <a href="{{ route('it.task.index') }}">
                                    <div class="media">
                                        <div class="main-img-user online">
                                            <img alt="avatar" src="{{ asset($data->image != null ? $data->image : 'assets/img/media/1.jpg') }}">
                                        </div>
                                        <div class="media-body">
                                            <p><strong>{{ $data->task }}</strong> is waiting to be accepted</p>
                                            <span>{{ Carbon\Carbon::parse($data->created_at)->format('j F Y') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endhasrole
                </div>
            </div>
            <div class="main-header-notification">
                <a class="nav-link icon" href="{{ route('chat.index') }}">
                    <i class="fe fe-message-square header-icons"></i>
                    @php
                        use App\Models\Chat;
                        $unreadmessage = Chat::where('to_id', Auth::user()->id)->where('status', 0)->count();
                    @endphp
                    @if ($unreadmessage > 0)
                        <span class="badge badge-danger nav-link-badge" id="totalmessage">{{ $unreadmessage }}</span>
                    @endif
                </a>
            </div>
            <div class="dropdown d-md-flex">
                <a class="nav-link icon full-screen-link" href="">
                    <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                    <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                </a>
            </div>
            <div class="dropdown main-profile-menu">
                <a class="d-flex" href="">
                    <span class="main-img-user"><img alt="avatar" src="{{ asset(Auth::user()->image) }}"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                        <p class="main-notification-text">{{ ucwords(Auth::user()->roles->first()->name) }}</p>
                    </div>
                    <a class="dropdown-item border-top" href="{{ route('profile.index') }}">
                        <i class="fe fe-user"></i> My Profile
                    </a>
                    @role('leader developer')
                        <a class="dropdown-item" href="{{ route('leader.project.index') }}">
                            <i class="fe fe-folder"></i> Project
                        </a>
                    @endrole
                    @hasrole('frontend developer|backend developer|mobile developer|UI/UX designer')
                        <a class="dropdown-item" href="">
                            <i class="fe fe-folder"></i> Project
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fe fe-list"></i> To-do List
                        </a>
                    @endhasrole
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a class="dropdown-item logout" href="javascript:void(0)">
                            <i class="fe fe-power"></i> Sign Out
                        </a>
                        <button type="submit" class="d-none btnlogout"></button>
                    </form>
                </div>
            </div>
            <button class="navbar-toggler navresponsive-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button><!-- Navresponsive closed -->
        </div>
    </div>
</div>
<!-- End Main Header-->

<!-- Mobile-header -->
<div class="mobile-main-header">
    <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown header-search">
                    <a class="nav-link icon header-search">
                        <i class="fe fe-search"></i>
                    </a>
                    <div class="dropdown-menu">
                        <div class="main-form-search p-2">
                            <div class="input-group">
                                <div class="input-group-btn search-panel">
                                    <select class="form-control select2-no-search">
                                        <option label="All categories">
                                        </option>
                                        <option value="IT Projects">
                                            IT Projects
                                        </option>
                                        <option value="Business Case">
                                            Business Case
                                        </option>
                                        <option value="Microsoft Project">
                                            Microsoft Project
                                        </option>
                                        <option value="Risk Management">
                                            Risk Management
                                        </option>
                                        <option value="Team Building">
                                            Team Building
                                        </option>
                                    </select>
                                </div>
                                <input type="search" class="form-control"
                                    placeholder="Search for anything...">
                                <button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65">
                                        </line>
                                    </svg></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown ">
                    <a class="nav-link icon full-screen-link">
                        <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                        <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                    </a>
                </div>
                <div class="dropdown main-header-notification">
                    <a class="nav-link icon" href="">
                        <i class="fe fe-bell header-icons"></i>
                        <span class="badge badge-danger nav-link-badge">4</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <p class="main-notification-text">You have 1 unread notification<span
                                    class="badge badge-pill badge-primary ml-3">View all</span></p>
                        </div>
                        <div class="main-notification-list">
                            <div class="media new">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="assets/img/users/5.jpg"></div>
                                <div class="media-body">
                                    <p>Congratulate <strong>Olivia James</strong> for New template start</p>
                                    <span>Oct 15 12:32pm</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="main-img-user"><img alt="avatar"
                                        src="assets/img/users/2.jpg"></div>
                                <div class="media-body">
                                    <p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13
                                        02:56am</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="assets/img/users/3.jpg"></div>
                                <div class="media-body">
                                    <p><strong>Elizabeth Lewis</strong> added new schedule realease</p><span>Oct
                                        12 10:40pm</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-footer">
                            <a href="#">View All Notifications</a>
                        </div>
                    </div>
                </div>
                <div class="main-header-notification mt-2">
                    <a class="nav-link icon" href="chat.html">
                        <i class="fe fe-message-square header-icons"></i>
                        <span class="badge badge-success nav-link-badge">6</span>
                    </a>
                </div>
                <div class="dropdown main-profile-menu">
                    <a class="d-flex" href="#">
                        <span class="main-img-user"><img alt="avatar"
                                src="assets/img/users/1.jpg"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <h6 class="main-notification-title">Sonia Taylor</h6>
                            <p class="main-notification-text">Web Designer</p>
                        </div>
                        <a class="dropdown-item border-top" href="profile.html">
                            <i class="fe fe-user"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-edit"></i> Edit Profile
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-settings"></i> Account Settings
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-settings"></i> Support
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-compass"></i> Activity
                        </a>
                        <a class="dropdown-item" href="signin.html">
                            <i class="fe fe-power"></i> Sign Out
                        </a>
                    </div>
                </div>
                <div class="dropdown  header-settings">
                    <a href="#" class="nav-link icon" data-toggle="sidebar-right"
                        data-target=".sidebar-right">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-align-right header-icons">
                            <line x1="21" y1="10" x2="7" y2="10"></line>
                            <line x1="21" y1="6" x2="3" y2="6"></line>
                            <line x1="21" y1="14" x2="3" y2="14"></line>
                            <line x1="21" y1="18" x2="7" y2="18"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile-header closed -->

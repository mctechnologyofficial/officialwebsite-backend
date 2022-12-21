@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="row square">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel profile-cover">
                        <div class="profile-cover__img">
                            <img id="usrimg" src="{{ asset($user->image) }}" alt="img" />
                            <form id="formimage" action="{{ route('profile.updateimage') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <input type="file" name="image" id="inputimg" class="d-none" accept="image/*" />
                            </form>
                            <h3 class="h3">{{ $user->name }}</h3>
                            <h5 class="text-muted">{{ ucwords($user->roles->first()->name) }}</h5>
                        </div>
                        <div class="btn-profile">
                            <a href="{{ Auth::user()->github_url }}" target="_blank" class="btn btn-rounded btn-info mx-1">
                                <i class="fa-brands fa-github"></i>
                            </a>
                            <a href="{{ Auth::user()->facebook_url }}" target="_blank" class="btn btn-rounded btn-info mx-1">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="{{ Auth::user()->twitter_url }}" target="_blank" class="btn btn-rounded btn-info mx-1">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="{{ Auth::user()->instagram_url }}" target="_blank" class="btn btn-rounded btn-info mx-1">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="{{ Auth::user()->linkedin_url }}" target="_blank" class="btn btn-rounded btn-info mx-1">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        </div>
                        <div class="profile-cover__action bg-img"></div>
                        <div class="profile-cover__info">
                            <ul class="nav">
                                <li>@hasrole('admin|marketing|owner') <br><br> @endhasrole @hasrole('leader developer|frontend developer|backend developer|mobile developer|UI/UX designer') <strong>{{ $projecttotal }}</strong>Projects @endhasrole</li>
                            </ul>
                        </div>
                    </div>
                    <div class="profile-tab tab-menu-heading">
                        <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
                            @if(request()->routeIs('profile.index'))
                                <a class="nav-link" data-toggle="tab" href="#edit">Edit Profile</a>
                            @endif
                            <a class="nav-link @hasrole('admin|marketing|owner') d-none @endhasrole" data-toggle="tab" href="#timeline">Timeline</a>
                            <a class="nav-link @hasrole('admin|marketing|owner') d-none @endhasrole" data-toggle="tab" href="#gallery">Project</a>
                            <a class="nav-link @hasrole('admin|marketing|owner') d-none @endhasrole" data-toggle="tab" href="#friends">Team</a>
                            <a class="nav-link" data-toggle="tab" href="#settings">Account Settings</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card main-content-body-profile">
                <div class="tab-content">
                    <div class="main-content-body tab-pane p-4 border-top-0 {{ request()->routeIs('profile.index') ? 'active' : '' }}" id="edit">
                        <div class="card-body border">
                            <div class="mb-4 main-content-label">Personal Information</div>
                            @if ($message = Session::get('success'))
                                <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
                                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

                                <script>
                                    Toastify({
                                        avatar: "{{ asset('assets/img/brand/logo-mc.png') }}",
                                        text: {!! json_encode($message) !!},
                                        duration: 5000,
                                        destination: "https://github.com/apvarun/toastify-js",
                                        newWindow: true,
                                        close: true,
                                        gravity: "bottom", // `top` or `bottom`
                                        position: "right", // `left`, `center` or `right`
                                        stopOnFocus: true, // Prevents dismissing of toast on hover
                                        style: {
                                            background: "#49b462",
                                            color: '#fff',
                                        },
                                        onClick: function(){} // Callback after click
                                    }).showToast();
                                </script>
                            @endif
                            <form autocomplete="off" action="{{ route('profile.update') }}" class="form-horizontal" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Email</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Position</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" name="position" class="form-control" value="{{ ucwords(Auth::user()->roles->first()->name) }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Github URL</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="github_url" class="form-control" value="{{ Auth::user()->github_url }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Facebook URL</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="facebook_url" class="form-control" value="{{ Auth::user()->facebook_url }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Twitter URL</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="twitter_url" class="form-control" value="{{ Auth::user()->twitter_url }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Instagram URL</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="instagram_url" class="form-control" value="{{ Auth::user()->instagram_url }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">LinkedIn URL</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="linkedin_url" class="form-control" value="{{ Auth::user()->linkedin_url }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-outline-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="main-content-body  tab-pane border-top-0 {{ request()->routeIs('profile.show') ? 'active' : '' }}" id="timeline">
                        <div class="border p-4">
                            <div class="main-content-body main-content-body-profile">
                                <div class="main-profile-body p-0">
                                    <div class="row row-sm">
                                        <div class="col-12">
                                            <div class="card mg-b-20 border">
                                                <div class="card-header p-4">
                                                    <div class="media">
                                                        <div class="media-user mr-2">
                                                            <div class="main-img-user avatar-md"><img alt=""
                                                                    class="rounded-circle"
                                                                    src="../../assets/img/users/6.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 mg-t-2 ml-2">Mintrona Pechon Pechon</h6><span
                                                                class="text-primary ml-2">just now</span>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <div class="dropdown show"> <a class="new option-dots2"
                                                                    data-toggle="dropdown" href="JavaScript:void(0);"><i
                                                                        class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right shadow"> <a
                                                                        class="dropdown-item" href="#">Edit Post</a>
                                                                    <a class="dropdown-item" href="#">Delete
                                                                        Post</a> <a class="dropdown-item"
                                                                        href="#">Personal Settings</a> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <p class="mg-t-0">There are many variations of passages of Lorem Ipsum
                                                        available, but the majority have suffered alteration in some form,
                                                        by injected humour, or randomised words which don't look even
                                                        slightly believable.</p>
                                                    <div class="row row-sm">
                                                        <div class="col"> <img alt="img" class="wd-200 mr-4"
                                                                src="../../assets/img/media/1.jpg"> <img alt="img"
                                                                class="wd-200" src="../../assets/img/media/2.jpg"> </div>
                                                    </div>
                                                    <div class="media mg-t-15 profile-footer">
                                                        <div class="media-user mr-2">
                                                            <div class="demo-avatar-group">
                                                                <div class="demo-avatar-group main-avatar-list-stacked">
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/12.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/12.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/3.jpg"></div>
                                                                    <div class="main-img-user online"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/5.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/6.jpg"></div>
                                                                    <div class="main-avatar"> +23 </div>
                                                                </div>
                                                                <!-- demo-avatar-group -->
                                                            </div>
                                                            <!-- demo-avatar-group -->
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 mg-t-10">28 people like your photo</h6>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <div class="dropdown show"> <a class="new"
                                                                    href="JavaScript:void(0);"><i
                                                                        class="far fa-heart mr-3"></i></a> <a
                                                                    class="new" href="JavaScript:void(0);"><i
                                                                        class="far fa-comment mr-3"></i></a> <a
                                                                    class="new" href="JavaScript:void(0);"><i
                                                                        class="far fa-share-square"></i></a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mg-b-20 border">
                                                <div class="card-header p-4">
                                                    <div class="media">
                                                        <div class="media-user mr-2">
                                                            <div class="main-img-user avatar-md"><img alt=""
                                                                    class="rounded-circle"
                                                                    src="../../assets/img/users/6.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 ml-2 mg-t-3">Mintrona Pechon Pechon</h6><span
                                                                class="text-muted ml-2">Sep 26 2019, 10:14am</span>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <div class="dropdown show"> <a class="new option-dots2"
                                                                    data-toggle="dropdown" href="JavaScript:void(0);"><i
                                                                        class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right shadow"> <a
                                                                        class="dropdown-item" href="#">Edit Post</a>
                                                                    <a class="dropdown-item" href="#">Delete
                                                                        Post</a> <a class="dropdown-item"
                                                                        href="#">Personal Settings</a> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body h-100">
                                                    <p class="mg-t-0">There are many variations of passages of Lorem Ipsum
                                                        available, but the majority have suffered alteration in some form,
                                                        by injected humour, or randomised words which don't look even
                                                        slightly believable.</p>
                                                    <div class="row row-sm">
                                                        <div class="col"> <img alt="img" class="wd-200 mr-4"
                                                                src="../../assets/img/media/4.jpg"> <img alt="img"
                                                                class="wd-200" src="../../assets/img/media/5.jpg"> </div>
                                                    </div>
                                                    <div class="media mg-t-15 profile-footer">
                                                        <div class="media-user mr-2">
                                                            <div class="demo-avatar-group">
                                                                <div class="demo-avatar-group main-avatar-list-stacked">
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/12.jpg"></div>
                                                                    <div class="main-img-user online"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/7.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/2.jpg"></div>
                                                                    <div class="main-img-user online"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/5.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/6.jpg"></div>
                                                                    <div class="main-avatar"> +23 </div>
                                                                </div>
                                                                <!-- demo-avatar-group -->
                                                            </div>
                                                            <!-- demo-avatar-group -->
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 mg-t-10">28 people like your photo</h6>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <div class="dropdown show"> <a class="new"
                                                                    href="JavaScript:void(0);"><i
                                                                        class="far fa-heart mr-3"></i></a> <a
                                                                    class="new" href="JavaScript:void(0);"><i
                                                                        class="far fa-comment mr-3"></i></a> <a
                                                                    class="new" href="JavaScript:void(0);"><i
                                                                        class="far fa-share-square"></i></a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mg-b-20 border">
                                                <div class="card-header p-4">
                                                    <div class="media">
                                                        <div class="media-user mr-2">
                                                            <div class="main-img-user avatar-md"><img alt=""
                                                                    class="rounded-circle"
                                                                    src="../../assets/img/users/6.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 ml-2 mg-t-3">Mintrona Pechon Pechon</h6><span
                                                                class="text-muted ml-2">Sep 26 2019, 10:14am</span>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <div class="dropdown show"> <a class="new option-dots2"
                                                                    data-toggle="dropdown" href="JavaScript:void(0);"><i
                                                                        class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right shadow"> <a
                                                                        class="dropdown-item" href="#">Edit Post</a>
                                                                    <a class="dropdown-item" href="#">Delete
                                                                        Post</a> <a class="dropdown-item"
                                                                        href="#">Personal Settings</a> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body h-100">
                                                    <p class="mg-t-0">There are many variations of passages of Lorem Ipsum
                                                        available, but the majority have suffered alteration in some form,
                                                        by injected humour, or randomised words which don't look even
                                                        slightly believable.</p>
                                                    <div class="media mg-t-15 profile-footer">
                                                        <div class="media-user mr-2">
                                                            <div class="demo-avatar-group">
                                                                <div class="demo-avatar-group main-avatar-list-stacked">
                                                                    <div class="main-img-user online"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/12.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/3.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/4.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/9.jpg"></div>
                                                                    <div class="main-img-user online"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/10.jpg"></div>
                                                                    <div class="main-avatar"> +23 </div>
                                                                </div>
                                                                <!-- demo-avatar-group -->
                                                            </div>
                                                            <!-- demo-avatar-group -->
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 mg-t-10">28 people like your photo</h6>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <div class="dropdown show"> <a class="new"
                                                                    href="JavaScript:void(0);"><i
                                                                        class="far fa-heart mr-3"></i></a> <a
                                                                    class="new" href="JavaScript:void(0);"><i
                                                                        class="far fa-comment mr-3"></i></a> <a
                                                                    class="new" href="JavaScript:void(0);"><i
                                                                        class="far fa-share-square"></i></a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card border">
                                                <div class="card-header p-4">
                                                    <div class="media">
                                                        <div class="media-user mr-2">
                                                            <div class="main-img-user avatar-md"><img alt=""
                                                                    class="rounded-circle"
                                                                    src="../../assets/img/users/2.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 ml-2 mg-t-3">Mintrona Pechon Pechon</h6><span
                                                                class="text-muted ml-2">Sep 26 2019, 10:14am</span>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <div class="dropdown show"> <a class="new option-dots2"
                                                                    data-toggle="dropdown" href="JavaScript:void(0);"><i
                                                                        class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right shadow"> <a
                                                                        class="dropdown-item" href="#">Edit Post</a>
                                                                    <a class="dropdown-item" href="#">Delete
                                                                        Post</a> <a class="dropdown-item"
                                                                        href="#">Personal Settings</a> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body h-100">
                                                    <p class="mg-t-0">There are many variations of passages of Lorem Ipsum
                                                        available, but the majority have suffered alteration in some form,
                                                        by injected humour, or randomised words which don't look even
                                                        slightly believable.</p>
                                                    <div class="row row-sm">
                                                        <div class="col"> <img alt="img" class="wd-200 mr-3"
                                                                src="../../assets/img/media/4.jpg"> <img alt="img"
                                                                class="wd-200" src="../../assets/img/media/7.jpg"> </div>
                                                    </div>
                                                    <div class="media mg-t-15 profile-footer">
                                                        <div class="media-user mr-2">
                                                            <div class="demo-avatar-group">
                                                                <div class="demo-avatar-group main-avatar-list-stacked">
                                                                    <div class="main-img-user online"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/11.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/12.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/3.jpg"></div>
                                                                    <div class="main-img-user"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/4.jpg"></div>
                                                                    <div class="main-img-user online"><img alt=""
                                                                            class="rounded-circle"
                                                                            src="../../assets/img/users/5.jpg"></div>
                                                                    <div class="main-avatar"> +23 </div>
                                                                </div>
                                                                <!-- demo-avatar-group -->
                                                            </div>
                                                            <!-- demo-avatar-group -->
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 mg-t-10">28 people like your photo</h6>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <div class="dropdown show"> <a class="new"
                                                                    href="JavaScript:void(0);"><i
                                                                        class="far fa-heart mr-3"></i></a> <a
                                                                    class="new" href="JavaScript:void(0);"><i
                                                                        class="far fa-comment mr-3"></i></a> <a
                                                                    class="new" href="JavaScript:void(0);"><i
                                                                        class="far fa-share-square"></i></a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- main-profile-body -->
                            </div>
                        </div>
                    </div>
                    <div class="main-content-body p-4 border tab-pane border-top-0" id="gallery">
                        <div class="card-body border">
                            <div class="demo-gallery">
                                <ul id="lightgallery" class="list-unstyled row row-sm">
                                    @foreach ($project as $data)
                                        <li class="col-sm-6 col-lg-4" data-responsive="{{ asset($data->image != null ? $data->image : 'assets/img/media/1.jpg') }}" data-src="{{ asset($data->image != null ? $data->image : 'assets/img/media/1.jpg') }}" data-sub-html="<h4>{{ $data->name }}</h4>">
                                            <a href="javascript:void(0)" class="wd-100p">
                                                <img class="img-thumbnail mb-4 wd-100p" src="{{ asset($data->image != null ? $data->image : 'assets/img/media/1.jpg') }}" alt="Thumb-1">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="main-content-body tab-pane border-top-0" id="friends">
                        <div class="card-body border pd-b-10">
                            <!-- row -->
                            <div class="row row-sm">
                                @foreach ($team as $data)
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                    <div class="card custom-card border">
                                        <div class="card-body text-center">
                                            <div class="user-lock text-center">
                                                <div class="dropdown text-right">
                                                    <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical"></i> </a>
                                                    @if ($data->id == Auth::user()->id)
                                                        @if (request()->routeIs('profile.show'))
                                                            <div class="dropdown-menu dropdown-menu-right shadow">
                                                                <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fe fe-eye mr-2"></i> Back to your profile</a>
                                                            </div>
                                                        @else

                                                        @endif
                                                    @else
                                                        <div class="dropdown-menu dropdown-menu-right shadow">
                                                            <a class="dropdown-item" href="#"><i class="fe fe-message-square mr-2"></i> Message</a>
                                                            <a class="dropdown-item" href="{{ route('profile.show', $data->id) }}"><i class="fe fe-eye mr-2"></i> View</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <img alt="avatar" class="rounded-circle" src="{{ asset($data->image) }}">
                                            </div>
                                            <h5 class=" mb-1 mt-3 main-content-label">@if($data->name == Auth::user()->name) You @else {{ $data->name }} @endif</h5>
                                            <p class="mb-2 mt-1 tx-inverse">{{ ucwords($data->roles->first()->name) }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="main-content-body tab-pane p-4 border-top-0" id="settings">
                        <div class="card-body border" data-select2-id="12">
                            <form autocomplete="off" action="{{ route('profile.updatepassword') }}" class="form-horizontal" data-select2-id="11" method="POST">
                                @csrf
                                @method('put')
                                <div class="mb-4 main-content-label">Account</div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Current Password</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="currentpassword" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">New Password</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="password" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Confirm Password</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="c_password" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-12 text-right">
                                            <input type="submit" class="btn btn-outline-primary" value="Save" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mb-4 main-content-label">Security Settings</div>
                            <div class="form-group ">
                                <div class="row row-sm">
                                    <div class="col-md-3">
                                        <label class="form-label">Password Verification</label>
                                    </div>
                                    <div class="col-md-9">
                                        <label class="ckbox mg-b-10-f">
                                        <input type="checkbox"><span>Require Personal Details</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row row-sm">
                                    <div class="col-md-3">
                                        <form action="{{ route('profile.destroy') }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a class="mg-r-20" href="#" id="textdeactive">Delete Account</a>
                                            <button type="submit" class="d-none" id="deactive"></button>
                                        </form>
                                    </div>
                                    <div class="col-md-9"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@section('js')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            $('#textdeactive').on('click', function(){
                $('#deactive').click();
            });

            $('#usrimg').on('click', function(){
                $('#inputimg').click();
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#usrimg').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#inputimg").change(function(e){
                readURL(this);
                let data = e.target.files[0];
                var formData = new FormData();
                formData.append('image', data);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('profile.updateimage') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if(response) {
                            Toastify({
                                avatar: "{{ asset('assets/img/brand/logo-mc.png') }}",
                                text: "Image has been updated successfully !",
                                duration: 5000,
                                destination: "https://github.com/apvarun/toastify-js",
                                newWindow: true,
                                close: true,
                                gravity: "bottom", // `top` or `bottom`
                                position: "right", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "#49b462",
                                    color: '#fff',
                                },
                                onClick: function(){} // Callback after click
                            }).showToast();
                        }
                    }
                });
            });
        });
    </script>
@endsection

@extends('layouts.app')
@section('title', 'Add Member')

@section('content')
    <div class="row row-sm mb-3">
        <div class="col-lg-12">
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
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.member.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputPassword1">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Position</label>
                            <select name="position" class="form-control @error('position') is-invalid @enderror" id="exampleInputPassword1">
                                <option value="" selected disabled>Choose position</option>
                                @foreach ($role as $data)
                                    <option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Team</label>
                            <select name="team_id" class="form-control @error('team_id') is-invalid @enderror" id="exampleInputPassword1">
                                <option value="" selected disabled>Choose team</option>
                                <option value="">None</option>
                                @foreach ($team as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @error('team_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Github URL</label>
                            <input type="text" name="github_url" class="form-control @error('github_url') is-invalid @enderror" id="exampleInputPassword1">
                            @error('github_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Facebook URL</label>
                            <input type="text" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" id="exampleInputPassword1">
                            @error('facebook_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Twitter URL</label>
                            <input type="text" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" id="exampleInputPassword1">
                            @error('twitter_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Instagram URL</label>
                            <input type="text" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" id="exampleInputPassword1">
                            @error('instagram_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">LinkedIn URL</label>
                            <input type="text" name="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" id="exampleInputPassword1">
                            @error('linkedin_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <img src="#" class="img-thumbnail w-25 my-3" id="image" />
                            <div class="input-group file-browser">
                                <input id="textfile" type="text" class="form-control border-right-0 browse-file @error('image') is-invalid @enderror" placeholder="Choose image" readonly />
                                <label class="input-group-btn">
                                    <span class="btn btn-primary">
                                        Browse <input type="file" style="display: none;" name="image" id="inputimage" accept="image/*" />
                                    </span>
                                </label>
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputimage").change(function(){
            readURL(this);
            var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
            $('#textfile').val(filename);
        });
    </script>
@endsection

@extends('layouts.app')
@section('title', 'Add Project')

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
                    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Project Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputPassword1">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Programming Language</label>
                            <input type="text" name="programming_language" class="form-control @error('programming_language') is-invalid @enderror" id="exampleInputEmail">
                            @error('programming_language')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Handle By Team</label>
                            <select name="team_id" id="teamid" class="form-control @error('team_id') is-invalid @enderror" id="exampleInputPassword1">
                                <option value="" selected disabled>Choose team</option>
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
                            <label for="exampleInputPassword1" class="form-label">Leader</label>
                            <input type="hidden" name="leader_id" id="leaderid">
                            <input type="text" id="leadername" class="form-control @error('leader_id') is-invalid @enderror" id="exampleInputPassword1" readonly />
                            @error('leader_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Github Repository URL</label>
                            <input type="text" name="github_repository" class="form-control @error('github_repository') is-invalid @enderror" id="exampleInputPassword1">
                            @error('github_repository')
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
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function createUser(response) {
            var len = 0;
            $("#leaderid").val('');
            $("#leadername").val('');

            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i = 0; i < len; i++){
                    var id = response['data'][i].id;
                    var name = response['data'][i].name;

                    $("#leaderid").val(id);
                    $("#leadername").val(name);
                }
            }else{
                $("#leaderid").val('');
                $("#leadername").val('');
            }
        }

        $("#inputimage").change(function(){
            readURL(this);
            var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
            $('#textfile').val(filename);
        });

        $('#teamid').on('change', function(){
            $.ajax({
                url: '/project/getuser',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    teamid: $(this).val()
                },
                dataType: 'json',
                success: function(response){
                    createUser(response);
                }
            });
        });
    </script>
@endsection

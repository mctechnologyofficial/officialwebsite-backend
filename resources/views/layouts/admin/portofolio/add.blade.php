@extends('layouts.app')

@section('title', 'Add Portofolio')

@section('content')
<div class="row row-sm">
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
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Project Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="company_name">Company name</label>
                        <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" id="company_name">
                        @error('company_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="10">

                       </textarea>
                       @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                       @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
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

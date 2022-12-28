@extends('layouts.home')
@section('title')
    <title>Documents | HR-Soft</title>
@endsection
@section('styles')
    <link href="/css/compact-gallery.css" rel="stylesheet">
    <style>
        dl,
        ol,
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .imgPreview img {
            padding: 8px;
            max-width: 250px;
        }
    </style>
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Upload</strong><span class="small ms-1">Documents</span>
                        </div>
                        <div class="card-body">
                            <section class="gallery-block cards-gallery">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($uploaded as $up)
                                            @if ($up->user_id == $users->id)
                                                @foreach (json_decode($up->name) as $image)
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="card border-0 transform-on-hover">
                                                            <a target="_blank"
                                                                href="/UploadedDocuments/{{ $image }}">
                                                                <img src="/UploadedDocuments/{{ $image }}"
                                                                    alt="{{ $image }}" class="card-img-top">
                                                            </a>
                                                            <div class="card-body">
                                                                <p>{{ $image }}</p>
                                                                @if (Auth::user()->status == 0)
                                                                <a href="/UploadedDocuments/{{ $image }}"
                                                                class="btn btn-sm btn-primary text-white"
                                                                download="{{ $image }}">
                                                                <i class="fas fa-download"></i> Download</a>
                                                                @endif   
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </section>
                                <form action="{{ route('imageUpload') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $users->id }}">
                                    <div class="user-image mb-3 text-center">
                                        <div class="imgPreview"> </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="imageFile[]" class="form-control" id="images"
                                            multiple="multiple">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                        Upload Images
                                    </button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>
@endsection

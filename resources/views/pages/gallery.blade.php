@extends('layouts.home')
@section('title')
    <title>Gallery | HR-Soft</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/grid-gallery.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
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
            <div class="card mb-4">
                <div class="card-body">
                    <section class="gallery-block grid-gallery">
                        <div class="container">
                            <div class="heading">
                                <h2>Gallery</h2>
                                @if (Auth::user()->status == 0)
                                    <a class="btn btn-sm btn-primary float-end" data-coreui-toggle="modal"
                                        data-coreui-target="#addImageModal"><svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                                        </svg> Add Images</a>
                                @endif
                                <div class="modal fade" id="addImageModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Images</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('galleryUpload') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="user-image mb-3 text-center">
                                                        <div class="imgPreview"> </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="file" name="imageFile[]" class="form-control"
                                                            id="images" multiple="multiple">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-coreui-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($galleries as $item)
                                    @foreach (json_decode($item->name) as $image)
                                        <div class="col-md-6 col-lg-4 item">
                                            <a class="lightbox"
                                                href="/Gallery/{{ $image }}">
                                                <img class="img-fluid image scale-on-hover" style="object-fit: cover; width: 100%; height: 250px"
                                                    src="/Gallery/{{ $image }}">
                                            </a>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.grid-gallery', {
            animation: 'slideIn'
        });
    </script>
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

@extends('layouts.home')
@section('title')
    <title>Announcements | HR-Soft</title>
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Announcements</strong>
                    @if (Auth::user()->status == 0)
                        <button type="button" class="btn btn-primary float-end" data-coreui-toggle="modal"
                            data-coreui-target="#addAnnouncement">
                            <svg class="icon">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                            </svg>Add
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Heading</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcements as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->heading }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="/view-announcements/{{ $item->id }}"
                                                class="btn btn-sm btn-primary m-1">View</a>
                                            @if (Auth::user()->status == 0)
                                                <a href="" class="btn btn-sm btn-warning m-1 text-white"
                                                    data-coreui-toggle="modal"
                                                    data-coreui-target="#updateAnnouncement{{ $item->id }}"><svg
                                                        class="icon">
                                                        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-pencil">
                                                        </use>
                                                    </svg>
                                                    <div class="modal fade" id="updateAnnouncement{{ $item->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        Announcement</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-coreui-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form action="/update-announcement/{{ $item->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="formGroupExampleInput"
                                                                                class="form-label">Heading</label>
                                                                            <input type="text" name="heading"
                                                                                class="form-control"
                                                                                id="formGroupExampleInput"
                                                                                value="{{ $item->heading }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="formGroupExampleInput"
                                                                                class="form-label">Event</label>
                                                                            <textarea placeholder="Event" name="event" id="textarea" cols="30" rows="10">{{ $item->event }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-coreui-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="/delete-announcement/{{ $item->id }}"
                                                    class="btn btn-sm btn-danger m-1 text-white"
                                                    onclick="return confirm('Are you sure?');"><svg class="icon">
                                                        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-trash">
                                                        </use>
                                                    </svg></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAnnouncement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add-announcement') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Heading</label>
                            <input type="text" name="heading" class="form-control" id="formGroupExampleInput"
                                placeholder="Heading">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Event</label>
                            <textarea placeholder="Event" name="event" id="textarea" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.tiny.cloud/1/2vs69j3qoqxd2osmkgudoiqa7oq8pt9wdeuivfwqaewog53a/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#textarea',
            height: 300
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
@endsection

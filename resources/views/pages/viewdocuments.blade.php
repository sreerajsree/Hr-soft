@extends('layouts.home')
@section('title')
    <title>View Documents | HR-Soft</title>
@endsection

@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>View</strong><span class="small ms-1">Documents</span>
                        </div>
                            <div class="card-body table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%" data-order="[[ 1, &quot;asc&quot; ]]">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Documents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($uploaded as $upds)
                                            <tr>
                                                <td>{{ $upds->id }}</td>
                                                <td>{{ $upds->name }}</td>
                                                <td>
                                                    @if ($upds->company_id == 3)
                                                        <button class="btn btn-primary">Apsensys</button>
                                                        
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach (json_decode($upds->doc_name) as $img)
                                                        <a href="{{ asset('UploadedDocuments/'.$img) }}" target="_blank">
                                                            <img src="{{ asset('UploadedDocuments/'.$img) }}" width="50" height="50">
                                                        </a>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
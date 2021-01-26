@extends('backend.layout.master')

@section('title')
<title>Report Section</title>
@endsection

@push('css')
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('page_index')
    {{"By Department Report"}}
@endsection

@section('main_content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Download Types</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Department Name</th>
                            <th>View Report</th>
                        </tr>
                    </thead>
                    @php
                        $i=1;
                    @endphp
                    <tbody>
                        @foreach ($departments as $dept)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $dept->name }}</td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $dept->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                        $i++;
                                    @endphp
                                    {{-- sending encrypted data into FacultyCRUDcontroller edit function --}}
                                    @can('department-can-view')
                                        <a class="btn btn-primary" href="{{ route('r_by_dept.view', $editID) }}"> <i class="fas fa-eye"></i> view</a>   
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@endsection

@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/datatables.init.js') }}"></script>
@endpush

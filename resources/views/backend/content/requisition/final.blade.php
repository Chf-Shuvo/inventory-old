@extends('backend.layout.master')

@section('title')
<title>Submitted Requisitions</title>
@endsection

@push('css')
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main_content')
<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
{{-- Delivery pending list --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Delivery Status: <span class="text-warning">Pending</span></h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Requisition ID</th>
                            <th>Department</th>
                            <th>Dep. Reg. Approval</th>
                            <th>Register's Approval</th>
                            <th>Delivery Status</th>
                            <th>Delivered By</th>
                            <th>Received By</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($requisitions_app as $requisition_a)
                            <tr>
                                <td>{{ 'Req: #'.$requisition_a->id }}</td>
                                <td>{{ $dept = \App\Department::where('id','=',$requisition_a->department)->value('name') }}</td>
                                <td>@if ($requisition_a->app_dpr == '0')
                                        <span class="text-danger">Not Approved Yet</span>
                                    @else
                                        <span class="text-success">Approved</span>
                                    @endif
                                </td>
                                <td>@if ($requisition_a->app_r == '0')
                                        <span class="text-danger">Not Approved Yet</span>
                                    @else
                                        <span class="text-success">Approved</span>
                                    @endif
                                </td>
                                <td>@if ($requisition_a->delivery_status == '0')
                                        <span class="text-warning">Processing</span>
                                    @else
                                        <span class="text-success">Delivered</span>
                                    @endif
                                </td>
                                <td>{{ $requisition_a->delivered_by }}</td>
                                <td>{{ $requisition_a->receiver }}</td>
                                <td>{{ $requisition_a->updated_at }}</td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $requisition_a->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                        // check if invoice is already done
                                        $inCheck = \App\Invoice::where('reqID',$requisition_a->id)->first();
                                    @endphp
                                    {{-- <a class="btn btn-success" href="#"> <i class="far fa-eye"></i> </a> --}}
                                    {{-- sending encrypted data into FacultyCRUDcontroller edit function --}}
                                    @can('view-requisition')
                                        <a class="btn btn-info" href="{{ route('approved.view',$editID) }}"><i class="fas fa-eye"></i> view</a> 
                                    @endcan
                                    @can('create-invoice')
                                        @if (empty($inCheck))
                                            <a class="btn btn-success" href="{{ route('invoice.create',$editID) }}"><i class="fas fa-eye"></i> invoice</a>
                                        @endif 
                                    @endcan
                                    @can('deliver-requisition', Model::class)
                                        @if ($requisition_a->delivery_status == '0')
                                            <a class="btn btn-primary" href="{{ route('approved.deliver',$editID) }}"><i class="fas fa-check"></i> Deliver</a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
{{-- Delivered list --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Delivery Status: <span class="text-success">Delivered</span></h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Dep. Reg. Approval</th>
                            <th>Register's Approval</th>
                            <th>Delivery Status</th>
                            <th>Delivered By</th>
                            <th>Received By</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($requisitions_delivered as $requisition_a)
                            <tr>
                                <td>{{ $requisition_a->id }}</td>
                                <td>{{ $dept = \App\Department::where('id','=',$requisition_a->department)->value('name') }}</td>
                                <td>@if ($requisition_a->app_dpr == '0')
                                        <span class="text-danger">Not Approved Yet</span>
                                    @else
                                        <span class="text-success">Approved</span>
                                    @endif
                                </td>
                                <td>@if ($requisition_a->app_r == '0')
                                        <span class="text-danger">Not Approved Yet</span>
                                    @else
                                        <span class="text-success">Approved</span>
                                    @endif
                                </td>
                                <td>@if ($requisition_a->delivery_status == '0')
                                        <span class="text-warning">Processing</span>
                                    @else
                                        <span class="text-success">Delivered</span>
                                    @endif
                                </td>
                                <td>{{ $requisition_a->delivered_by }}</td>
                                <td>{{ $requisition_a->receiver }}</td>
                                <td>{{ $requisition_a->updated_at }}</td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $requisition_a->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                    @endphp
                                    <a class="btn btn-info" href="{{ route('approved.view',$editID) }}"><i class="fas fa-eye"></i> view</a>
                                    @if ($requisition_a->delivery_status == '0')
                                        <a class="btn btn-primary" href="{{ route('submit.approve_deputy',$editID) }}">Deputy Reg.</a>
                                    @endif
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
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

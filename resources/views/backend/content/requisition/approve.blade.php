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

@section('page_index')
    {{$modelname}}
@endsection

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
@role('head|admin|super-admin')
{{-- pending list --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Requisitions</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Submitted By</th>
                            <th>Date</th>
                            <th>Approval Status</th>
                            <th>Approval From Authority</th>
                            <th>Delivery Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($requisitions_pen as $requisition)
                            <tr>
                                <td>{{ $requisition->id }}</td>
                                <td>{{ $department = App\Department::where('id','=',$requisition->department)->value('name') }}</td>
                                <td>{{ $requisition->submittedBy }}</td>
                                <td>{{ $requisition->created_at }}</td>
                                <td>
                                    @if ($requisition->app_head == 0)
                                        <span class="text-danger">no</span>
                                    @else
                                        <span class="text-success">yes</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($requisition->app_dpr==0 || $requisition->app_r==0  )
                                        <span class="text-danger">Pending</span>
                                    @else
                                        <span class="text-success">Approved</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($requisition->delivery_status == 0)
                                        <span class="text-warning">Processing</span>
                                    @else
                                        <span class="text-success">Delivered</span>    
                                    @endif
                                </td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $requisition->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                    @endphp
                                    {{-- view after heads approval --}}
                                    @can('view-requisition')
                                        @if ($requisition->app_head =='1')
                                            <a class="btn btn-info" href="{{ route('approved.view',$editID) }}"><i class="fas fa-eye"></i> view</a>
                                        @endif
                                    @endcan
                                    {{-- heads approval --}}
                                    @can('head-approval')
                                        @if ($requisition->app_head =='0')
                                            <a class="btn btn-info" href="{{ route('submit.approve_confirm',$editID) }}"><i class="fas fa-check"></i> Head</a>
                                        @endif
                                    @endcan
                                    {{-- deputy registrar's approval --}}
                                    @can('deputy-approval', Model::class)
                                        @if ($requisition->app_dpr == 0)
                                            <a class="btn btn-primary" href="{{ route('submit.approve_deputy', $editID) }}"><i class="fas fa-check"></i> Deputy Reg.</a>
                                        @endif 
                                    @endcan
                                    {{-- registrar's approval --}}
                                    @can('reg-approval')
                                        @if ($requisition->app_r == 0)
                                            <a class="btn btn-success" href="{{ route('submit.approve_registrar', $editID) }}"><i class="fas fa-check"></i> Reg.</a>
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
@endrole

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

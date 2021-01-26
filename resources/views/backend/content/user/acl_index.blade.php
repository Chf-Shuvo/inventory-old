@extends('backend.layout.master')

@section('title')
<title>Access Control List</title>
@endsection

@push('css')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('page_index')
{{$modelname.' & '.$modelname2}}
@endsection

@section('main_content')
@can('add-rp')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <button type="button" class="btn btn-primary waves-effect waves-light float-right" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fas fa-user-plus"></i> Add Role/Permission</button>
            <br><br>
        </div>
    </div>
@endcan

{{-- permissions --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Permissions:</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Actions (Performable)</th>
                        </tr>
                    </thead>
                    @php
                        $i=1;
                    @endphp
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{$permission->name}}</td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $permission->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                        $i++;
                                    @endphp
                                    {{-- <a class="btn btn-success" href="{{ route('user.show', $editID) }}"> <i class="far fa-eye"></i> </a> --}}
                                    {{-- sending encrypted data into FacultyCRUDcontroller edit function --}}
                                    @can('edit-permission', Model::class)
                                        <a class="btn btn-primary" href="{{ route('permission.edit', $editID) }}"> <i class="fas fa-edit"></i> </a>
                                    @endcan
                                    @can('delete-permission', Model::class)
                                        <a class="btn btn-danger" href="{{ route('permission.delete', $editID) }}" onclick="return confirm('Are you sure to delete this item??')"> <i class="fas fa-trash"></i> </a>
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
{{-- roles --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Roles:</h4>
                <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Actions (Performable)</th>
                        </tr>
                    </thead>
                    @php
                        $i=1;
                    @endphp
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $role->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                        $i++;
                                    @endphp
                                    {{-- <a class="btn btn-success" href="{{ route('user.show', $editID) }}"> <i class="far fa-eye"></i> </a> --}}
                                    {{-- sending encrypted data into FacultyCRUDcontroller edit function --}}
                                    @can('edit-role', Model::class)
                                        <a class="btn btn-primary" href="{{ route('role.edit', $editID) }}"> <i class="fas fa-edit"></i> </a>
                                    @endcan
                                    @can('delete-role', Model::class)
                                        <a class="btn btn-danger" href="{{ route('role.delete', $editID) }}" onclick="return confirm('Are you sure to delete this item??')"> <i class="fas fa-trash"></i> </a>
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
{{-- form modal --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">User - Panel</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">ADD Role/Permission</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <div class="mb-3">
                            <form method="POST" action="{{ route('acl.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="type" class="col-md-2 col-form-label text-left">{{ __('Type') }}</label>

                                    <div class="col-md-10">
                                        <select name="type" class="form-control">
                                            <option value="" disabled selected>Please choose...</option>
                                            <option value="1">Role</option>
                                            <option value="2">Permission</option>
                                        </select>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-left">{{ __('Name') }}</label>

                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-right">
                                            {{ __('add') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

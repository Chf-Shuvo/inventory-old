@extends('backend.layout.master')

@section('title')
<title>Vendors List</title>
@endsection

@push('css')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('page_index')
{{$modelname}}
@endsection

@section('main_content')
@can('add-vendor')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <button type="button" class="btn btn-primary waves-effect waves-light float-right" data-toggle="modal" data-target=".bs-example-modal-xl"> <i class="fas fa-user-plus"></i> Add Vendor</button>
            <br><br>
        </div>
    </div>
@endcan

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Download Types</h4>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vendor Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($vendors as $vendor)
                                <tr>
                                <td>{{$i}}</td>
                                    <td>{{$vendor->name}}</td>
                                    <td>{{$vendor->phone}}</td>
                                    <td>{{$vendor->email}}</td>
                                    <td>{{$vendor->address}}</td>
                                    <td>
                                        {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                        @php
                                            $editID = $vendor->id;//assigning into the variable
                                            $editID = Crypt::encrypt($editID);//perform encryption
                                        @endphp
                                        {{-- <a class="btn btn-success" href="#"> <i class="far fa-eye"></i> </a> --}}
                                        {{-- sending encrypted data into FacultyCRUDcontroller edit function --}}
                                        @can('edit-vendor')
                                            <a class="btn btn-primary" href="{{ route('vendor.show', $editID) }}"> <i class="fas fa-eye"></i> </a> 
                                        @endcan
                                        @can('delete-vendor')
                                            <a class="btn btn-primary" href="{{ route('vendor.edit', $editID) }}"> <i class="fas fa-edit"></i> </a>
                                        @endcan
                                        @can('view-vendor')
                                            <a class="btn btn-danger" href="{{ route('vendor.delete', $editID) }}" onclick="return confirm('Are you sure to delete the item?')"> <i class="fas fa-trash"></i> </a>
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
    {{-- form modal --}}
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Vendors - Panel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                        <div class="card-header">
                            <h5 class="card-title">
                            ADD Vendor
                            <small>to the user panel</small>
                            </h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{ route('vendor.store') }}">
                                            @csrf
                                            {{-- name --}}
                                            <div class="form-group">
                                                <label for="name">Vendor Name:</label>
                                                <input type="text" class="form-control" data-validation="required" name="name">
                                            </div>
                                            {{-- Email --}}
                                            <div class="form-group">
                                                <label for="email">Vendor Email:</label>
                                                <input type="email" class="form-control" name="email">
                                            </div>
                                            {{-- contact person --}}
                                            <div class="form-group">
                                                <label for="contact_person">Contact Person:</label>
                                                <input type="text" class="form-control" name="contact_person">
                                            </div>
                                            {{-- contact person phone --}}
                                            <div class="form-group">
                                                <label for="contact_person_phone">Contact Person Phone:</label>
                                                <input type="phone" class="form-control" name="contact_person_phone">
                                            </div>
                                            {{-- phone --}}
                                            <div class="form-group">
                                                <label for="phone">Vendor Phone:</label>
                                                <input type="phone" class="form-control" name="phone">
                                            </div>
                                            {{-- address --}}
                                            <div class="form-group">
                                                <label for="address">Vendor Address:</label>
                                                <input type="text" class="form-control" data-validation="required" name="address">
                                            </div>
                                            {{-- submit --}}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-md float-right">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
        <!-- /.modal -->
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate({
    lang: 'en'
  });
</script>
@endpush

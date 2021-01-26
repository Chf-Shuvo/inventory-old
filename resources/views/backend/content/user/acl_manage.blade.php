@extends('backend.layout.master')

@section('title')
    <title>ACL - Management</title>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
       
        
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Access Control List</h3>
            </div>
        <!-- /.card-header -->
            <div class="card-body pad">
                <div class="row">
                    <div class="col-md-6">
                        <h6><b>Name:</b> {{$user->name}}</h6>
                    </div>
                    <div class="col-md-6">
                        <h6><b>Type:</b> {{$user->type}}</h6>
                    </div>
                </div>
                {{-- gathering role information --}}
                @php
                    $permissions = \Spatie\Permission\Models\Permission::all();
                @endphp
                {{-- gathering ends --}}
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                    <h6><b><u>Assigned Permissions:</u></b></h6>
                    @foreach ($candoos as $candoo)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked disabled>
                            <label class="form-check-label" for="inlineCheckbox1">{{ $candoo->name }}</label>
                        </div>
                    @endforeach
                        <form method="POST" action="{{ route('acl.add',$user->id) }}">
                            @csrf
                            <h6 class="mt-3"><b><u>Select Type Assign/Revoke</u></b></h6>
                            <select name="type" class="form-control" required>
                                <option value="" disabled selected>Please choose.....</option>
                                <option value="assign">assign</option>
                                <option value="revoke">revoke</option>
                            </select>
                            <h6 class="mt-3"><b><u>Select a new permission to assign/revoke from below:</u></b></h6>
                            <select name="permission[]" class="select2 select2-multiple" data-placeholder="please choose...." multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group row mt-5">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- ./row -->
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
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@endpush


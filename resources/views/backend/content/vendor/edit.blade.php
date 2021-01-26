@extends('backend.layout.master')

@section('title')
<title>Vendors</title>
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
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @php
                        $id = Crypt::encrypt($vendor->id);
                    @endphp
                    <form method="POST" action="{{ route('vendor.update', $id) }}">
                        @method('PATCH')
                        @csrf
                        {{-- name --}}
                        <div class="form-group">
                            <label for="name">Vendor Name:</label>
                            <input type="text" class="form-control" data-validation="required" name="name" value="{{ $vendor->name }}">
                        </div>
                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Vendor Email:</label>
                            <input type="email" class="form-control" data-validation="email" name="email" value="{{ $vendor->email }}">
                        </div>
                        {{-- contact person --}}
                        <div class="form-group">
                            <label for="contact_person">Contact Person:</label>
                            <input type="text" class="form-control" data-validation="required" name="contact_person" value="{{ $vendor->contact_person }}">
                        </div>
                        {{-- contact person phone --}}
                        <div class="form-group">
                            <label for="contact_person_phone">Contact Person Phone:</label>
                            <input type="phone" class="form-control" data-validation="required" name="contact_person_phone" value="{{ $vendor->contact_person_phone }}">
                        </div>
                        {{-- phone --}}
                        <div class="form-group">
                            <label for="phone">Vendor Phone:</label>
                            <input type="phone" class="form-control" data-validation="required" name="phone" value="{{ $vendor->phone }}">
                        </div>
                        {{-- address --}}
                        <div class="form-group">
                            <label for="address">Vendor Address:</label>
                            <input type="text" class="form-control" data-validation="required" name="address" value="{{ $vendor->address }}">
                        </div>
                        {{-- submit --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-md float-right">Submit</button>
                        </div>
                    </form>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate({
    lang: 'en'
  });
</script>
@endpush

@extends('backend.layout.master')

@section('title')
<title>Stock</title>
@endsection

@push('css')
<link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('page_index')
{{$modelname}}
@endsection

@section('main_content')
<div class="row">
    <div class="col-md-12 mb-5">
        @foreach ($errors->all() as $error)
            <li class="text-danger text-bold">{{ $error }}</li>
        @endforeach
    </div>
</div>
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @php
                        $id = Crypt::encrypt($stock->id);
                    @endphp
                    <form method="POST" action="{{ route('stock.update', $id )}}">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            {{-- vendor --}}
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label for="vendor">Vendor:</label>
                                    <select name="vendor" class="select2">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" @if ($vendor->id == $stock->vendor)
                                                selected
                                            @endif>{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- quantity --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" class="form-control" data-validation="required" name="quantity" value="{{ $stock->quantity }}">
                                </div>
                            </div>
                            {{-- price --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="number" class="form-control" data-validation="required" name="price" value="{{ $stock->price }}">
                                </div>
                            </div>
                            {{-- date --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="text" class="form-control datepicker" data-validation="required" name="date" autocomplete="off" value="{{ $stock->date }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- storage --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="storage">Storage:</label>
                                    <select name="storage" class="select2">
                                        @foreach ($storages as $storage)
                                            <option value="{{ $storage->id }}" @if ($storage->id == $stock->storage)
                                                selected
                                            @endif>{{ $storage->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           {{-- Unit --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="storage">Unit:</label>
                                    <input type="text" class="form-control" name="unit" value="{{ $stock->unit }}">
                                </div>
                            </div>
                            {{-- note --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note">Note:</label>
                                    <textarea name="note" cols="30" rows="10" class="form-control">{{ $stock->note }}</textarea>
                                </div>
                            </div>
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
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
    $(function () {
   // date only
   $('.datepicker').datepicker({
        format: 'd M yyyy',
        autoclose: true,
        orientation: "auto",
        todayHighlight: true,
        clearBtn:true
    });
  });
</script>
<script>
  $.validate({
    lang: 'en'
  });
</script>
@endpush


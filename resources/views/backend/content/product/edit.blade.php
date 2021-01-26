@extends('backend.layout.master')

@section('title')
<title>Vendors</title>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
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
                        $id = Crypt::encrypt($product->id);
                    @endphp
                    <form method="POST" action="{{ route('product.update', $id) }}">
                        @method('PATCH')
                        @csrf
                        {{-- name --}}
                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" data-validation="required" name="name" value="{{ $product->name }}">
                        </div>
                        {{-- category --}}
                        <div class="form-group">
                            <label for="category">Product category:</label>
                            <select name="category" class="select2">
                                <option value="" selected disabled>Please choose....</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $product->category)
                                        selected
                                    @endif>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- brand --}}
                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <input type="text" class="form-control" data-validation="required" name="brand" value="{{ $product->brand }}">
                        </div>
                        {{-- Code --}}
                        <div class="form-group">
                            <label for="code">Color:</label>
                            <input type="text" class="form-control" data-validation="required" name="code" value="{{ $product->code }}">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
  $.validate({
    lang: 'en'
  });
</script>
@endpush


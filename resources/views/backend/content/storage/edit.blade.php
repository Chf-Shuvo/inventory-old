@extends('backend.layout.master')

@section('title')
<title>Storages</title>
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
                        $id = Crypt::encrypt($storage->id);
                    @endphp
                    <form method="POST" action="{{ route('storage.update', $id) }}">
                        @method('PATCH')
                        @csrf
                        {{-- name --}}
                        <div class="form-group">
                            <label for="name">Storage Name:</label>
                            <input type="text" class="form-control" data-validation="required" name="name" value="{{ $storage->name }}">
                        </div>

                        {{-- location --}}
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" data-validation="required" name="location" value="{{ $storage->location }}">
                        </div>

                        {{-- product_category --}}
                        <div class="form-group">
                            <label for="product_category">Types of Product:</label>
                            <select name="product_category" class="select2" data-validation="required">
                                <option value="" selected disabled>Please choose....</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $storage->product_category)
                                        selected
                                    @endif>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
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


@extends('backend.layout.master')

@section('title')
    <title>Department - Edit</title>
@endsection

@section('main_content')
    <div class="container">
            {{-- @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif --}}
            {{-- @if (Session::has("Success"))
                <div class="alert alert-success" role="alert">
                    <strong>Flashed Back</strong>
                </div>
            @endif --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Editing Department</h3>   
                </div>
                @php
                    $editID = Crypt::encrypt($department->id);
                @endphp
                <!-- /.card-header -->
                <div class="card-body pad">
                    <div class="mb-3">
                        <form method="POST" action="{{ route('department.update',$editID) }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$department->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Update') }}
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
@endsection

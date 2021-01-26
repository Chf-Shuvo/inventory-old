@extends('backend.layout.master')

@section('title')
    <title>User - Edit</title>
@endsection
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush
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
                    <h3 class="card-title">Editing USER<small>from the user panel</small></h3>   
                </div>
                @php
                    $editID = Crypt::encrypt($user->id);
                @endphp
                <!-- /.card-header -->
                <div class="card-body pad">
                    <div class="mb-3">
                        <form method="POST" action="{{ route('user.update',$editID) }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                                @php
                                    $departments = App\Department::all();
                                @endphp
                                <div class="col-md-6">
                                    <select name="department" class="select2" id="">
                                        @foreach ($departments as $department)
                                            <option @if ($department->id == $user->department)
                                                selected
                                            @endif value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>    

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required readonly>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                                @php
                                     $roles = DB::table('roles')->get();
                                @endphp
                                <div class="col-md-6">
                                    {{-- <input id="type" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="type" value="{{ old('email') }}" required> --}}
                                    <select name="type" class="form-control select2">
                                        @foreach ($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    {{-- <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required> --}}
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">active</option>
                                        <option value="inactive">inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush
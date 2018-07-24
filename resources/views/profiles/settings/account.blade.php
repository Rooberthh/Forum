@extends('layouts.app');

@section('content');
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(auth()->id() == $user->id)
                @include('profiles.settings._settings');
            @endif
        </div>

        <div class="col-md-9">
            <div class="container">
                <h2>Update Your Account</h2>
                <form  method="POST" action="{{ route('account.update', $user) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <label class="form-label" for="name">Username:</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">

                        @if ($errors->has('name'))
                            <span class="error-message">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">

                        @if ($errors->has('email'))
                            <span class="error-message">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password">

                        @if ($errors->has('password'))
                            <span class="error-message">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Password Confirmation:</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-outline-info font-weight-bold btn-lg" type="submit">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
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
                <update-settings inline-template :user="{{ $user }}">
                    <form  method="POST" @submit.prevent="updateProfile">
                        <div class="form-group">
                            <label class="form-label" for="name">Username:</label>
                            <input type="text" class="form-control" name="name" id="name" v-model="form.name">
                            <div v-if="errors.name" v-text="errors.name[0]" class="text-sm text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" v-model="form.email">
                            <div v-if="errors.email" v-text="errors.email[0]" class="text-sm text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" v-model="form.password">
                            <div v-if="errors.password" v-text="errors.password[0]" class="text-sm text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Password Confirmation:</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" v-model="form.password_confirmation">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-info font-weight-bold btn-lg" type="submit">Update</button>
                        </div>
                    </form>
                </update-settings>
            </div>
        </div>
    </div>
</div>
@endsection

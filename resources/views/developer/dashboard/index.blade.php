@extends('developer.layouts.app')

@section('developer-content')
    <developer-tile :url="{{ route('api.users.index') }}"></developer-tile>
@endsection

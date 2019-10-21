@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <login :title="'{{ config('app.name') }}'" :errors="'{{ json_encode($errors->all()) }}'"></login>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <div id="app">
        <app :title="'{{ config('app.name') }}'"></app>

        <div>
            hello
        </div>
    </div>
@endsection

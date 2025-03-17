@extends('layouts.app')

@section('title', 'My tasks')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Welcome to {{ env('APP_NAME') }} project!</h2>
    </div>
@endsection

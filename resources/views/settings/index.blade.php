@extends('layouts.app')

@section('title', 'My tasks')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Settings</h2>
    </div>

    <form method="post" action="{{ route('settings.create.token') }}" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4 mt-4">
                <button type="submit" class="btn btn-primary w-100">Generate Token</button>
            </div>
        </div>
    </form>

    @if(session('token'))
        <div class="alert alert-success mt-4">
            <strong>Generated Token:</strong> {{ session('token') }}
        </div>
    @endif
@endsection

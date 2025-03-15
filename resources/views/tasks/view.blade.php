@extends('layouts.app')

@section('title', 'View task')

@section('content')
    <h2>{{ $task->name }}</h2>
    <p><strong>Description:</strong> {{ $task->description ?? 'None' }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
    <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
@endsection

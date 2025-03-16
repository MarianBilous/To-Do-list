@extends('layouts.app')

@section('title', 'View task')

@section('content')
    <div class="container">
        <h2 class="mb-4">History changes: {{ $task->name }}</h2>

        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mb-3">Back</a>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Changes</h5>
            </div>
            <div class="card-body">
                @if($taskHistories->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Date change</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($taskHistories as $change)
                            <tr>
                                <td>
                                    <a href="{{ route('tasks.history.show', $change) }}">
                                        <span class="badge bg-{{ getClassByAction($change->action) }}">{{ ucfirst($change->action) }}</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('tasks.history.show', $change) }}">
                                        {{ $change->created_at->format('d-m-Y H:i') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Changes not found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

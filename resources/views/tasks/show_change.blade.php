@extends('layouts.app')

@section('title', 'View task')

@section('content')
    <div class="container">
        <h2>View change - {{ ucfirst($history->action) }}</h2>

        <a href="{{ route('tasks.history.index', $history->task) }}" class="btn btn-secondary mb-3">Back</a>

        @if($history->action == 'updated')
            <h5>Changes:</h5>
            <ul>
                @foreach(json_decode($history->data, true)['changes'] as $field => $change)
                    <li><strong>{{ ucfirst($field) }}:</strong>
                        old change: {{ $change['old_value'] ?? 'none'}}
                        -> new change: {{ $change['new_value'] }}</li>
                @endforeach
            </ul>
        @elseif($history->action == 'created')
            <h5>Data at creation:</h5>
            @foreach(json_decode($history->data, true)['task_data'] as $field => $data)
                <li><strong>{{ ucfirst($field) }}:</strong> value: {{ $data ?? 'none'}}</li>
            @endforeach
        @endif
    </div>
@endsection

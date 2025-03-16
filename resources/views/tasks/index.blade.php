@extends('layouts.app')

@section('title', 'My tasks')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>My tasks</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create new Task</a>
    </div>

    <form method="get" action="{{ route('tasks.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All</option>
                    <option value="to-do" {{ request('status') == 'to-do' ? 'selected' : '' }}>To-do</option>
                    <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="priority" class="form-label">Priority</label>
                <select name="priority" id="priority" class="form-select">
                    <option value="">All</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="deadline_from" class="form-label">From</label>
                <input type="date" id="deadline_from" name="deadline_from" class="form-control" value="{{ request('deadline_from') }}">
            </div>

            <div class="col-md-2">
                <label for="deadline_to" class="form-label">To</label>
                <input type="date" id="deadline_to" name="deadline_to" class="form-control" value="{{ request('deadline_to') }}">
            </div>

            <div class="col-md-2">
                <label for="sort_by" class="form-label">Sort by</label>
                <select name="sort_by" id="sort_by" class="form-select">
                    <option value="deadline" {{ request('sort_by') == 'deadline' ? 'selected' : '' }}>Deadline</option>
                    <option value="priority" {{ request('sort_by') == 'priority' ? 'selected' : '' }}>Priority</option>
                </select>
            </div>

            <div class="col-md-1 mt-4">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-1 mt-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($tasks->count())
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td><span class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'success') }}">
                        {{ ucfirst($task->priority) }}
                    </span></td>
                    <td>{{ ucfirst(str_replace('-', ' ', $task->status)) }}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        <a class="btn btn-sm btn-primary generate-link-btn" data-task-id="{{ $task->id }}">
                            Generate public link & copy
                        </a>
                        <a class="btn btn-sm btn-primary" href="{{ route('tasks.history.index', $task) }}">
                            View history changes
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    {{ $tasks->withQueryString()->links('custom.pagination') }}
@endsection

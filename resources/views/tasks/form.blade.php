@extends('layouts.app')

@section('title', isset($task) ? 'Edit task' : 'Create Task')

@section('content')
    <h2>{{ isset($task) ? 'Edit task' : 'Create Task' }}</h2>

    <form method="POST"
          action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}"
          class="row g-3 needs-validation" novalidate>
        @csrf
        @isset($task)
            @method('PUT')
        @endisset

        <div class="col-md-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $task->name ?? '') }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="priority" class="form-label">Priority</label>
            <select id="priority" name="priority" class="form-select" >
                <option value="low" {{ old('priority', $task->priority ?? '') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority', $task->priority ?? '') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority', $task->priority ?? '') == 'high' ? 'selected' : '' }}>High</option>
            </select>
            @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="to-do" {{ old('status', $task->status ?? '') == 'to-do' ? 'selected' : '' }}>To-do</option>
                <option value="in-progress" {{ old('status', $task->status ?? '') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ old('status', $task->status ?? '') == 'done' ? 'selected' : '' }}>Done</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" id="deadline" name="deadline" class="form-control @error('deadline') is-invalid @enderror"
                   value="{{ old('deadline', $task->deadline ?? '') }}">
            @error('deadline')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">{{ isset($task) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
@endsection

@extends('layouts.app')

@section('pagetitle', isset($task) ? 'Edit Task' : 'Add Task')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('content')


<form method="post" action="{{ isset($task) ? route('tasks.update', [ 'task' => $task->id ]) : route('tasks.store') }}">
    @csrf
    @isset($task)
        @method('PUT')
    @endisset
    <div class="mb-4">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"
        @class(['border-red-500' => $errors->has('title')])>
        @error('title')
            <p class="error"> {{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="5"
        @class(['border-red-500' => $errors->has('description')])>{{ $task->description ?? old('description') }}</textarea>
        @error('description')
            <p class="error"> {{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="long_description">Long Description</label>
        <textarea name="long_description" id="long_description" rows="10"
        @class(['border-red-500' => $errors->has('long_description')])>{{ $task->long_description ?? old('long_description') }}</textarea>
        @error('long_description')
            <p class="error"> {{ $message }}</p>
        @enderror
    </div>
    <div class="flex items-center gap-2">
        @isset($task)
            <button type="submit" class="btn">
                Update Task
            </button>
            <a href="{{ route('tasks.show', ['task' => $task]) }}" class="link">Cancel</a>
        @else
            <button type="submit" class="btn">
                Add Task
            </button>
            <a href="{{ route('tasks.index') }}" class="link">Cancel</a>
        @endisset
        
    </div>
</form>
@endsection

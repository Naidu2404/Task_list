@extends('layouts.app')

@section('pagetitle','List')

@section('title','List of tasks')



@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}"
        class="link">Add Task!</a>
    </nav>
    <!-- @if (count($tasks))
        @foreach ($tasks as $task)
            <div>
                {{ $task->title }}
            </div>
        @endforeach
    @else
        <div>No tasks</div>
    @endif -->
    @forelse ($tasks as $task)
        <div> <a href="{{route('tasks.show', [ 'task' => $task->id ])}}"
         @class(['line-through' => $task->completed])>{{ $task->title }}</a> </div>
    @empty
        <div>No tasks</div>
    @endforelse


    @if ($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection

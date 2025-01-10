@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Your Tasks</h2>
        <a href="{{ route('tasks.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
           Create Task
        </a>
    </div>

    @foreach ($tasks as $task)
        <div class="flex items-center justify-between mb-3 p-4 bg-white rounded shadow">
            <div>
                <input type="checkbox"
                       id="task-{{ $task->id }}"
                       {{ $task->completed ? 'checked' : '' }}
                       onchange="event.preventDefault(); document.getElementById('toggle-complete-{{ $task->id }}').submit();">
                    <label for="task-{{ $task->id }}" class="{{ $task->completed ? 'line-through text-gray-500' : '' }}">
                        <strong>{{ $task->title }}</strong>
                    </label>
                    <label for="task-{{ $task->id }}" class="text-sm text-gray-500 ml-2">
                        (Due: {{ $task->due_date->format('M d, Y') }})
                    <br>
                    <label for="task-{{ $task->id }}" class="text-sm text-gray-500 ml-2">
                        {{ $task->description }}
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('tasks.edit', $task->id) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-700">
                   Edit
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                </form>
                <form id="toggle-complete-{{ $task->id }}" action="{{ route('tasks.toggleComplete', $task->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PATCH')
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection

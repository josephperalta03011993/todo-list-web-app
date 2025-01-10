@extends('layouts.app')
@section('content')
    <div class="max-w-2xl mx-auto mt-6 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Task</h2>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="w-full p-3 bg-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full p-3 bg-gray-300 rounded">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="due_date" class="block text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" class="w-full p-3 bg-gray-300 rounded">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('tasks.index') }}" class="bg-gray-300 px-4 py-2 rounded mr-2">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
@endsection

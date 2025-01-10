@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Create a New Task</h2>
    <form action="{{ route('tasks.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
            <input type="text" name="title" id="title" class="bg-gray-300 p-3 mt-1 block w-full rounded border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="bg-gray-300 p-3 mt-1 block w-full rounded border-gray-300 shadow-sm"></textarea>
        </div>
        <div class="mb-4">
            <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="bg-gray-300 p-3 mt-1 block w-full rounded border-gray-300 shadow-sm" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Create Task</button>
        </div>
    </form>
</div>
@endsection

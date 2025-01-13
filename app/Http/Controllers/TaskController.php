<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
                        ->orderBy('due_date', 'ASC')
                        ->get();
        $totalGoals = Task::where('user_id', Auth::id())->count();
        return view('tasks.index', compact('tasks', 'totalGoals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'due_date' => 'required|date',
            'is_weekly' => 'nullable|boolean',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_weekly' => 0,
            'user_id' => auth()->id(),
            'completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);

        $task->update(['completed' => !$task->completed]);

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date'
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function create()
    {
        return view('tasks.create')->with('success', 'New task created successfully!');
    }

    public function deleteCompleted()
    {
        try {
            $this->authorize('deleteAnyCompleted', Task::class);

            // Check if there are any completed tasks
            $completedTasksCount = Task::where('user_id', auth()->id())
                ->where('completed', 1)
                ->count();

            if ($completedTasksCount === 0) {
                return redirect()
                    ->route('tasks.index')
                    ->with('info', 'No completed tasks found to delete.');
            }

            DB::beginTransaction();
            try {
                $deleted = Task::where('user_id', auth()->id())
                    ->where('completed', 1)
                    ->delete();

                DB::commit();

                return redirect()
                    ->route('tasks.index')
                    ->with('success', "{$deleted} tasks were deleted successfully!");
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Error deleting completed tasks: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'exception' => $e
            ]);

            return redirect()
                ->route('tasks.index')
                ->with('error', "An error occurred while deleting tasks. {$e->getMessage()}");
        }
    }
}

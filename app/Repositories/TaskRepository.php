<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasks($query)
    {
        $userId = auth()->id();

        $filter = $query['filter'];

        $tasks = Task::all()->where('user_id', $userId);


        if ($filter == 'todo') {
            $tasks = $tasks->where('completed', false);
        } else if ($filter == 'completed') {
            $tasks = $tasks->where('completed', true);
        }

        $result = [];

        foreach ($tasks as $task) {
            $date = $task->created_at->format('D. d \d\e F \d\e Y');

            if (!isset($result[$date])) {
                $result[$date] = [
                    'id' => count($result) + 1,
                    'title' => $date,
                    'data' => []
                ];
            }

            $result[$date]['data'][] = [
                'id' => $task->id,
                'description' => $task->description,
                'completed' => (bool) $task->completed
            ];
        }
        return array_values($result);
    }

    public function getTaskById($taskId)
    {
        return Task::findOrFail($taskId);
    }

    public function deleteTask($taskId)
    {
        return  Task::destroy($taskId);
    }

    public function createTask(array $taskDetails)
    {
        return Task::create($taskDetails);
    }

    public function updateTask($taskId, array $newDetails)
    {
        return Task::whereId($taskId)->update($newDetails);
    }

    public function getTaskRelatory()
    {
        $relatory = [];

        $relatory['total'] = auth()->user()->tasks->count();
        $relatory['completed'] = auth()->user()->tasks->where('completed', 1)->count();

        return $relatory;
    }
}

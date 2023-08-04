<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasks()
    {

        $tasks = auth()->user()->tasks;
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
                'completed' => $task->completed
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
}

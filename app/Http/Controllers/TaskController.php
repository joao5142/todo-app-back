<?php

namespace App\Http\Controllers;

use App\Interfaces\TaskRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;


    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        try {

            $tasks = $this->taskRepository->getAllTasks();
            return  response()->json(['message' => 'Sucesso', 'tasks' => $tasks]);
        } catch (Exception $err) {
            return response()->json(['error' => $err->getMessage()], 401);
        }
    }

    public function store(Request $request)
    {

        $userId = auth()->id();

        try {
            $taskDetails = [
                'description' => $request->description,
                'user_id' =>   $userId
            ];

            $task = $this->taskRepository->createTask($taskDetails);

            return  response()->json(['message' => 'Task criada com sucesso!', 'task' => $task]);
        } catch (Exception $err) {
            return response()->json(['error' => $err->getMessage()], 401);
        }
    }

    public function show(Request $request)
    {
        try {
            $taskId = $request->route('taskId');
            $task = $this->taskRepository->getTaskById($taskId);

            return  response()->json(['message' => 'Task encontrada!', 'task' => $task]);
        } catch (Exception $err) {
            return response()->json(['error' => $err->getMessage()], 401);
        }
    }
    public function update(Request $request)
    {

        try {
            $taskId = $request->route('taskId');

            $taskDetails = [];

            $completeTaskValue = $request->completed;
            $descriptionTaskValue = $request->description;

            if (isset($completeTaskValue)) {
                $taskDetails['completed'] = $completeTaskValue;
            }

            if (isset($descriptionTaskValue)) {
                $taskDetails['description'] = $descriptionTaskValue;
            }

            $isTaskUpdate = $this->taskRepository->updateTask($taskId, $taskDetails);

            return  response()->json(['message' => 'Task Atualizada!', 'success' => (bool) $isTaskUpdate]);
        } catch (Exception $err) {
            return response()->json(['error' => $err->getMessage()], 401);
        }
    }

    public function destroy(Request $request)
    {

        try {


            $taskId = $request->route('taskId');

            $isTaskDeleted = $this->taskRepository->deleteTask($taskId);

            if ($isTaskDeleted) {
                return  response()->json(['message' => 'Task deletada com sucesso!', 'success' => (bool) $isTaskDeleted]);
            } else {
                return  response()->json(['message' => 'Task já foi deletada!', 'success' => (bool) $isTaskDeleted]);
            }
        } catch (Exception $err) {
            return response()->json(['error' => $err->getMessage()], 401);
        }
    }
}

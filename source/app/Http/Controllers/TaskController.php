<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Services\Task\TaskPlanService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getIndex(Request $request, TaskPlanService $taskPlanService){
        
        $taskPlanService->assign();
        $developers = Developer::with(['tasks'])->get();
        
        return view('tasks')
            ->with('developers', $developers);
    }
}

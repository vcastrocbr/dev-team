<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userTasks = Task::where('creator_id', auth()->id())
            ->orderByRaw("
            CASE
                WHEN priority = 'high' THEN 1
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 3
                ELSE 4
            END
        ")
            ->paginate(5);

        return view('dashboard', compact('userTasks'));
    }
}

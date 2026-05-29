<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total number of users
        $userCount = User::count();

        // Total assignments 
        $taskCount = Assignment::where('user_id', $user->id)
            ->count();

        // Total assignments due this week
        $myTaskCount = Assignment::where('user_id', $user->id)
            ->whereBetween('due_date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->count();

        // Retrieve assignments due this week
        $tasks = Assignment::where('user_id', $user->id)
            ->whereBetween('due_date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->orderBy('due_date')
            ->get();

        return view('dashboard', compact(
            'userCount',
            'taskCount',
            'myTaskCount',
            'tasks'
        ));
    }

    /**
     * Display the users page.
     */
    public function users()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }
}
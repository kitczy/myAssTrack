<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display all assignments of the authenticated user.
     */
    public function index()
    {
        $assignments = Assignment::where('user_id', Auth::id())
            ->oldest()
            ->get();

        return view('assignments', compact('assignments'));
    }

    /**
     * Store a newly created assignment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        Assignment::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return back()->with('success', 'Assignment added successfully.');
    }

    /**
     * Update the selected assignment.
     */
    public function update(Request $request, $id)
    {
        $assignment = Assignment::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return back()->with('success', 'Assignment updated successfully.');
    }

    /**
     * Delete the selected assignment.
     */
    public function destroy($id)
    {
        $assignment = Assignment::where('user_id', Auth::id())->findOrFail($id);

        $assignment->delete();

        return back()->with('success', 'Assignment deleted successfully.');
    }
}
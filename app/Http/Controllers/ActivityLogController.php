<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::with('user')
            ->latest()
            ->paginate(15);

        return view('activity-logs.index', compact('activityLogs'));
    }
}

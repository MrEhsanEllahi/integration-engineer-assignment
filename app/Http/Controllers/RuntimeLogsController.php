<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RuntimeLog;

class RuntimeLogsController extends Controller
{
    public function index()
    {
        $runtimeLogs = RuntimeLog::latest()->paginate(10);

        $totalEntries = RuntimeLog::count();
        return view('runtime-logs.index', compact('runtimeLogs', 'totalEntries'));
    }

    /**
     * View Runtime Log
     */
    public function show($runtimeLogId)
    {
        $runtimeLog = RuntimeLog::find($runtimeLogId);

        if (!$runtimeLog) {
            $notification = ['message' => 'Log not found', 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        return view('runtime-logs.show', compact('runtimeLog'));
    }
}

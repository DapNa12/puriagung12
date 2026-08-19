<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');

        if ($action = $request->get('action')) {
            $query->where('action', $action);
        }

        if ($model = $request->get('model')) {
            $query->where('model_type', $model);
        }

        if ($user = $request->get('user')) {
            $query->where('user_id', $user);
        }

        if ($dari = $request->get('dari')) {
            $query->whereDate('created_at', '>=', $dari);
        }

        if ($sampai = $request->get('sampai')) {
            $query->whereDate('created_at', '<=', $sampai);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        $logs = $query->latest()->paginate(15)->withQueryString();
        $modelTypes = ActivityLog::distinct()->pluck('model_type');
        $users = User::where('role', '!=', 'warga')->orderBy('name')->get();

        return view('admin.activity-log.index', compact('logs', 'modelTypes', 'users'));
    }

    public function show($id)
    {
        $log = ActivityLog::with('user')->findOrFail($id);

        return view('admin.activity-log.show', compact('log'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Form;
use App\Models\Input;

class DashboardController extends Controller
{
    public function index()
    {
        // すべてのプロジェクト
        $projects = Project::with('forms.input')->get();
        // 更新日順のプロジェクト（3件）
        $recentProjects = Project::orderBy('updated_at', 'desc')->limit(3)->get();
        // すべてのフォーム
        $forms = Form::all();
        return view('dashboard', ['projects' => $projects, 'recentProjects' => $recentProjects, 'forms' => $forms]);
    }
}

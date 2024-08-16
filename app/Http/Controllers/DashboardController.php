<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Input;
use App\Models\Project;
use App\Models\Form;

class DashboardController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        // すべてのプロジェクト
        $projects = Project::with('forms.input')->get();
        // 更新日順のプロジェクト（3件）
        $recentProjects = Project::orderBy('updated_at', 'desc')->limit(5)->get();
        // すべてのフォーム
        $forms = Form::all();
        return view('dashboard', ['projects' => $projects, 'recentProjects' => $recentProjects, 'forms' => $forms]);
    }
}

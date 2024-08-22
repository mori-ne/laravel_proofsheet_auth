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
        // 更新日順のプロジェクト
        $recentProjects = Project::orderBy('updated_at', 'desc')->limit(10)->get();
        // すべてのフォーム
        $forms = Form::all();
        // 更新日時順のフォーム
        $recentForms = Form::orderBy('updated_at', 'desc')->limit(10)->get();

        return view('dashboard', ['projects' => $projects, 'recentProjects' => $recentProjects, 'forms' => $forms, 'recentForms' => $recentForms]);
    }
}

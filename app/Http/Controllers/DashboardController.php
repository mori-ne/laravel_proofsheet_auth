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
        $projects = Project::with('forms.input')->get();
        $recentProjects = Project::orderBy('updated_at', 'desc')->limit(3)->get();
        return view('dashboard', ['projects' => $projects, 'recentProjects' => $recentProjects]);
    }
}

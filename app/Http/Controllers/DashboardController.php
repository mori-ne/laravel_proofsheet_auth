<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Input;
use App\Models\Project;
use App\Models\Form;
use Carbon\Carbon;

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

        // 現在時刻
        $now = Carbon::now();
        // 1週間後の時刻
        $oneWeekLater = $now->copy()->addWeek();
        // 1週間以内の期限＆公開中のタスクを取得
        $nearLimitProjects = Project::whereBetween('is_deadline', [$now, $oneWeekLater])->where('status', 1)->get();

        return view('dashboard', ['projects' => $projects, 'recentProjects' => $recentProjects, 'forms' => $forms, 'recentForms' => $recentForms, 'nearLimitProjects' => $nearLimitProjects]);
    }
}

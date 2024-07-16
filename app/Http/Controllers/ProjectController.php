<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    //    一覧表示・GET検索
    public function index(Request $request)
    {
        // クエリビルダーを使用してベースクエリを作成
        $query = Project::query();

        // 検索パラメーターが存在する場合、クエリに条件を追加
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $search = $request->query('search');
                $q->where('project_name', 'like', '%' . $search . '%');
            });
        }

        // 並び替えパラメーターに基づいてソート
        if ($request->query('sort') == 'oldest') {
            $query->orderBy('id', 'asc');
        } else {
            // デフォルトはdesc順で並び替える
            $query->orderBy('id', 'desc');
        }

        // クエリを実行してデータを取得
        $projects = $query->get();

        // データをビューに渡す
        return view('/projects', compact('projects'));

        // $projects = Project::orderby('id', 'desc')->get();
        // return view('/projects', compact('projects'));
    }

    // 新規作成
    public function create()
    {
        return view('projects.create');
    }

    // 確認
    public function confirm(Request $request)
    {
        $validator = $request->validate([
            'project_name' => 'required|max:100',
            'mail_subject' => 'max:255',
        ]);

        $project = $request->all();
        return view('projects.confirm', ['project' => $project]);
    }

    // 新規作成の適用
    public function store(Request $request)
    {
        $project = Project::create([
            'project_name' => $request->project_name,
            'uuid' => (string) Str::uuid(),
            'description' => $request->description,
            'status' => 0,
            'mail_subject' => $request->mail_subject,
            'mail_content' => $request->mail_content,
            'is_deadline' => $request->is_deadline,
        ]);

        return redirect()->route('projects.index')->with('status', 'プロジェクトを新規作成しました');
    }

    // 詳細表示
    public function show(string $id)
    {
        $project = Project::find($id);
        return view('projects.show', compact('project'));
    }

    // 編集
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', ['project' => $project]);
    }

    // 編集の適用
    public function update(Request $request, string $id)
    {
        //
    }

    // 削除
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('status', 'プロジェクトを削除しました');
    }
}

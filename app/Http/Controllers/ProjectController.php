<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Form;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ProjectController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc'); // デフォルトを新しい順（更新日）に設定
        $query = Project::query();

        if ($search) {
            // クエリがある場合、プロジェクトを検索
            $query->where('project_name', 'LIKE', '%' . $search . '%');
        }

        // 並び替え
        if ($sort === 'asc') {
            $query->orderBy('updated_at', 'asc');
        }
        if ($sort === 'desc') {
            $query->orderBy('updated_at', 'desc');
        }
        if ($sort === 'iddesc') {
            $query->orderBy('id', 'desc');
        }
        if ($sort === 'idasc') {
            $query->orderBy('id', 'asc');
        }

        $projects = $query->with('forms')->get();

        return view('/projects', compact('projects'));
    }

    // 検索
    public function search(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc'); // デフォルトを新しい順（更新日）に設定
        $query = Project::query();

        if ($search) {
            // クエリがある場合、プロジェクトを検索
            $query->where('project_name', 'LIKE', '%' . $search . '%');
        }

        // 並び替え
        if ($sort === 'asc') {
            $query->orderBy('updated_at', 'asc');
        }
        if ($sort === 'desc') {
            $query->orderBy('updated_at', 'desc');
        }
        if ($sort === 'iddesc') {
            $query->orderBy('id', 'desc');
        }
        if ($sort === 'idasc') {
            $query->orderBy('id', 'asc');
        }

        $projects = $query->with('forms')->get();

        return view('/projects', compact('projects'));
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
        $project = Project::with('forms')->find($id);
        return view('projects.show', compact('project'));
    }

    // 更新
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', ['project' => $project]);
    }

    // 更新の適用
    public function update(Request $request, string $id)
    {
        // バリデーションルールの定義
        $validatedData = $request->validate([
            'project_name' => 'required|max:100',
            'project_date' => 'nullable|max:100',
            'project_message' => 'nullable|string',
            'status' => 'integer',
            'description' => 'nullable|string',
            'is_deadline' => 'nullable',
            'mail_subject' => 'max:255|nullable|string',
            'mail_content' => 'nullable|string',
        ]);

        // プロジェクトを検索して更新
        $project = Project::findOrFail($id);
        $project->update($validatedData);

        // リダイレクトしてflash messageを設定
        return back()->with('status', 'プロジェクトを更新しました');
    }

    // 削除
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('status', 'プロジェクトを削除しました');
    }

    // 公開・非公開の切り替え
    public function toggleStatus($id)
    {
        $project = Project::findOrFail($id);
        if (!$project->status) {
            $project->update([
                'status' => 1,
            ]);
        } else {
            $project->update([
                'status' => 0,
            ]);
        }
        return redirect()->back()->with('status', 'プロジェクトの公開・非公開を切り替えました');
    }

    // コピー
    public function duplicate($id)
    {
        $original = Project::find($id);

        // 見つからない場合
        if (!$original) {
            return redirect()->back()->with('error', 'レコードが見つかりませんでした');
        }

        $duplicate = $original->replicate();
        $duplicate->uuid = Str::uuid()->toString();
        $duplicate->project_name = $original->project_name . '_コピー';
        $duplicate->created_at = Carbon::now('Asia/Tokyo');
        $duplicate->updated_at = Carbon::now('Asia/Tokyo');
        $duplicate->save();

        return redirect()->back()->with('status', 'レコードを複製しました');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Form;
use App\Models\Input;
use App\Models\PostUser;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ProjectController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        // パラメータ取得
        $input = $request->input('search');
        // デフォルトの並び順
        $sort = $request->input('sort', 'desc');
        // クエリ発行
        $query = Project::query();

        // クエリがある場合、プロジェクトを検索
        if ($input) {
            $query->where('project_name', 'LIKE', '%' . $input . '%');
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
        return view('/projects', ['projects' => $projects]);
    }

    // 検索
    public function search(Request $request)
    {
        // パラメータ取得
        $input = $request->input('search');
        // デフォルトの並び順
        $sort = $request->input('sort', 'desc');
        // クエリ発行
        $query = Project::query();

        // クエリがある場合、プロジェクトを検索
        if ($input) {
            $query->where('project_name', 'LIKE', '%' . $input . '%');
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
            'project_name' => 'required|string|max:100',
            'project_description' => 'nullable|string',
            'project_message' => 'nullable|string',
            'status' => 'boolean',
            'mail_subject' => 'nullable|string|max:255',
            'main_content' => 'nullable|string',
        ]);

        $project = $request->all();
        return view('projects.confirm', ['project' => $project]);
    }

    // 新規作成の適用
    public function store(Request $request)
    {
        $project = Project::create([
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'project_message' => $request->project_message,
            'uuid' => (string) Str::uuid(),
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
        $project = Project::with('forms.input')->find($id);
        // 見つからなかった場合はリダイレクト
        if (!$project) {
            return redirect('projects');
        }

        $postusers = PostUser::where('uuid', $project->uuid)->get();
        // dd($postusers);
        return view('projects.show', ['project' => $project, 'postusers' => $postusers]);
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
            'project_message' => 'nullable|string',
            'status' => 'integer',
            'project_description' => 'nullable|string',
            'is_deadline' => 'nullable',
            'mail_subject' => 'max:255|nullable|string',
            'mail_content' => 'nullable|string',
        ]);

        // プロジェクトを検索して更新
        $project = Project::findOrFail($id);
        $project->update($validatedData);

        // リダイレクトしてflash messageを設定
        // return back()->with('status', 'プロジェクトを更新しました');
        return redirect()->route('projects.show', $project->id)->with('status', 'プロジェクトを更新しました');
    }

    // 削除
    public function destroy(string $id)
    {
        $project = Project::with('forms.input')->findOrFail($id);

        // 各formに関連するinputを削除
        foreach ($project->forms as $form) {
            if ($form->input) {
                $form->input->delete();
            }
        }

        // 各formを削除
        foreach ($project->forms as $form) {
            $form->delete();
        }

        // プロジェクトを削除
        $project->delete();

        return redirect()->route('projects.index')->with('status', $project->project_name . 'を削除しました');
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

    // 複製
    public function duplicate($id)
    {
        $original = Project::with('forms.input')->find($id);

        // 見つからない場合
        if (!$original) {
            return redirect()->back()->with('error', '複製するプロジェクトが見つかりませんでした');
        }

        $duplicate = $original->replicate();
        $duplicate->uuid = Str::uuid()->toString();
        $duplicate->project_name = $original->project_name . '_複製';
        $duplicate->created_at = Carbon::now('Asia/Tokyo');
        $duplicate->updated_at = Carbon::now('Asia/Tokyo');
        $duplicate->save();

        // formを複製
        $original->forms->each(function ($form) use ($duplicate) {
            $newForm = $form->replicate();
            $newForm->project_id = $duplicate->id; // 外部キーに複製後のidを指定
            $newForm->save();

            // inputを複製
            if ($form->input) {
                $newInput = $form->input->replicate();
                $newInput->form_id = $newForm->id; // 外部キーに新しいformのidを指定
                $newInput->save();
            }
        });

        return redirect()->back()->with('status', $original->project_name . ' を複製しました');
    }
}

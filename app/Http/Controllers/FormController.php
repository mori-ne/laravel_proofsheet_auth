<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Form;
use App\Models\Input;
use Carbon\Carbon;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('project')->orderby('id', 'desc')->get();
        return view('forms', compact('forms'));
    }

    public function create()
    {
        $projects = Project::orderby('id', 'desc')->get();
        return view('forms.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'project_id' => 'required|integer', // project_id も必須で整数であること
            'form_name' => 'required|max:100',
            'form_description' => 'nullable|max:255', // 空でも許容し、最大255文字まで
        ]);

        $form = Form::create([
            'project_id' => $request->project_id,
            'form_name' => $request->form_name,
            'form_description' => $request->form_description,
        ]);

        // ここにinputのdbにも作成する処理を記述
        // $input = Input::create([
        // 'form_id' => $form->id,
        // ]);

        return redirect()->route('forms.index')->with('status', 'フォームを新規作成しました');
    }

    public function show(string $id)
    {

        $form = Form::with('project')->find($id);
        // 見つからなかった場合
        if (!$form) {
            return redirect('forms');
        }
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::all();
        $form = Form::findOrFail($id);

        // 見つからなかった場合
        if (!$form) {
            return redirect('forms');
        }

        return view('forms.edit', ['form' => $form, 'projects' => $projects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // バリデーションルールの定義
        $validatedData = $request->validate([
            'project_id' => 'required|integer',
            'form_name' => 'required|string',
            'form_description' => 'nullable|string',
        ]);

        // フォームを検索して更新
        $form = Form::with('project')->findOrFail($id);
        $form->update($validatedData);
        // リダイレクトしてflash messageを設定
        return redirect()->route('projects.show', $form->project_id)->with('status', 'フォームを新規作成しました');
    }

    public function destroy(string $id)
    {
        $form = Form::findOrFail($id);
        $form->delete();

        return back()->with('status', 'フォームを削除しました');
    }

    public function destroyAll(string $id)
    {
        $form = Form::findOrFail($id);
        // フォームのIDからプロジェクトのIDを取り出し
        $project_id = $form->project_id;
        Form::where('project_id', $project_id)->delete();

        return redirect()->back()->with('status', ' すべてのフォームを複製しました');
    }

    // 複製
    public function duplicate(string $id)
    {
        $form = Form::findOrFail($id);

        // 見つからない場合
        if (!$form) {
            return redirect()->back()->with('error', '複製するフォームが見つかりませんでした');
        }

        $duplicate = $form->replicate();
        $duplicate->form_name = $form->form_name . '_複製';
        $duplicate->created_at = Carbon::now('Asia/Tokyo');
        $duplicate->updated_at = Carbon::now('Asia/Tokyo');
        $duplicate->save();

        return redirect()->back()->with('status', $form->form_name . ' を複製しました');
    }

    public function inputEdit($id)
    {
        $form = Form::with('project')->findOrFail($id);
        $input = Input::findOrFail($id);

        return view('inputs.edit', compact('form', 'input'));
    }
}

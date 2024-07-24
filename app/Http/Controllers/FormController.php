<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Form;

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
        $form = Form::findOrFail($id);
        $form->update($validatedData);

        // リダイレクトしてflash messageを設定
        return back()->with('status', 'フォームを更新しました');
    }

    public function destroy(string $id)
    {
        $form = Form::findOrFail($id);
        $form->delete();

        return back()->with('status', 'フォームを削除しました');
    }

    public function destroyAll(string $project_id)
    {
        // $form = Form::findOrFail($id);
        // $form->delete();
    }
}

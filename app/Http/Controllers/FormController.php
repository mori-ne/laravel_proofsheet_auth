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
        //
    }

    public function show(string $id)
    {
        $form = Form::with('project')->find($id);
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::all();
        $form = Form::findOrFail($id);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

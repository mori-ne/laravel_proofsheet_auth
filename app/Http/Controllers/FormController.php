<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Form;
use App\Models\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function index(Request $request)
    {
        $forms = Form::with('project')->orderBy('updated_at', 'desc')->get();

        // パラメータ取得
        $input = $request->input('search');
        // クエリ発行
        $query = Form::query();

        // クエリがある場合、フォームを検索
        if ($input) {
            $query->where('form_name', 'LIKE', '%' . $input . '%');
        }

        $forms = $query->orderBy('updated_at', 'desc')->get();
        return view('forms', compact('forms'));
    }

    public function search(Request $request)
    {
        $forms = Form::with('project')->orderBy('updated_at', 'desc')->get();

        // パラメータ取得
        $input = $request->input('search');
        // クエリ発行
        $query = Form::query();

        // クエリがある場合、フォームを検索
        if ($input) {
            $query->where('form_name', 'LIKE', '%' . $input . '%');
        }

        $forms = $query->orderBy('updated_at', 'desc')->get();
        return view('forms', compact('forms'));
    }

    public function create(Request $request)
    {
        $projects = Project::orderBy('id', 'desc')->get();
        return view('forms.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'project_id' => 'required|integer', // project_id も必須で整数であること
            'form_name' => 'required|max:100',
            'form_description' => 'nullable|max:255', // 空でも許容し、最大255文字まで
        ]);

        // トランザクションの開始
        DB::beginTransaction();

        try {
            // フォームを作成
            $form = Form::create([
                'project_id' => $request->project_id,
                'form_name' => $request->form_name,
                'form_description' => $request->form_description,
            ]);

            // inputを作成
            $inputData = $request->input('input');
            $inputData['form_id'] = $form->id; // form_idを追加
            Input::create($inputData);

            // コミット
            DB::commit();

            return redirect()->route('forms.show', $form->id)->with('status', 'フォームを新規作成しました');
        } catch (\Exception $e) {
            // ロールバック
            DB::rollBack();
            return redirect()->route('forms.create')->withErrors('フォームの作成に失敗しました。もう一度お試しください。');
        }
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

        // トランザクションの開始
        DB::beginTransaction();

        try {
            // プロジェクトに関連するすべてのフォームを削除
            $forms = Form::where('project_id', $project_id)->get();
            foreach ($forms as $form) {
                $form->delete(); // これにより関連するInputも自動的に削除される
            }

            // コミット
            DB::commit();

            return redirect()->back()->with('status', 'すべてのフォームを削除しました');
        } catch (\Exception $e) {
            // ロールバック
            DB::rollBack();
            return redirect()->back()->withErrors('フォームの削除に失敗しました。もう一度お試しください。');
        }
    }

    // 複製
    public function duplicate(string $id)
    {
        $form = Form::with('input')->findOrFail($id);

        // 見つからない場合
        if (!$form) {
            return redirect()->back()->with('error', '複製するフォームが見つかりませんでした');
        }

        $duplicate = $form->replicate();
        $duplicate->form_name = $form->form_name . '_複製';
        $duplicate->created_at = Carbon::now('Asia/Tokyo');
        $duplicate->updated_at = Carbon::now('Asia/Tokyo');
        $duplicate->save();

        // 入力フィールドの複製
        $input = $form->input; // 1対1の関係なので1つの入力フィールドを取得
        if ($input) {
            $duplicateInput = $input->replicate();
            $duplicateInput->form_id = $duplicate->id;
            $duplicateInput->created_at = Carbon::now('Asia/Tokyo');
            $duplicateInput->updated_at = Carbon::now('Asia/Tokyo');
            $duplicateInput->save();
        }

        return redirect()->back()->with('status', $form->form_name . ' を複製しました');
    }

    public function inputEdit($id)
    {
        $form = Form::with('project')->findOrFail($id);
        $input = Input::where('form_id', $id)->firstOrFail();
        return view('inputs.edit', compact('form', 'input'));
    }

    public function submit(Request $request)
    {
        // echo 'accessed'
        dd($request);
        // 受け取ったデータを処理
        // return response()->json(['message' => 'Data submitted successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * リソースのリストを表示します。
     */
    public function index()
    {
        $projects = Project::all();
        return view('/project', compact('projects'));
    }

    /**
     * 新しいリソースを作成するためのフォームを表示します。
     */
    public function create()
    {
        //
    }

    /**
     * 新しく作成されたリソースをストレージに保存します。
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 指定されたリソースを表示します。
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        return view('project.show', compact('project'));
    }

    /**
     * 指定されたリソースを編集するためのフォームを表示します。
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * ストレージ内の指定されたリソースを更新します。
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * 指定されたリソースをストレージから削除します。
     */
    public function destroy(string $id)
    {
        //
    }
}

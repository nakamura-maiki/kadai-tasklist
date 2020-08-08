<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            return view('tasks.index', [
                'user' => $user,
                'tasks' => $tasks,
            ]);
        }else{
            return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        
        // $task = new Task;
     
        // $task->status = $request->status;
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status
         ]);
         
        // $task->save();
        

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）の投稿でなければ、トップへリダイレクト
        if (\Auth::id() !== $task->user_id) {
            return redirect('/');
        }        
        
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $task = Task::findOrFail($id);
        // 認証済みユーザ（閲覧者）の投稿でなければ、トップへリダイレクト
        if (\Auth::id() !== $task->user_id) {
            return redirect('/');
        }    
        
        return view('tasks.edit', [
            'task' => $task,
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        // 認証済みユーザ（閲覧者）の投稿でなければ、トップへリダイレクト
        if (\Auth::id() !== $task->user_id) {
            return redirect('/');
        }
        
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $task = Task::findOrFail($id);
        // 認証済みユーザ（閲覧者）の投稿でなければ、トップへリダイレクト
        if (\Auth::id() !== $task->user_id) {
            return redirect('/');
        }   
    
        $task->delete();
        return redirect('/');
    }
}

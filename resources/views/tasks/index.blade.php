@extends('layouts.app')

@section('content')

    @if (Auth::check())
        <div class="text-center  register_btn">
        {{ Auth::user()->name. "さん、おかえりなさい" }}
        </div>
    @else
        <!--<div class="center jumbotron">-->
            <div class="text-center  register_btn">
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif

    @if (Auth::check())
         {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'nav-link, btn btn-lg btn-primary']) !!}
        <h1>タスク一覧</h1>
        @if (count($tasks) > 0)
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>タスク</th>
                        <th>ステータス</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                        <td>{{ $task->content }}</td>
                        <td>{{ $task->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
    
        <style type="text/css">
            .register_btn{
                font-size: 20px;
                margin-bottom: 30px;
            }
        </style>

@endsection
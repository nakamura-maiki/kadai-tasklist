@extends('layouts.app')

@section('content')
   
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
    {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'nav-link, btn btn-lg btn-primary']) !!}

    <style type="text/css">
        .register_btn{
            font-size: 20px;
            margin-bottom: 30px;
        }
    </style>
@endsection
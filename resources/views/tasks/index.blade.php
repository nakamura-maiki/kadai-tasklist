@extends('layouts.app')

@section('content')
    {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-primary register_btn']) !!}
    
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
        <style type="text/css">
            .register_btn{
                margin-bottom: 50px;
            }
        </style>

@endsection
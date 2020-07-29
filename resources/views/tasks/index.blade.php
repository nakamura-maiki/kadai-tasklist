@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>

    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $tasks)
                <tr>
                    <td>{{ $tasks->id }}</td>
                    <td>{{ $tasks->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
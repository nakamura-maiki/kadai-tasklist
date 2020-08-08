@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center  register_btn">
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
    <style type="text/css">
        .register_btn{
            font-size: 20px;
            margin-bottom: 30px;
        }
    </style>
    
@endsection


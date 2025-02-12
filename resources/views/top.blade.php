@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">トップページ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>ToDoアプリへようこそ</p>
                    {{-- モーダルここから --}}
                    <p>初めて使う方はこちら</p>
                    <a href="{{ route('register') }}">無料登録する</a>
                    <p>登録済みの方はこちら</p>
                    <a href="{{ route('login') }}">ログイン</a>
                    <p><a href="{{ url('/sample') }}">ログインせずに試す</a></p>
                    {{-- モーダルここまで --}}
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

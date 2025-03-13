@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">トップページ</div>
                <p>{{ isset($loginUser) ? $loginUser['name'] : 'ゲスト'}}　さん、こんにちは。</p>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card__inner">
                        <p class="card__ttl">ToDoアプリへようこそ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- モーダルここから --}}
<div class="mdl js-noclick">
    <div class="mdl__inner">
        <p>このアプリの使用にはアカウント登録が必要です</p>
        <div class="mdl__pannel">
            <div class="mdl__pannel-member">
                <div class="mdl-register">
                    <p>初めて使う方はこちら</p>
                    <a href="{{ route('register') }}">無料登録する</a>
                </div>
                <div class="mdl-login">
                    <p>登録済みの方はこちら</p>
                    <a href="{{ route('login') }}">ログイン</a>
                </div>
            </div>
            <div class="mdl__pannel-nomember">
                <div class="mdl-sample">
                    <p><a href="{{ url('/sample') }}">ログインせずに試す</a></p>
                </div>
            </div>
        </div>
        
    </div>
</div>
{{-- モーダルここまで --}}
@endsection

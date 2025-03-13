@extends('layouts.app')
@section('content')
<div class="container">
    <h1>
        編集ページ
    </h1>
    <div class="tasks__form"> 
        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')
            <input class="tasks__form_name" type="text" name="task_name" value="{{ $task->name }}">
            @if($errors->any())
                @foreach($errors->get('task_name') as $message)
                    <p class="has-error">{{ $message }}</p>
                @endforeach
            @endif
            <div>
                <a href="{{ isset($loginUser) ? '/tasks' : '/sample' }}">戻る</a>
                <button type="submit">編集する</button>

            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')

<div class="container">
<h1>これはサンプルページです</h1>
<p>会員登録せずにこのアプリをお試しいただけます</p>

@auth
    <p>ログアウトしてからお試しください</p>
    <div class="nav-item dropdown">
        <a id="navbarDropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}ここからログアウト<span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
@else
    <p>ゲストこんにちは。</p>

    <h2>今日は何する？</h2>
    <form method="POST" action="/tasks">
        @csrf
        <input type="text" name="task_name" placeholder="洗濯する、とか。">
        <input type="hidden" name="guest_id" value={{ $guest_id }}>
        <input type="hidden" name="type" value="guest">
        @if($errors->any())
            @foreach($errors->get('task_name') as $message)
                <p class="has-error">{{ $message }}</p>
            @endforeach
        @endif
        <button type="submit">追加する</button>
    </form>
    @if($tasks)
        <h3>{{ $guestUser }}さんのタスク</h3>
        <table>
            <tbody>
                @foreach( $tasks as $task )
                <tr>
                    <td>
                        {{ $task->getUdate() }}
                    </td>
                    <td>
                        {{ $task->getTaskName() }}
                    </td>
                    <td>
                        <form action="/tasks/{{ $task->getTaskId() }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ $task->getStatus() }}">
                            <button type="submit">完了</button>
                        </form>
                    </td>
                    <td><a href="/sample/tasks/{{ $task->getTaskId() }}/edit">編集</a></td>
                    <td>
                        <form action="/tasks/{{ $task->getTaskId() }}" method="POST" onsubmit="return deleteTask();">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @if($tasksFinished)
        <h3>{{ $guestUser }}さんの完了したタスク</h3>
        <table>
            <tbody>
                @foreach($tasksFinished as $task)
                <tr>
                    <td>
                        <span>完了日</span>
                        {{ $task->getUdate() }}
                    </td>
                    <td>
                        <span>登録日</span>
                        {{ $task->getCdate() }}
                    </td>
                    
                    <td>
                        {{ $task->getTaskName() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
    <script>
        function deleteTask(){
            if(confirm('本当に削除しますか？')){
                return true;
            } else {
                return false;
            }
        }
    </script>
@endauth
@endsection

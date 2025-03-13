
@extends('layouts.app')
@section('content')


@auth
    <div class="container">
        <p>{{ isset($loginUser) ? $loginUser['name'] : 'ゲスト'}}さん、こんにちは。</p>
        <h2 class="ttl">今日は何する？</h2>
        <div class="tasks__form">   
            <form method="POST" action="/tasks">
                @csrf
                <input class="tasks__form_name" type="text" name="task_name" placeholder="洗濯する、とか。">
                <input type="hidden" name="type" value="member">
                @if($errors->any())
                    @foreach($errors->get('task_name') as $message)
                        <p class="has-error">{{ $message }}</p>
                    @endforeach
                @endif
                <button type="submit">追加する</button>

            </form>
        </div>
    
        @if($tasks)
        <h3>{{ $loginUser['name']}}さんのタスク</h3>
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
                    <td><a href="/tasks/{{ $task->getTaskId() }}/edit">編集</a></td>
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
        <h3>{{ $loginUser['name']}}さんの完了したタスク</h3>
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
@else
    <div class="container">
        <h2>ログインしてからお試しください</h2>
    </div>
@endauth
@endsection


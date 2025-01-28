<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>一覧ページ</title>
</head>
<body>
    <heaader>ToDoアプリ</heaader>
    <main>
        {{-- {{ $msg }} --}}
        
        <form method="POST" action="/tasks">
            @csrf
            <input type="text" name="task_name" placeholder="洗濯する、とか。">
            <button type="submit">追加する</button>

        </form>
        
        <table>
            <tbody>
                <tr>
                    タスク
                </tr>
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

        <table>
            <p>完了したタスク</p>
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
        
       

    </main>
    <script>
        function deleteTask(){
            if(confirm('本当に削除しますか？')){
                return true;
            } else {
                return false;
            }
        }
    </script>
    
</body>
</html>
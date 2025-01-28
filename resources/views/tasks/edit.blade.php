

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編集ページ</title>
</head>
<body>
    <header>
        編集ページ
    </header>
    <main>
        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="task_name" value="{{ $task->name }}">
            
            <div>
                <a href="/tasks">戻る</a>
                <button type="submit">編集する</button>
            </div>
        </form>
    </main>
    
</body>
</html>
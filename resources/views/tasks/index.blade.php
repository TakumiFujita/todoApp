@extends('layout')

@section('title', 'index')

@section('content')
    <style>
        h1 {
            text-align: center;
            padding: 30px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .task__add {
            text-align: right;
            padding-bottom: 10px;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
            border-bottom: 1px solid #aaa;
            color: #555;
            width: 100%;
        }

        th {
            border-top: 1px solid #aaa;
            background-color: #f5f5f5;
            padding: 10px 0 10px 6px;
            text-align: center;
        }

        td {
            border-top: 1px solid #aaa;
            padding: 10px 0 10px 6px;
            text-align: center;
        }

        .td1 {
            border-top: 1px solid #aaa;
            padding: 10px 0 10px 6px;
            text-align: center;
        }

        .td2 {
            border-top: 1px solid #aaa;
            padding: 10px 0 10px 6px;
            display: flex;
            justify-content: center;
        }

        a {
            margin-right: 20px;
        }
    </style>
    <h1 class="text-4xl font-normal">タスク一覧</h1>
    <div class="container">
        <div class="task__add">
            <a href="{{ route('tasks.add') }}"
                class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">＋タスクを追加する</a>
        </div>
        <table>
            <tr>
                <th>タスク</th>
                <th>期限</th>
                <th>アクション</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td class="td1">{{ $task->name }}</td>
                    <td>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y年m月d日') : '未設定' }}</td>
                    <td class="td2">
                        <a href="{{ route('tasks.show', ['id' => $task->id]) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white rounded px-4 py-2">詳細</a>
                        <a href="{{ route('tasks.edit', ['id' => $task->id]) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white rounded px-4 py-2">編集</a>
                        <form action="{{ route('tasks.delete', ['id' => $task->id]) }}" method="POST">
                            @csrf
                            <button type="submit" onClick="delete_alert(event);return false;"
                                class="bg-red-500 hover:bg-red-600 text-white rounded px-4 py-2">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script>
        function delete_alert(e) {
            if (!window.confirm('本当に削除しますか？')) {
                return false;
            }
            document.deleteform.submit();
        };
    </script>
@endsection

@extends('layout')

@section('title', 'edit')

@section('content')
    <style>
        h1 {
            text-align: center;
            padding: 30px;
        }

        .error {
            text-align: center;
        }

        .error__message {
            color: red;
        }

        .form {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        .form-group {
            padding-bottom: 50px;
        }

        span {
            color: red;
        }

        input {
            width: 60%;
            height: 30px;
            border: 1px solid #999999;
        }

        textarea {
            width: 60%;
            border: 1px solid #999999;
        }
    </style>
    <h1 class="text-4xl font-normal">タスク編集</h1>
    <div class="error">
        @foreach ($errors->all() as $error)
            <p class="error__message">{{ $error }}</p>
        @endforeach
    </div>
    <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="POST" class="form">
        @csrf
        <div class="form-group">
            <label for="name">タスク<span>(必須)</span></label><br>
            <input type="text" name="name" maxlength="30" placeholder="タスクは30文字で書きましょう。"
                value="{{ old('name', $task->name) }}">
        </div>
        <div class="form-group">
            <label for="content">タスク内容<span>(必須)</span></label><br>
            <textarea rows="5" name="content" placeholder="タスク内容を具体的に書きましょう">{{ old('content', $task->content) }}</textarea>
        </div>
        <div class="form-group">
            <label for="deadline">期限</label><br>
            @if ($task->deadline === null)
                <input type="date" name="deadline" min={{ $nowDate }} value="{{ old('deadline') }}">
            @else
                <input type="date" name="deadline" min={{ $nowDate }}
                    value="{{ old('deadline', Carbon\Carbon::parse($task->deadline)->format('Y-m-d')) }}">
            @endif
        </div>
        <a href="/"
            class="bg-blue-500 hover:bg-blue-600 text-white rounded px-4 py-2 mr-4 inline-flex items-center">戻る</a>
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white rounded px-4 py-2 inline-flex items-center">更新する</button>
    </form>
@endsection

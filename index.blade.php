<?php /* @var \App\Models\Todo[] $todos */ ?>

@extends('layout.app')

@section('content')
    <div class="container">
       
        @if(session('joke'))
            <div class="joke">
                <h3>Chuck Norris Joke:</h3>
                <p>{{ session('joke') }}</p>
            </div>
        @endif

        <ul class="todo-list">
            @foreach($todos as $todo)
                <li class="todo-item">
                    <form class="todo-item__form" action="{{route('todos.update', $todo)}}" method="post" onchange="this.submit()">
                        @method('PUT')
                        @csrf
                        <input type="checkbox" name="done" {{ $todo->done ? 'checked' : null }}>
                    </form>
                    <div class="todo-item__content">
                        <h3>{{ ucfirst($todo->title) }}</h3>
                        <p>{{ $todo->content }}</p>
                        @if($todo->parent_id)
                            <p>Parent: {{ $todo->parent->title }}</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

        <h2>Create To-do</h2>

        <form action="{{route('todos.store')}}" method="post" class="create-todo">
            @csrf
            <div class="create-todo__input-group">
                <label for="title">Title</label>
                <input id="title" type="text" name="title">
            </div>
            <div class="create-todo__input-group">
                <label for="content">Description</label>
                <textarea id="content" name="content"cols="30" rows="10"></textarea>
            </div>
            <div class="create-todo__input-group">
                <label for="parent_id">Parent To-do:</label>
                <select id="parent_id" name="parent_id">
                    <option value="">None</option>
                    @foreach($todos as $todo)
                        <option value="{{ $todo->id }}">{{ $todo->title }}</option>
                    @endforeach
                </select>
            </div>
            <button class="button" type="submit">Save</button>
        </form>
    </div>
@endsection

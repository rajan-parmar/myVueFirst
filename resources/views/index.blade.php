@extends('layouts.master')

@section('title', 'Homepage')
@section('contents')
    <div class="vue_todo col-lg-4">
        <div class="mb-3">
            <h3 class="font-weight-bold">Todo Lists :</h3>
            <input type="text" class="form-control" placeholder="Insert Todo" @keyup.enter="addTodo" />
        </div>

        <ul class="list-group">
            <li class="list-group-item" v-for="todo in todos" :key="todo.id">
                <div class="row">
                    <div class="col-lg-10">
                        <input v-if="todo.edit" v-model="todo.description" @keyup.enter="todo.edit = false;">

                        <div v-else>
                            <label @click="todo.edit = true;">@{{ todo.description }}</label>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <button class="btn-sm btn-danger" title="Delete Todo" @click="removeTodo(todo.id)">X</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
@endsection

@push('scripts')
    <script>
        new Vue({
            el: '.vue_todo',
            data: {
                todos: [
                    { description: "First todo", id: Math.floor(Math.random() * 10), edit: false },
                ],
            },
            methods: {
                addTodo({ target }) {
                    this.todos.push({ description: target.value, id: Math.floor(Math.random() * 10), edit: false })
                    target.value = ''
                },
                removeTodo(id) {
                    this.todos = this.todos.filter(todo => todo.id !== id)
                },
            }
        })
    </script>
@endpush

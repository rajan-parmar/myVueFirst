@extends('layouts.master')

@section('title', 'Homepage')
@section('contents')
    <div class="vue_todo col-lg-4">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>

                <tbody>
                    <tr v-for="newTodo in newTodos" :key="newTodo.id">
                        <td>@{{ newTodo.id }}</td>
                        <td>@{{ newTodo.name }}</td>
                        <td>
                            <button class="btn-sm btn-danger" title="Delete Todo" @click="removeTodo(newTodo.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        new Vue({
            el: '.vue_todo',
            data() {
                return {
                    name: '',
                    newTodos: {},
                }
            },
            methods: {
                getUser() {
                    axios.get('/todo')
                        .then((response)=>{
                        this.newTodos = response.data
                    })
                },
                removeTodo(id) {
                    axios.delete('/delete/' + id, {
                    })
                    this.getUser();
                },
            },
            mounted() {
                this.getUser()
            },
        })
    </script>
@endpush

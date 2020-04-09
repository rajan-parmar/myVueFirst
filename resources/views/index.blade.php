@extends('layouts.master')

@section('title', 'Homepage')
@section('contents')
    <div class="vue_todo col-lg-4">
        <div class="mb-3">
            <h3 class="font-weight-bold">Todo Lists :</h3>

            <form @submit.prevent="addNewTodo">
                <input type="text" class="form-control mb-3" placeholder="Insert Todo" v-model="name" />

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

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
                            <td v-if="todoEdit">
                                <input v-model="newTodo.name"
                                    class="form-control"
                                    @keyup.enter="todoEdit = false; updateTodo(newTodo.id, newTodo.name)"
                                >
                            </td>
                            <td v-else @click="todoEdit = true;">@{{ newTodo.name }}</td>
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
            data: {
                name: '',
                newTodos: {},
                todoEdit: false,
            },
            mounted: function() {
                this.getUser()
            },
            methods: {
                getUser() {
                    axios.get('/todo')
                    .then((response)=>{
                        this.newTodos = response.data
                    })
                },
                addNewTodo() {
                    axios.post("/store", {
                        name: this.name,
                    })
                    this.name = '';
                    this.getUser();
                },
                updateTodo(id, name) {
                    axios.post("/update/" + id, {
                        name: name,
                    })
                    .then((response)=>{
                        this.getUser();
                    })
                },
                removeTodo(id) {
                    axios.delete('/delete/' + id)
                    .then((response)=>{
                        this.getUser();
                    })
                },
            },
        })
    </script>
@endpush

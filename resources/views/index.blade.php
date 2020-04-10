@extends('layouts.master')

@section('title', 'Homepage')
@section('contents')
    <div class="vue_todo col-lg-4">
        <div class="mb-3">
            <h3 class="font-weight-bold">Todo Lists :</h3>

            <p class="text-center alert" v-bind:class="{ 'alert-danger': hasError, 'd-none': errorHasError }">
                Please fill all fields!
            </p>

            <p class="text-center alert" v-bind:class="{ 'alert-success': hasSuccess, 'd-none': errorSuccess }">
                Record Inserted Successfully!
            </p>

            <p class="text-center alert" v-bind:class="{ 'alert-success': hasUpdate, 'd-none': errorUpdate }">
                Record Updated Successfully!
            </p>

            <p class="text-center alert" v-bind:class="{ 'alert-success': hasDelete, 'd-none': errorDelete }">
                Record Deleted Successfully!
            </p>

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
            </thead>

            <tbody>
                <tr v-for="newTodo in newTodos" :key="newTodo.id">
                    <td>@{{ newTodo.id }}</td>
                    <td>
                        <input v-model="newTodo.name"
                            v-if="newTodo.isEdit"
                            class="form-control"
                            @keyup.enter="newTodo.isEdit = false; updateTodo(newTodo.id, newTodo.name)"
                        >
                        <label v-else @click="newTodo.isEdit = true;">@{{ newTodo.name }}</label>
                    <td>
                        <button class="btn-sm btn-danger" title="Delete Todo" @click="removeTodo(newTodo.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
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
                hasError: false,
                errorHasError: true,
                hasSuccess: false,
                errorSuccess: true,
                hasUpdate: false,
                errorUpdate: true,
                errorDelete: true,
                hasDelete: false,
            },
            mounted: function() {
                this.getTodos()
            },
            methods: {
                getTodos() {
                    axios.get('/todo')
                    .then((response)=>{
                        for (let i = 0; i < response.data.length; i++) {
                            response.data[i].isEdit =  false;
                        }
                        this.newTodos = response.data;
                    })
                },
                addNewTodo() {
                    if (this.name == '') {
                        this.errorHasError = false;
                        this.hasError = true;
                    } else {
                        axios.post("/store", {
                            name: this.name,
                        })
                        this.name = '';
                        this.getTodos();
                        this.errorSuccess = false;
                        this.hasSuccess = true;
                    }
                },
                updateTodo(todoId, todoName) {
                    axios.post("/update/" + todoId, {
                        name: todoName,
                    })
                    .then((response)=>{
                        this.getTodos();
                        this.errorUpdate = false;
                        this.hasUpdate = true;
                    })
                },
                removeTodo(TodoId) {
                    axios.delete('/delete/' + TodoId)
                    .then((response)=>{
                        this.getTodos();
                        this.errorDelete = false;
                        this.hasDelete = true;
                    })
                },
            },
        })
    </script>
@endpush

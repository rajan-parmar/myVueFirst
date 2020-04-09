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
                        this.newTodos = response.data
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
                        this.getUser();
                        this.errorSuccess = false;
                        this.hasSuccess = true;
                    }
                },
                updateTodo(id, name) {
                    axios.post("/update/" + id, {
                        name: name,
                    })
                    .then((response)=>{
                        this.getUser();
                        this.errorUpdate = false;
                        this.hasUpdate = true;
                    })
                },
                removeTodo(id) {
                    axios.delete('/delete/' + id)
                    .then((response)=>{
                        this.getUser();
                        this.errorDelete = false;
                        this.hasDelete = true;
                    })
                },
            },
        })
    </script>
@endpush

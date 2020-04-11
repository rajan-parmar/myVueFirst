@extends('layouts.master')

@section('title', 'Product Homepage')
@section('contents')
    <div class="col-lg-5 mb-5">
        <h3 class="font-weight-bold mb-3">Product Lists :</h3>

        <form @submit.prevent="addNewTodo">
            <div class="form-group">
                <label class="font-weight-bold">Product:</label>
                <input type="text" class="form-control" placeholder="Insert Product" v-model="product" />
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Price:</label>
                <input type="text" class="form-control" placeholder="Insert Price" v-model="price" />
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Image Url:</label>
                <input type="text" class="form-control" placeholder="Insert Image Url" v-model="url" />
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="col-lg-8">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Product Image</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')


@endpush

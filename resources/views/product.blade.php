@extends('layouts.master')

@section('title', 'Product Homepage')
@section('contents')
    <div class="products">
        <div class="col-lg-4 mb-5">
            <h3 class="font-weight-bold mb-3">Product Lists :</h3>

            <form @submit.prevent="addNewProduct">
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

        <div class="col-lg-6">
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
                    <tr v-for="productList in productLists" :key="productList.id">
                        <td>@{{ productList.id }}</td>
                        <td>@{{ productList.product }}</td>
                        <td>@{{ productList.price }}</td>
                        <td>
                            <img :src="productList.url" width="50px" height="50px">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        new Vue({
            el: '.products',
            data: {
                id: '',
                product: '',
                price: '',
                url: '',
                productLists: [],
            },
            methods: {
                addNewProduct() {
                    if (this.product == '' || this.price == '' || this.url == '') {
                        alert('empty');
                    } else {
                        this.productLists.push({ id: Math.floor(Math.random() * 10), product: this.product, price: this.price, url: this.url })
                        this.product = '';
                        this.price = '';
                        this.url = '';
                    }
                }
            }
        })
    </script>
@endpush

<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            <h2 class="text-primary fs-2 my-2">Dashboard</h2>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold fs-5">All Products</h5>
                    <a href="{{ route("product.create") }}" class="btn btn-primary">Add product</a>

                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">quantity</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $p)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img style="width: 80px !important;" src="{{ asset($p->image) }}"></td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->price }}</td>
                                <td>{{ $p->quantity }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $p->id) }}" class="btn btn-primary">Edit</a>
                                    <form class="d-inline" action="{{ route('product.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>




        </div>
    </section>

</x-app-layout>

<x-app-layout>

    <!--============================
        CART START
    =============================-->
    <section class="wsus__cart mt_170 pb_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 wow fadeInUp">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="pro_img">Item</th>
                                        <th class="pro_name">Name</th>
                                        <th class="pro_select">Quantity</th>
                                        <th class="pro_tk">Price</th>
                                        <th class="pro_icon">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td class="pro_img">
                                                <img src="{{ asset($item['image']) }}" alt="product"
                                                    class="img-fluid w-100">
                                            </td>
                                            <td class="pro_name">
                                                <a href="#">{{ $item['name'] }}</a>
                                            </td>
                                            <td class="pro_select">
                                                <div class="quentity_btn">
                                                    <button class="btn btn-danger decrement"
                                                        data-id="{{ $item['id'] }}"><i
                                                            class="fal fa-minus"></i></button>
                                                    <input type="text" class="qty" placeholder="1"
                                                        value="{{ $item['quantity'] }}">
                                                    <button class="btn btn-success increment"
                                                        data-id="{{ $item['id'] }}"><i
                                                            class="fal fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td class="pro_tk">
                                                <h6>${{ $item['price'] * $item['quantity'] }}</h6>
                                            </td>
                                            <td class="pro_icon">
                                                <form action="{{ route('cart.destroy', $item['id']) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><i class="fal fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="wsus__cart_list_bottom">
                        <div class="row justify-content-between">
                            <div class="col-md-6 col-xl-5 ms-auto">
                                <div class="wsus__cart_list_pricing">
                                  @php
                                    $total = 0;
                                    foreach ($items as $product) {
                                      $total += $product["price"]*$product["quantity"];
                                    }
                                  @endphp
                                    <h6>Total <span>$ {{ $total }}</span></h6>
                                    {{-- <p>Tax<span>12%</span></p>
                                    <p>Discount<span>$ 60.00</span></p>
                                    <h5>Sub total<span>$ 300.00</span></h5> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <ul class="wsus__cart_list_bottom_btn">
                        <li><a href="products.html" class="common_btn cont_shop">Continue To Shipping</a>
                        </li>
                        <li><a href="checkout.html" class="common_btn common_btn_2">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CART END
    =============================-->

    <x-slot name="scripts">
        <script>
            $(document).ready(function() {

                $(".increment").on("click", function() {
                    // let qty = $(".qty").val()
                    let qty = $(this).siblings(".qty").val()
                    let id = $(this).data("id");
                    qty = parseInt(qty) + 1
                    $(this).siblings(".qty").val(qty)

                    $.ajax({
                        method: "POST",
                        url: "{{ route('cart.update_qty') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            qty,
                            id
                        },
                        success: function(data) {
                            if (data.status == "ok") {
                                location.reload()
                            }
                        }
                    })
                })

                $(".decrement").click(function() {
                    let qty = $(this).siblings(".qty").val()
                    let id = $(this).data("id");
                    if (qty > 1) {
                        qty = parseInt(qty) - 1
                        $(this).siblings(".qty").val(qty)
                        $.ajax({
                            method: "POST",
                            url: "{{ route('cart.update_qty') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                qty,
                                id
                            },
                            success: function(data) {
                                if (data.status == "ok") {
                                    location.reload()
                                }
                            }
                        })
                    }
                })

            })
        </script>
    </x-slot>

</x-app-layout>

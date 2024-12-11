<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            {{-- @if ($errors->any())
          @foreach ($errors->all() as $e)
              <div class="alert alert-danger">{{ $e }}</div>
          @endforeach
          @endif --}}
            <h2 class="text-primary fs-2 my-2">Dashboard</h2>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold fs-5">Update Product</h5>
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Go back</a>

                </div>
                <div class="card-body">
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <x-form-feild :name="'image'" :type="'file'" />
                            <img class="my-2" style="width: 100px !important" src="{{ asset($product->image) }}" alt="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">other images</label>
                            <input type="file" multiple name="images[]"
                                class="form-control @error('images') is-invalid @enderror">
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @foreach($images as $img)
                            <img class="m-2 d-inline" style="width: 100px !important" src="{{asset($img)}}">
                            @endforeach
                        </div>
                        <div class="mb-3">
                          <x-form-feild :name="'name'" :type="'text'" :value="$product->name" />
                        </div>
                        <div class="mb-3">
                            <x-form-feild :name="'price'" :type="'text'" :value="$product->price" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">colors: </label>
                            <input class="form-check-input ms-3" @checked(in_array("black", $colors))  type="checkbox" name="colors[]"value="black">
                            <label class="form-check-label ">Black</label>
                            <input class="form-check-input ms-3" @checked(in_array("green", $colors)) type="checkbox" name="colors[]"value="green">
                            <label class="form-check-label">Green</label>
                            <input class="form-check-input ms-3" @checked(in_array("red", $colors)) type="checkbox" name="colors[]"value="red">
                            <label class="form-check-label">Red</label>
                            <input class="form-check-input ms-3" @checked(in_array("cyan", $colors)) type="checkbox" name="colors[]"value="cyan">
                            <label class="form-check-label">Cyan</label>

                        </div>
                        <div class="mb-3">
                            <x-form-feild :name="'short_description'" :type="'text'" :value="$product->short_description" />
                        </div>
                        <div class="mb-3">
                            <x-form-feild :name="'qty'" :type="'text'" :value="$product->quantity"/>
                        </div>
                        <div class="mb-3">
                            <x-form-feild :name="'sku'" :type="'text'" :value="$product->sku" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea id="basic-example" type="text" name="description"
                                class="form-control @error('description') is-invalid @enderror @if(old("description")) is-valid @endif">{{ old("description") ?? $product->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>


        </div>
    </section>

    <x-slot name="scripts">
        <script>
            tinymce.init({
                selector: 'textarea#basic-example',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        </script>
    </x-slot>
</x-app-layout>

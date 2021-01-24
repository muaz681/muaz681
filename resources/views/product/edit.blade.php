<x-app-layout>

  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Product
      </h2>

  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
          <div class="container">
            <div class="row">
              <div class="col-md-4 m-auto">
                <div class="card">
                  <h3 class="card-header">Product Edit</h3>
                  <div class="card-body">
                    <form method="post" action="{{url('product/edited')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label>Product Name</label>
                        <input type="hidden" class="form-control" name="product_id" value="{{ $product_edit->id }}">
                        <input type="text" class="form-control" name="product_name" value="{{ $product_edit->product_name }}">
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Category</label>
                        <select class="form-control" name="category_id">
                          <option value="">-Select-</option>
                          @foreach($categoryes as $category)
                            <option value="{{ $category->id }}" {{ ($product_edit->category_id == $category->id)? "selected": " " }}>{{$category->category_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" name="product_price" value="{{ $product_edit->product_price }}">
                        @error('product_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Quantity</label>
                        <input type="text" class="form-control" name="product_quantity" value="{{ $product_edit->product_quantity }}">
                        @error('product_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Alert Quantity</label>
                        <input type="text" class="form-control" name="alert_quantity" value="{{ $product_edit->alert_quantity }}">
                        @error('alert_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" class="form-control" name="new_photo" onchange="readURL(this);">
                        <img width="50" class="hidden" id="tenant_photo_viewer" src="#" alt="your image" />
                        <script>
                        function readURL(input) {
                          if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                              $('#tenant_photo_viewer').attr('src', e.target.result).width(150).height(195);
                            };
                            $('#tenant_photo_viewer').removeClass('hidden');
                            reader.readAsDataURL(input.files[0]);
                          }
                        }
                        </script>
                      </div>
                      <div class="form-group">
                        <img height="50" width="50" src="{{asset('uploads/product_images')}}/{{ $product_edit->product_photo }}" alt="">
                      </div>
                      <button type="submit" class="btn btn-info">Edit</button>
                    </form>
                  </div>
                  </div>
              </div>
            </div>
          </div>
    </div>
  </div>


</x-app-layout>

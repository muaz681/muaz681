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
              <div class="col-md-8">
                <div class="card">
                  <h3 class="card-header">Product List</h3>
                  <div class="card-body">

                    @if (session('delete_status'))
                        <div class="alert alert-danger">
                            {{ session('delete_status') }}
                        </div>
                    @endif

                    @if (session('edit_status'))
                        <div class="alert alert-success">
                            {{ session('edit_status') }}
                        </div>
                    @endif
                    <table class="table table-responsive d-block" id="product_data">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Product Name</th>
                          <th>Category Name</th>
                          <th>Product Price</th>
                          <th>Quantity</th>
                          <th>Alert Quantity</th>
                          <th>Product Image</th>
                          <th>Product Insert Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @forelse($users as $user)
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$user->product_name}}</td>
                            {{-- <td>{{App\Models\Category::find($user->category_id)->category_name}}</td> --}}
                            <td>{{ $user->relationtocetagorytable->category_name }}</td>
                            <td>{{$user->product_price}}</td>
                            <td>{{$user->product_quantity}}</td>
                            <td>{{$user->alert_quantity}}</td>
                            <td>
                              <img height="50" width="50" src="{{asset('uploads/product_images')}}/{{$user->product_photo}}" alt="Not Available">
                            </td>
                            <td>{{$user->created_at}}</td>
                            <td>
                              <div class="btn-group btn-group-sm" role="group">
                              <a href="{{ url('product/edit') }}/{{ $user->id }}" class="btn btn-warning">Edit</a>
                              <button class="btn btn-danger delete_btn" type="button" value="{{ url('product/delete') }}/{{ $user->id }}">Delete</button>
                              </div>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="6" class="text-center text-danger">Product is Empty</td>
                          </tr>
                          @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>

                <br>
                <br>

                <div class="card">
                  <h3 class="card-header">Product List</h3>
                  <div class="card-body">
                    <table class="table table-responsive d-block" id="product_trashed_data">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Product Name</th>
                          <th>Product Price</th>
                          <th>Quantity</th>
                          <th>Alert Quantity</th>
                          <th>Product Image</th>
                          <th>Product Deleted Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @forelse($product_soft_deletes as $product_soft_delete)
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$product_soft_delete->product_name}}</td>
                            <td>{{$product_soft_delete->product_price}}</td>
                            <td>{{$product_soft_delete->product_quantity}}</td>
                            <td>{{$product_soft_delete->alert_quantity}}</td>
                            <td>
                              <img height="50" width="50" src="{{asset('uploads/product_images')}}/{{$product_soft_delete->product_photo}}" alt="Not Available">
                            </td>
                            <td>{{$product_soft_delete->updated_at->diffForHumans()}}</td>
                            <td>
                              <div class="btn-group btn-group-sm" role="group">
                              <a href="{{ url('product/restore') }}/{{ $product_soft_delete->id }}" class="btn btn-dark">Restore</a>
                              <a href="{{ url('product/force/delete') }}/{{ $product_soft_delete->id }}" class="btn btn-danger">Force</a>
                              </div>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="6" class="text-center text-danger">Product is Empty</td>
                          </tr>
                          @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                  <h3 class="card-header">Product Insert List</h3>
                  <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{url('product/insert')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label>Product Category</label>
                        <select class="form-control" name="category_id">
                          <option value="">-Select-</option>
                          @foreach($categoryes as $category)
                            <option value="{{ $category->id }}">{{$category->category_name}}</option>
                          @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}">
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Short Description</label>
                        <textarea class="form-control" name="product_short_text" rows="2"></textarea>
                        @error('product_short_text')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Long Description</label>
                        <textarea class="form-control" name="product_long_text" rows="4"></textarea>
                        @error('product_long_text')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" name="product_price" value="{{ old('product_price') }}">
                        @error('product_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Quantity</label>
                        <input type="text" class="form-control" name="product_quantity" value="{{ old('product_quantity') }}">
                        @error('product_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Alert Quantity</label>
                        <input type="text" class="form-control" name="alert_quantity" value="{{ old('alert_quantity') }}">
                        @error('alert_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" class="form-control" name="product_photo">
                      </div>
                      <div class="form-group">
                        <label>Product Multiple Images</label>
                        <input type="file" class="form-control" name="product_multiple_photo[]" multiple>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                  </div>
              </div>
            </div>
          </div>
    </div>
  </div>


</x-app-layout>

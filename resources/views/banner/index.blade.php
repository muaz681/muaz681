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
                    <table class="table table-responsive d-block" id="product_data">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Banner Title</th>
                          <th>Banner Image</th>
                          <th>Image Inserted</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @forelse($banners as $banner)
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$banner->banner_title}}</td>
                            <td>
                              <img height="50" width="50" src="{!! asset('uploads/banner_images') !!}/{{ $banner->banner_photo }}" alt="">
                            </td>
                            <td>{{ $banner->created_at}}</td>
                            <td>--</td>
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
                  <h3 class="card-header">Banner Insert</h3>
                  <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{route('bannerinsert')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label>Banner Title</label>
                        <input type="text" class="form-control" name="banner_title">
                      </div>
                      <div class="form-group">
                        <label>banner Image</label>
                        <input type="file" class="form-control" name="banner_photo">
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

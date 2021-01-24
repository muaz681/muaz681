<x-app-layout>

  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Category
      </h2>

  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <h3 class="card-header">Category List</h3>
                  <div class="card-body">
                    <table class="table" id="product_data">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Category Name</th>
                          <th>Add Owner</th>
                          <th>Insert Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @forelse($categoryes as $category)
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{ App\Models\User::find($category->added_by)->name }}</td>
                            <td>{{$category->created_at}}</td>
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
                  <h3 class="card-header">Category Insert</h3>
                  <div class="card-body">
                    <form method="post" action="{{route('category.store')}}">
                      @csrf
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="category_name">
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

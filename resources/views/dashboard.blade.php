<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Muaz Dashboard
        </h2>

    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

              <!-- Muaz overwriting start -->
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Account Open</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td>{{$loop->index+1}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>
                            @if($user->created_at->diffForHumans() == '1 day ago')
                            {{ $user->created_at }}
                            @else
                            {{$user->created_at->diffForHumans()}}
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Muaz overwriting end -->

            </div>
        </div>
    </div>
</x-app-layout>

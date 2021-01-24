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
                          <th>Website</th>
                          <th>Subject</th>
                          <th>Message</th>
                          <th>File</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                          <td>{{$loop->index+1}}</td>
                          <td>{{$contact->first_name}}</td>
                          <td>{{$contact->email}}</td>
                          <td>{{$contact->website}}</td>
                          <td>{{$contact->subject}}</td>
                          <td>{{$contact->message}}</td>
                          <td>
                            @if ($contact->upload_file == 'No File')
                              <button type="button" class="btn btn-danger btn-sm">No File</button>
                            @else
                              <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                <a class="btn btn-warning" href="{!! asset('storage/contact_file') !!}/{{ $contact->upload_file }}" target="_blank">View</a>
                                <a class="btn btn-success" href="{{ url('contact/download') }}/{{ $contact->upload_file }}">Download</a>
                              </div>
                            @endif
                          </td>
                          <td>--</td>
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Raffles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

              <div class="table-responsive">
                <table class="table table-striped table-sm table-hover text-center">
                  <tr>
                    <th>Raffle Name</th>
                    <th>Names</th>
                    <th>Prizes</th>
                    <th>Results</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                  @forelse ($raffles as $raffle)
                    <tr>
                      <td>{{ $raffle->name }}</td>
                      <td>{{ $raffle->names->count() }}</td>
                      <td>{{ $raffle->prizes->count() }}</td>
                      <td>{{ $raffle->results->count() }}</td>
                      <td>{{ $raffle->created_at }}</td>
                      <td>
                        <a class="btn-sm btn-info" href="{{ route('raffle.view', $raffle->id) }}">View</a>
                        <a class="btn-sm btn-info" href="{{ route('raffle.edit', $raffle->id) }}">Upload</a>
                        <a class="btn-sm btn-info" href="{{ route('raffle.show', $raffle->id) }}">Draw</a>
                        <a class="btn-sm btn-info" href="{{ route('raffle.results', $raffle->id) }}">Results</a>
                        <a class="btn-sm btn-info" href="{{ route('raffle.reset', $raffle->id) }}">Reset</a>
                        <a class="btn-sm btn-info" href="">Delete</a>
                      </td>
                    </tr>
                  @empty
                    No raffles
                  @endforelse
                </table>
              </div>
              <div class="d-flex flex-row">
                <div class="p-2"><a class="btn btn-info" href="{{ route('raffle.create')}}">Create New Raffle</a></div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>

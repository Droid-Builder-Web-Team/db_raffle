<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Raffles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <a class="btn btn-info" href="{{ route('raffle.create')}}">Create New Raffle</a>
              <table>
                <tr>
                  <th>Raffle Name</th>
                  <th>Names</th>
                  <th>Prizes</th>
                  <th>Results</th>
                  <th>Actions</th>
                </tr>
                @forelse ($raffles as $raffle)
                  <tr>
                    <td>{{ $raffle->name }}</td>
                    <td>{{ $raffle->names->count() }}</td>
                    <td>{{ $raffle->prizes->count() }}</td>
                    <td>{{ $raffle->results->count() }}</td>
                    <td>
                      <a class="btn-sm btn-info" href="">Edit</a>
                      <a class="btn-sm btn-info" href="">Draw</a>
                      <a class="btn-sm btn-info" href="">Results</a>
                      <a class="btn-sm btn-info" href="">Reset</a>
                      <a class="btn-sm btn-info" href="">Delete</a>
                    </td>
                  </tr>
                @empty
                  No raffles
                @endforelse
              </table>
            </div>
        </div>
    </div>
</x-app-layout>

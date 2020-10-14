<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Raffles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="card">
                <div class="card-header">
                  View Raffle - {{ $raffle->name}}
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <td>Name</td>
                          <td>Picked?</td>
                        </tr>
                          @foreach($names as $name)
                            <tr><td>{{$name->name}}</td><td>{{ $name->picked }}</td></tr>
                          @endforeach
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table>
                        <tr>
                          <td>Prize</td>
                          <td>Picked?</td>
                        </tr>
                          @foreach($prizes as $prize)
                            <tr><td>{{$prize->name}}</td><td>{{ $prize->picked }}</td></tr>
                          @endforeach
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>

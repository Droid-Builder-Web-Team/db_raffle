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
                      <div class="table-responsive">
                        <table class="table table-striped table-sm table-hover text-center">
                          <tr>
                            <td>Name</td>
                            <td>Picked?</td>
                          </tr>
                            @foreach($names as $name)
                              <tr><td>{{$name->name}}</td>
                                <td><input type="checkbox" name="picked" {{ $name->picked == 1 ? 'checked="Yes"' : 'value=Yes' }} class="form-control"></td>
                              </tr>
                            @endforeach
                        </table>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="table-responsive">
                        <table class="table table-striped table-sm table-hover text-center">
                          <tr>
                            <td>Prize</td>
                            <td>Picked?</td>
                          </tr>
                            @foreach($prizes as $prize)
                              <tr><td>{{$prize->name}}</td>
                                <td><input type="checkbox" name="picked" {{ $prize->picked == 1 ? 'checked="Yes"' : 'value=Yes' }} class="form-control"></td>
                              </tr>
                            @endforeach
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>

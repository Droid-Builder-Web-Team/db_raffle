<x-app-layout>

  <script>
   function exportResults(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>
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
                  View Raffle Results - {{ $raffle->name}}
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-sm table-hover text-center">
                          <tr>
                            <td>Name</td>
                            <td>Prize</td>
                          </tr>
                            @foreach($results as $result)
                              <tr><td>{{$result->name}}</td><td>{{ $result->prize }}</td></tr>
                            @endforeach
                        </table>
                      </div>
                      <div class="d-flex flex-row">
                        <div class="p-2">
                          <span data-href="{{ route('raffle.export', $raffle->id )}}" id="export" class="btn btn-success btn-sm align-right" onclick="exportResults(event.target);">Export</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>

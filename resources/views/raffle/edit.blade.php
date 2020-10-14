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
                  Upload Raffle File- {{ $raffle->name }}
                </div>
                <div class="body">
                  Upload name and prize lists. These should be a plain text file, with a name/prize per line.
                  <form action="{{ route('raffle.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $raffle->id}}">
                    <div class="form-group">
                      <label for="raffleNames">Names</label>
                      <input type="file" id="raffleNames" name="names" class="form-control" required="">
                    </div>
                    <div class="form-group">
                      <label for="rafflePrizes">Prizes</label>
                      <input type="file" id="rafflePrizes" name="prizes" class="form-control" required="">
                    </div>
                    <div class="d-flex flex-row">
                      <div class="p-2"><input type="Submit" name="Submit" value="Submit"></div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>

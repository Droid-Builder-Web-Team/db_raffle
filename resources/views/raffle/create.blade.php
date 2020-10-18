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
                  Create Raffle
                </div>
                <div class="card-body">
                  <form action="{{ route('raffle.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="raffleName">Name</label>
                      <input type="text" id="raffleName" name="name" class="form-control" required="">
                    </div>
                    <div class="form-group">
                      <label for="raffleTheme">Theme</label>
                      <select name="theme">
                        <option value="default">Default</option>
                        <option value="droidbuilders">Droid Builders</option>
                        <option value="droidbuilders_xmas">Droid Builders Xmas</option>
                      </select>
                    </div>
                    <input type="Submit" name="Submit" value="Submit">
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>

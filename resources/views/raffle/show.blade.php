<x-app-layout>

  <script>
  function updateDraw() {
    console.log("Draw!!!!");
    $.ajax({
      url: "/raffle/draw/{{$raffle->id}}",
      dataType: "json",
      cache: false,
      success: function(data) {
        console.log(data);
        $('#raffleName').text(data['name']);
        $('#rafflePrize').text(data['prize']);
      }
    });

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
              <button class="btn btn-danger" onClick="updateDraw()">DRAW!</button>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div id="raffleName"></div>
              </div>
              <div class="col-md-6">
                <div id="rafflePrize"></div>
              </div>
        </div>
    </div>


</x-app-layout>

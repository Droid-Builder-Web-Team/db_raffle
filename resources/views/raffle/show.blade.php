<x-draw-layout>

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
        $('#namesLeft').text(data['names_left']);
        $('#prizesLeft').text(data['prizes_left']);
        if (data['prizes_left'] == 0) {
          console.log("No more prizes left");
          $('#draw').prop('disabled', true);
          $('#draw').text('No More Prizes!');
        }
      }
    });

  }

  $( document ).ready(function() {
    if({{ $raffle->prizes_left()->count()}} == 0) {
        $('#draw').prop('disabled', true);
        $('#draw').text('No More Prizes!');
    }
});

  </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('raffle.index')}}">Droid Builders Raffle Draw</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="row justify-content-md-center">
                <div class="col-md-auto">
                  <div id="raffleName">Who will win</div>
                </div>
                <div class="col-md-auto">
                  <div id="rafflePrize">What?</div>
                </div>
              </div>
              <div class="row justify-content-md-center">
                <div class="col-md-1">
                  <button id="draw" class="btn btn-danger" onClick="updateDraw()">DRAW!</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  Names Left:
                </div>
                <div class="col-md-auto">
                  <div id="namesLeft">{{ $raffle->names_left()->count() }}</div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  Prizes Left:
                </div>
                <div class="col-md-auto">
                  <div id="prizesLeft">{{ $raffle->prizes_left()->count() }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>


</x-draw-layout>

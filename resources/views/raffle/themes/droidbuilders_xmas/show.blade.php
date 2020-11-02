<x-draw-layout :raffle="$raffle">

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

    <div class="w-100 p-3 h-100" style="background: linear-gradient(180deg,rgba(16, 20, 48, 1) 0%,rgba(0, 0, 0, 1) 100%);">

              <div class="row h-25">
                <div class="col-md-auto w-100 display-3 text-center" style="text-transform:uppercase; letter-spacing:5px;">Droid Builders Raffle</div>
              </div>
              <div class="row text-center p-4">
                <div class="col-md-auto w-50"><h1 class="title">Names Left:</h1> <div id="namesLeft">{{ $raffle->names_left()->count() }}</div></div>
                <div class="col-md-auto w-50"><h1 class="title">Prizes Left:</h1> <div id="prizesLeft">{{ $raffle->prizes_left()->count() }}</div></div>
              </div>
              <div class="row">
                <div class="col-md-auto w-50 display-1 text-center" style="text-transform:uppercase;" id="raffleName">Name</div>
                <div class="col-md-auto w-50 display-1 text-center" style="text-transform:uppercase;" id="rafflePrize">Prize</div>
              </div>
              <div class="row justify-content-md-center">
                <div class="col-md-1">
                  <button id="draw" class="btn btn-draw" onClick="updateDraw()">DRAW</button>
                </div>
              </div>

        </div>


</x-draw-layout>

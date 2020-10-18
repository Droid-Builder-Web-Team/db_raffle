<x-draw-layout :raffle="$raffle">

    <div class="w-100 p-3 h-100">

              <div class="row h-25">
                <div class="col-md-auto w-100 display-3 text-center">Droid Builders Raffle</div>
              </div>
              <div class="row text-center p-4">
                <div class="col-md-auto w-50">Names Left: <div id="namesLeft">{{ $raffle->names_left()->count() }}</div></div>
                <div class="col-md-auto w-50">Prizes Left: <div id="prizesLeft">{{ $raffle->prizes_left()->count() }}</div></div>
              </div>
              <div class="row h-50">
                <div class="col-md-auto w-50 display-1 text-center" id="raffleName">Who will win</div>
                <div class="col-md-auto w-50 display-1 text-center" id="rafflePrize">What?</div>
              </div>
              <div class="row justify-content-md-center">
                <div class="col-md-1">
                  <button id="draw" class="btn btn-danger" onClick="updateDraw()">DRAW!</button>
                </div>
              </div>



        </div>


</x-draw-layout>

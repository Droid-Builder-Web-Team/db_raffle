<x-draw-layout :raffle="$raffle">
<style>

/* The flip box container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
.flip-box {
  background-color: transparent;
  width: 20vw;
  height: 20vw;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
  position: absolute;
  left: 8px;
  bottom: 8px;
}

@keyframes spinSnowflake {
  50% {
    transform: rotateY(180deg);
  }

}

.animateSnowflake {
  animation: spinSnowflake 2s;
}

.animateSnowflakeConstant {
  animation: spinSnowflake 10s infinite linear;
}
</style>

    <script>

        var drawResult;

        /**
         * Start the 3 second countdown and perform a draw
         */
        function onDrawClicked()
        {
            draw();
            var count = 3;
            var countdownInterval;
            $('#snowflake').removeClass('animateSnowflake');
            $("#raffle-controls").hide();
            $("#countdown-container").show();
            $("#countdown").html(count);
            $("#countdown").fadeIn(300).delay(400);
            $("#countdown").fadeOut(300);

            countdownInterval = setInterval(function()
            {
                count--;
                $("#countdown").fadeIn(300).delay(400);
                $("#countdown").html(count);
                $("#countdown").fadeOut(300);
                if (count === 0)
                {
                    clearInterval(countdownInterval);
                    $("#draw").show();
                    $("#countdown-container").hide();
                    showResults();
                }
            }, 1000);
        }

        function draw()
        {
            $('#raffleName').text("NAME");
            $('#rafflePrize').text("PRIZE");
            $.ajax({
                url: "/raffle/draw/{{ $raffle->id }}",
                dataType: "json",
                cache: false,
                success: function(data) {
                    // Cache the draw result to display after the countdown
                    drawResult = data;
                }
            });
        }

        /**
         * Show the results for the draw and reset the UI for another raffle
         */
        function showResults()
        {
            $('#raffleName').text(drawResult['name']);
            $('#rafflePrize').text(drawResult['prize']);
            $('#namesLeft').text(drawResult['names_left']);
            $('#prizesLeft').text(drawResult['prizes_left']);
            $('#snowflake').addClass('animateSnowflake');
            reset();
            if (drawResult['prizes_left'] == 0)
            {
                onRaffleOver();
            }
        }

        /**
         * Reset for another draw
         */
        function reset()
        {
            $("#raffle-controls").show();
            $("#raffle-done-container").hide();
            $("#countdown-container").hide();
            $("#countdown").html(3);
        }

        /**
         * Update the UI to display the "raffle ended" message and hide the
         * raffle controls.
         */
        function onRaffleOver()
        {
            $("#raffle-controls").hide();
            $("#raffle-done-container").show();
            $('#snowflake').addClass('animateSnowflakeConstant');
        }

        $(document).ready(function() {
            reset();
            if ({{ $raffle->prizes_left()->count() }} == 0)
            {
                onRaffleOver();
            }
        });

    </script>

    <div class="w-100 p-3 h-100"
        style="background: linear-gradient(180deg,rgba(16, 20, 48, 1) 0%,rgba(0, 0, 0, 1) 100%);">

        <div class="row h-25">
            <div class="col-md-auto w-100 display-3 text-center" style="text-transform:uppercase; letter-spacing:5px;">
                Droid Builders UK Raffle
            </div>
        </div>

        <div class="row text-center p-4" >
            <div class="col-md-auto w-50">
                <h1 class="title">Names Left:</h1>
                <div id="namesLeft">{{ $raffle->names_left()->count() }}</div>
            </div>
            <div class="col-md-auto w-50">
                <h1 class="title">Prizes Left:</h1>
                <div id="prizesLeft">{{ $raffle->prizes_left()->count() }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-auto w-50 display-1 text-center" style="text-transform:uppercase;" id="raffleName">Name
            </div>
            <div class="col-md-auto w-50 display-1 text-center" style="text-transform:uppercase;" id="rafflePrize">Prize
            </div>
        </div>
        <div class="row countdown-row" id="raffle-controls">
            <div class="col-12 text-center">
                <button class="btn btn-draw" onClick="onDrawClicked()">DRAW</button>
            </div>
        </div>

        <div id="raffle-done-container">
            No more prizes!
        </div>

        <div class="row countdown-row" id="countdown-container">
            <div class="col-12 text-center">
                <div id="countdown"></div>
            </div>
        </div>
        <div class="flip-box">
          <img src="{{ '/'.$raffle->theme.'/snowflake.png' }}" id="snowflake">
        </div>
</div>

    </div>

</x-draw-layout>

<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\Name;
use App\Models\Prize;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RaffleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raffles = auth()->user()->raffles;
        return view('raffle.index', compact('raffles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('raffle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $raffle = new Raffle;
        $raffle->name = $request->name;
        $raffle->user_id = auth()->user()->id;

        try {
          $raffle->save();
          toastr()->success('Raffle created successfully');
        } catch (\Illuminate\Database\QueryException $exception) {
          toastr()->error('Failed to create Raffle ');
        }

        return redirect()->route('raffle.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Raffle  $raffle
     * @return \Illuminate\Http\Response
     */
    public function show(Raffle $raffle)
    {
        return view('raffle.show', compact('raffle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Raffle  $raffle
     * @return \Illuminate\Http\Response
     */
    public function edit(Raffle $raffle)
    {
        return view('raffle.edit', compact('raffle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Raffle  $raffle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Raffle $raffle)
    {


    }

    public function process(Request $request)
    {
        $names = fopen($request->file('names')->path(), 'r');
        if ($names)
        {
            while (($name = fgets($names, 4096)) !== false ) {
              $new_name = new Name;
              $new_name->name = trim($name);
              $new_name->picked = 0;
              $new_name->raffle_id = $request->id;
              $new_name->save();
            }
            if (!feof($names)) {
              echo "Error: unexpected fgets() fail\n";
            }
            fclose($names);
        }

        $prizes = fopen($request->file('prizes')->path(), 'r');
        if ($prizes)
        {
            while (($prize = fgets($prizes, 4096)) !== false ) {
              $new_prize = new Prize;
              $new_prize->name = trim($prize);
              $new_prize->picked = 0;
              $new_prize->raffle_id = $request->id;
              $new_prize->save();
            }
            if (!feof($prizes)) {
              echo "Error: unexpected fgets() fail\n";
            }
            fclose($prizes);
        }

        return redirect()->route('raffle.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Raffle  $raffle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raffle $raffle)
    {
        //
    }

    public function draw($raffle_id)
    {

        $name = Name::where('raffle_id', $raffle_id)
                      ->where('picked', 0)
                      ->inRandomOrder()
                      ->limit(1)
                      ->first();
        $name->picked = 1;
        $name->save();

        $prize = Prize::where('raffle_id', $raffle_id)
                      ->where('picked', 0)
                      ->inRandomOrder()
                      ->limit(1)
                      ->first();
        $prize->picked = 1;
        $prize->save();

        $draw = [
          'name' => $name->name,
          'prize' => $prize->name
        ];

        $result = new Result;
        $result->name = $name->name;
        $result->prize = $prize->name;
        $result->raffle_id = $raffle_id;
        $result->save();

        return $draw;
    }
}

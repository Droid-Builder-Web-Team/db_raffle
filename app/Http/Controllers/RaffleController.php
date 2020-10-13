<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

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

        $raffle->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Raffle  $raffle
     * @return \Illuminate\Http\Response
     */
    public function edit(Raffle $raffle)
    {
        //
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
        //
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
}

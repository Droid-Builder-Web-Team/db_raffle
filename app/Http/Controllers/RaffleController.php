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
        $raffles = Raffle::where('user_id', auth()->user()->id)
                    ->OrderBy('created_at', 'desc')
                    ->get();
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
        $raffle = Raffle::find($request->id);
        if (auth()->user()->id != $raffle->user_id)
                    abort(403);
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
        $raffle = Raffle::find($raffle_id);
        if (auth()->user()->id != $raffle->user_id)
                    abort(403);
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

    public function view($raffle_id)
    {
        $raffle = Raffle::find($raffle_id);
        if (auth()->user()->id != $raffle->user_id)
                    abort(403);
        $names = Name::where('raffle_id', $raffle_id)->get();
        $prizes = Prize::where('raffle_id', $raffle_id)->get();

        return view('raffle.view', compact('names', 'prizes', 'raffle'));
    }

    public function results($raffle_id)
    {
        $raffle = Raffle::find($raffle_id);
        if (auth()->user()->id != $raffle->user_id)
                    abort(403);
        $results = Result::where('raffle_id', $raffle_id)->get();

        return view('raffle.results', compact('results', 'raffle'));
    }

    public function reset($raffle_id)
    {
        $raffle = Raffle::find($raffle_id);
        if (auth()->user()->id != $raffle->user_id)
                    abort(403);
        $names = Name::where('raffle_id', $raffle_id)->get();
        $prizes = Prize::where('raffle_id', $raffle_id)->get();
        $results = Result::where('raffle_id', $raffle_id)->get();
        foreach($names as $name)
        {
            $name->picked = 0;
            $name->save();
        }

        foreach($prizes as $prize)
        {
            $prize->picked = 0;
            $prize->save();
        }

        foreach($results as $result)
        {
            $result->delete();
        }

        return back();
    }

    public function export($raffle_id)
    {
        $raffle = Raffle::find($raffle_id);
        if (auth()->user()->id != $raffle->user_id)
                    abort(403);

        $fileName = 'results.csv';
        $results = Result::where('raffle_id', $raffle_id)->get();

        $headers = array(
              "Content-type"        => "text/csv",
              "Content-Disposition" => "attachment; filename=$fileName",
              "Pragma"              => "no-cache",
              "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
              "Expires"             => "0"
        );

        $columns = array('Raffle Date', 'Raffle Name', 'Winner', 'Prize');

        $callback = function() use($results, $columns, $raffle) {
              $file = fopen('php://output', 'w');
              fputcsv($file, $columns);

              foreach ($results as $result) {
                  $row['Raffle Date']  = $raffle->created_at;
                  $row['Raffle Name']    = $raffle->name;
                  $row['Winner']    = $result->name;
                  $row['Prize']  = $result->prize;

                  fputcsv($file, array($row['Raffle Date'], $row['Raffle Name'], $row['Winner'], $row['Prize']));
              }

              fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

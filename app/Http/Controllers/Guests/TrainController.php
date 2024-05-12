<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Train;

class TrainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trains = Train::all();
        return view('home', compact('trains'));
    }   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Train $train)
    {
       return view('guests.train.show', compact('train'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Train $train)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Train $train)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Train $train)
    {
        //
    }
}

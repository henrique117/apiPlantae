<?php

namespace App\Http\Controllers;

use App\Models\Nutrientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NutrientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensagens = Nutrientes::all();
        return view("restict/nutrientes", compact('nutrientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'N' => 'required',
            'K' => 'required',
            'P' => 'required',
            'Ca' => 'required',
            'Mg' => 'required',
            'S' => 'required',
        ]);
        if ($validated) {
            $nutrientes = new Nutrientes();
            $nutrientes->user_id = Auth::user()->id;
            $nutrientes->N = $request->get('N');
            $nutrientes->K = $request->get('K');
            $nutrientes->P = $request->get('P');
            $nutrientes->Ca = $request->get('Ca');
            $nutrientes->Mg = $request->get('Mg');
            $nutrientes->S = $request->get('S');
            $nutrientes->save();
            return redirect('nutrientes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nutrientes  $nutrientes
     * @return \Illuminate\Http\Response
     */
    public function show(Nutrientes $nutrientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nutrientes  $nutrientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Nutrientes $nutrientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nutrientes  $nutrientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nutrientes $nutrientes)
    {
        $validated = $request->validate([
            'N' => 'required',
            'K' => 'required',
            'P' => 'required',
            'Ca' => 'required',
            'Mg' => 'required',
            'S' => 'required',
        ]);
        if ($validated) {
            $nutrientes = new Nutrientes();
            $nutrientes->user_id = Auth::user()->id;
            $nutrientes->N = $request->get('N');
            $nutrientes->K = $request->get('K');
            $nutrientes->P = $request->get('P');
            $nutrientes->Ca = $request->get('Ca');
            $nutrientes->Mg = $request->get('Mg');
            $nutrientes->S = $request->get('S');
            $nutrientes->save();
            return redirect('nutrientes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nutrientes  $nutrientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nutrientes $nutrientes)
    {
        $nutrientes->delete();
        return redirect('nutrientes');
    }
}

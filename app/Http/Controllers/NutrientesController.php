<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Nutrientes;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NutrientesController extends Controller
{

    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nutrientes = Nutrientes::select(['id', 'user_id', 'N', 'P', 'K', 'Ca', 'Mg', 'S'])
            ->with('user:id,name')
            ->where('user_id', Auth::user()->id)
            ->get();
        if (count($nutrientes) > 0) {
            $nutrientes = $nutrientes[0];
        }
        return $this->success($nutrientes);
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
            try {
                $nutrientes = Nutrientes::firstWhere('user_id', Auth::user()->id);
                if (!$nutrientes) {
                    $nutrientes = new Nutrientes();
                }
                $nutrientes->user_id = Auth::user()->id;
                $nutrientes->N = $request->get('N');
                $nutrientes->K = $request->get('K');
                $nutrientes->P = $request->get('P');
                $nutrientes->Ca = $request->get('Ca');
                $nutrientes->Mg = $request->get('Mg');
                $nutrientes->S = $request->get('S');
                $nutrientes->save();

                return $this->success($nutrientes);
            } catch (\Throwable $th) {
                return $this->error("Erro ao cadastrar os nutrientes, verifique as informações!!!", 401, $th->getMessage());
            }
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
        try {
            $nutrientes = Nutrientes::where('id', $id)->with('topicos')->get();
            return $this->success($nutrientes[0]);
        } catch (\Throwable $th) {
            return $this->error("Error", 401, $th->getMessage());
        }
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
        try {
            $nutrientes = Nutrientes::findOrFail($id);
            $nutrientes->delete();
            return $this->success($nutrientes);
        } catch (\Throwable $th) {
            return $this->error("Erro ao deletar nutriente", 401, $th->getMessage());
        }
    }
}

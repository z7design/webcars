<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Repositories\VeiculoRepository;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    public function __construct(Veiculo $veiculo){
        $this->veiculo = $veiculo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $veiculoRepository = new VeiculoRepository($this->veiculo);

        if($request->has('atributos_modelo')){
            $atributos_modelo = 'modelos:id,' .$request->atributos_modelo;
            $veiculoRepository->selectAtributosRegistrosRelacionados($atributos_modelo);

        }else {
            $veiculoRepository->selectAtributosRegistrosRelacionados('modelo');
        }
        if($request->has('filtro')){
            $veiculoRepository->filtro($request->filtro);
        }
        if($request->has('atibutos')){
            $veiculoRepository->selectAtributos($request->atributos);

        }
        return response()->json($veiculoRepository->getResultado(), 200);
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
        $request->validate($this->veiculo->rules());

        $veiculo = $this->veiculo->create([
            'modelo_id' => $request->modelo_id,
            'placa' => $request->placa,
            'disponivel' => $request->disponivel,
            'km' => $request->km,
            'ano' => $request->ano,
            'descricao' => $request->descricao,
            'vendido' => $request->vendido
        ]);
        return response()->json($veiculo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculo = $this->veiculo->with('modelo')->find($id);
        if($veiculo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }
        return response()->json($veiculo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Veiculo $veiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $veiculo = $this->veiculo->find($id);

        if($veiculo === null){
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }
        if($request->method() === 'PATCH'){
            $regrasDinamicas = array();


            foreach ($veiculo->rules() as $input => $regra ){

                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);

        }else {
            $request->validate($veiculo->rules());
        }

        $veiculo->fill($request->all());
        $veiculo->save();

        return response()->json($veiculo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veiculo = $this->veiculo->find($id);

        if($veiculo === null){
            return response()->json(['erro' => 'Impossível realizar a Exclusão. O recurso solicitado não existe'], 404);
        }
        $veiculo->delete();
        return response()->json(['Veiculo removido com sucesso!!'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use App\Models\images;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function __construct(Produtos $Produto,images $Images)
    {
        $this->produto = $Produto;
        $this->images = $Images;
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->produto->with('Images')->get();
        return $response; 
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->produto->rules(),$this->produto->feedback()); //valida dados da tabela produto
        $request->validate($this->images->rules(),$this->images->feedback()); //valida dados da tabela images

        $storeProducts = $this->produto;
        $storeProducts->name = $request->name;
        $storeProducts->description = $request->description;
        $storeProducts->dimensions = $request->dimensions;
        $storeProducts->line = $request->line;
        $storeProducts->save();

        $image = $request->file('image');
        $image_urn = $image->store('image','public');
        $storeImage = $this->images;
        $storeImage->image = $image_urn;
        $storeImage->produtos_id = $storeProducts->id;
        $storeImage->save();

        return $storeImage;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $response = $this->produto->with('Images')->find($id);

        if(!$response) return ['msg' => 'item não identificado'];

        return $response;
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $changeProduct = $this->produto->find($id);
        
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produtos $produtos)
    {
        //
    }
}

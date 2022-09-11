<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seleksi;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SeleksiResource;

class SeleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seleksis = Seleksi::all();
        return response(['seleksis' => SeleksiResource::collection($seleksis),'message' => 'Data berhasil ditampilkan'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nama' => 'required|max:255',
            'harga' =>'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validasi data nama atau harga salah!']);
        }

        $seleksi = Seleksi::create($data);

        return response(['seleksi'=> new SeleksiResource($seleksi), 'message'=>'Data proyek berhasil ditambahkan'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seleksi  $seleksi
     * @return \Illuminate\Http\Response
     */
    public function show(Seleksi $seleksi)
    {
        return response(['seleksi'=> new SeleksiResource($seleksi), 'message'=>'Data proyek berhasil diambil'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seleksi  $seleksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seleksi $seleksi)
    {
        $seleksi->update($request->all());

        return response(['seleksi'=> new SeleksiResource($seleksi), 'message'=>'Data proyek berhasil diubah'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seleksi  $seleksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seleksi $seleksi)
    {
        $seleksi->delete();

        return response(['message'=>'Data terhapus']);
    }
}

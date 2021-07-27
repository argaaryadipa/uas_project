<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarif;
use App\Models\Lapangan;

class tarifController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());
        $lapangan            = new Lapangan;
        $lapangan->nama_lapangan      = $request->nama_lapangan;
        $lapangan->jumlah_lapangan    = $request->jumlah_lapangan;
        $lapangan->luas_lapangan   = $request->luas_lapangan;
        $lapangan->save();

        foreach ($request->list_tarif as $key => $value) {
            $tarif = array(
                'mulai' => $value['mulai'],
                'selsai' => $value['selsai'],
                'perjam' => $value['perjam'],
                'id_lapangan' => $lapangan->id
            );
            $tarif = Tarif::create($tarif);
        }

        return response()->json([
                'message'       => 'success'
            ], 200);
    }
    public function edit($id)
    {
        $tarif = Tarif::find($id);
        return response()->json([
                'message'       => 'success',
                'data_tarif'  => $tarif
            ], 200);
    }
     public function update(Request $request, $id)
    {
        $tarif = Tarif::find($id);
         
        $lapangan            = new Lapangan;
        $lapangan->nama_lapangan      = $request->nama_lapangan;
        $lapangan->jumlah_lapangan    = $request->jumlah_lapangan;
        $lapangan->luas_lapangan   = $request->luas_lapangan;
        $lapangan->save();

        foreach ($request->list_tarif as $key => $value) {
            $tarif = array(
                'mulai' => $value['mulai'],
                'selsai' => $value['selsai'],
                'perjam' => $value['perjam'],
                'id_lapangan' => $lapangan->id
            );

        return response()->json([
                'message'       => 'success',
                'data_Lapangan'  => $lapangan
            ], 200);
    }

    public function delete($id)
    {
        $tarif = Tarif::find($id)->delete();

        return response()->json([
                'message'       => 'data Tarif berhasil dihapus'
            ], 200);
    }
}

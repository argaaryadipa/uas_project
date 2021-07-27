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
        $lapangan                     = new Lapangan;
        $lapangan->nama_lapangan      = $request->nama_lapangan;
        $lapangan->jumlah_lapangan    = $request->jumlah_lapangan;
        $lapangan->luas_lapangan      = $request->luas_lapangan;
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
                'message'       => 'success',
                'data_lapangan' => $lapangan
            ], 200);
    }
    public function edit($id)
    {
        $lapangan = Lapangan::with('tarif')->where('id', $id)->first();
        return response()->json([
                'message'       => 'success',
                'data_lapangan' => $lapangan
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $lapangan = Lapangan::find($id);

        // dd($request->all());
        $lapangan->update([
            'nama_lapangan'  => $request->nama_lapangan,
            'jumlah_lapangan'=> $request->jumlah_lapangan,
            'luas_lapangan'  => $request->luas_lapangan
        ]);
        
        Tarif::where('id_lapangan', $id)->delete();

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
            'message'       => 'data Tarif berhasil ubah'
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

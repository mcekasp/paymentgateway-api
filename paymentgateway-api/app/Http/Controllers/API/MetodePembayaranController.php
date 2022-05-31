<?php

namespace App\Http\Controllers\API;

use App\Helpers\apiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Metode_Pembayaran;
use Exception;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Metode_Pembayaran::all();

        if($data){
            return apiFormatter::createAPI(200, 'Berhasil', $data);
        }else{
            return apiFormatter::createAPI(400, 'Gagal');
        }
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
        try {
            $request->validate([
                'nama_penyedia' => 'required',
                'tarif_transaksi' => 'required',
            ]);

            $metode = Metode_Pembayaran::create([
                'nama_penyedia' => $request->nama_penyedia,
                'tarif_transaksi' => $request->tarif_transaksi
            ]);

            $data = Metode_Pembayaran::where('id', '=', $metode->id)->get();

            if($data){
                return apiFormatter::createAPI(200, 'Berhasil', $data);
            }else{
                return apiFormatter::createAPI(400, 'Gagal');
            }

        } catch (Exception $error) {
            return apiFormatter::createAPI(400, 'Gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Metode_Pembayaran::where('id', '=', $id)->get();

        if($data){
            return apiFormatter::createAPI(200, 'Berhasil', $data);
        }else{
            return apiFormatter::createAPI(400, 'Gagal');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_penyedia' => 'required',
                'tarif_transaksi' => 'required',
            ]);

            $metode = Metode_Pembayaran::findOrFail($id);

            $metode->update([
                'nama_penyedia' => $request->nama_penyedia,
                'tarif_transaksi' => $request->tarif_transaksi
            ]);

            $data = Metode_Pembayaran::where('id', '=', $metode->id)->get();

            if($data){
                return apiFormatter::createAPI(200, 'Berhasil', $data);
            }else{
                return apiFormatter::createAPI(400, 'Gagal');
            }

        } catch (Exception $error) {
            return apiFormatter::createAPI(400, 'Gagal');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $metode = Metode_Pembayaran::findOrFail($id);

            $data = $metode->delete();
    
            if($data){
                return apiFormatter::createAPI(200, 'Data Berhasil Dihapus');
            }else{
                return apiFormatter::createAPI(400, 'Gagal');
            }
        } catch (Exception $error) {
            return apiFormatter::createAPI(400, 'Gagal');
        }
        
       
    }
}

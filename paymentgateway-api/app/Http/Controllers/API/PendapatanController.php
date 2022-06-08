<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendapatan;
use App\Helpers\apiFormatter;
use Exception;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pendapatan::all();

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
                'id_logging' => 'required',
                'id_tiket_hotel' => 'nullable',
                'id_tiket_transportasi' => 'nullable',
                'tarif_transaksi' => 'required',
                'status_pembayaran'
            ]);


            $pendapatan = Pendapatan::create([
                'id_pesanan' => $request->id_pesanan,
                'id_tiket_hotel' => $request->id_tiket_hotel,
                'id_tiket_transportasi' => $request->id_tiket_transportasi,
                'tarif_transaksi' => $request->tarif_transaksi,
            ]);

            $data = Pendapatan::where('id', '=', $pendapatan->id)->get();

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
        $data = Pendapatan::where('id', '=', $id)->get();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\Pendapatan;
use App\Helpers\apiFormatter;
use Exception;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pesanan::all();

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
                'id_pelanggan' => 'required',
                'id_vendor' => 'required',
                'id_ticket' => 'required',
                'id_metode' => 'required',
                'total' => 'required',
            ]);

            $pesanan = Pesanan::create([
                'id_pelanggan' => $request->id_pelanggan,
                'id_vendor' => $request->id_vendor,
                'id_ticket' => $request->id_ticket,
                'id_metode' => $request->id_metode,
                'total' => $request->total,
                'status' => $request->status
            ]);

            $tarif = DB::table('metode_pembayaran')
                        ->where('id', '=' , $request->id_metode)
                        ->pluck('tarif_transaksi');
            
            $pendapatan = Pendapatan::create([
                'id_pesanan' => $pesanan->id,
                'id_ticket' => $request->id_ticket,
                'tarif_transaksi' => $tarif[0],
            ]);

            $data1 = Pesanan::where('id_pesanan', '=', $pesanan->id)->get();
            $data2 = Pendapatan::where('id_pendapatan', '=', $pendapatan->id)->get();

            if($data2){
                return apiFormatter::createAPI(200, 'Berhasil', $data2);
            }else{
                return apiFormatter::createAPI(400, 'Gagal');
            }

        } catch (Exception $error) {
            return $error;
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
        $data = Pesanan::where('id_pesanan', '=', $id)->get();

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

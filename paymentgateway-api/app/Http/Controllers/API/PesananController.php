<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\Pendapatan;
use App\Models\Logging;
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
                'nama_pelanggan' => 'required',
                'id_tiket_hotel' => 'nullable',
                'id_tiket_transportasi' => 'nullable',
                'metode_pembayaran' => 'required',
                'total' => 'required',
            ]);

            $pesanan = Pesanan::create([
                'id_pelanggan' => $request->id_pelanggan,
                'nama_pelanggan' => $request->nama_pelanggan,
                'id_tiket_hotel' => $request->id_tiket_hotel,
                'id_tiket_transportasi' => $request->id_tiket_transportasi,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total' => $request->total,
                'kode_bayar' => $this->generateUniqueCode()
            ]);

            $get_kode = DB::table('pesanan')->where('id_pesanan', '=', $pesanan->id)->pluck('kode_bayar');
            $kode = $get_kode[0];

            $tarif = DB::table('metode_pembayaran')
                        ->where('id', '=' , $request->metode_pembayaran)
                        ->pluck('tarif_transaksi');
            $penyedia = DB::table('metode_pembayaran')
                        ->where('id', '=' , $request->metode_pembayaran)
                        ->pluck('nama_penyedia');

            $total = $request->total;
            $setor_vendor = $total - $tarif[0];

            $logging = Logging::create([
                'id_pesanan' => $pesanan->id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'id_tiket_hotel' => $request->id_tiket_hotel,
                'id_tiket_transportasi' => $request->id_tiket_transportasi,
                'metode_pembayaran' => $penyedia[0],
                'total' => $setor_vendor,
                'kode_bayar' => $kode
            ]);
            
            $pendapatan = Pendapatan::create([
                'id_logging' => $logging->id,
                'id_tiket_hotel' => $request->id_tiket_hotel,
                'id_tiket_transportasi' => $request->id_tiket_transportasi,
                'tarif_transaksi' => $tarif[0],
            ]);
            
            $data1 = Pesanan::where('id_pesanan', '=', $pesanan->id)->get();
            $data2 = Pendapatan::where('id', '=', $pendapatan->id)->get();
            $data3 = Logging::where('id', '=', $logging->id)->get();

            if($data3){
                return apiFormatter::createAPI(200, 'Pemesanan Berhasil! Kode Pembayaran Anda : ' . $kode, $data1);
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

    public function generateUniqueCode()
    {
        do {
            $code = random_int(1000000000000000, 9999999999999999);
        } while (Pesanan::where("kode_bayar", "=", $code)->first());
  
        return $code;
    }
}

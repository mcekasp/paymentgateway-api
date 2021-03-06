<?php

namespace App\Http\Controllers\API;

use App\Helpers\apiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Logging;
use App\Models\Pendapatan;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class LoggingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Logging::all();

        if ($data) {
            return apiFormatter::createAPI(200, "Success", $data);
        } else {
            return apiFormatter::createAPI(400, "Failed");
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
                'id_pesanan' => 'required',
                'id_vendor' => 'required',
                'id_ticket' => 'required',
                'total_pembayaran' => 'required',
                'status' => 'required'
            ]);

            $logging = Logging::create([
                'id_pesanan' => $request->id_pesanan,
                'id_vendor' => $request->id_vendor,
                'id_ticket' => $request->id_ticket,
                'total_pembayaran' => $request->total_pembayaran,
                'status' => $request->status
            ]);

            $data = Logging::where('id_logging', '=', $logging->id)->get();

            if ($data) {
                return apiFormatter::createAPI(200, "Success", $data);
            } else {
                return apiFormatter::createAPI(400, "Failed");
            }
        } catch (Exception $error) {
            return apiFormatter::createAPI(400, "Failed");
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
        $data = Logging::where('id', '=', $id)->get();

            if ($data) {
                return apiFormatter::createAPI(200, "Success", $data);
            } else {
                return apiFormatter::createAPI(400, "Failed");
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
    public function update($kode_bayar)
    {
        try {
            //$logging = Logging::findOrFail($kode_bayar);
            //$logging = Logging::where('kode_bayar', '=', $kode_bayar)->first();
            $getlogging = DB::table('logging')->where('kode_bayar', '=', $kode_bayar)->pluck('id');
            $idlogging = $getlogging[0];

            $logging = Logging::findOrFail($idlogging);
            $logging->update([
                'status_pembayaran' => 1,
                //'tanggal_pembayaran' => now()
            ]);
            $logging->touch();

            $pendapatan = Pendapatan::findOrFail($idlogging);
            $pendapatan->update([
                'status_pembayaran' => 1,
                'tanggal_pembayaran' => now()
            ]);

            $data = Logging::where('kode_bayar', '=', $logging->kode_bayar)->get();

            if ($data) {
                return apiFormatter::createAPI(200, "Pembayaran dengan kode pembayaran : " . $logging->kode_bayar . " Berhasil dilakukan. Terima kasih!", $data);
            } else {
                return apiFormatter::createAPI(400, "Failed");
            }
        } catch (Exception $error) {
            return $error;
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
        //
    }

    public function forHotel()
    {
        $hotel_payment = Logging::select('id','id_pesanan','nama_pelanggan','id_tiket_hotel','metode_pembayaran','total','kode_bayar','status_pembayaran','tanggal_pesanan','tanggal_pembayaran')
                            ->where('id_tiket_transportasi', '=', null)->get();
        
        if ($hotel_payment) {
            return apiFormatter::createAPI(200, "Success", $hotel_payment);
        } else {
            return apiFormatter::createAPI(400, "Failed");
        }
    }

    public function forTransport()
    {
        $transport_payment = Logging::select('id','id_pesanan','nama_pelanggan','id_tiket_transportasi','metode_pembayaran','total','kode_bayar','status_pembayaran','tanggal_pesanan','tanggal_pembayaran')
                            ->where('id_tiket_hotel', '=', null)->get();
        
        if ($transport_payment) {
            return apiFormatter::createAPI(200, "Success", $transport_payment);
        } else {
            return apiFormatter::createAPI(400, "Failed");
        }
    }
}

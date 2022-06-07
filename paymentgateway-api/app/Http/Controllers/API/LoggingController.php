<?php

namespace App\Http\Controllers\API;

use App\Helpers\apiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Logging;
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
        $data = Logging::where('id_logging', '=', $id)->get();

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
            //$request->validate([
            //    'id_pesanan' => 'required',
            //    'id_vendor' => 'required',
            //    'id_ticket' => 'required',
            //    'total_pembayaran' => 'required',
            //    'status' => 'required'
            //]);

            //$logging = Logging::findOrFail($kode_bayar);
            $logging = Logging::where('kode_bayar', '=', $kode_bayar);

            $logging->update([
                'status_pembayaran' => 0,
                'tanggal_pembayaran' => now()
            ]);

            $data = Logging::where('kode_bayar', '=', $logging->kode_bayar)->get();

            if ($data) {
                return apiFormatter::createAPI(200, "Success", $data);
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
}

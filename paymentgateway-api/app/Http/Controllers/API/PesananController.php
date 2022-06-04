<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
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
                'status' => 'required',
            ]);

            $pesanan = Pesanan::create([
                'id_pelanggan' => $request->id_pelanggan,
                'id_vendor' => $request->id_vendor,
                'id_ticket' => $request->id_ticket,
                'id_metode' => $request->id_metode,
                'total' => $request->total,
                'status' => $request->status
            ]);

            $data = Pesanan::where('id_pesanan', '=', $pesanan->id)->get();

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outlet;
use App\Product;
use App\StockOut;
use App\StockOutInfo;

class StokKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Stok Keluar';

        $model = StockOut::all();

        return view('inventori.stokkeluar.index', [
            'title' => $title,
            'models' => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = Outlet::all();
        $produk = Product::all();

        return view('inventori.stokkeluar.tambah', ['outlets' => $outlet, 'produks' => $produk]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd($request);
        $model = new StockOut();
        $model->outlet_id = $request->outlet;
        $model->description = $request->catatan;
        $model->user_id = 25;
        $model->tanggal = \App\Helpers\AppHelper::tanggalToMysql($request->tanggal);
        $model->save();

        $model_info = new StockOutInfo();
        $model_info->stock_out_id = $model->id;
        $model_info->product_id = $request->produk;
        $model_info->jumlah = $request->jumlah;
        $model_info->save();

        return redirect('/inventori/stokkeluar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('pembelian.index', compact('supplier'));
    }

    public function listData()
    {
        $pembelian = Pembelian::leftJoin('supplier', 'supplier.id_supplier', '=', 'pelian.id_supplier')
                        ->orderBy('pembelian.id_pembelian', 'desc')
                        ->get();
        $data = array();

        foreach ($pembelian as $key => $list) {
            $no = $key + 1;
            $row = array();
            $row[] = $no;
            $row[] = tanggal_indonesia(substr($list->created_at, 0, 10), false);
            $row[] = $list->nama;
            $row[] = $list->total_item;
            $row[] = "Rp. " . format_uang($list->total_harga);
            $row[] = $list->diskon. '%';
            $row[] = "Rp. " . format_uang($list->bayar);
            $row[] = '
                <div class="btn-group w-100">
                    <a onclick="editForm('. $list->id_pembelian .')" class="btn btn-info btn-sm btn-icon" aria-label="Button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                    </a>
                    <a onclick="deleteData('. $list->id_pembelian .')" class="btn btn-danger btn-sm btn-icon" aria-label="Button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    </a>
                </div>
            ';
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pembelian = new Pembelian();
        $pembelian->id_supplier = $id;
        $pembelian->total_item = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon = 0;
        $pembelian->bayar = 0;
        $pembelian->save();

        session(['idpembelian' => $pembelian->id_pembelian]);
        session(['idsupplier' => $id]);

        return redirect()->route('pembelian_detail.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pembelian = Pembelian::find($request->idpembelian);
        $pembelian->total_item = $request->total_item;
        $pembelian->total_harga = $request->total;
        $pembelian->diskon = $request->diskon;
        $pembelian->bayar = $request->bayar;
        $pembelian->update();

        $detail = PembelianDetail::where('id_pembelian', '=', $request->idpembelian)->get();
        foreach($detail as $data) {
            $produk = Produk::where('kode_produk', '=', $data->kode_produk)->first();
            $produk->stok += $data->jumlah;
            $produk->update();
        }
        return redirect()->route('pembelian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = PembelianDetail::leftJoin('produk', 'produk.kode_produk', '=', 'pembelian_detail.kode_produk')
                    ->where('id_pembelian', '=', $id)
                    ->get();
        $no = 0;
        $data = array();
        foreach($detail as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama_produk;
            $row[] = "Rp. ". format_uang($list->harga_beli);
            $row[] = $list->jumlah;
            $row[] = 'Rp. '. format_uang($list->harga_beli * $list->jumlah);
            $row[] = $row;
        }
        $output = array('data' => $data);
        return response()->json($output);
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
        $pembelian = Pembelian::find($id);
        $pembelian->delete();

        $detail = PembelianDetail::where('id_pembelian', '=', $id)->get();
        foreach($detail as $data) {
            $produk = Produk::where('kode_produk', '=', $data->kode_produk)->first();
            $produk->stok = $data->jumlah;
            $produk->update();
            $data->delete();
        }
    }
}

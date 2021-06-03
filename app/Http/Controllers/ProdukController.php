<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
// use Barryvdh\DomPDF\PDF;
use PDF;
// use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Rect;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('produk.index', compact('kategori'));
    }

    public function listData()
    {
        $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                        ->orderBy('produk.id_produk', 'desc')
                        ->get();
        $no = 0;
        $data = array();
        foreach($produk as $list) {
            $no++;
            $row = array();
            $row[] = "<input type='checkbox' name='id[]' value='". $list->id_produk ."'>";
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama_produk;
            $row[] = $list->nama_kategori;
            $row[] = $list->merk;
            $row[] = "Rp. ". format_uang($list->harga_beli);
            $row[] = "Rp. ". format_uang($list->harga_jual);
            $row[] = $list->diskon. "%";
            $row[] = $list->stok;
            $row[] = "
            <div class='btn-group w-100'>
                    <a onclick='editForm(". $list->id_produk .")' class='btn btn-info btn-sm btn-icon' aria-label='Button'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg>
                    </a>
                    <a onclick='deleteData(". $list->id_produk .")' class='btn btn-danger btn-sm btn-icon' aria-label='Button'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg>
                    </a>
                </div>
            ";
            $data[] = $row;
        }
        return Datatables::of($data)->escapeColumns([])->make(true);
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
        $validator = Validator::make($request->all(), [
            'kode' => 'required|numeric',
            'nama' => 'required',
            'kategori' => 'required',
            'merk' => 'required',
            'harga_beli' => 'required',
            'diskon' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        // $kode = (int)$request->kode;
        // dd($kode);
        $jml = Produk::where('kode_produk', '=', $request['kode'])->count();
        if ($jml < 1) {
            $produk = new Produk;
            $produk->kode_produk = $request['kode'];
            $produk->nama_produk = $request['nama'];
            $produk->id_kategori = $request['kategori'];
            $produk->merk = $request['merk'];
            $produk->harga_beli = $request['harga_beli'];
            $produk->diskon = $request['diskon'];
            $produk->harga_jual = $request['harga_jual'];
            $produk->stok = $request['stok'];
            $produk->save();
            echo json_encode(array('msg' => 'success'));
        } else {
            echo json_encode(array('msg' => 'error'));
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
        $produk = Produk::find($id);
        echo json_encode($produk);
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
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            'merk' => 'required',
            'harga_beli' => 'required',
            'diskon' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $produk = Produk::find($id);
        $produk->nama_produk = $request['nama'];
        $produk->id_kategori = $request['kategori'];
        $produk->merk = $request['merk'];
        $produk->harga_beli = $request['harga_beli'];
        $produk->diskon = $request['diskon'];
        $produk->harga_jual = $request['harga_jual'];
        $produk->stok = $request['stok'];
        $produk->update();
        echo json_encode(array('msg' => 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
    }

    public function deleteSelected(Request $request)
    {
        foreach($request['id'] as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }
    }

    public function printBarcode(Request $request)
    {
        $dataproduk = array();
        foreach($request['id'] as $id) {
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }
        $no = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}

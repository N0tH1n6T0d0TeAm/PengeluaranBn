<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Cafe;
use App\Models\Transaksi;
use App\Models\Pembelian_Detail;
use App\Models\Transaksi_Cafe;
use App\Models\Detail_Cafe;

class pengeluaran extends Controller
{
    ################################################REMPAH-REMPAH#######################################
    function menu(Request $req)
    {
        $menu = new Menu;
        $menu->nama_menu = $req->nama_menu;
        $menu->save();
        return redirect()->back();
    }
    function tampilMenu()
    {
        $tampil = Menu::all();
        return view('daftar_rempah', ['lihat' => $tampil]);
    }

    function edit($id)
    {
        $see = Menu::find($id);
        return response()->json([
            'status' => 200,
            'tampil' => $see,
        ]);
    }

    function update_menu(Request $req)
    {
        $menu_id = $req->input('men_id');
        $update = Menu::find($menu_id);
        $update->nama_menu = $req->input('nama_menu');
        $update->update();
        return redirect()->back();
    }

    function kill($id)
    {
        $kill = Menu::find($id);
        $kill->delete();
        return redirect()->back();
    }
    ################################################REMPAH-REMPAH#######################################



    ################################################CAFFFFFFEEEEEEESSSS#######################################
    function cafe(Request $req)
    {
        $cafe = new Cafe;
        $cafe->nama_barang = $req->nama_barang;
        $cafe->save();
        return redirect()->back();
    }

    function tampilCafe()
    {
        $tampil = Cafe::all();
        return view('daftar_cafe', ['lihat' => $tampil]);
    }

    function edit_cafe($id)
    {
        $see = Cafe::find($id);
        return response()->json([
            'status' => 200,
            'tampil' => $see,
        ]);
    }

    function update_menu_cafe(Request $req)
    {
        $cafe_id = $req->input('bar_id');
        $update = Cafe::find($cafe_id);
        $update->nama_barang = $req->input('nama_barang');
        $update->update();
        return redirect()->back();
    }

    function kill_cafe($id)
    {
        $kill = Cafe::find($id);
        $kill->delete();
        return redirect()->back();
    }
    ################################################CAFFFFFFEEEEEEESSSS#######################################

 ################################################TRANSAKSI____REMPAH###########################################
    function tampilRempah()
    {
        $rempah = Menu::all();
        return view('transaksi', ['rempah' => $rempah]);
    }



    function dataRempah(Request $request)
    {
        $transaksi_jumlah = 0;
        $data = $request->all();
        $transaksi = new Transaksi;
        $no_po = Transaksi::whereDate('tanggal', Carbon::today())->count();
        $no_po++;
        $no_nota_po = date('ymd') . str_pad($no_po, 3, 0, STR_PAD_LEFT);
        $transaksi->no_nota = $no_nota_po;
        $transaksi->nama_toko = $data['nama_toko'];
        $transaksi->metode_pembayaran = $data['bayar'];
        $transaksi->kembalian = $data['kembalian'];
        $transaksi->pembayaran = $data['pembayaran'];
        $transaksi->tanggal = $data['tanggal'];
       

        for ($id_menu = 0; $id_menu < count($request->id_menu); $id_menu++){
        $transaksi_jumlah += $request->total[$id_menu];
        $detail_trans = new Pembelian_Detail;
        
        $detail_trans->id_rempah = $request->id_menu[$id_menu];
        $detail_trans->harga = $request->harga[$id_menu];
        $detail_trans->kwantitas = $request->kwantitas[$id_menu];
        $detail_trans->satuan = $request->satuan[$id_menu];
        $detail_trans->diskon = $request->diskon[$id_menu];
        $detail_trans->total = $request->total[$id_menu];

        $transaksi->transaksi_jumlah = $transaksi_jumlah; //Jumlah Transaksi
        $transaksi->save();
        $detail_trans->id_transaksi = $transaksi->id;
        $detail_trans->save();
        }

        return redirect()->back();
        ################################################TRANSAKSI____REMPAH###########################################
    }

    ################################################TRANSAKSI____CAFE###########################################
    function tampilKafe()
    {
        $kafe = Cafe::all();
        return view('cafes', ['kafe' => $kafe]);
    }

    function dataKafe(Request $request)
    {
        $transaksi_jumlah = 0;

        $data = $request->all();
        $transaksi = new Transaksi_Cafe;
        $no_po = Transaksi::whereDate('tanggal', Carbon::today())->count();
        $no_po++;
        $no_nota_po = date('ymd') . str_pad($no_po, 3, 0, STR_PAD_LEFT);
        $transaksi->no_nota = $no_nota_po;
        $transaksi->nama_toko = $data['nama_toko']; 
        $transaksi->metode_pembayaran = $data['bayar'];
        $transaksi->kembalian = $data['kembalian'];
        $transaksi->pembayaran = $data['pembayaran'];
        $transaksi->tanggal = $data['tanggal'];
       

        for ($id_menu = 0; $id_menu < count($request->id_menu); $id_menu++){
        $transaksi_jumlah += $request->total[$id_menu];


        $detail_trans = new Detail_Cafe;
        
        $detail_trans->id_cafe = $request->id_menu[$id_menu];
        $detail_trans->harga = $request->harga[$id_menu];
        $detail_trans->kwantitas = $request->kwantitas[$id_menu];
        $detail_trans->satuan = $request->satuan[$id_menu];
        $detail_trans->diskon = $request->diskon[$id_menu];
        $detail_trans->total = $request->total[$id_menu];

        $transaksi->transaksi_jumlah = $transaksi_jumlah; //Jumlah Transaksi
        $transaksi->save();
        $detail_trans->id_transaksi_cafe = $transaksi->id;
        $detail_trans->save();
        }

        return redirect()->back();
    }
    ################################################TRANSAKSI____CAFE###########################################


    ################################################RIWAYAT_______________CAFE###########################################

    public function search(Request $req) {
        $datefrom = $req->datefrom;
        $dateto = $req->dateto;
    	$transaksi = Transaksi_Cafe::with("detail_cafes")
        ->whereBetween('tanggal',[$datefrom,$dateto])
        ->orWhere('tanggal', $datefrom)
        ->orWhere('tanggal', $dateto)->get();
        return view("riwayat_cafe", ["transaksi" => $transaksi]);
    }

    public function detail($id) {
        $transaksi = Transaksi_Cafe::with("detail_cafes")->get();
        $detailorder = Detail_Cafe::where('id_transaksi_cafe', $id)->get();
        return view("riwayat_cafe", ["transaksi"=>$transaksi,"detailorder"=>$detailorder]);
    }
    
    public function kill_riwayat($id) {
        $bunuh = Transaksi_Cafe::find($id);
        $bunuh->delete();
        return redirect()->back();
    }

    public function update_cafe_riwayat(Request $req) {
        $id_trans = $req->input('t_cafe');
        $riwayat_c = Transaksi_Cafe::find($id_trans);
        $riwayat_c->tanggal = $req->input('tanggal');
        $riwayat_c->nama_toko = $req->input('nama_toko');
        $riwayat_c->metode_pembayaran = $req->input('metode');
        $riwayat_c->transaksi_jumlah = $req->input('jumlah');
        $riwayat_c->pembayaran = $req->input('bayar');
        $riwayat_c->kembalian = $req->input('kembalian');
        $riwayat_c->update();
        return redirect()->back();
    }

    public function edit_riwayat_cafe($id) {
        $see = Transaksi_Cafe::find($id);
        return response()->json([
            'status' => 200,
            'tampil' => $see,
        ]);
    }
    ################################################RIWAYAT_______________CAFE###########################################



################################################RIWAYAT_______________PO###########################################
public function search_po(Request $req) {
    $datefrom = $req->datefrom;
        $dateto = $req->dateto;
    	$transaksi = Transaksi::with("details")
        ->whereBetween('tanggal',[$datefrom,$dateto])
        ->orWhere('tanggal', $datefrom)
        ->orWhere('tanggal', $dateto)->get();
        return view("riwayat_po", ["transaksi" => $transaksi]);
}

public function detailPo($id) {
    $transaksi = Transaksi::with("details")->get();
    $detailorder = Pembelian_Detail::where('id_transaksi', $id)->get();
    return view("riwayat_po", ["transaksi"=>$transaksi,"detailorder"=>$detailorder]);
}

public function edit_riwayat_po($id) {
    $liat = Transaksi::find($id);
    return response()->json([
        'status' => 200,
        'liat' => $liat,
    ]);
}

public function update_po_riwayat(Request $req) {
    $update_id = $req->input('t_cafe');
    $ubah = Transaksi::find($update_id);
    $ubah->nama_toko = $req->input("nama_toko");
    $ubah->metode_pembayaran= $req->input("metode");
    $ubah->kembalian = $req->input("kembalian");
    $ubah->transaksi_jumlah = $req->input("jumlah");
    $ubah->pembayaran = $req->input("bayar");
    $ubah->tanggal = $req->input("tanggal");
    $ubah->update();
    return redirect()->back();
}

public function kill_riwayat_po($id) {
    $hancur = Transaksi::find($id);
    $hancur->delete();
    return redirect()->back();
}
################################################RIWAYAT_______________PO###########################################


################################################LAPORAN_______________CAFE###########################################
function tampilLap()
    {
        $kafe = Transaksi_Cafe::all();
        return view('laporan_cafe_bulanan', ['cafe' => $kafe]);
    }

public function search_laporan(Request $req) {
    if($req->has('search')) {
        $tanggal = Transaksi_Cafe::whereMonth('tanggal','LIKE',$req->search)->whereYear('tanggal','LIKE',$req->search2)->get();
    }else{
        $tanggal = Transaksi_Cafe::all();
    }

    return view('laporan_cafe_bulanan',['cafe'=>$tanggal]);
}
#################################################LAPORAN_______________CAFE###########################################

################################################LAPORAN_______________PO###########################################
function tampilLapPo()
    {
        $po = Transaksi::all();
        return view('laporan_po_bulanan', ['ikapesta' => $po]);
    }

    public function search_laporan_po(Request $req) {
        if($req->has('search')) {
            $tanggal_po = Transaksi::whereMonth('tanggal','LIKE',$req->search)->whereYear('tanggal','LIKE',$req->search2)->get();
        }else{
            $tanggal_po = Transaksi::all();
        }
    
        return view('laporan_po_bulanan',['ikapesta'=>$tanggal_po]);
    }
################################################LAPORAN_______________PO###########################################




################################################HOMEEEEEEEEE###########################################
public function home()
    {
       $home = Transaksi::all(); 
       $home2 = Transaksi_Cafe::all();
       return view("home", ["home"=>$home,"home2"=>$home2]);
    }
################################################HOMEEEEEEEEE###########################################
}
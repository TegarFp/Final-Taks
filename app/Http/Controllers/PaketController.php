<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    public function index()
    {
      $paket = Paket::with('satuan')->get();

      $satuan = Satuan::select('id', 'satuan')->get();

      $data = array(
        'paket' => $paket,
        'satuan' => $satuan,

      );
      return view('paket.pakets', $data);
    }
    public function store(Request $request)
    {
      
      $paket = Paket::create($request->all());
      session()->flash('success', 'Paket Data Saved Successfully');
      return redirect('/paket');
    }
    public function aktif(Request $request, $id)
    {
      $status = $request->input('status');
      DB::table('pakets')
      ->where('id', $id)
      ->update(['status' => $status]);
      session()->flash('success', 'Paket Data Update Successfully');
      return redirect('/paket');
    }

    public function update(Request $request, $id)
    {
      $paket = $request->input('paket');
      $berat = $request->input('berat');
      $satuan_id = $request->input('satuan_id');
      $harga = $request->input('harga');
      $cabang = $request->input('cabang');

      DB::table('pakets')
      ->where('id', $id)
      ->update(['paket' => $paket, 'berat' => $berat, 'satuan_id' => $satuan_id, 'harga' => $harga, 'cabang' => $cabang]);
        session()->flash('success', 'Paket Data Updated Successfully');
        return redirect('/paket');
    }
}

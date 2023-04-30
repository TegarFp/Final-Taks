<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = Satuan::get();
        $data = [
          'satuan'=> $satuan,
      ];

        return view('dashboard', $data);
    }

    public function aktif(Request $request, $id)
    {
      $status = $request->input('status');
      DB::table('satuans')
      ->where('id', $id)
      ->update(['status' => $status]);
      session()->flash('success', 'Satuan Data Update Successfully');
      return redirect('/dashboard');
    }

    public function store(Request $request)
    {
      $satuan = Satuan::create($request->all());
        session()->flash('success', 'Satuan Data Saved Successfully');
        return redirect('/dashboard');
    }

    public function update(Request $request, $id)
    {
      $satuan = $request->input('satuan');
      $deskripsi = $request->input('deskripsi');

      DB::table('satuans')
      ->where('id', $id)
      ->update(['satuan' => $satuan, 'deskripsi' => $deskripsi]);
        session()->flash('success', 'Satuan Data Updated Successfully');
        return redirect('/dashboard');
    }

}

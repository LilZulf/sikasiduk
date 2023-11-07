<?php

namespace App\Http\Controllers;

use App\Imports\PendudukImport;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class PendudukController extends Controller
{
    //
    public function index()
    {
        $data = Penduduk::all();
        return view("pages.penduduk.datapenduduk", ["datas" => $data]);
    }
    public function create()
    {
        return view("pages.penduduk.tambahpenduduk");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "file" => "required|mimes:xlsx,xls,csv"
        ]);

        if ($validator->fails()) {
            return redirect()->route("penduduk")
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $excel = $request->file('file');
            $namaExcel = time() . '.' . $excel->getClientOriginalExtension();
            $excel->move(public_path('storage'), $namaExcel);
            Excel::import(new PendudukImport, public_path('/storage/' . $namaExcel));

            return response()->json(['success' => $namaExcel]);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['success' => $e]);
        }
    }
    public function storeSingle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'tps' => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->route("penduduk")
                ->withErrors($validator)
                ->withInput();
        }

        Penduduk::create([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "rt" => $request->rt,
            "rw" => $request->rw,
            "tps" => $request->tps,
            "uid" => 1,
            "status" => 0
        ]);
        return redirect()
            ->route("penduduk")
            ->with("success", "Berhasil Tambah data");
    }

    public function edit($id)
    {
        $data = Penduduk::find($id);
        if (!$data) {
            return redirect()->route("penduduk")->with("error", "Data tidak ditemukan");
        }
        return view("pages.penduduk.editpenduduk", ["data" => $data, "id" => $id]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'tps' => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('edit-penduduk', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $data = Penduduk::find($id);
        if (!$data) {
            return redirect()
                ->route('edit-penduduk', ['id' => $id])
                ->with('error', 'data tidak ditemukan');
        }

        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->rt = $request->rt;
        $data->rw = $request->rw;
        $data->tps = $request->tps;
        $data->save();
        return redirect()->route('penduduk')->with('success', 'Berhasil update data');
    }
    public function delete($id)
    {
        $data = Penduduk::find($id);
        if (!$data) {
            return redirect()
                ->route('penduduk')
                ->with('error', 'data tidak ditemukan');
        }
        $data->delete();
        return redirect()->route('penduduk')->with('success','Data berhasil dihapus');
    }
}

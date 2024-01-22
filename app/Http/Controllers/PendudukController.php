<?php

namespace App\Http\Controllers;

use App\Imports\PendudukImport;
use App\Models\Alamat;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class PendudukController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        if ($user->level != 0) {
            return redirect()->route("home")
                ->withErrors("Anda Bukan Admin")
                ->withInput();
        }

        $data = Penduduk::all();
        $belum = $data->where('status', '=', '0')->where('uid', '1')->first();
        $belumAlamat = Penduduk::where('id_alamat', null)
            ->where('uid', 1)
            ->first();
        return view("pages.penduduk.datapenduduk", ["datas" => $data, 'belum' => $belum, 'belumAlamat' => $belumAlamat]);
    }

    public function indexAudit()
    {
        $user = Auth::user();

        if ($user->level != 1) {
            return redirect()->route("home")
                ->withErrors("Anda Bukan Auditor")
                ->withInput();
        }

        $data = Penduduk::where('tps', '>', '0')->get();
        $belum = $data->where('status', '=', '0')->where('uid', '1')->first();
        $belumAlamat = Penduduk::where('id_alamat', null)
            ->where('uid', 1)
            ->first();
        return view("pages.penduduk.auditpenduduk", ["datas" => $data, 'belum' => $belum, 'belumAlamat' => $belumAlamat]);
    }

    public function auditAll()
    {
        $penduduk = Penduduk::where('tps', '>', '0')->where('status', '=', '1')->get();
        foreach ($penduduk as $i) {
            $audit = Penduduk::find($i->id);
            $audit->status = 2;
            $audit->save();
        }
        return redirect()
            ->route("audit-penduduk")
            ->with("success", "Berhasil Audit Semua");
    }

    public function auditSingle($id)
    {
        $audit = Penduduk::find($id);
        $audit->status = 2;
        $audit->save();
        return redirect()
            ->route("audit-penduduk")
            ->with("success", "Berhasil Audit " . $audit->nama);
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
        return redirect()->route('penduduk')->with('success', 'Data berhasil dihapus');
    }

    public function alamatConvert()
    {
        $data = Penduduk::where('id_alamat', null)
            ->where('uid', '1')
            ->orderBy('alamat', 'asc') // 'asc' untuk ascending, 'desc' untuk descending
            ->get();
        foreach ($data as $i) {
            $penduduk = Penduduk::find($i->id);
            if (!$penduduk) {
                return redirect()->route("penduduk")->with("error", "penduduk tidak ditemukan");
            }
            $alamat = Alamat::where('nama_alamat', $i->alamat)->first();
            if (!$alamat) {
                $alamat = Alamat::create([
                    'nama_alamat' => $i->alamat
                ]);
            }
            $penduduk->id_alamat = $alamat->id;
            $penduduk->save();
        }
        return redirect()->route('penduduk')->with('success', 'Alamat berhasil mendapat ID');
    }

    public function alamatCleaning(Request $request)
    {
        $data = Penduduk::where('status', '=', '0')->where('uid', '1')->get();
        foreach ($data as $i) {
            $penduduk = Penduduk::find($i->id);
            if (!$penduduk) {
                return redirect()->route("penduduk")->with("error", "penduduk tidak ditemukan");
            }
            $upperCaseAlamat = strtoupper($penduduk->alamat);
            $upperCaseNama = strtoupper($penduduk->nama);
            $cleanedString = str_replace([
                ' ',
                '.',
                '/',
                '-',
                'GG',
                'GANG',
                'DSN',
                'DUSUN',
                'NO',
                'JL',
                'JLN',
                'JALAN',
                'PERUM',
                'PERUMAHAN'
            ], '', $upperCaseAlamat);
            $penduduk->nama = $upperCaseNama;
            $penduduk->alamat = $cleanedString;
            $penduduk->status = '1';
            $penduduk->save();
        }

        return redirect()->route('penduduk')->with('success', 'Data berhasil dibersihkan');
    }
}

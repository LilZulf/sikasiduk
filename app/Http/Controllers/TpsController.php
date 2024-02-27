<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TpsController extends Controller
{
    //
    public function index()
    {
        $data = Tps::all();
        return view("pages.tps.datatps", ["datas" => $data]);
    }
    public function create()
    {
        return view("pages.tps.tambahtps");
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'tps' => 'required|unique:tps',
            'nama_tps' => 'required|max:7',
            'alamat' => 'required',
            'rt' => 'required|numeric|min:0|max:50',
            'rw' => 'required|numeric|min:0|max:50',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route("tps")
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('storage'), $namaFoto);
            } else {
                $namaFoto = "Sikas.png";
            }
            // Create a new Tps instance with the validated data
            $tps = Tps::create([
                'tps' => $request->tps,
                'nama_tps' => $request->nama_tps,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'foto' => $namaFoto,
                'long' => $request->long,
                'lat' => $request->lat,
                'uid' => '1',
                'status' => 0,
            ]);
        } catch (\Exception $e) {
            return redirect()
                ->route('tps')
                ->with('error', $e);
        }


        // Optionally, you can return a response or redirect to a different page
        return redirect()->route('tps')->with('success', 'Berhasil Tambah TPS');
    }
    public function edit($id)
    {
        $tps = Tps::find($id);
        if (!$tps) {
            return redirect()->route("tps")->with("error", "TPS tidak ditemukan");
        }

        return view('pages.tps.edittps', ['data' => $tps]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_tps' => 'required|max:7',
            'alamat' => 'required',
            'rt' => 'required|numeric|min:0|max:50',
            'rw' => 'required|numeric|min:0|max:50',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route("tps")
                ->withErrors($validator)
                ->withInput();
        }
        $tps = Tps::find($id);
        if (!$tps) {
            return redirect()->route('tps')->with('error', 'Data tidak ditemukan');
        }
        try {
            $tps->nama_tps = $request->nama_tps;
            $tps->alamat = $request->alamat;
            $tps->rt = $request->rt;
            $tps->rw = $request->rw;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('storage'), $namaFoto);
            } else {
                $namaFoto = $tps->foto;
            }
            $tps->foto = $namaFoto;
            $tps->save();
        } catch (\Exception $e) {
            return redirect()
                ->route('tps')
                ->with('error', $e);
        }
        return redirect()->route('tps')->with('success', 'Berhasil Update TPS');
    }

    public function destroy($id)
    {
        $tps = Tps::find($id);
        if (!$tps) {
            return redirect()->route('tps')->with('error', 'Data tidak ditemukan');
        }
        $tps->delete();
        return redirect()->route('tps')->with('success', 'Berhasil Hapus TPS');
    }

    public function indexAudit()
    {
        $user = Auth::user();

        if ($user->level != 1) {
            return redirect()->route("home")
                ->withErrors("Anda Bukan Auditor")
                ->withInput();
        }

        $data = Tps::all();
        $belum = $data->where('status', '=', '0')->where('uid', '1')->first();
        return view("pages.tps.audittps", ["datas" => $data, 'belum' => $belum]);
    }

    public function auditAll()
    {
        $tps = Tps::where('tps', '>', '0')->where('status', '=', '1')->get();
        foreach ($tps as $i) {
            $audit = Tps::find($i->id);
            $audit->status = 2;
            $audit->save();
        }
        return redirect()
            ->route("audit-tps")
            ->with("success", "Berhasil Audit Semua");
    }

    public function auditSingle($id)
    {
        $audit = Tps::find($id);
        $audit->status = 2;
        $audit->save();
        return redirect()
            ->route("audit-tps")
            ->with("success", "Berhasil Audit " . $audit->nama);
    }

}

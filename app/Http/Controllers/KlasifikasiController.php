<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Testing;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\Proses;
use Illuminate\Support\Facades\Validator;
use Phpml\Dataset\ArrayDataset;
use Phpml\Classification\KNearestNeighbors;

class KlasifikasiController extends Controller {
    //
    public function index() {
        $data = Proses::where('uid', '1')->get();
        return view('pages.klasifikasi.dataklasifikasi', ['datas' => $data]);
    }

    public function create(Request $request) {
        return view('pages.klasifikasi.tambahklasifikasi');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "nilai_k" => "required|numeric|min:1"
        ]);

        if($validator->fails()) {
            return redirect()->route("klasifikasi")
                ->withErrors($validator)
                ->withInput();
        }
        try {
            Proses::create([
                'nilai_k' => $request->nilai_k,
                'uid' => 1,
                'status' => 0
            ]);
        } catch (\Throwable $th) {
            return redirect()->route("klasifikasi")
                ->withErrors($th)
                ->withInput();
        }
        return redirect()
            ->route("klasifikasi")
            ->with("success", "Berhasil Tambah data");
    }

    public function prepareDataset($id_proses) {
        // Ambil data dari database
        $samples = Training::join('penduduk', 'trainings.id_penduduk', '=', 'penduduk.id')
            ->where('id_proses', $id_proses)
            ->select('penduduk.rt', 'penduduk.rw', 'penduduk.id_alamat', 'penduduk.tps', 'trainings.*')
            ->get();

        // Persiapkan dataset dalam format yang dapat digunakan oleh PHP-ML
        $data = [];
        $labels = [];

        foreach($samples as $sample) {
            $data[] = [$sample->rt, $sample->rw, $sample->id_alamat];
            $labels[] = $sample->tps;
        }

        // Buat objek dataset dari data yang dipersiapkan
        $dataset = new ArrayDataset($data, $labels);

        return $dataset;
    }

    public function detail($id) {
        $proses = Proses::find($id);
        if(!$proses) {
            return redirect()->route("klasifikasi")
                ->withErrors('Data tidak ditemukan')
                ->withInput();
        }
        $trainingData = Training::where('id_proses', $id)->pluck('id_penduduk')->toArray();
        $testingData = Testing::where('id_proses', $id)->pluck('id_penduduk')->toArray();

        $penduduk = Penduduk::whereNotIn('id', $trainingData)
            ->whereNotIn('id', $testingData)
            ->where('uid', '1')
            ->get();
        $training = Training::join('penduduk', 'trainings.id_penduduk', '=', 'penduduk.id')
            ->where('trainings.id_proses', $id)
            ->select('penduduk.rt', 'penduduk.rw', 'penduduk.id_alamat', 'penduduk.tps', 'trainings.*')
            ->get();
        $testing = Testing::join('penduduk', 'testings.id_penduduk', '=', 'penduduk.id')
            ->where('testings.id_proses', $id)
            ->select('penduduk.rt', 'penduduk.rw', 'penduduk.id_alamat', 'penduduk.tps', 'testings.*')
            ->get();
        $prediksi = $testing->whereNotNull('prediksi');
        return view('pages.klasifikasi.detailklasifikasi', [
            'proses' => $proses,
            'penduduk' => $penduduk,
            'training' => $training,
            'testing' => $testing,
            'prediksi' => $prediksi
        ]);
    }

    public function prediksi(Request $request, $id_proses) {
        $dataset = $this->prepareDataset($id_proses);
        $trainingSamples = $dataset->getSamples();
        $trainingLabels = $dataset->getTargets();

        $classifier = new KNearestNeighbors();
        $classifier->train($trainingSamples, $trainingLabels);

        $testing = Testing::join('penduduk', 'testings.id_penduduk', '=', 'penduduk.id')
            ->where('testings.id_proses', $id_proses)
            ->select('penduduk.rt', 'penduduk.rw', 'penduduk.id_alamat', 'penduduk.tps', 'testings.*')
            ->get();
        if($testing->count() < 1) {
            return redirect()
                ->route("detail-klasifikasi", ['id' => $id_proses])
                ->withErrors('Belum Ada data testing');
        }

        foreach($testing as $i) {
            $test = Testing::find($i->id);
            $prediction = $classifier->predict([$i->rt, $i->rw, $i->id_alamat]);
            $test->prediksi = $prediction;
            $test->save();
        }
        $proses = Proses::find($id_proses);
        $proses->status = 1;
        $proses->save();
        return redirect()
            ->route("detail-klasifikasi", ['id' => $id_proses])
            ->with("success", "Berhasil Prediksi TPS");
    }

    public function storeTraining(Request $request, $id_proses) {
        if($request->has('select_all')) {
            // Pilih semua data penduduk
            $jumlahRandom = $request->input('jumlah_random');
            $trainingData = Training::where('id_proses', $id_proses)->pluck('id_penduduk')->toArray();
            $testingData = Testing::where('id_proses', $id_proses)->pluck('id_penduduk')->toArray();

            $penduduk = Penduduk::whereNotIn('id', $trainingData)
                ->whereNotIn('id', $testingData)
                ->where('uid', '1')
                ->get();
                
            try {
                Training::where('id_proses', $id_proses)->delete();
                foreach($penduduk as $i) {
                    Training::create([
                        'id_proses' => $id_proses,
                        'id_penduduk' => $i->id
                    ]);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()
                    ->route("detail-klasifikasi", ['id' => $id_proses])
                    ->withErrors('Gagal Input data training');
            }
        } elseif($request->has('select_random')) {
            $validator = Validator::make($request->all(), [
                "jumlah_random" => "required|numeric|min:1"
            ]);

            if($validator->fails()) {
                return redirect()->route("detail-klasifikasi", ['id' => $id_proses])
                    ->withErrors($validator);
            }
            $jumlahRandom = $request->input('jumlah_random');
            $trainingData = Training::where('id_proses', $id_proses)->pluck('id_penduduk')->toArray();
            $testingData = Testing::where('id_proses', $id_proses)->pluck('id_penduduk')->toArray();

            $penduduk = Penduduk::whereNotIn('id', $trainingData)
                ->whereNotIn('id', $testingData)
                ->where('uid', '1')
                ->get();
            // Mengambil data penduduk secara acak sesuai dengan jumlah random yang diinginkan
            $penduduk = $penduduk->inRandomOrder()->take($jumlahRandom);
            try {
                Training::where('id_proses', $id_proses)->delete();
                foreach($penduduk as $i) {
                    Training::create([
                        'id_proses' => $id_proses,
                        'id_penduduk' => $i->id
                    ]);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()
                    ->route("detail-klasifikasi", ['id' => $id_proses])
                    ->withErrors('Gagal Input data training');
            }
        } else {
            // Pilih data sesuai dengan pilihan dropdown
            $validator = Validator::make($request->all(), [
                "id_penduduk" => "required"
            ]);

            if($validator->fails()) {
                return redirect()->route("klasifikasi")
                    ->withErrors($validator);
            }
            try {
                Training::create([
                    'id_proses' => $id_proses,
                    'id_penduduk' => $request->id_penduduk
                ]);

            } catch (\Throwable $th) {
                return redirect()
                    ->route("detail-klasifikasi", ['id' => $id_proses])
                    ->withErrors('Gagal Input data training');
            }
        }
        return redirect()
            ->route("detail-klasifikasi", ['id' => $id_proses])
            ->with("success", "Berhasil Tambah data");
    }
    public function destroyTraining(Request $request, $id) {
        $delete = Training::find($id);
        $validator = Validator::make($request->all(), [
            "id_proses" => "required"
        ]);

        if($validator->fails()) {
            return redirect()->route("detail-klasifikasi", ['id' => $request->id_proses])
                ->withErrors($validator)
                ->withInput();
        }
        if(!$delete) {
            return redirect()->route("detail-klasifikasi", ['id' => $request->id_proses])
                ->withErrors('Data tidak ditemukan')
                ->withInput();
        }
        $delete->delete();
        return redirect()
            ->route("detail-klasifikasi", ['id' => $request->id_proses])
            ->with("success", "Berhasil Hapus data");
    }
    public function storeTesting(Request $request, $id_proses) {
        $validator = Validator::make($request->all(), [
            "id_penduduk" => "required"
        ]);

        if($validator->fails()) {
            return redirect()->route("klasifikasi")
                ->withErrors($validator);
        }
        try {
            Testing::create([
                'id_proses' => $id_proses,
                'id_penduduk' => $request->id_penduduk
            ]);

        } catch (\Throwable $th) {
            return redirect()
                ->route("detail-klasifikasi", ['id' => $id_proses])
                ->withErrors('Gagal Input data training');
        }
        return redirect()
            ->route("detail-klasifikasi", ['id' => $id_proses])
            ->with("success", "Berhasil Tambah data");
    }
    public function destroyTesting(Request $request, $id) {
        $delete = Testing::find($id);
        $validator = Validator::make($request->all(), [
            "id_proses" => "required"
        ]);

        if($validator->fails()) {
            return redirect()->route("detail-klasifikasi", ['id' => $request->id_proses])
                ->withErrors($validator)
                ->withInput();
        }
        if(!$delete) {
            return redirect()->route("detail-klasifikasi", ['id' => $request->id_proses])
                ->withErrors('Data tidak ditemukan')
                ->withInput();
        }
        $delete->delete();
        return redirect()
            ->route("detail-klasifikasi", ['id' => $request->id_proses])
            ->with("success", "Berhasil Hapus data");
    }

    public function destroy(Request $request, $id) {
        $delete = Proses::find($id);
        if(!$delete) {
            return redirect()->route("klasifikasi")
                ->withErrors('Data tidak ditemukan')
                ->withInput();
        }
        $delete->delete();
        return redirect()
            ->route("klasifikasi")
            ->with("success", "Berhasil Hapus data");
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventsModel;
use Illuminate\Routing\UrlGenerator;

class EventsControllers extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $data = EventsModel::paginate(8);
        return view('layouts/index', compact('data'));
    }

    public function create(Request $request)
    {
        $session_id = $request->session()->get('person_id');

        $data = array(
            'acara_nama'                    => $request->nama_acara,
            'acara_mulai'                   => $request->tgl_mulai_acara,
            'acara_selesai'                 => $request->tgl_selesai_acara,
            'acara_mulai_checkin'           => $request->waktu_mulai_presensi,
            'acara_selesai_checkin'         => $request->waktu_selesai_presensi,
            'acara_lokasi'                  => $request->lokasi_acara,
            'acara_koordinat'               => $request->titik_koordinat,
            'acara_deskripsi'               => $request->deskripsi_acara,
            'acara_max_kuota_per_peserta'   => $request->maks_peserta,
            'acara_status'                  => "aktif",
            'acara_create_by'               => $session_id,
            'acara_alamat_lokasi'           => $request->alamat_lokasi,
            'acara_pic'                     => $request->nama_pic,
            'acara_whatsapp_pic'            => $request->telp_pic
        );

        $link = null;


        for ($i = 1; $i < 6; $i++) {
            if ($request->file('banner_' . $i)) {
                $fileName = time() . '_' . $request->file('banner_' . $i)->getClientOriginalName();
                $path = $request->file('banner_' . $i)->storeAs('files', $fileName, 'public');
                $link .= asset('storage/files/' . $fileName);
                if ($i < 5) {
                    $link .= ";";
                }
            }
        }


        $data['acara_banner'] = $link;

        try {
            EventsModel::create($data);
            toastr()->success('Proses simpan acara berhasil!');
            return back()->with("Proses simpan acara berhasil!");
        } catch (Exceptions $e) {
            toastr()->error('Proses simpan acara gagal!');
            return back()->withFail("Proses simpan acara gagal!");
        }
    }
}

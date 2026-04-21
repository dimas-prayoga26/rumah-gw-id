<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\MitraNotification;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;

class PageController extends Controller
{
    public function beranda()
    {
        $allJasa = Mitra::all();

        if ($allJasa->count() >= 4) {
            $jasa = $allJasa->random(4);
        } else {
            $jasa = $allJasa;
        }

        return view('parts.beranda', compact('jasa'));
    }


    public function jasa(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $kategori = $request->query('kategori');
        $promo = $request->query('promo');

        if ($promo) {
            if ($promo == 'TukangPromo') {
                $title = 'Promo Jasa Tukang';
                $subtitle = 'Dapatkan penawaran terbaik untuk jasa tukang pilihan dengan harga lebih hemat';
            } elseif ($promo == 'InteriorPromo') {
                $title = 'Promo Jasa Interior';
                $subtitle = 'Wujudkan desain interior impian Anda dengan penawaran spesial';
            } elseif ($promo == 'ArsitekPromo') {
                $title = 'Promo Jasa Arsitek';
                $subtitle = 'Gunakan layanan arsitek profesional dengan promo menarik';
            } else {
                $title = 'Promo Spesial';
                $subtitle = 'Temukan berbagai penawaran menarik dari mitra terbaik kami';
            }
        } else {
            if ($kategori == 'Interior') {
                $title = 'Jasa Interior';
                $subtitle = 'Temukan Mitra Terbaik untuk Desain Interior Impian Anda';
            } elseif ($kategori == 'Arsitek') {
                $title = 'Jasa Arsitek';
                $subtitle = 'Wujudkan Bangunan Impian Anda dengan Bantuan Arsitek Profesional';
            } elseif ($kategori == 'Tukang') {
                $title = 'Jasa Tukang';
                $subtitle = 'Mitra Tukang Terpercaya untuk Semua Kebutuhan Perbaikan Rumah Anda';
            } else {
                $title = 'Rekomendasi Gue';
                $subtitle = 'Temukan Mitra Terbaik untuk Bangunan Impian Anda';
            }
        }

        // Base query
        $query = Mitra::with([
            'user:id,nama',
            'promos:id,mitra_id,harga_akhir,diskon'
        ]);

        if ($promo) {
            // Ambil HANYA mitra yang punya promo
            $query->whereHas('promos');

            // Optional: filter berdasarkan kategori promo
            if ($promo == 'TukangPromo') {
                $query->where('keahlian', 'LIKE', '%Tukang%');
            } elseif ($promo == 'InteriorPromo') {
                $query->where('keahlian', 'LIKE', '%Interior%');
            } elseif ($promo == 'ArsitekPromo') {
                $query->where('keahlian', 'LIKE', '%Arsitek%');
            }
        } else {
            if ($kategori) {
                $query->where('keahlian', 'LIKE', "%$kategori%");
            }
        }

        // Ambil data jasa
        $jasa = $query->get(['id', 'user_id', 'harga', 'foto_profil', 'keahlian', 'lokasi']);

        // Ambil lokasi berdasarkan hasil filter
        $lokasi = (clone $query)->select('lokasi')->distinct()->get();

        return view('pages.jasa', compact('jasa', 'lokasi', 'title', 'subtitle'));
    }

    public function jasaDetail($id)
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $jasa = Mitra::findOrFail($id);

        $sliderImages = array_filter([
            $jasa->foto_profil ? [
                'path' => 'assets/img/Profile/',
                'file' => $jasa->foto_profil
            ] : null,

            $jasa->portfolio ? [
                'path' => 'assets/img/Portfolio/' . $jasa->user->nama . '/',
                'file' => $jasa->portfolio
            ] : null,

            $jasa->portfolio2 ? [
                'path' => 'assets/img/Portfolio/' . $jasa->user->nama . '/',
                'file' => $jasa->portfolio2
            ] : null,

            $jasa->portfolio3 ? [
                'path' => 'assets/img/Portfolio/' . $jasa->user->nama . '/',
                'file' => $jasa->portfolio3
            ] : null,

            $jasa->portfolio4 ? [
                'path' => 'assets/img/Portfolio/' . $jasa->user->nama . '/',
                'file' => $jasa->portfolio4
            ] : null,

            $jasa->portfolio5 ? [
                'path' => 'assets/img/Portfolio/' . $jasa->user->nama . '/',
                'file' => $jasa->portfolio5
            ] : null,
        ]);

        $relatedJasa = Mitra::where('id', '!=', $id)
            ->where('lokasi', 'LIKE', '%' . $jasa->lokasi . '%')
            ->where('keahlian', 'LIKE', '%' . $jasa->keahlian . '%')
            ->get();

        return view('pages.detail', compact('jasa', 'sliderImages', 'relatedJasa'));
    }

    public function hasil(){
        return view('pages.hasil');
    }

    // Mitra Page

    public function mitraHome()
    {
        if(!Auth::check() || Auth::user()->is_mitra != 1){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $mitra = Mitra::where('user_id', Auth::id())->firstOrFail();

        return view('mitra.data', compact('mitra'));
    }

    public function mitraSettings()
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        return view('mitra.pengaturan');
    }

    public function mitraPortfolio()
    {
        if (!Auth::check() || Auth::user()->is_mitra != 1) {
            return redirect()->route('login')
                ->with('error', 'Silahkan login terlebih dahulu');
        }
        $mitra = Mitra::with('user:id,nama')->where('user_id', Auth::id())->firstOrFail();

        // dd($mitra);

        return view('mitra.porto', compact('mitra'));
    }

    // Admin Page

    public function adminUser()
    {
        if (!Auth::check() || Auth::user()->is_mitra != 2) {
            return redirect()->route('login')
                ->with('error', 'Silahkan login terlebih dahulu');
        }

        $users = User::where('is_mitra', '0')->orderBy('is_mitra', 'desc')->get();
        return view('admin.user', compact('users'));
    }

    public function pengaturan(){
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $data = User::find(Auth::id());

        return view('pages.pengaturan', compact('data'));
    }

    public function pengaturanUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email|unique:users,email,' . $user->id,
            'passUser' => 'required',
            'newPassUser' => 'nullable|min:6',
            'passUserRepeat' => 'same:newPassUser',
        ],[
            'passUserRepeat.same' => 'Password Tidak Sama',
            'namaUser.required' => 'Nama Tidak Boleh Kosong',
            'emailUser.required' => 'Email Tidak Boleh Kosong',
            'passUser.required' => 'Isi Password Sekarang untuk melakukan perubahan',
            'emailUser.unique' => 'Email Sudah Terdaftar',
            'newPassUser.min' => 'Password minimal 6 karakter',
        ]);

        if (!Hash::check($request->passUser, $user->password)) {
            return response()->json(['message' => 'Password lama salah'], 422);
        }

        $otp = rand(100000, 999999);

        Session::put('pending_data', [
            'nama' => $request->namaUser,
            'email' => $request->emailUser,
            'password' => $request->newPassUser,
            'otp' => $otp,
            'created_at' => now()
        ]);

        Mail::send('email.change-user', [
            'user_name' => $user->name,
            'otp' => $otp
        ], function($msg) use ($request) {
            $msg->to($request->emailUser)->subject('Verifikasi Perubahan Data Diri Rumahgue');
        });

        return response()->json(['success' => true]);
    }

    public function pengaturanVerif(Request $request)
    {
        $data = Session::get('pending_data');
        if (!$data || $request->otp != $data['otp']) {
            return response()->json(['message' => 'OTP tidak valid'], 422);
        }

        $user = Auth::user();
        $user->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password']
                ? Hash::make($data['password'])
                : $user->password
        ]);

        Session::forget('pending_data');

        return response()->json(['success' => true]);
    }

    public function adminMitra(){
        $mitras = Mitra::with('user:id,nama,email,is_mitra')
            ->whereHas('user', function($query) {
                $query->where('is_mitra', 1);
            })
            ->get();
        return view('admin.mitra', compact('mitras'));
    }
}

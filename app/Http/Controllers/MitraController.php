<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\MitraNotification;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Session;

class MitraController extends Controller
{
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'passUser' => 'required|current_password',
            'newPassUser' => 'required',
            'passUserRepeat' => 'required|same:newPassUser'
        ],[
            'passUser.required' => 'Password Saat Ini wajib diisi',
            'newPassUser.required' => 'Password Baru wajib diisi',
            'newPassUser.min' => 'Password Baru minimal 8 karakter',
            'passUserRepeat.required' => 'Konfirmasi Password Baru wajib diisi',
            'passUserRepeat.same' => 'Konfirmasi Password Baru tidak sesuai',
            'passUser.current_password' => 'Password Saat Ini tidak sesuai'
        ]);

        if (!Hash::check($request->passUser, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password Saat Ini Salah'
            ]);
        }

        $otp = rand(100000, 999999);

        Session::put('pending_password', [
            'email' => $user->email,
            'new_password' => $request->newPassUser,
            'otp' => $otp
        ]);

        Mail::send('email.change-password', [
            'user_name' => $user->nama,
            'otp' => $otp
        ], function ($msg) use ($user) {
            $msg->to($user->email)
                ->subject('Perubahan Password Mitra');
        });

        return response()->json([
            'success' => true,
            'message' => 'OTP telah dikirimkan ke email Anda'
        ]);
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $sessionData = Session::get('pending_password');

        if (!$sessionData || $request->otp != $sessionData['otp']) {
            return response()->json([
                'success' => false,
                'message' => 'OTP salah atau kadaluarsa'
            ]);
        }

        User::where('email', $sessionData['email'])->update([
            'password' => Hash::make($sessionData['new_password'])
        ]);

        Session::forget('pending_password');
        Auth::logout();

        return response()->json([
            'success' => true,
            'redirect' => route('login')
        ]);
    }

    public function updateMitra(Request $request){
        $user = Auth::user();
        $mitra = $user->mitra;
        $request->validate([
            'namaMitra' => 'required|string|max:255',
            'lokasiMitra' => 'required|string|max:255',
            'waMitra' => 'required|string|max:15',
            'emailMitra' => 'required|email|unique:users,email,' . $user->id,
            'keahlianMitra' => 'required|string|in:Interior,Arsitek,Konstruksi,Tukang',
            'hargaMitra' => 'required|numeric|min:0',
            'alamatMitra' => 'required|string|max:255',
            'deskripsiMitra' => 'nullable|string'
        ],[
            'hargaMitra.numeric' => 'Harga Mitra harus berupa angka',
            'namaMitra.required' => 'Nama Mitra Tidak Boleh Kosong',
            'lokasiMitra.required' => 'Lokasi Mitra Tidak Boleh Kosong',
            'waMitra.required' => 'Nomor Whatsapp Mitra Tidak Boleh Kosong',
            'hargaMitra.required' => 'Harga Mitra Tidak Boleh Kosong',
            'alamatMitra.required' => 'Alamat Mitra Tidak Boleh Kosong',
        ]);

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');

            if ($mitra->foto_profil && file_exists(public_path('assets/img/Profile/' . $mitra->foto_profil) && $mitra->foto_profil != 'default.jpg')) {
                unlink(public_path('assets/img/Profile/' . $mitra->foto_profil));
            }

            $filename = $user->nama . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/Profile'), $filename);
        }else{
            $filename = $mitra->foto_profil;
        }

        User::where('id', $user->id)->update([
            'nama' => $request->namaMitra,
            'email' => $request->emailMitra
        ]);

        $wa = $request->waMitra;

        // buang spasi, strip, dll
        $wa = preg_replace('/[^0-9+]/', '', $wa);

        // kalau diawali +62 → buang +
        if (str_starts_with($wa, '+62')) {
            $wa = substr($wa, 1);
        }

        // kalau diawali 08 → ganti jadi 628
        if (str_starts_with($wa, '08')) {
            $wa = '628' . substr($wa, 2);
        }

        Mitra::where('user_id', $user->id)->update([
            'foto_profil' => $filename,
            'lokasi' => $request->lokasiMitra,
            'whatsapp' => $wa,
            'keahlian' => $request->keahlianMitra,
            'harga' => str_replace('.', '',$request->hargaMitra),
            'alamat_mitra' => $request->alamatMitra,
            'deskripsi' => $request->deskripsiMitra
        ]);

        return response()->json([
            "success" => true,
            "message" => "Data berhasil diubah",
            "redirect" => route('mitra-home')
        ]);
    }

       public function add(Request $request)
    {
        $request->validate([
            'portfolio' => 'required|image|max:2048'
        ]);

        $mitra = Mitra::with('user:id,nama')->where('user_id', Auth::id())->firstOrFail();

        // Cari slot portofolio kosong
        for($i=1; $i<=5; $i++){
            $slot = $i == 1 ? 'portfolio' : 'portfolio'.$i;
            if(empty($mitra->$slot)){
                $file = $request->file('portfolio');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = public_path('assets/img/Portfolio/'.$mitra->user->nama);

                if(!file_exists($path)) mkdir($path, 0777, true);

                $file->move($path, $filename);

                $mitra->$slot = $filename;
                $mitra->save();

                return response()->json(['success'=>true, 'slot'=>$slot, 'filename'=>$filename]);
            }
        }

        return response()->json(['success'=>false, 'message'=>'Semua slot portofolio sudah penuh.']);
    }

    public function edit(Request $request)
    {
        $request->validate([
            'slot' => 'required|string|in:portfolio,portfolio2,portfolio3,portfolio4,portfolio5',
            'portfolio' => 'nullable|image|max:2048'
        ]);

        $mitra = Mitra::with('user:id,nama')->where('user_id', Auth::id())->firstOrFail();

        $slot = $request->slot;

        if($request->hasFile('portfolio')){
            // Hapus file lama
            $oldFile = public_path('assets/img/Portfolio/'.$mitra->user->nama.'/'.$mitra->$slot);
            if(!empty($mitra->$slot) && file_exists($oldFile)){
                unlink($oldFile);
            }

            $file = $request->file('portfolio');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('assets/img/Portfolio/'.$mitra->user->nama);
            if(!file_exists($path)) mkdir($path, 0777, true);
            $file->move($path, $filename);

            $mitra->$slot = $filename;
            $mitra->save();

            return response()->json(['success'=>true, 'filename'=>$filename]);
        }

        return response()->json(['success'=>true, 'message'=>'Tidak ada perubahan file']);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'slot' => 'required|string|in:portfolio,portfolio2,portfolio3,portfolio4,portfolio5',
        ]);

        $mitra = Mitra::with('user:id,nama')->where('user_id', Auth::id())->firstOrFail();
        $slot = $request->slot;

        if(!empty($mitra->$slot)){
            $filePath = public_path('assets/img/Portfolio/'.$mitra->user->nama.'/'.$mitra->$slot);
            if(file_exists($filePath)) unlink($filePath);

            $mitra->$slot = null;
            $mitra->save();

            return response()->json(['success'=>true]);
        }

        return response()->json(['success'=>false, 'message'=>'Portofolio tidak ditemukan']);
    }

    public function notifikasi()
    {
        if (!Auth::check() || Auth::user()->is_mitra != 1) {
            return response()->json(['error' => 'Anda bukan mitra']);
        }

        // Ambil semua notifikasi terbaru untuk mitra
        $notif = MitraNotification::with('user:id,nama')
            ->where('mitra_id', Auth::id())
            ->limit(6)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notif);
    }

    public function notifRead()
    {
        MitraNotification::where('mitra_id', auth()->id())
            ->where('is_read', '0')
            ->update(['is_read' => '1']);

        return response()->json(['success' => true]);
    }

    public function notifCreate(Request $request){
        if(!Auth::check()){
            return response()->json(['success' => false, 'message' => 'Silahkan login terlebih dahulu']);
        }

        $notif = MitraNotification::create([
            'is_read' => '0',
            'user_id' => Auth::id(),
            'mitra_id' => Mitra::where('id', $request->jasa_id)->first()->user->id,
            'message' => 'Baru Saja Menghubungi Anda di Whatsapp!'
        ]);

        return response()->json($notif);
    }
}

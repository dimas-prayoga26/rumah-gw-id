<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function login(Request $request){
        $email = $request->input('emailUser');
        $password = $request->input('passwordUser');

        $user = User::where('email', $email)->first();

        if($user && Hash::check($password, $user->password) && $user->is_mitra == 0){
            Auth::login($user);
            return redirect()->route('jasa');
        }elseif($user && Hash::check($password, $user->password) && $user->is_mitra == 1){
            Auth::login($user);
            return redirect()->route('mitra-home');
        }elseif($user && Hash::check($password, $user->password) && $user->is_mitra == 2){
            Auth::login($user);
            return redirect()->route('admin-user');
        }else{
            return redirect()->back()->withInput()->withErrors(['email' => 'Email atau password salah']);
        }
    }

    public function requestOTP(Request $request){
        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email:dns|unique:users,email',
            'passUser' => 'required',
            'passUserRepeat' => 'required|same:passUser',
            'is_mitra' => 'nullable|integer|min:0|max:1',
            'keahlianMitra' => 'nullable|string',
            'alamatMitra' => 'nullable|string',
            'teleponMitra' => 'nullable|string',
        ],[
            'passUserRepeat.same' => 'Password Tidak Sama',
            'namaUser.required' => 'Nama Tidak Boleh Kosong',
            'emailUser.required' => 'Email Tidak Boleh Kosong',
            'passUser.required' => 'Password Tidak Boleh Kosong',
            'emailUser.unique' => 'Email Sudah Terdaftar',
            'emailUser.email' => 'Format Email Tidak Valid',
        ]);

        $otp = rand(100000, 999999);

        $sessionData = [
            'nama'       => $request->namaUser,
            'email'      => $request->emailUser,
            'telepon'    => $request->telepon,
            'password'   => $request->passUser,
            'is_mitra'   => $request->teleponMitra ? 1 : 0,
            'keahlian'   => $request->keahlianMitra ?? '',
            'alamat'     => $request->alamatMitra ?? '',
            'whatsapp'    => $request->teleponMitra ?? '',
            'otp'        => $otp,
            'created_at' => now()
        ];

        // SIMPAN SESSION
        if ($request->input('teleponMitra')) {
            Session::put('pending_mitra', $sessionData);
        } else {
            Session::put('pending_user', $sessionData);
        }

        Mail::send('email.verify-email', [
            'user_name' => $sessionData['nama'],
            'otp' => $otp
        ], function($msg) use ($request) {
            $msg->to($request->emailUser)->subject('Verifikasi Akun Rumahgue');
        });

        return response()->json([
            'success' => true,
            'message' => 'Mitra Status: ' . ($request->keahlianMitra ? '1' : '0')
        ]);
    }

    public function verifyRegister(Request $request) {
        $isMitra = Session::has('pending_mitra');
        $sessionData = $isMitra ? Session::get('pending_mitra') : Session::get('pending_user');

        if (!$sessionData) {
            return response()->json([
                'success' => false,
                'message' => 'Session tidak ditemukan. Silakan daftar ulang!'
            ]);
        }

        // cek expired
        if (now()->diffInMinutes($sessionData['created_at']) > 10) {
            Session::forget('pending_user');
            Session::forget('pending_mitra');
            return response()->json([
                'success' => false,
                'message' => 'OTP sudah kadaluarsa. Silakan daftar ulang!'
            ]);
        }

        // cek OTP
        if ($request->otp != $sessionData['otp']) {
            return response()->json([
                'success' => false,
                'message' => 'OTP salah!'
            ]);
        }

        // INSERT USER
        $user = User::create([
            'nama'      => $sessionData['nama'],
            'email'     => $sessionData['email'],
            'is_mitra'  => $sessionData['is_mitra'],
            'password'  => Hash::make($sessionData['password']),
            'google_id' => null,
        ]);

        $wa = $sessionData['whatsapp'];

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

        // Jika mitra → insert data mitra
        if ($isMitra) {
            DB::table('mitra')->insert([
                'user_id'       => $user->id,
                'deskripsi'     => null,
                'keahlian'      => $sessionData['keahlian'],
                'alamat_mitra'  => $sessionData['alamat'],
                'whatsapp'      => $wa,
            ]);
        }

        // Bersihkan session
        Session::forget('pending_user');
        Session::forget('pending_mitra');

        return response()->json([
            'success' => true,
            'redirect' => route('login')
        ]);
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('rumahgue');
    }
}

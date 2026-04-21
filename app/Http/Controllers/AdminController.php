<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function editUser($id, Request $request){
        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email|unique:users,email,' . $id,
        ],[
            'namaUser.required' => 'Nama Tidak Boleh Kosong',
            'emailUser.required' => 'Email Tidak Boleh Kosong',
            'emailUser.unique' => 'Email Sudah Terdaftar',
        ]);

        $user = User::findOrFail($id);

        $user->nama = $request->namaUser;
        $user->email = $request->emailUser;
        $user->is_mitra = 0;

        $user->update();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah'
        ]);
    }


    public function hapusUser($id){
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus'
        ]);
    }

    public function tambahUser(Request $request){
        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email|unique:users,email',
        ],[
            'namaUser.required' => 'Nama Tidak Boleh Kosong',
            'emailUser.required' => 'Email Tidak Boleh Kosong',
            'emailUser.unique' => 'Email Sudah Terdaftar',
        ]);

        $user = new User();
        $user->nama = $request->namaUser;
        $user->email = $request->emailUser;
        $user->password = Hash::make('password');
        $user->is_mitra = 0;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan'
        ]);
    }
    public function editMitra($id, Request $request)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'namaMitra'     => 'required',
            'emailMitra'    => 'required|email|unique:users,email,' . $user->id,
            'keahlianMitra' => 'required',
            'deskripsiMitra'=> 'nullable',
            'alamatMitra'   => 'required',
            'lokasiMitra'   => 'required',
            'whatsappMitra' => 'required',
            'hargaMitra'    => 'required|numeric',
        ],[
            'namaMitra.required' => 'Nama Tidak Boleh Kosong',
            'lokasiMitra.required' => 'Nama Tidak Boleh Kosong',
            'emailMitra.required' => 'Email Tidak Boleh Kosong',
            'emailMitra.unique' => 'Email Sudah Terdaftar',
            'keahlianMitra.required' => 'Keahlian Tidak Boleh Kosong',
            'alamatMitra.required' => 'Alamat Tidak Boleh Kosong',
            'whatsappMitra.required' => 'Nomor Whatsapp Tidak Boleh Kosong',
            'hargaMitra.required' => 'Harga Tidak Boleh Kosong',
            'hargaMitra.numeric' => 'Harga harus berupa angka',
        ]);

        // Update user
        $user->update([
            'nama' => $request->namaMitra,
            'email' => $request->emailMitra,
            'is_mitra' => 1
        ]);

        $wa = $request->whatsappMitra;

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

        // Update mitra
        $user->mitra->update([
            'deskripsi' => $request->deskripsiMitra,
            'keahlian' => $request->keahlianMitra,
            'lokasi' => $request->lokasiMitra,
            'alamat_mitra' => $request->alamatMitra,
            'whatsapp' => $wa,
            'harga' => $request->hargaMitra,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah'
        ]);
    }

    public function tambahMitra(Request $request)
    {
        $request->validate([
            'namaMitra' => 'required',
            'emailMitra' => 'required|email|unique:users,email',
            'keahlianMitra' => 'required',
            'alamatMitra' => 'required',
            'whatsappMitra' => 'required',
            'hargaMitra' => 'required|numeric',
            'deskripsiMitra' => 'nullable'
        ],[
            'namaMitra.required' => 'Nama Tidak Boleh Kosong',
            'emailMitra.required' => 'Email Tidak Boleh Kosong',
            'emailMitra.unique' => 'Email Sudah Terdaftar',
            'keahlianMitra.required' => 'Keahlian Tidak Boleh Kosong',
            'alamatMitra.required' => 'Alamat Tidak Boleh Kosong',
            'whatsappMitra.required' => 'Nomor Whatsapp Tidak Boleh Kosong',
            'hargaMitra.required' => 'Harga Tidak Boleh Kosong',
            'hargaMitra.numeric' => 'Harga harus berupa angka',
        ]);

        $user = User::create([
            'nama' => $request->namaMitra,
            'email' => $request->emailMitra,
            'password' => Hash::make('password'),
            'is_mitra' => 1
        ]);

        $wa = $request->whatsappMitra;

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

        $user->mitra()->create([
            'deskripsi' => $request->deskripsiMitra,
            'keahlian' => $request->keahlianMitra,
            'lokasi' => $request->lokasiMitra,
            'alamat_mitra' => $request->alamatMitra,
            'whatsapp' => $wa,
            'harga' => $request->hargaMitra
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan'
        ]);
    }

    public function hapusMitra($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus'
        ]);
    }
}

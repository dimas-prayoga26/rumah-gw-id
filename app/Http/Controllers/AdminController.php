<?php

namespace App\Http\Controllers;

use App\Models\ImagePortofolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private function extractLokasiParts(Request $request): array
    {
        $provinsi = $request->input('provinsiMitra');
        $kabupatenKota = $request->input('kabupatenMitra');
        $kecamatan = $request->input('kecamatanMitra');
        $desa = $request->input('desaMitra');

        if (!$provinsi || !$kabupatenKota || !$kecamatan || !$desa) {
            $lokasi = trim((string) $request->input('lokasiMitra', ''));
            if ($lokasi !== '') {
                $parts = array_map('trim', explode(',', $lokasi));
                if (count($parts) >= 4) {
                    $desa = $desa ?: $parts[0];
                    $kecamatan = $kecamatan ?: $parts[1];
                    $kabupatenKota = $kabupatenKota ?: $parts[2];
                    $provinsi = $provinsi ?: $parts[3];
                }
            }
        }

        return [
            'provinsi' => $provinsi ?: null,
            'kabupaten_kota' => $kabupatenKota ?: null,
            'kecamatan' => $kecamatan ?: null,
            'desa' => $desa ?: null,
        ];
    }

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
        $oldNama = $user->nama;

        $request->validate([
            'namaMitra'     => 'required',
            'emailMitra'    => 'required|email|unique:users,email,' . $user->id,
            'keahlianMitra' => 'required',
            'deskripsiMitra'=> 'nullable',
            'alamatMitra'   => 'required',
            'lokasiMitra'   => 'required',
            'provinsiMitra' => 'nullable|string|max:255',
            'kabupatenMitra' => 'nullable|string|max:255',
            'kecamatanMitra' => 'nullable|string|max:255',
            'desaMitra' => 'nullable|string|max:255',
            'whatsappMitra' => 'required',
            'hargaMitra'    => 'required|numeric',
            'portfolioImages' => 'nullable|array|max:20',
            'portfolioImages.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            'portfolioImages.array' => 'Data image portofolio tidak valid',
            'portfolioImages.max' => 'Maksimal upload 20 image portofolio',
            'portfolioImages.*.image' => 'Setiap file portofolio harus berupa gambar',
            'portfolioImages.*.mimes' => 'Format file portofolio harus JPG, JPEG, PNG, atau WEBP',
            'portfolioImages.*.max' => 'Ukuran setiap file portofolio maksimal 2MB',
        ]);

        $lokasiParts = $this->extractLokasiParts($request);

        // Update user
        $user->update([
            'nama' => $request->namaMitra,
            'email' => $request->emailMitra,
            'is_mitra' => 1
        ]);

        if ($oldNama !== $user->nama) {
            $oldPortfolioPath = public_path('assets/img/Portfolio/' . $oldNama);
            $newPortfolioPath = public_path('assets/img/Portfolio/' . $user->nama);

            if (is_dir($oldPortfolioPath)) {
                if (!is_dir($newPortfolioPath)) {
                    @rename($oldPortfolioPath, $newPortfolioPath);
                } else {
                    $oldFiles = scandir($oldPortfolioPath) ?: [];
                    foreach ($oldFiles as $oldFile) {
                        if ($oldFile === '.' || $oldFile === '..') {
                            continue;
                        }
                        @rename(
                            $oldPortfolioPath . DIRECTORY_SEPARATOR . $oldFile,
                            $newPortfolioPath . DIRECTORY_SEPARATOR . $oldFile
                        );
                    }
                    @rmdir($oldPortfolioPath);
                }
            }
        }

        $wa = $request->whatsappMitra;

        // buang spasi, strip, dll
        $wa = preg_replace('/[^0-9+]/', '', $wa);

        // kalau diawali +62 -> buang +
        if (str_starts_with($wa, '+62')) {
            $wa = substr($wa, 1);
        }

        // kalau diawali 08 -> ganti jadi 628
        if (str_starts_with($wa, '08')) {
            $wa = '628' . substr($wa, 2);
        }

        $mitra = $user->mitra;

        // Update mitra
        $mitra->update([
            'deskripsi' => $request->deskripsiMitra,
            'keahlian' => $request->keahlianMitra,
            'lokasi' => $request->lokasiMitra,
            'provinsi' => $lokasiParts['provinsi'],
            'kabupaten_kota' => $lokasiParts['kabupaten_kota'],
            'kecamatan' => $lokasiParts['kecamatan'],
            'desa' => $lokasiParts['desa'],
            'alamat_mitra' => $request->alamatMitra,
            'whatsapp' => $wa,
            'harga' => $request->hargaMitra,
        ]);

        if ($request->hasFile('portfolioImages')) {
            $portfolioPath = public_path('assets/img/Portfolio/' . $user->nama);
            if (!file_exists($portfolioPath)) {
                mkdir($portfolioPath, 0777, true);
            }

            $existingImages = ImagePortofolio::where('mitra_id', $mitra->id)->get();
            foreach ($existingImages as $existingImage) {
                $oldFilePath = $portfolioPath . DIRECTORY_SEPARATOR . $existingImage->mitra_image_portfolio;
                if (file_exists($oldFilePath)) {
                    @unlink($oldFilePath);
                }
            }
            ImagePortofolio::where('mitra_id', $mitra->id)->delete();

            $imageRows = [];
            foreach ($request->file('portfolioImages') as $index => $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }

                $filename = time() . '_' . Str::random(8) . '_' . $index . '.' . strtolower($file->getClientOriginalExtension());
                $file->move($portfolioPath, $filename);

                $imageRows[] = [
                    'mitra_id' => $mitra->id,
                    'mitra_image_portfolio' => $filename,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($imageRows)) {
                ImagePortofolio::insert($imageRows);
            }
        }

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
            'lokasiMitra' => 'required',
            'provinsiMitra' => 'nullable|string|max:255',
            'kabupatenMitra' => 'nullable|string|max:255',
            'kecamatanMitra' => 'nullable|string|max:255',
            'desaMitra' => 'nullable|string|max:255',
            'whatsappMitra' => 'required',
            'hargaMitra' => 'required|numeric',
            'deskripsiMitra' => 'nullable',
            'portfolioImages' => 'nullable|array|max:20',
            'portfolioImages.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ],[
            'namaMitra.required' => 'Nama Tidak Boleh Kosong',
            'emailMitra.required' => 'Email Tidak Boleh Kosong',
            'emailMitra.unique' => 'Email Sudah Terdaftar',
            'keahlianMitra.required' => 'Keahlian Tidak Boleh Kosong',
            'alamatMitra.required' => 'Alamat Tidak Boleh Kosong',
            'lokasiMitra.required' => 'Lokasi Tidak Boleh Kosong',
            'whatsappMitra.required' => 'Nomor Whatsapp Tidak Boleh Kosong',
            'hargaMitra.required' => 'Harga Tidak Boleh Kosong',
            'hargaMitra.numeric' => 'Harga harus berupa angka',
            'portfolioImages.array' => 'Data image portofolio tidak valid',
            'portfolioImages.max' => 'Maksimal upload 20 image portofolio',
            'portfolioImages.*.image' => 'Setiap file portofolio harus berupa gambar',
            'portfolioImages.*.mimes' => 'Format file portofolio harus JPG, JPEG, PNG, atau WEBP',
            'portfolioImages.*.max' => 'Ukuran setiap file portofolio maksimal 2MB',
        ]);

        $lokasiParts = $this->extractLokasiParts($request);

        $user = User::create([
            'nama' => $request->namaMitra,
            'email' => $request->emailMitra,
            'password' => Hash::make('password'),
            'is_mitra' => 1
        ]);

        $wa = $request->whatsappMitra;

        // buang spasi, strip, dll
        $wa = preg_replace('/[^0-9+]/', '', $wa);

        // kalau diawali +62 -> buang +
        if (str_starts_with($wa, '+62')) {
            $wa = substr($wa, 1);
        }

        // kalau diawali 08 -> ganti jadi 628
        if (str_starts_with($wa, '08')) {
            $wa = '628' . substr($wa, 2);
        }

        $mitra = $user->mitra()->create([
            'deskripsi' => $request->deskripsiMitra,
            'keahlian' => $request->keahlianMitra,
            'lokasi' => $request->lokasiMitra,
            'provinsi' => $lokasiParts['provinsi'],
            'kabupaten_kota' => $lokasiParts['kabupaten_kota'],
            'kecamatan' => $lokasiParts['kecamatan'],
            'desa' => $lokasiParts['desa'],
            'alamat_mitra' => $request->alamatMitra,
            'whatsapp' => $wa,
            'harga' => $request->hargaMitra
        ]);

        if ($request->hasFile('portfolioImages')) {
            $portfolioPath = public_path('assets/img/Portfolio/' . $user->nama);
            if (!file_exists($portfolioPath)) {
                mkdir($portfolioPath, 0777, true);
            }

            $imageRows = [];

            foreach ($request->file('portfolioImages') as $index => $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }

                $filename = time() . '_' . Str::random(8) . '_' . $index . '.' . strtolower($file->getClientOriginalExtension());
                $file->move($portfolioPath, $filename);

                $imageRows[] = [
                    'mitra_id' => $mitra->id,
                    'mitra_image_portfolio' => $filename,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($imageRows)) {
                ImagePortofolio::insert($imageRows);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan'
        ]);
    }

    public function hapusMitra($id)
    {
        $user = User::with('mitra.imagePortofolios')->findOrFail($id);
        $mitra = $user->mitra;

        if ($mitra) {
            $portfolioPath = public_path('assets/img/Portfolio/' . $user->nama);

            foreach ($mitra->imagePortofolios as $portfolioImage) {
                $filePath = $portfolioPath . DIRECTORY_SEPARATOR . $portfolioImage->mitra_image_portfolio;
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }

            if (is_dir($portfolioPath)) {
                File::deleteDirectory($portfolioPath);
            }
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus'
        ]);
    }

    public function getWilayah($level, $code = null)
    {
        $allowedLevels = ['provinces', 'regencies', 'districts', 'villages'];
        if (!in_array($level, $allowedLevels, true)) {
            return response()->json([
                'message' => 'Level wilayah tidak valid'
            ], 404);
        }

        if ($level !== 'provinces' && empty($code)) {
            return response()->json([
                'message' => 'Kode wilayah wajib diisi'
            ], 422);
        }

        $path = $level . ($code ? '/' . $code : '') . '.json';
        $cacheKey = 'wilayah:' . $level . ':' . ($code ?? 'all');

        $payload = Cache::remember($cacheKey, now()->addHours(6), function () use ($path) {
            $response = Http::timeout(15)
                ->acceptJson()
                ->get("https://wilayah.id/api/{$path}");

            if (!$response->successful()) {
                return null;
            }

            return $response->json();
        });

        if (!$payload || !isset($payload['data']) || !is_array($payload['data'])) {
            return response()->json([
                'message' => 'Gagal mengambil data wilayah'
            ], 502);
        }

        $items = $payload['data'];
        $query = trim((string) request()->query('q', ''));
        $page = max((int) request()->query('page', 1), 1);
        $perPage = min(max((int) request()->query('per_page', 5), 1), 50);

        if ($query !== '') {
            $queryLower = Str::lower($query);
            $items = array_values(array_filter($items, function ($item) use ($queryLower) {
                $name = Str::lower((string) ($item['name'] ?? ''));
                return Str::contains($name, $queryLower);
            }));
        }

        $total = count($items);
        $offset = ($page - 1) * $perPage;
        $paginated = array_slice($items, $offset, $perPage);
        $hasMore = ($offset + $perPage) < $total;

        $results = array_map(function ($item) {
            $codeVal = $item['code'] ?? $item['id'] ?? '';
            $nameVal = $item['name'] ?? '';
            return [
                'id' => $codeVal,
                'text' => $nameVal,
                'code' => $codeVal,
                'name' => $nameVal,
            ];
        }, $paginated);

        return response()->json([
            'data' => $paginated,
            'results' => $results,
            'pagination' => [
                'more' => $hasMore,
            ],
            'meta' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => $total,
            ],
        ]);
    }
}

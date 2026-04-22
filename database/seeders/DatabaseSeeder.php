<?php

namespace Database\Seeders;

use App\Models\Mitra;
use App\Models\Promo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MaterialSeeder::class);
        $this->call(RecommendSeeder::class);

        User::updateOrCreate([
            'email' => 'rumahgue@gmail.com',
        ], [
            'nama' => 'Admin Rumahgue',
            'password' => Hash::make('password'),
            'is_mitra' => 2,
        ]);

        $wilayahList = [
            ['provinsi' => 'Jawa Barat', 'kabupaten_kota' => 'Kabupaten Bogor', 'kecamatan' => 'Cibinong', 'desa' => 'Nanggewer'],
            ['provinsi' => 'Jawa Barat', 'kabupaten_kota' => 'Kota Bekasi', 'kecamatan' => 'Bekasi Selatan', 'desa' => 'Kayuringin Jaya'],
            ['provinsi' => 'Jawa Tengah', 'kabupaten_kota' => 'Kota Semarang', 'kecamatan' => 'Banyumanik', 'desa' => 'Ngesrep'],
            ['provinsi' => 'Jawa Timur', 'kabupaten_kota' => 'Kota Surabaya', 'kecamatan' => 'Sukolilo', 'desa' => 'Keputih'],
            ['provinsi' => 'DI Yogyakarta', 'kabupaten_kota' => 'Kabupaten Sleman', 'kecamatan' => 'Depok', 'desa' => 'Caturtunggal'],
            ['provinsi' => 'Banten', 'kabupaten_kota' => 'Kota Tangerang Selatan', 'kecamatan' => 'Pondok Aren', 'desa' => 'Jurang Mangu Timur'],
            ['provinsi' => 'Sumatera Utara', 'kabupaten_kota' => 'Kota Medan', 'kecamatan' => 'Medan Johor', 'desa' => 'Titi Kuning'],
            ['provinsi' => 'Bali', 'kabupaten_kota' => 'Kabupaten Badung', 'kecamatan' => 'Kuta Utara', 'desa' => 'Kerobokan'],
            ['provinsi' => 'Sulawesi Selatan', 'kabupaten_kota' => 'Kota Makassar', 'kecamatan' => 'Panakkukang', 'desa' => 'Masale'],
            ['provinsi' => 'Kalimantan Timur', 'kabupaten_kota' => 'Kota Balikpapan', 'kecamatan' => 'Balikpapan Selatan', 'desa' => 'Damai Baru'],
        ];

        $keahlianList = ['Interior', 'Arsitek', 'Tukang'];
        $hargaList = range(1000000, 15000000, 500000);
        $mitraCollection = collect();

        for ($i = 1; $i <= 10; $i++) {
            $wilayah = $wilayahList[array_rand($wilayahList)];
            $keahlian = $keahlianList[array_rand($keahlianList)];
            $nama = "Mitra Dummy {$i}";
            $email = "mitra{$i}@dummy.rumahgue.id";

            $user = User::updateOrCreate([
                'email' => $email,
            ], [
                'nama' => $nama,
                'password' => Hash::make('password'),
                'is_mitra' => 1,
            ]);

            $lokasi = "{$wilayah['desa']}, {$wilayah['kecamatan']}, {$wilayah['kabupaten_kota']}, {$wilayah['provinsi']}";
            $nomorWa = '62812345' . str_pad((string) $i, 4, '0', STR_PAD_LEFT);

            $mitra = Mitra::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'deskripsi' => "Ini akun dummy untuk {$nama}. Berpengalaman pada layanan {$keahlian}.",
                'keahlian' => $keahlian,
                'alamat_mitra' => "Jl. Contoh No. {$i}, {$wilayah['desa']}, {$wilayah['kecamatan']}",
                'lokasi' => $lokasi,
                'provinsi' => $wilayah['provinsi'],
                'kabupaten_kota' => $wilayah['kabupaten_kota'],
                'kecamatan' => $wilayah['kecamatan'],
                'desa' => $wilayah['desa'],
                'harga' => $hargaList[array_rand($hargaList)],
                'whatsapp' => $nomorWa,
                'foto_profil' => 'default.jpg',
            ]);

            $mitraCollection->push($mitra);
        }

        Promo::factory()->recycle($mitraCollection)->count(5)->create();
    }
}

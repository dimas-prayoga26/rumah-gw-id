<?php

namespace Database\Seeders;

use App\Models\Mitra;
use App\Models\MitraNotification;
use App\Models\Promo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        Promo::factory()->recycle(Mitra::factory()->count(10)->create())->count(5)->create();

        User::create([
            'nama' => 'Admin Rumahgue',
            'email' => 'rumahgue@gmail.com',
            'password' => bcrypt('password'),
            'is_mitra' => 2
        ]);
        User::create([
            'nama' => 'Andre',
            'email' => 'andremm73@gmail.com',
            'password' => bcrypt('password'),
            'is_mitra' => 1
        ]);
        Mitra::create([
            'user_id' => 12,
            'deskripsi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam magnam, qui pariatur molestiae labore est quisquam quasi, modi eaque, impedit dolores error reiciendis tenetur doloribus at aut. Natus, doloremque consectetur!',
            'keahlian' => 'Interior',
            'alamat_mitra' => 'Stadion Timur',
            'lokasi' => 'Yogyakarta',
            'harga' => 5000000,
            'whatsapp' => '08999999999',
            'foto_profil' => 'default.jpg'
        ]);

        User::create([
            'nama' => 'Ryuta',
            'email' => 'ntakachi73@gmail.com',
            'password' => bcrypt('password'),
            'is_mitra' => 0
        ]);
        // MitraNotification::factory(10)->create();
    }
}

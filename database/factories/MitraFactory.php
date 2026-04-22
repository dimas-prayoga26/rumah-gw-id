<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mitra>
 */
class MitraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'deskripsi' => $this->faker->paragraph(),
            'foto_profil' => 'Ray.jpg',
            'lokasi' => $this->faker->randomElement(['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang']),
            'harga' => $this->faker->numberBetween(5000000, 10000000),
            'keahlian' => 'Interior',
            'alamat_mitra' => $this->faker->address(),
            'whatsapp' => '085233899868',
        ];
    }
}

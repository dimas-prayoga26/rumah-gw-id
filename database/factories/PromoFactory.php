<?php

namespace Database\Factories;

use App\Models\Mitra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promo>
 */
class PromoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hargaAkhirList = range(1000000, 15000000, 500000);

        return [
            'mitra_id' => Mitra::factory(),
            'judul' => $this->faker->sentence(),
            'diskon' => $this->faker->numberBetween(10, 50),
            'harga_akhir' => $this->faker->randomElement($hargaAkhirList),
            'tanggal_mulai' => $this->faker->dateTimeBetween('now', 'now')->format('Y-m-d'),
            'tanggal_selesai' => $this->faker->dateTimeBetween('+1 week', '+2 week')->format('Y-m-d'),
        ];
    }
}

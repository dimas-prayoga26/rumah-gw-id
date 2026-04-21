<?php

namespace Database\Seeders;

use App\Models\RABMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun pintu kayu jati',
            'harga' => 4030000,
            'rasio' => 0.0188679,
            'item' => 'daun_pintu',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun Pintu kayu + kaca',
            'harga' => 1230000,
            'rasio' => 0.0188679,
            'item' => 'daun_pintu',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun pintu PVC',
            'harga' => 730000,
            'rasio' => 0.0188679,
            'item' => 'daun_pintu',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun Pintu alumunium',
            'harga' => 2830000,
            'rasio' => 0.0188679,
            'item' => 'daun_pintu',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun pintu KM/WC panil kayu lapis aluwood',
            'harga' => 1530000,
            'rasio' => 0.0188679,
            'item' => 'daun_pintu_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun pintu KM/WC alumunium',
            'harga' => 1030000,
            'rasio' => 0.0188679,
            'item' => 'daun_pintu_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun pintu KM/WC PVC',
            'harga' => 780000,
            'rasio' => 0.0188679,
            'item' => 'daun_pintu_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun jendela kayu + kaca',
            'harga' => 153000,
            'rasio' => 0.0188679,
            'item' => 'daun_jendela',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun jendela uPVC + kaca',
            'harga' => 1230000,
            'rasio' => 0.0188679,
            'item' => 'daun_jendela',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Daun jendela alumunium + kaca',
            'harga' => 1030000,
            'rasio' => 0.0188679,
            'item' => 'daun_jendela',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Handrail Tangga Kayu Jati Kw.Politur',
            'harga' => 405000,
            'rasio' => 0.0566038,
            'item' => 'tangga',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Railling Tangga+Handrail Besi St.Steel',
            'harga' => 1030000,
            'rasio' => 0.0566038,
            'item' => 'tangga',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Galaxy black, brown, cream, grey, white KW- A 20X20',
            'harga' => 70000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Alpha blue, green KW- A 20X20',
            'harga' => 72000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Track brown, grey KW- A 30X30',
            'harga' => 74500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Capri brown, grey KW- A 30X30',
            'harga' => 67500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Newton brown, green, grey KW- A 30X30',
            'harga' => 68000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Cordon, bone, brown, cream KW- A 30X30',
            'harga' => 76000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Bintan, bone, brown, cream KW- A 30X30',
            'harga' => 77500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Platinum Gobi cream, grey KW- A 50X50',
            'harga' => 100000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Platinum Cavalli, cream, white KW- A 60X60',
            'harga' => 112300,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Platinum Fredo, cream, grey KW- A 60X60',
            'harga' => 112300,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Platinum Tudor, cream, white KW- A 60X60',
            'harga' => 112300,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Platinum Teakwood, beige, brown, latte KW- A 60X60',
            'harga' => 112300,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Arwana Warna Tua 20×20',
            'harga' => 67500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Arwana Warna Muda 20×20',
            'harga' => 65000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Arwana Warna Putih 30×30',
            'harga' => 61500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Arwana Warna Marble 30×30',
            'harga' => 66000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Arwana Warna Fancy 30×30',
            'harga' => 70500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Arwana Warna Putih 40×40',
            'harga' => 67500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Arwana Warna Marble 40×40',
            'harga' => 72500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Pure Color 50×50',
            'harga' => 124500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Classy Color 50×50',
            'harga' => 133000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Fancy Color 50×50',
            'harga' => 143500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Accent Color 50×50',
            'harga' => 216000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Accent Color 25×50',
            'harga' => 201000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Pure Color 25×25',
            'harga' => 103000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Accent Color 25×25',
            'harga' => 193500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Putih 40×40',
            'harga' => 80500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Median 40×40',
            'harga' => 82000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Gelap 40×40',
            'harga' => 84500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Milan Rustic 40×40',
            'harga' => 76250,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Supermilan 25×33 – Golongan A',
            'harga' => 86500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Supermilan 25×33 – Golongan B',
            'harga' => 88000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Supermilan 40×40 – Putih',
            'harga' => 80500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Supermilan 40×40 – Median',
            'harga' => 84000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Supermilan 40×40 – Gelap',
            'harga' => 85000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Supermilan 50×50 – Putih',
            'harga' => 103500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Hercules – Gelap 40×40',
            'harga' => 78750,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Hercules – Motif Khusus 40×40',
            'harga' => 73150,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Hercules – Putih 40×40',
            'harga' => 69850,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Hercules – Motif Dasar Putih 40×40',
            'harga' => 75500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Hercules – Motif Dasar Gelap 40×40',
            'harga' => 76500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 20×20 Golongan A',
            'harga' => 117000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 33.3×33.3 Golongan A',
            'harga' => 127000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 40×40 Golongan A',
            'harga' => 127000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 45×45 Golongan A',
            'harga' => 137000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 50×50 Golongan A',
            'harga' => 153500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 60×60 Golongan A',
            'harga' => 185000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 16.5×66.6 Golongan A',
            'harga' => 222000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 33.3×66.6 Golongan A',
            'harga' => 202500,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 8×30 Hospital Skirting',
            'harga' => 504000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Roman 10×20 Step Nosing',
            'harga' => 545000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Granito Keramik 220 – Ivory dan 280 Joyce',
            'harga' => 205000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Granito Keramik 242 – Sara',
            'harga' => 230000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik 240 – White',
            'harga' => 230000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik 989 – Granite Black',
            'harga' => 270000,
            'rasio' => 0.39283,
            'item' => 'keramik',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Lantai keramik tangga Roman 30X60',
            'harga' => 250000,
            'rasio' => 0.0815094,
            'item' => 'lantai',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Lantai keramik tangga motif kayu 30X60',
            'harga' => 150000,
            'rasio' => 0.0815094,
            'item' => 'lantai',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Lantai keramik tangga granit 30X60',
            'harga' => 125000,
            'rasio' => 0.0815094,
            'item' => 'lantai',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Lantai keramik tangga marmer 30X60',
            'harga' => 430000,
            'rasio' => 0.0815094,
            'item' => 'lantai',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Plint keramik lantai 10 x 40',
            'harga' => 80000,
            'rasio' => 0.31217,
            'item' => 'plint',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Plint granit polos 15 x 60',
            'harga' => 90000,
            'rasio' => 0.31217,
            'item' => 'plint',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Plint granit motif 15 x 60',
            'harga' => 130000,
            'rasio' => 0.31217,
            'item' => 'plint',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan A 30 x 30',
            'harga' => 143000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan A 20 x 60',
            'harga' => 158000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan A 30 x 60',
            'harga' => 158000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan A 32.5 x 65.6 Rectified',
            'harga' => 221000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan B 20 x 20',
            'harga' => 120000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan B 20 x 60',
            'harga' => 170000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan B 30 x 60',
            'harga' => 170000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan B 32.5 x 97.5 Rectified',
            'harga' => 353000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan C 20 x 25',
            'harga' => 123000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan C 20 x 60',
            'harga' => 158000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan C 30 x 60',
            'harga' => 158000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan C 32.5 x 65.6 Rectified',
            'harga' => 256000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan D 20 x 60 ',
            'harga' => 174000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan D 30 x 60 ',
            'harga' => 174000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan D 20 x 60',
            'harga' => 206000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan D 30 x 60',
            'harga' => 206000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Roman lantai KM/WC Golongan E 30 x 60',
            'harga' => 216000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Pure Color 50 X 50',
            'harga' => 127000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Pure Color 25 X 25',
            'harga' => 104000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Classy Color 50 X 50',
            'harga' => 136000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Classy Color 25 X 25',
            'harga' => 110000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Fancy Color 50 X 50',
            'harga' => 146000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Fancy Color 25 X 25',
            'harga' => 122000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Accent Color 50 X 50',
            'harga' => 219000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Accent Color 25 X 25',
            'harga' => 194000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Putih 40 X 40',
            'harga' => 81000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Median 40 X 40',
            'harga' => 83000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Gelap 40 X 40',
            'harga' => 85000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Rustic 40 X 40',
            'harga' => 77000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Supermilan Putih 40 X 40',
            'harga' => 81000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Supermilan Median 40 X 40',
            'harga' => 85000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Supermilan Gelap 40 X 41',
            'harga' => 86000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Supermilan Putih 50 X 50',
            'harga' => 104000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Supermilan Golongan A 25 X 33',
            'harga' => 87000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik Milan lantai KM/WC Supermilan Golongan B 25 X 33',
            'harga' => 89000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Cavalli, Cream, White KW- A 30 X 30',
            'harga' => 219000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Fredo, Cream, Grey KW- A 30 X 30',
            'harga' => 219000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Fresno, Cream, Grey KW- A 30 X 30',
            'harga' => 219000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Salsa, Cream, Grey KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Sicillia, Grey KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Sonata, Brown KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Strata, Cream, Grey KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Tequila, Cream, White KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik Platinum Tosca, Cream, White KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Hercules Gelap 40 X 40',
            'harga' => 80000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Hercules Putih 40 X 40',
            'harga' => 73000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Hercules Motif Dasar Putih 40 X 40',
            'harga' => 77000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Hercules Motif Dasar Gelap 40 X 40',
            'harga' => 79000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Hercules Motif Khusus 40 X 40',
            'harga' => 76000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Arwana Putih 30 X 30',
            'harga' => 64000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Arwana Marble 40 X 40',
            'harga' => 75000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Arwana Marble 30 X 30',
            'harga' => 68000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Arwana Muda 20 X 20',
            'harga' => 67000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Arwana Fancy 30 X 30',
            'harga' => 72000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Arwana Tua 20 X 20',
            'harga' => 67000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Arwana Putih 40 X 40',
            'harga' => 69000,
            'rasio' => 0.040566,
            'item' => 'keramik_wc',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan A 30 x 30',
            'harga' => 143000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan A 20 x 60',
            'harga' => 158000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan A 30 x 60',
            'harga' => 158000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan A 32.5 x 65.6 Rectified',
            'harga' => 221000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan B 20 x 20',
            'harga' => 120000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan B 20 x 60',
            'harga' => 170000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan B 30 x 60',
            'harga' => 170000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan B 32.5 x 97.5 Rectified',
            'harga' => 353000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan C 20 x 25',
            'harga' => 123000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan C 20 x 60',
            'harga' => 158000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan C 30 x 60',
            'harga' => 158000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan C 32.5 x 65.6 Rectified',
            'harga' => 256000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan D 20 x 60 ',
            'harga' => 174000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan D 30 x 60 ',
            'harga' => 174000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan D 20 x 60',
            'harga' => 206000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan D 30 x 60',
            'harga' => 206000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Roman lantai KM/WC Golongan E 30 x 60',
            'harga' => 216000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Pure Color 50 X 50',
            'harga' => 127000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Pure Color 25 X 25',
            'harga' => 104000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Classy Color 50 X 50',
            'harga' => 136000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Classy Color 25 X 25',
            'harga' => 110000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Fancy Color 50 X 50',
            'harga' => 146000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Fancy Color 25 X 25',
            'harga' => 122000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Accent Color 50 X 50',
            'harga' => 219000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Accent Color 25 X 25',
            'harga' => 194000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Putih 40 X 40',
            'harga' => 81000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Median 40 X 40',
            'harga' => 83000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Gelap 40 X 40',
            'harga' => 85000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Rustic 40 X 40',
            'harga' => 77000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Supermilan Putih 40 X 40',
            'harga' => 81000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Supermilan Median 40 X 40',
            'harga' => 85000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Supermilan Gelap 40 X 41',
            'harga' => 86000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Supermilan Putih 50 X 50',
            'harga' => 104000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Supermilan Golongan A 25 X 33',
            'harga' => 87000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => ' Keramik dinding Milan lantai KM/WC Supermilan Golongan B 25 X 33',
            'harga' => 89000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Cavalli, Cream, White KW- A 30 X 30',
            'harga' => 219000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Fredo, Cream, Grey KW- A 30 X 30',
            'harga' => 219000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Fresno, Cream, Grey KW- A 30 X 30',
            'harga' => 219000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Salsa, Cream, Grey KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Sicillia, Grey KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Sonata, Brown KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Strata, Cream, Grey KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Tequila, Cream, White KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Platinum Tosca, Cream, White KW- A 30 X 30',
            'harga' => 113000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Hercules Gelap 40 X 40',
            'harga' => 80000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Hercules Putih 40 X 40',
            'harga' => 73000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Hercules Motif Dasar Putih 40 X 40',
            'harga' => 77000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramik dinding Hercules Motif Dasar Gelap 40 X 40',
            'harga' => 79000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramin dinding Hercules Motif Khusus 40 X 40',
            'harga' => 76000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramin dinding Arwana Putih 30 X 30',
            'harga' => 64000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramin dinding Arwana Marble 40 X 40',
            'harga' => 75000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramin dinding Arwana Marble 30 X 30',
            'harga' => 68000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramin dinding Arwana Muda 20 X 20',
            'harga' => 67000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramin dinding Arwana Fancy 30 X 30',
            'harga' => 72000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramin dinding Arwana Tua 20 X 20',
            'harga' => 67000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'lantai',
            'nama' => 'Keramin dinding Arwana Putih 40 X 40',
            'harga' => 69000,
            'rasio' => 0.0609434,
            'item' => 'keramik_dinding',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam jotun',
            'harga' => 93000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam tembok Vinilex',
            'harga' => 62000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam tembok Decolith',
            'harga' => 62300,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Dulux',
            'harga' => 85000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Metrolite',
            'harga' => 61000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Mowilex',
            'harga' => 78000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Avian Paint',
            'harga' => 52000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Altex',
            'harga' => 63000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Catylac',
            'harga' => 63000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Avitex',
            'harga' => 59000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Paragon',
            'harga' => 58000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Danabrite',
            'harga' => 62000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Danalac',
            'harga' => 51000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Danacryl',
            'harga' => 69000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Danashiel',
            'harga' => 86000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding dalam Cendana',
            'harga' => 61000,
            'rasio' => 1.50755,
            'item' => 'cat_dalam',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding luar tembok Vinilex ',
            'harga' => 63000,
            'rasio' => 0.828868,
            'item' => 'cat_luar',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding luar Mowilex ',
            'harga' => 88000,
            'rasio' => 0.828868,
            'item' => 'cat_luar',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat dinding luar jotun',
            'harga' => 93000,
            'rasio' => 0.828868,
            'item' => 'cat_luar',
        ]);

        RABMaterial::create([
            'kategori' => 'listrik',
            'nama' => ' Daya 2200 VA',
            'harga' => 3540000,
            'rasio' => 0.00943396,
            'item' => 'daya',
        ]);

        RABMaterial::create([
            'kategori' => 'listrik',
            'nama' => ' Daya 1300 VA',
            'harga' => 2740000,
            'rasio' => 0.00943396,
            'item' => 'daya',
        ]);

        RABMaterial::create([
            'kategori' => 'listrik',
            'nama' => ' Daya 900 VA',
            'harga' => 1340000,
            'rasio' => 0.00943396,
            'item' => 'daya',
        ]);

        RABMaterial::create([
            'kategori' => 'listrik',
            'nama' => ' Daya 450 VA',
            'harga' => 740000,
            'rasio' => 0.00943396,
            'item' => 'daya',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kloset duduk porselin  (INA)',
            'harga' => 1330000,
            'rasio' => 0.0188679,
            'item' => 'kloset',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kloset duduk porselin  (KIA)',
            'harga' => 1482000,
            'rasio' => 0.0188679,
            'item' => 'kloset',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kloset duduk porselin  (TOTO)',
            'harga' => 1645000,
            'rasio' => 0.0188679,
            'item' => 'kloset',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kloset jongkok porselin (INA)',
            'harga' => 1842500,
            'rasio' => 0.0188679,
            'item' => 'kloset',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kloset jongkok porselin (TOTO)',
            'harga' => 186300,
            'rasio' => 0.0188679,
            'item' => 'kloset',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kloset jongkok teraso',
            'harga' => 122000,
            'rasio' => 0.0188679,
            'item' => 'kloset',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kran dinding stainless steel',
            'harga' => 101800,
            'rasio' => 0.0283019,
            'item' => 'kran',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kran dinding (DUPONT)',
            'harga' => 257000,
            'rasio' => 0.0283019,
            'item' => 'kran',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => ' Kran dinding kuningan',
            'harga' => 71000,
            'rasio' => 0.0283019,
            'item' => 'kran',
        ]);

        RABMaterial::create([
            'kategori' => 'kunci',
            'nama' => ' Kunci tanam "SES" besar (dengan handel)',
            'harga' => 504000,
            'rasio' => 0.00943396,
            'item' => 'kunci',
        ]);

        RABMaterial::create([
            'kategori' => 'kunci',
            'nama' => ' Kunci tanam "ELT" besar (dengan handel)',
            'harga' => 525000,
            'rasio' => 0.00943396,
            'item' => 'kunci',
        ]);

        RABMaterial::create([
            'kategori' => 'kunci',
            'nama' => ' Kunci tanam "SOLID" besar (dengan handel)',
            'harga' => 152000,
            'rasio' => 0.00943396,
            'item' => 'kunci',
        ]);

        RABMaterial::create([
            'kategori' => 'kunci',
            'nama' => ' Kunci slot merk "SES" (dengan handel)',
            'harga' => 452000,
            'rasio' => 0.00943396,
            'item' => 'kunci',
        ]);

        RABMaterial::create([
            'kategori' => 'kunci',
            'nama' => ' Kunci slot merk "ELT" (dengan handel)',
            'harga' => 473000,
            'rasio' => 0.00943396,
            'item' => 'kunci',
        ]);

        RABMaterial::create([
            'kategori' => 'kunci',
            'nama' => ' Kunci slot merk "SOLID\'" (dengan handel)',
            'harga' => 355000,
            'rasio' => 0.00943396,
            'item' => 'kunci',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng beton "flat"',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng flam press Jawa/lokal',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng kaca (model Karang Pilang)',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng Karang Pilang/Wisma',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng bubung Karang Pilang/Wisma ',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng bubung Jawa/lokal ',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng prentul  ex.Trenggalek',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng bubung prentul ex. Trenggalek',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng Mantili ex Trenggalek',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng bubung Mantili ex Trenggalek',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng Biasa',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng Beton',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng bubung Beton ',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng Kanmuri Glasur ',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng Kanmuri bubung Glasur',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng KIA Glasur ',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng KIA bubung Glasur ',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng Impresso Glasur',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'genteng',
            'nama' => ' Genteng bubung Impresso Glasur',
            'harga' => 115000,
            'rasio' => 0.412075,
            'item' => 'genteng',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Kusen pintu, jendela dan boven kayu ',
            'harga' => 200000,
            'rasio' => 0.308679,
            'item' => 'kusen',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Kusen pintu, jendela dan boven uPVC',
            'harga' => 170000,
            'rasio' => 0.308679,
            'item' => 'kusen',
        ]);

        RABMaterial::create([
            'kategori' => 'pintu_jendela',
            'nama' => ' Kusen pintu, jendela dan boven alumnium',
            'harga' => 150000,
            'rasio' => 0.308679,
            'item' => 'kusen',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat plafond luar tembok Vinilex ',
            'harga' => 63000,
            'rasio' => 0.35066,
            'item' => 'cat_plafond',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat plafond luar Mowilex ',
            'harga' => 88000,
            'rasio' => 0.35066,
            'item' => 'cat_plafond',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat plafond luar jotun',
            'harga' => 93000,
            'rasio' => 0.35066,
            'item' => 'cat_plafond',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat kayu Emco',
            'harga' => 104000,
            'rasio' => 0.0493396,
            'item' => 'cat_kayu',
        ]);

        RABMaterial::create([
            'kategori' => 'cat',
            'nama' => ' Cat kayu Altex',
            'harga' => 104000,
            'rasio' => 0.0493396,
            'item' => 'cat_kayu',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Wastafel TOTO',
            'harga' => 1540000,
            'rasio' => 0.00943396,
            'item' => 'westafel',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Wastafel American Standard',
            'harga' => 590000,
            'rasio' => 0.00943396,
            'item' => 'westafel',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Wastafel Saricite',
            'harga' => 540000,
            'rasio' => 0.00943396,
            'item' => 'westafel',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Wastafel Volk',
            'harga' => 390000,
            'rasio' => 0.00943396,
            'item' => 'westafel',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Shower Set Toto TX432SD',
            'harga' => 1340000,
            'rasio' => 0.00943396,
            'item' => 'shower',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Hand Shower Doyo',
            'harga' => 90000,
            'rasio' => 0.00943396,
            'item' => 'shower',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Shower Onda SO 230',
            'harga' => 240000,
            'rasio' => 0.00943396,
            'item' => 'shower',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Shower American Standard Saga in Wall WF',
            'harga' => 1340000,
            'rasio' => 0.00943396,
            'item' => 'shower',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Shower Grohe Power and Soul 190',
            'harga' => 4740000,
            'rasio' => 0.00943396,
            'item' => 'shower',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Shower Sanitary 177',
            'harga' => 440000,
            'rasio' => 0.00943396,
            'item' => 'shower',
        ]);

        RABMaterial::create([
            'kategori' => 'sanitasi',
            'nama' => 'Shower Grohe Tipe 28784001',
            'harga' => 4940000,
            'rasio' => 0.00943396,
            'item' => 'shower',
        ]);

    }
}

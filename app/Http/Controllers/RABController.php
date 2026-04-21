<?php

namespace App\Http\Controllers;

use App\Models\RABMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RABController
{
    public function getRAB(Request $request){
        $input_data = $request->all();
        $data = json_encode($this->get_rab($input_data));
        Session::put('rab', $data);
        return response()->json($data);
    }

    public function get_rab($data){
        $recomend = Session::get('recomend');

        $luas = $data['luasTotal'] ?? 0;
        $lantai = $data['lantai'] ?? 1;

        $fasad = [200000, 270000, 370000, 500000, 170000, 300000, 150000, 620000, 200000, 270000];

        $res = [
            'lantai' => $lantai,
            'fasad' => $fasad[$data['konsep'] ?? 0] * $luas,
            'lantai1'=>[
                'PEKERJAAN PERSIAPAN'=>[
                    [
                        'Pembersihan lokasi',
                        round(1 * $data['luas'], 3),
                        'm<sup>2</sup>',
                        10000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Brak kerja / Gudang',
                        1,
                        'ls',
                        1500000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Listrik + air',
                        1,
                        'ls',
                        300000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Pengukuran / bouwplank',
                        round(0.60754717 * $data['luas'], 3),
                        'm',
                        36000,
                        true,
                        0.60754717,
                        false
                    ],
                ],
                'PEKERJAAN TANAH DAN PASIR'=>[
                    [
                        'Galian pondasi sedalam 1 m (pondasi)',
                        round(0.541509434 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        37800,
                        true,
                        0.541509434,
                        false
                    ],
                    [
                        'Urug tanah kembali',
                        round(0.301886792 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        10470,
                        true,
                        0.301886792,
                        false
                    ],
                    [
                        'Urug pasir bawah pondasi 10 cm',
                        round(0.026415094 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        85000,
                        true,
                        0.026415094,
                        false
                    ],
                    [
                        'Urug pasir bawah lantai 10 cm',
                        round(0.040566038 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        85000,
                        true,
                        0.040566038,
                        false
                    ],
                ],
                'PEKERJAAN PASANGAN DAN PLESTERAN'=>[
                    [
                        'Pondasi batu kali 1Pc : 5 Ps',
                        round(0.246226415 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        458052,
                        true,
                        1,
                        false
                    ],
                    [
                        'Pasangan dinding bata 1Pc : 5 Ps',
                        round(1.560377358 * $luas, 3),
                        'm<sup>2</sup>',
                        82939,
                        true,
                        1,
                        false
                    ],
                    [
                        'Plesteran + aci',
                        round(3.120754717 * $luas, 3),
                        'm<sup>2</sup>',
                        42303,
                        true,
                        1,
                        false
                    ],
                    [
                        'Sponengan',
                        round(0.287169811 * $luas, 3),
                        'm',
                        11800,
                        true,
                        1,
                        false
                    ],
                    [
                        'Rollag',
                        round(0.044339623 * $data['luas'], 3),
                        'm',
                        11800,
                        true,
                        1,
                        false
                    ],
                ],
                'PEKERJAAN BETON'=>[
                    [
                        'Lantai kerja',
                        round(0.016037736 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        1000000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Beton sloof ( 15/25 )',
                        round(0.022735849 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        3000000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Kolom ( 15/15 )',
                        round(0.008301887 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        2200000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Kolom K1 ( 25/25 )',
                        round(0.006509434 * $luas, 3),
                        'm<sup>3</sup>',
                        3200000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Kolom K2 ( 15/30 )',
                        round(0.008018868 * $luas, 3),
                        'm<sup>3</sup>',
                        3100000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Balok 15/15',
                        round(0.001603774 * $data['luas'], 3),
                        'm<sup>3</sup>',
                        2000000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Balok ( 15/40 )',
                        round(0.028962264 * $luas, 3),
                        'm<sup>3</sup>',
                        4000000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Topi-topi',
                        round(0.007924528 * $luas, 3),
                        'm<sup>3</sup>',
                        3450000,
                        true,
                        1,
                        false
                    ],
                ],
                'PEKERJAAN PLAFOND' => [
                    [
                        'Rangka plafond hollow + gypsumboard',
                        round(0.345283019*$luas,3),
                        'm<sup>2</sup>',
                        90000,
                        true,
                        1,
                        false
                    ],
                    [
                        'List shadow line',
                        round(0.25*$luas,3),
                        'm',
                        25000,
                        true,
                        1,
                        false
                    ],
                ],
                'PEKERJAAN PINTU JENDELA' => [],
                'PEKERJAAN LANTAI' => [],
                'PEKERJAAN CAT - CATAN' => [
                    // [
                    //     'Cat plafond',
                    //     round(0.350660377*(float)$data['luas'],3),
                    //     'm<sup>2</sup>',
                    //     25000,
                    //     true,
                    //     1,
                    //     false
                    // ],
                    // [
                    //     'Cat kayu',
                    //     round(0.350660377*(float)$data['luas'],3),
                    //     'm<sup>2</sup>',
                    //     25000,
                    //     true,
                    //     1,
                    //     false
                    // ],
                ],
                'PEKERJAAN LISTRIK' => [
                    [
                        'Instalasi titik lampu fitting tempel',
                        ceil(0.018867925*(float)$luas),
                        'ttk',
                        180000,
                        false,
                        0.018867925,
                        false
                    ],
                    [
                        'Instalasi titik lampu downlight',
                        ceil(0.113207547*(float)$luas),
                        'ttk',
                        220000,
                        false,
                        0.113207547,
                        false
                    ],
                    [
                        'Instalasi lampu dinding',
                        ceil(0.037735849*(float)$luas),
                        'ttk',
                        180000,
                        false,
                        0.037735849,
                        false
                    ],
                    [
                        'Instalasi titik stop kontak',
                        ceil(0.066037736*(float)$luas),
                        'ttk',
                        180000,
                        false,
                        0.066037736,
                        false
                    ],
                    [
                        'AC',
                        ceil(0.009433962*(float)$luas),
                        'bh',
                        3800000,
                        false,
                        0.009433962,
                        false
                    ],
                    [
                        'Hiter',
                        ceil(0.009433962*(float)$data['luas']),
                        'bh',
                        2600000,
                        false,
                        0.009433962,
                        false
                    ],
                    [
                        'Lampu',
                        ceil(0.122641509*(float)$luas),
                        'bh',
                        15000,
                        false,
                        0.122641509,
                        false
                    ],
                    [
                        'MCB',
                        ceil(0.009433962*(float)$data['luas']),
                        'bh',
                        95000,
                        false,
                        0.009433962,
                        false
                    ],
                    [
                        'Box MCB',
                        ceil(0.009433962*(float)$data['luas']),
                        'bh',
                        60000,
                        false,
                        0.009433962,
                        false
                    ],
                    [
                        'Saklar seri 250 V / 6A',
                        ceil(0.037735849*(float)$luas),
                        'bh',
                        55000,
                        false,
                        0.037735849,
                        false
                    ],
                    [
                        'Saklar tunggal 250 V / 6A',
                        ceil(0.047169811*(float)$luas),
                        'bh',
                        45000,
                        false,
                        0.047169811,
                        false
                    ],
                ],
                'PEKERJAAN SANITASI' => [
                    // array(
                    //     'Kran wastafel',
                    //     ceil(0.009433962*(float)$data['luas']),
                    //     'bh',
                    //     600000,
                    //     false,
                    //     0.009433962,
                    //     false
                    // ),
                    [
                        'Kran washer',
                        ceil(0.018867925*(float)$data['luas']),
                        'bh',
                        600000,
                        false,
                        0.018867925,
                        false
                    ],
                    [
                        'Floor drain stenlist',
                        ceil(0.018867925*(float)$luas),
                        'bh',
                        140000,
                        false,
                        0.018867925,
                        false
                    ],
                    [
                        'Pipa air bersih 3/4" PVC',
                        round(0.222264151*(float)$luas,3),
                        'm',
                        22138,
                        true,
                        1,
                        false
                    ],
                    [
                        'Pipa air kotor 3" PVC',
                        round(0.191320755*(float)$luas,3),
                        'm',
                        66292,
                        true,
                        1,
                        false
                    ],
                    [
                        'Pipa air kotor 4" PVC',
                        round(0.165283019*(float)$luas,3),
                        'm',
                        87856,
                        true,
                        1,
                        false
                    ],
                    [
                        'SAH ( Sumur Air Hujan )',
                        1,
                        'bh',
                        1200000,
                        true,
                        1,
                        false
                    ],
                    [
                        'SAK ( Sumur Air Kotor )',
                        1,
                        'bh',
                        1200000,
                        true,
                        1,
                        false
                    ],
                    [
                        'SAL ( Sumur Air Lemak )',
                        1,
                        'bh',
                        850000,
                        true,
                        1,
                        false
                    ],
                    [
                        'SP ( Sumur Peresapan )',
                        1,
                        'bh',
                        1200000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Bak kontrol',
                        ceil(0.018867925*(float)$data['luas']),
                        'bh',
                        250000,
                        false,
                        0.018867925,
                        false
                    ],
                    [
                        'Stop kran',
                        ceil(0.009433962*(float)$data['luas']),
                        'bh',
                        45000,
                        false,
                        0.009433962,
                        false
                    ],
                    [
                        'Septiktank',
                        ceil(0.009433962*(float)$data['luas']),
                        'bh',
                        2000000,
                        false,
                        0.009433962,
                        false
                    ],
                    // array(
                    //     'Wastafel amstad',
                    //     ceil(0.009433962*(float)$luas),
                    //     'bh',
                    //     500000,
                    //     false,
                    //     0.009433962,
                    //     false
                    // ),
                    // array(
                    //     'Shower amstad',
                    //     ceil(0.009433962*(float)$luas),
                    //     'bh',
                    //     700000,
                    //     false,
                    //     0.009433962,
                    //     false
                    // ),
                    [
                        'Pipa air panas 3/4" PVC',
                        round(0.018867925*(float)$luas,3),
                        'm',
                        22138,
                        true,
                        1,
                        false
                    ],
                ],
                'PEKERJAAN PENGGANTUNG DAN PENGUNCI' => [
                    [
                        'Handle pintu',
                        (int)$recomend['ruang_1'][1]['jml']+(int)$recomend['ruang_1'][3]['jml']+(int)$recomend['ruang_1'][4]['jml']+(int)$recomend['ruang_1'][6]['jml'],//ceil(0.018867925*$data['luas']),
                        'bh',
                        160000,
                        false,
                        0.018867925,
                        false
                    ],
                    [
                        'Slot pintu KM/WC',
                        ceil(0.018867925*$luas),
                        'bh',
                        95000,
                        false,
                        0.018867925,
                        false
                    ],
                    [
                        'Engsel pintu',
                        ceil(0.198113208*$luas),
                        'bh',
                        35000,
                        false,
                        0.198113208,
                        false
                    ],
                    [
                        'Engsel jendela',
                        ceil(0.094339623*$luas),
                        'bh',
                        35000,
                        false,
                        0.094339623,
                        false
                    ],
                    [
                        'Grendel jendela',
                        ceil(0.047169811*$luas),
                        'bh',
                        35000,
                        false,
                        0.047169811,
                        false
                    ],
                ],
                'PEKERJAAN ATAP' => [
                    [
                        'Rangka atap baja ringan',
                        round(0.478301887 * ((int)$data['lantai'] > 1 ? $luas : $data['luas']), 3),
                        'm<sup>3</sup>',
                        120000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Talang BRC',
                        round(0.113207547 * ((int)$data['lantai'] > 1 ? $luas : $data['luas']), 3),
                        'm',
                        115000,
                        true,
                        1,
                        false
                    ],
                    [
                        'Listplank GRC',
                        round(0.254716981 * ((int)$data['lantai'] > 1 ? $luas : $data['luas']), 3),
                        'm',
                        85000,
                        true,
                        1,
                        false
                    ],
                ]
            ]
        ];
        if((int)$lantai > 1){
            array_unshift($res['lantai1']['PEKERJAAN TANAH DAN PASIR'], [
                'Galian footplat sedalam 2 m',
                round(0.152830189 * $data['luas'], 3),
                'm<sup>3</sup>',
                50316,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN BETON'], [
                'Footplate',
                round(0.051415094 * $luas, 3),
                'm<sup>3</sup>',
                1800000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN BETON'], [
                'Balok dudukan rangka atap ( 15/15 )',
                round(0.004433962 * $data['luas2'], 3),
                'm<sup>3</sup>',
                2000000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN BETON'], [
                'Talang beton',
                round(0.009622642 * $data['luas2'], 3),
                'm<sup>3</sup>',
                3450000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN PINTU JENDELA'], [
                'Kaca bening 5 mm',
                round(0.03245283 * $data['luas2'], 3),
                'm<sup>2</sup>',
                90000,
                false,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN LISTRIK'], [
                'Line telepon',
                ceil(0.009433962 * $data['luas2']),
                'ttk',
                180000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN LISTRIK'], [
                'Line TV',
                ceil(0.009433962 * $data['luas2']),
                'ttk',
                180000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN SANITASI'], [
                'Pompa pendorong',
                ceil(0.009433962 * $data['luas2']),
                'bh',
                5000000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN SANITASI'], [
                'Water tank',
                ceil(0.009433962 * $data['luas2']),
                'bh',
                2800000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN PENGGANTUNG DAN PENGUNCI'], [
                'Slot pintu biasa',
                ceil(0.028301887 * $data['luas2']),
                'bh',
                95000,
                false,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN BETON'], [
                'Plat lantai tbl 12 cm',
                round(0.049716981 * $data['luas2'], 3),
                'm<sup>3</sup>',
                3550000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN BETON'], [
                'Plat tangga tbl 10 cm',
                round(0.006792453 * $data['luas2'], 3),
                'm<sup>3</sup>',
                3500000,
                true,
                1,
                false
            ]);
            array_unshift($res['lantai1']['PEKERJAAN BETON'], [
                'Balok gantung 15/40',
                round(0.020943396 * $data['luas2'], 3),
                'm<sup>3</sup>',
                3900000,
                true,
                1,
                false
            ]);


            // $kolom = RABMaterial::Material(array('kategori'=>'beton','item'=>'kolom'));
            // array_unshift($res['lantai1']['PEKERJAAN BETON'],array(
            //     'kolom',
            //     round($kolom[0]['rasio']*$luas,3),
            //     'm<sup>3</sup>',
            //     $kolom[0]['harga'],
            //     true,
            //     1,
            //     $kolom
            // ));

            // $plat = $CI->RAB_model->material(array('kategori'=>'beton','item'=>'plat'));
            // array_unshift($res['lantai1']['PEKERJAAN BETON'],array(
            //     'plat',
            //     round($plat[0]['rasio']*$data['luas2'],3),
            //     'm<sup>3</sup>',
            //     $plat[0]['harga'],
            //     true,
            //     1,
            //     $plat
            // ));

            $genteng = RABMaterial::Material(['kategori' => 'genteng', 'item' => 'genteng']);
            $res['lantai1']['PEKERJAAN ATAP'][] = [
                'genteng',
                round($genteng->rasio * ((int)$data['lantai'] > 1 ? $luas : $data['luas']), 3),
                'm<sup>2</sup>',
                $genteng->harga,
                true,
                1,
                $genteng
            ];
        }

            if($data['carpot']){
                array_unshift($res['lantai1']['PEKERJAAN LANTAI'], [
                    'Lantai carport 60 x 60 motif kasar',
                    17.5,
                    'm<sup>2</sup>',
                    180000,
                    true,
                    1,
                    false
                ]);
            }


            $kusen = RABMaterial::Material(['kategori' => 'pintu_jendela', 'item' => 'kusen']);
            $res['lantai1']['PEKERJAAN PINTU JENDELA'][] = [
                'kusen',
                round($kusen->rasio * $luas, 3),
                'm',
                $kusen->harga,
                true,
                1,
                $kusen
            ];

            $daun_pintu = RABMaterial::Material(['kategori' => 'pintu_jendela', 'item' => 'kusen']);
            $res['lantai1']['PEKERJAAN PINTU JENDELA'][] = [
                'daun_pintu',
                ceil($daun_pintu->rasio * $luas),
                'bh',
                $daun_pintu->harga,
                false,
                1,
                $daun_pintu
            ];

            $daun_pintu_wc = RABMaterial::Material(['kategori' => 'pintu_jendela', 'item' => 'daun_pintu']);
            $res['lantai1']['PEKERJAAN PINTU JENDELA'][] = [
                'daun_pintu_wc',
                $recomend['ruang_1'][6]['jml'],
                'bh',
                $daun_pintu_wc->harga,
                false,
                1,
                $daun_pintu_wc
            ];

            $daun_jendela = RABMaterial::Material(['kategori' => 'pintu_jendela', 'item' => 'daun_jendela']);
            $res['lantai1']['PEKERJAAN PINTU JENDELA'][] = [
                'daun_jendela',
                $recomend['ruang_1'][1]['jml'] + $recomend['ruang_1'][3]['jml'] + $recomend['ruang_1'][4]['jml'], //ceil($daun_jendela->rasio * $luas),
                'bh',
                $daun_jendela->harga,
                false,
                1,
                $daun_jendela
            ];

            $tangga = RABMaterial::Material(['kategori' => 'pintu_jendela', 'item' => 'tangga']);
            $res['lantai1']['PEKERJAAN PINTU JENDELA'][] = [
                'tangga',
                round($tangga->rasio * $data['luas'], 3),
                'm<sup>2</sup>',
                $tangga->harga,
                true,
                1,
                $tangga
            ];

            $keramik = RABMaterial::Material(['kategori' => 'lantai', 'item' => 'keramik']);
            $res['lantai1']['PEKERJAAN LANTAI'][] = [
                'keramik',
                round($keramik->rasio * ($luas - ( (int)$recomend['ruang_1'][6]['jml'] * (int)$recomend['ruang_1'][6]['luas'] )), 3),
                'm<sup>2</sup>',
                $keramik->harga,
                true,
                1,
                $keramik
            ];

            $lantai = RABMaterial::Material(['kategori' => 'lantai', 'item' => 'lantai']);
            $res['lantai1']['PEKERJAAN LANTAI'][] = [
                'lantai',
                round($lantai->rasio * $data['luas'], 3),
                'm<sup>2</sup>',
                $lantai->harga,
                true,
                1,
                $lantai
            ];

            $plint = RABMaterial::Material(['kategori' => 'lantai', 'item' => 'plint']);
            $res['lantai1']['PEKERJAAN LANTAI'][] = [
                'plint',
                round($plint->rasio * $data['luas'], 3),
                'm<sup>2</sup>',
                $plint->harga,
                true,
                1,
                $plint
            ];

            $keramik_wc = RABMaterial::Material(['kategori' => 'lantai', 'item' => 'keramik_wc']);
            $res['lantai1']['PEKERJAAN LANTAI'][] = [
                'keramik_wc',
                round($keramik_wc->rasio * ( (int)$recomend['ruang_1'][6]['jml'] * (int)$recomend['ruang_1'][6]['luas'] ), 3),
                'm<sup>2</sup>',
                $keramik_wc->harga,
                true,
                1,
                $keramik_wc
            ];

            $keramik_dinding = RABMaterial::Material(['kategori' => 'lantai', 'item' => 'keramik_dinding']);
            $res['lantai1']['PEKERJAAN LANTAI'][] = [
                'keramik_dinding',
                round($keramik_dinding->rasio * $data['luas'], 3),
                'm<sup>2</sup>',
                $keramik_dinding->harga,
                true,
                1,
                $keramik_dinding
            ];

            $cat_dalam = RABMaterial::Material(['kategori' => 'cat', 'item' => 'cat_dalam']);
            $res['lantai1']['PEKERJAAN CAT - CATAN'][] = [
                'cat_dalam',
                round($cat_dalam->rasio * $data['luas'], 3),
                'm<sup>2</sup>',
                $cat_dalam->harga,
                true,
                1,
                $cat_dalam
            ];

            $cat_luar = RABMaterial::Material(['kategori' => 'cat', 'item' => 'cat_luar']);
            $res['lantai1']['PEKERJAAN CAT - CATAN'][] = [
                'cat_luar',
                round($cat_luar->rasio * $data['luas'], 3),
                'm<sup>2</sup>',
                $cat_luar->harga,
                true,
                1,
                $cat_luar
            ];

            $daya = RABMaterial::Material(['kategori' => 'listrik', 'item' => 'daya']);
            array_unshift($res['lantai1']['PEKERJAAN LISTRIK'], [
                'daya',
                1,
                'ls',
                $daya->harga,
                true,
                1,
                $daya
            ]);

            $kloset = RABMaterial::Material(['kategori' => 'sanitasi', 'item' => 'kloset']);
            array_unshift($res['lantai1']['PEKERJAAN SANITASI'], [
                'kloset',
                ceil($kloset->rasio * $luas),
                'bh',
                $kloset->harga,
                false,
                1,
                $kloset
            ]);

            $kran = RABMaterial::Material(['kategori' => 'sanitasi', 'item' => 'kran']);
            array_unshift($res['lantai1']['PEKERJAAN SANITASI'], [
                'kran',
                ceil($kran->rasio * $luas),
                'bh',
                $kran->harga,
                false,
                1,
                $kran
            ]);

            $kunci = RABMaterial::Material(['kategori' => 'kunci', 'item' => 'kunci']);
            array_unshift($res['lantai1']['PEKERJAAN PENGGANTUNG DAN PENGUNCI'], [
                'kunci',
                (int)$recomend['ruang_1'][1]['jml'] + (int)$recomend['ruang_1'][3]['jml'] + (int)$recomend['ruang_1'][4]['jml'] + (int)$recomend['ruang_1'][6]['jml'] + ($data['lantai'] > 1 ? (int)$recomend['ruang_2'][2]['jml'] : 0),
                'bh',
                $kunci->harga,
                false,
                1,
                $kunci
            ]);

            $cat_plafond = RABMaterial::Material(['kategori'=>'cat','item'=>'cat_plafond']);
                array_unshift($res['lantai1']['PEKERJAAN CAT - CATAN'],[
                    'cat_plafond',
                    round($cat_plafond->rasio*$luas,3),
                    'm<sup>2</sup>',
                    $cat_plafond->harga,
                    true,
                    1,
                    $cat_plafond
                ]);

                $cat_kayu = RABMaterial::Material(['kategori'=>'cat','item'=>'cat_kayu']);
                array_unshift($res['lantai1']['PEKERJAAN CAT - CATAN'],[
                    'cat_kayu',
                    round($cat_kayu->rasio*$luas,3),
                    'm<sup>2</sup>',
                    $cat_kayu->harga,
                    true,
                    1,
                    $cat_kayu
                ]);

                $westafel = RABMaterial::Material(['kategori'=>'sanitasi','item'=>'westafel']);
                array_unshift($res['lantai1']['PEKERJAAN SANITASI'],[
                    'westafel',
                    ceil($westafel->rasio*$luas),
                    'bh',
                    $westafel->harga,
                    false,
                    1,
                    $westafel
                ]);

                $shower = RABMaterial::Material(['kategori'=>'sanitasi','item'=>'shower']);
                array_unshift($res['lantai1']['PEKERJAAN SANITASI'],[
                    'shower',
                    ceil($shower->rasio*$luas),
                    'bh',
                    $shower->harga,
                    false,
                    1,
                    $shower
                ]);

        return $res;
    }
}

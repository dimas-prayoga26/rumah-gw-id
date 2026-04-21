<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>RAB - RumahGue</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Roboto", sans-serif;
            margin: 40px;
            color: #333;
            font-size: 14px;
        }

        .meta {
            margin-bottom: 10px;
        }

        .meta p {
            margin: 3px 0;
        }

        .content p {
            margin-bottom: 10px;
            text-align: justify;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .summary-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 60px;
            width: 100%;
        }

        .footer .right {
            float: right;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="meta">
        <p style="text-align: right">{{ now()->translatedFormat('d F Y') }}</p><br>
        @if (!empty($user))
            <p><strong>Nama</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $user->nama }}</p>
        @else
            <p><strong>Nama</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Anonymous</p>
        @endif
        <p><strong>Perihal</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rancangan Anggaran Biaya (RAB)</p>
        <p><strong>Lampiran</strong>&nbsp;&nbsp;: {{ $jumlah_halaman ?? 'Tidak ada' }} lembar</p>
    </div>

    <div class="content">
        <p>Dengan hormat,</p>
        <p>
             &nbsp;Kami lampirkan rincian Rancangan Anggaran Biaya (RAB) yang disusun berdasarkan kebutuhan pembangunan rumah yang telah dirancang melalui platform RumahGue. Di dalamnya tercantum daftar pekerjaan, volume, serta estimasi biaya untuk masing-masing bagian.
        </p>
        <p>
            &nbsp;Jika ada hal yang perlu disesuaikan atau ingin didiskusikan lebih lanjut, silakan hubungi tim RumahGue. Semoga dokumen ini dapat membantu dalam proses perencanaan, dan menjadi langkah awal untuk mewujudkan hunian yang diinginkan.
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Macam Pekerjaan</th>
                <th style="text-align: center;">Volume / QTY</th>
                <th style="text-align: center;">Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                // $konsep = collect($rab)->last()['konsep_biaya'] ?? 0;
                $total = collect($rab)->last()['total_biaya'] ?? 0;
            @endphp
            @foreach($rab as $item)
                @if(isset($item['pekerjaan']))
                <tr>
                    <td style="width: 5%; text-align: center">{{ $no++ }}</td>
                    <td style="width: 45%; word-wrap: break-word">{{ $item['pekerjaan'] }}</td>
                    <td style="text-align:center">
                        {!! $item['volume'] !!}
                        <script>
                            document.querySelectorAll('input[type="number"]').forEach(input => input.replaceWith(document.createTextNode(input.value)));
                        </script>
                    </td>
                    <td style="text-align: end; width: 25%;">Rp {{ number_format($item['jumlah_harga'], 0, ',', '.') }}</td>
                </tr>
                @endif
            @endforeach
            <tr class="summary-row">
                <td colspan="3">Total Biaya</td>
                <td style="text-align: end;">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <div style="page-break-inside: avoid; text-align: justify;">
        <p>Rencana Anggaran Biaya (RAB) terlampir merupakan hasil simulasi awal dari perhitungan kasar pembangunan, yang disusun berdasarkan asumsi-asumsi umum dan standar perhitungan sementara. Oleh karena itu, perhitungan tersebut masih bersifat estimatif dan perlu dilakukan penyesuaian secara lebih rinci serta akurat berdasarkan kondisi nyata di lapangan, termasuk faktor teknis, lingkungan, dan ketersediaan material pada saat pelaksanaan.</p>
    </div>
    <div class="footer">
        <div class="right">
            <p>Hormat kami,</p>
            <br><br>
            <p><strong>Tim Rumahgue</strong></p>
        </div>
    </div>

</body>
</html>

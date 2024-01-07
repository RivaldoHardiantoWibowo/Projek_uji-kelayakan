<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Surat Pernyataan Terlambat</title>
</head>
<style>
body {
    font-family:Tahoma, sans-serif;
}

.container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 20px;
    text-align: justify;
}

h1 {
    text-align: center;
    font-size: 19px;
    font-weight: bold;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
    font-size: 13px;
}

.container p {
    max-width: 900px;
    font-size: 13px;
    color: #495057;
}

.lokasi{
    float: right;
    font-weight: bold;
}

.signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
}

        .signature .box {
            width: 33%;
            text-align:center;
        }

        .signature .box span {
            display: block;
            margin-top: 20px;
        }
</style>
<body>
    @if (Auth::check())
@if (Auth::user()->role == 'admin')
    <div class="container">
        <h1>SURAT PERNYATAAN<br> TIDAK AKAN DATANG TERLAMBAT KESEKOLAH</h1>
        <br>
        <br>
        <br>
        <p>Yang bertanda tangan dibawah ini:</p>
        <ul>
            <li>NIS    : {{ $student->nis }}</li>
            <li>Nama   : {{ $student->name }}</li>
            <li>Rombel:{{ $student->rombel->rombel }}</li>
            <li>Rayon: {{ $student->rayon->rayon }}</li>
        </ul>
        <br>
        <br>
        <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak 3 Kali yang mana hal tersebut termasuk kedalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.</p>
        <br>
        <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
        <br>
        <br>
        <br>
        <br>
        <br><br>
        <span class="lokasi">Bogor, 24 November 2023</span>
        <div class="signature">
            <div class="box">
                Peserta Didik,
                <br>
                <br><br><br><br>
                <span>{{ $student->name }}</span>
                <br>
                <br>
                <br><br><br>
                Pembimbing Siswa
            </div>
        </div>
    </div>
    @else
    <div class="container">
        <h1>SURAT PERNYATAAN<br> TIDAK AKAN DATANG TERLAMBAT KESEKOLAH</h1>
        <br>
        <br>
        <br>
        <p>Yang bertanda tangan dibawah ini:</p>
        <ul>
            <li>NIS    : {{ $lates->students->nis }}</li>
            <li>Nama   :{{ $lates->students->name }}</li>
            <li>Rombel:{{ $lates->students->rombel->rombel }}</li>
            <li>Rayon:{{ $lates->students->rayon->rayon }} </li>
        </ul>
        <br>
        <br>
        <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak 3 Kali yang mana hal tersebut termasuk kedalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.</p>
        <br>
        <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
        <br>
        <br>
        <br>
        <br>
        <br><br>
        <span class="lokasi">Bogor, 24 November 2023</span>
        <div class="signature">
            <div class="box">
                Peserta Didik,
                <br>
                <br><br><br><br>
                <span>{{ $lates->students->name }}</span>
                <br>
                <br>
                <br><br><br>
                Pembimbing Siswa
            </div>
        </div>
    </div>
@endif
@endif

</body>
</html>

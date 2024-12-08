<!DOCTYPE html>
<html>
<head>
    <title>Cetak IRS</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Isian Rencana Studi (IRS)</h1>
    <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
    <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
    <p><strong>Semester:</strong> {{ $mahasiswa->semester }}</p>


    <h2>Data IRS</h2>
    <table>
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>SKS</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Pengampu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($irs as $item)
            <tr>
                <td>{{ $item->kodemk }}</td>
                <td>{{ $item->namamk }}</td>
                <td>{{ $item->sks }}</td>
                <td>{{ $item->kelas }}</td>
                <td>{{ $item->hari }}</td>
                <td>{{ $item->mulai }} - {{ $item->selesai }}</td>
                <td>{{ $item->jadwal->dosen_pengampu }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

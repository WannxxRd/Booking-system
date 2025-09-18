<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Registrasi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        th {
            height: 25px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 4px;
        }

        thead {
            background: lightgray;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .top {
            vertical-align: top;
        }

        .table-no-border {
            table-layout: fixed;
        }

        .table-no-border,
        .table-no-border th,
        .table-no-border td {
            border: none;
        }

        .table-no-border-2,
        .table-no-border-2 th,
        .table-no-border-2 td {
            border: none;
        }

        .mt-1 {
            margin-top: 20px;
        }

        .mt-2 {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <h3 class="center">
        REGISTRASI / <i>(Registration)</i>
    </h3>

    <hr>

    <table class="mt-1 table-no-border-2">
        <tr class="top">
            <td width="25%">Tanggal Registrasi<br><i>(Date of Registration)</i></td>
            <td width="1%">:</td>
            <td><?= date('Y-m-d H:i', strtotime($registrasi['tgl_registrasi'])) ?></td>
        </tr>
        <?php if ($user['jenis_user'] == 'Kapal'): ?>
            <tr class="top">
                <td>Nama Kapal<br><i>(Ship Name)</i></td>
                <td>:</td>
                <td><?= $user['nama'] ?></td>
            </tr>
            <tr class="top">
                <td>GT Kapal<br><i>(Ship GT)</i></td>
                <td>:</td>
                <td><?= $user['gt_kapal'] ?></td>
            </tr>
            <tr class="top">
                <td>Asal Kapal<br><i>(Ship's Origin)</i></td>
                <td>:</td>
                <td><?= $user['asal_kapal'] ?></td>
            </tr>
        <?php elseif ($user['jenis_user'] == 'Land Base'): ?>
            <tr class="top">
                <td>Nama Homestay / Resort<br><i>(Homestay / Resort Name)</i></td>
                <td>:</td>
                <td><?= $user['nama'] ?></td>
            </tr>
            <tr class="top">
                <td>Lokasi Homestay / Resort<br><i>(Homestay / Resort Location)</i></td>
                <td>:</td>
                <td><?= $user['lokasi'] ?></td>
            </tr>
        <?php endif; ?>
        <tr class="top">
            <td>Nama Operator<br><i>(Operator Name)</i></td>
            <td>:</td>
            <td><?= $user['nama_operator'] ?></td>
        </tr>
        <tr class="top">
            <td>Nomor WA<br><i>(WA Number)</i></td>
            <td>:</td>
            <td><?= $user['nomor_wa'] ?></td>
        </tr>
        <tr class="top">
            <td>Email</td>
            <td>:</td>
            <td><?= $user['email'] ?></td>
        </tr>
        <tr class="top">
            <td>Jumlah Penumpang<br><i>(Number of Passengers)</i></td>
            <td>:</td>
            <td><?= $registrasi['jml_penumpang'] ?></td>
        </tr>
    </table>

    <table class="mt-1">
        <thead>
            <tr>
                <th>No</th>
                <th>Cluster</th>
                <th>Tanggal / <i>(Date)</i></th>
                <th>Lokasi Selam / <i>(Dive Spot)</i></th>
                <th>Jam / <i>(Time)</i></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($detail as $d) : ?>
                <tr class="top">
                    <td class="center"><?= $no++ ?></td>
                    <td class="center"><?= $d['nama_cluster'] ?></td>
                    <td class="center"><?= $d['tanggal'] ?></td>
                    <td><?= $d['nama_dive_spot'] ?></td>
                    <td class="center"><?= implode('<br>', array_column($jam[$d['id']]['jam'], 'nama_jam')) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
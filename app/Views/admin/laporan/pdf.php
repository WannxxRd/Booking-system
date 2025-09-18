<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Registrasi</title>
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
        LAPORAN DATA REGISTRASI
        <br><?= empty($cluster) ? 'SEMUA CLUSTER' : strtoupper($nama_cluster) ?>
        <br>PERIODE <?= date('d-m-Y', strtotime($dari)) ?> s/d <?= date('d-m-Y', strtotime($sampai)) ?>
    </h3>

    <hr>

    <table class="mt-1">
        <thead>
            <tr>
                <th>No</th>
                <th>Cluster</th>
                <th>Nama</th>
                <th>Nama Operator</th>
                <th>Tgl Masuk</th>
                <th>Tgl Keluar</th>
                <th>Dive Spot / Jam</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($hasil as $rowc) : ?>
                <?php foreach ($rowc['registrasi'] as $row) : ?>
                    <?php $rowcCount = count($row['detail']); ?>
                    <?php foreach ($row['detail'] as $key => $rowd) : ?>
                        <tr class="top">
                            <?php if ($key === 0) : ?>
                                <td class="center" rowspan="<?= $rowcCount ?>"><?= $no++ ?></td>
                                <td class="center" rowspan="<?= $rowcCount ?>"><?= $rowc['cluster']['nama_cluster'] ?></td>
                                <td rowspan="<?= $rowcCount ?>"><?= $row['registrasi']['nama'] ?></td>
                                <td rowspan="<?= $rowcCount ?>">
                                    <?= $row['registrasi']['nama_operator'] ?><br><?= $row['registrasi']['nomor_wa'] ?>
                                </td>
                            <?php endif; ?>
                            <td class="center"><?= date('d-m-Y', strtotime($rowd['tgl_masuk'])) ?></td>
                            <td class="center"><?= date('d-m-Y', strtotime($rowd['tgl_keluar'])) ?></td>
                            <td>
                                <?= $rowd['dive_spot']['nama_dive_spot'] ?>
                                <br>
                                <?= implode('<br>', array_column($rowd['jam'], 'nama_jam')) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
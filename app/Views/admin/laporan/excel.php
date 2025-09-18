<h3>LAPORAN DATA REGISTRASI <?= empty($cluster) ? 'SEMUA CLUSTER' : strtoupper($nama_cluster) ?></h3>
<h3>PERIODE <?= date('d-m-Y', strtotime($dari)) ?> s/d <?= date('d-m-Y', strtotime($sampai)) ?></h3>

<table>
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
                    <tr>
                        <?php if ($key === 0) : ?>
                            <td rowspan="<?= $rowcCount ?>"><?= $no++ ?></td>
                            <td rowspan="<?= $rowcCount ?>"><?= $rowc['cluster']['nama_cluster'] ?></td>
                            <td rowspan="<?= $rowcCount ?>"><?= $row['registrasi']['nama'] ?></td>
                            <td rowspan="<?= $rowcCount ?>">
                                <?= $row['registrasi']['nama_operator'] ?><br><?= $row['registrasi']['nomor_wa'] ?>
                            </td>
                        <?php endif; ?>
                        <td><?= date('d-m-Y', strtotime($rowd['tgl_masuk'])) ?></td>
                        <td><?= date('d-m-Y', strtotime($rowd['tgl_keluar'])) ?></td>
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
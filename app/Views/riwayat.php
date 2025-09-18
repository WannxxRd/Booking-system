<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<section id="starter-section" class="starter-section section">

    <div class="container">
        <div class="card mt-2 text-dark bg-light mb-2">
            <div class="card-header">
                <h3 class="text-center">RIWAYAT REGISTRASI</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center my-4">
                    <div class="col-md-12 table-responsive">

                        <table class="table table-hover" id="datatable" data-ordering="false">
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
                                <?php foreach ($hasil as $rowc) : ?>
                                    <?php foreach ($rowc['registrasi'] as $row) : ?>
                                        <tr>
                                            <td></td>
                                            <td><?= $rowc['cluster']['nama_cluster'] ?></td>
                                            <td><?= $row['registrasi']['nama'] ?></td>
                                            <td><?= $row['registrasi']['nama_operator'] ?><br><?= $row['registrasi']['nomor_wa'] ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['durasi']['tgl_masuk'])) ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['durasi']['tgl_keluar'])) ?></td>
                                            <td>
                                                <?php $detailCount = count($row['detail']); ?>
                                                <?php foreach ($row['detail'] as $key => $d) : ?>
                                                    <?= $d['dive_spot']['nama_dive_spot'] ?>
                                                    <br>
                                                    <?= implode('<br>', array_column($d['jam'], 'nama_jam')) ?>
                                                    <?= ($key !== $detailCount - 1) ? '<hr>' : '' ?>
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>
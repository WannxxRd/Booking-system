<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4">Laporan</h4>

    <div class="card">
        <div class="card-body">

            <form action="<?= base_url('admin/laporan') ?>" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <label for="cluster" class="form-label">Cluster</label>
                        <select name="cluster" id="cluster" class="form-select">
                            <option value="">- Semua Cluster -</option>
                            <?php foreach ($datacluster as $row) : ?>
                                <option value="<?= $row['id'] ?>" <?= $cluster == $row['id'] ? 'selected' : '' ?>><?= $row['nama_cluster'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="dari" class="form-label">Dari Tanggal</label>
                        <input type="date" name="dari" id="dari" class="form-control" value="<?= $dari ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label for="sampai" class="form-label">Sampai Tanggal</label>
                        <input type="date" name="sampai" id="sampai" class="form-control" value="<?= $sampai ?>" required>
                    </div>
                    <div class="col-md-5">
                        <label for="submit" class="form-label">&nbsp;</label>
                        <div class="d-flex align-items-end">
                            <button type="submit" id="submit" class="btn btn-outline-primary d-inline mx-2"><i class="bx bx-search"></i> Tampilkan</button>
                            <?php if (!empty($dari) && !empty($sampai) && $total > 0) : ?>
                                <a href="<?= base_url('admin/laporan/excel?cluster=' . $cluster . '&dari=' . $dari . '&sampai=' . $sampai) ?>" target="_blank" class="btn btn-outline-success d-inline mx-2"><i class="bx bx-file"></i> Excel</a>
                                <a href="<?= base_url('admin/laporan/pdf?cluster=' . $cluster . '&dari=' . $dari . '&sampai=' . $sampai) ?>" target="_blank" class="btn btn-outline-success d-inline mx-2"><i class="bx bx-file-blank"></i> PDF</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
            <hr>

            <?php if (!empty($dari) && !empty($sampai)) : ?>

                <?php if ($total == 0) : ?>
                    <div class="alert alert-danger text-center" role="alert">
                        Tidak ada data registrasi untuk periode tersebut
                    </div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
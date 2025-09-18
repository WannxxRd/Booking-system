<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4">Data Dive Spot - Pilih Cluster</h4>

    <div class="card">
        <div class="card-body table-responsive">

            <?= session()->getFlashdata('pesan'); ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Cluster</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($cluster as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_cluster'] ?></td>
                            <td><a href="<?= base_url('admin/dive_spot/' . $row['id']) ?>" class="btn btn-info btn-sm" title="Pilih"><i class="bx bx-check me-1"></i> Pilih</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
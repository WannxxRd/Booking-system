<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4">Riwayat Registrasi User</h4>

    <div class="card">
        <div class="card-body table-responsive">

            <?= session()->getFlashdata('pesan'); ?>

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
                        <th>Dokumen</th>
                        <th>Aksi</th>
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
                                <td>
                                    <?php if ($row['registrasi']['dokumen']) : ?>
                                        <a href="<?= base_url('uploads/dokumen/' . $row['registrasi']['dokumen']); ?>" class="btn btn-outline-success btn-sm" target="_blank" title="Lihat Dokumen"><i class="bx bx-file"></i> Dokumen</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form action="<?= base_url('admin/riwayat/hapus/' . $row['registrasi']['id']) ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <button class="btn btn-danger btn-sm delete-confirm" type="submit" title="Hapus"><i class="bx bx-trash me-1"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').on('click', '.delete-confirm', function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: "Konfirmasi",
                    text: "Anda yakin data ini mau dihapus?",
                    icon: "warning",
                    buttons: ['Batal', 'Hapus'],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    });
</script>
<?= $this->endSection() ?>
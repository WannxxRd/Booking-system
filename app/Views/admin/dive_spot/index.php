<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4">Data Dive Spot - <?= $cluster['nama_cluster'] ?></h4>

    <div class="card">
        <h5 class="card-header">
            <a href="<?= base_url('admin/dive_spot') ?>" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> Kembali</a>
            <a href="<?= base_url('admin/dive_spot/tambah/' . $cluster['id']) ?>" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Tambah Dive Spot</a>
        </h5>
        <div class="card-body table-responsive">

            <?= session()->getFlashdata('pesan'); ?>

            <table class="table table-hover" id="datatable" data-ordering="false">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dive Spot</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dive_spot as $row) : ?>
                        <?php $label = $row['aktif'] ? 'Aktif' : 'Nonaktif' ?>
                        <?php $warna = $row['aktif'] ? 'primary' : 'danger' ?>
                        <tr>
                            <td></td>
                            <td><?= $row['nama_dive_spot'] ?></td>
                            <td><span class="badge bg-label-<?= $warna ?> me-1"><?= $label ?></span></td>
                            <td>
                                <form action="<?= base_url('admin/dive_spot/hapus/' . $row['id'] . '/' . $cluster['id']) ?>" method="POST">
                                    <?= csrf_field() ?>

                                    <a href="<?= base_url('admin/dive_spot/ubah/' . $row['id'] . '/' . $cluster['id']) ?>" class="btn btn-success btn-sm" title="Ubah"><i class="bx bx-pencil me-1"></i> Ubah</a>
                                    <button class="btn btn-danger btn-sm delete-confirm" type="submit" title="Hapus"><i class="bx bx-trash me-1"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
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
<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4">Data User</h4>

    <div class="card">
        <div class="card-body table-responsive">

            <?= session()->getFlashdata('pesan'); ?>

            <table class="table table-hover" id="datatable" data-ordering="false">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis User</th>
                        <th>Nama</th>
                        <th>Nama Operator</th>
                        <th>Nomor WA</th>
                        <th>Email</th>
                        <th>Lokasi (Resort)</th>
                        <th>Foto (Resort)</th>
                        <th>GT (Kapal)</th>
                        <th>Asal (Kapal)</th>
                        <th>Max Penumpang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $row) : ?>
                        <tr>
                            <td></td>
                            <td><?= $row['jenis_user'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['nama_operator'] ?></td>
                            <td><?= $row['nomor_wa'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['lokasi'] ?></td>
                            <td>
                                <?php if (!empty($row['foto'])): ?>
                                    <img src="<?= base_url('uploads/foto/' . $row['foto']) ?>" alt="Foto" width="60">
                                <?php endif; ?>
                            </td>
                            <td><?= $row['gt_kapal'] ?></td>
                            <td><?= $row['asal_kapal'] ?></td>
                            <td><?= $row['max_penumpang'] ?></td>
                            <td>
                                <form action="<?= base_url('admin/user/hapus/' . $row['id']) ?>" method="POST">
                                    <?= csrf_field() ?>
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
<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4">Data Jam</h4>

    <div class="card">
        <h5 class="card-header">
            <a href="<?= base_url('admin/jam/tambah') ?>" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Tambah Jam</a>
        </h5>
        <div class="card-body table-responsive">

            <?= session()->getFlashdata('pesan'); ?>

            <table class="table table-hover" id="datatable" data-ordering="false">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jam as $row) : ?>
                        <tr>
                            <td></td>
                            <td><?= $row['nama_jam'] ?></td>
                            <td>
                                <form action="<?= base_url('admin/jam/hapus/' . $row['id']) ?>" method="POST">
                                    <?= csrf_field() ?>

                                    <a href="<?= base_url('admin/jam/ubah/' . $row['id']) ?>" class="btn btn-success btn-sm" title="Ubah"><i class="bx bx-pencil me-1"></i> Ubah</a>
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
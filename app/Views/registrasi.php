<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<section id="starter-section" class="starter-section section">

    <div class="container">
        <div class="card mt-2 text-dark bg-light mb-2">
            <div class="card-header">
                <h3 class="text-center">Registrasi</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center my-4">
                    <div class="col-md-8">

                        <?= session()->getFlashdata('pesan'); ?>

                        <form action="<?= base_url('registrasi/proses') ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="jml_penumpang" class="form-label">Jumlah Penumpang / <i class="font-italic">(Total Passenger)</i></label>
                                <select class="form-select" name="jml_penumpang" id="jml_penumpang" required>
                                    <option value="">- Pilih -</option>
                                    <?php for ($i = 1; $i <= 30; $i++) : ?>
                                        <option value="<?= $i ?>" <?= set_value('jml_penumpang', $jml_penumpang) == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dokumen" class="form-label">Dokumen TLPJL dan TMKW <i class="font-italic">(PDF Only)</i></label>
                                <?php if (!empty($dokumen)) : ?>
                                    <p>
                                        <a href="<?= base_url('uploads/dokumen/' . $dokumen) ?>" class="btn btn-sm btn-outline-success" target="_blank"><i class="bi bi-file-earmark-text"></i> Lihat Dokumen</a>
                                    </p>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="dokumen" id="dokumen">
                            </div>
                            <div class="mt-4 d-flex justify-content-between">
                                <button type="submit" class="btn btn-success"><i class="bi bi-check"></i> Continue </button>
                                <a href="<?= base_url('registrasi/reset') ?>" class="btn btn-danger"><i class="bi bi-arrow-repeat"></i> Reset</a>
                            </div>
                        </form>

                        <?php if (!empty($jml_penumpang)) : ?>

                            <form action="<?= base_url('registrasi/proses2') ?>" method="post">
                                <hr>
                                <h4>Pilih Cluster yang ingin dimasuki / <i class="font-italic">(Select the cluster you want to enter)</i></h4>
                                <div class="mt-2">
                                    <?php foreach ($cluster as $c) : ?>
                                        <input type="radio" class="btn-check" name="cluster_id" id="cluster<?= $c['id'] ?>" autocomplete="off" value="<?= $c['id'] ?>">
                                        <label class="btn btn-outline-primary me-2 mb-2" for="cluster<?= $c['id'] ?>"><?= $c['nama_cluster'] ?></label>
                                    <?php endforeach; ?>
                                </div>

                                <div id="form_tanggal">
                                    <hr>
                                    <h4>Pilih tanggal / <i class="font-italic">(Select A Date)</i></h4>
                                    <div class="mt-2 row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= set_value('tanggal') ?>" autocomplete="off" placeholder="Pilih tanggal">
                                                <span class="input-group-text" id="calendar-icon"><i class="bi bi-calendar-date"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="form_lokasi">
                                    <hr>
                                    <h4>Pilih lokasi selam / <i class="font-italic">(Select a dive spot)</i></h4>
                                    <div class="mt-2">
                                        <div id="lokasi_selam"></div>
                                    </div>
                                    <div class="mt-4">
                                        <h4> Pilih Waktu Menyelam / <i class="font-italic">(Select dive time)</i></h4>
                                        <?php foreach ($jam as $j) : ?>
                                            <input type="radio" class="btn-check" name="jam_id[]" id="jam<?= $j['id'] ?>" autocomplete="off" value="<?= $j['id'] ?>">
                                            <label class="btn btn-outline-primary btn-sm me-2 mb-2" for="jam<?= $j['id'] ?>"><?= $j['nama_jam'] ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success" id="btn_tambah"><i class="bi bi-plus"></i> Add</button>
                                </div>
                            </form>

                            <?php if (!empty($detail)) : ?>
                                <hr>
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Cluster</th>
                                            <th>Tanggal/ <i class="font-italic">(Date)</i></th>
                                            <th>Lokasi Selam /<i class="font-italic">(Dive Spot)</i></th>
                                            <th>Jam / <i class="font-italic">(Time)</i></th>
                                            <th>Aksi / <i class="font-italic">(Action)</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($detail as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['options']['tanggal'] ?></td>
                                                <td><?= $row['options']['nama_dive_spot'] ?></td>
                                                <td><?= implode('<br>', $row['options']['nama_jam']) ?></td>
                                                <td>
                                                    <a href="<?= base_url('registrasi/hapus/') . $row['rowid'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <hr>
                                <div class="mt-2">
                                    <a href="#" data-href="<?= base_url('registrasi/simpan'); ?>" data-bs-toggle="modal" data-bs-target="#registrasiModal" class="btn btn-success" title="Save data"><i class="bi bi-save"></i> Save</a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<div class="modal fade" id="registrasiModal" tabindex="-1" aria-labelledby="registrasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrasiModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Apakah Data Yang Anda Inputkan Sudah Benar ?<br>
                    <i class="text-muted">Mohon periksa kembali data yang anda isi pada form registrasi</i>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a class="btn btn-success btn-registrasi"><i class="bi bi-save"></i> Save</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#form_tanggal').hide();
            $('#form_lokasi').hide();
            $('#btn_tambah').hide();

            $('input[name="cluster_id"]').on('change', function() {
                $('#form_tanggal').show();
                $('#form_lokasi').hide();
                $('#btn_tambah').hide();
            });

            $('#tanggal').on('change', function() {
                $('#form_lokasi').show();
                $('#btn_tambah').show();
            });

            $("#registrasiModal").on("shown.bs.modal", function(e) {
                $(this).find(".btn-registrasi").attr("href", $(e.relatedTarget).data("href"));
            });
        });

        $('input[name="cluster_id"]').on('change', function() {
            var cluster_id = $(this).val();

            $.ajax({
                url: "<?= base_url('registrasi/getDiveSpot') ?>",
                type: "POST",
                data: {
                    cluster_id: cluster_id
                },
                dataType: "json",
                success: function(data) {
                    var html = '';
                    $.each(data, function(i, item) {
                        html += '<div class="form-check">';
                        html += '<input class="form-check-input" type="checkbox" value="' + item.id + '" id="dive_spot' + item.id + '" name="dive_spot_id[]">';
                        html += '<label class="form-check-label" for="dive_spot' + item.id + '">';
                        html += item.nama_dive_spot;
                        html += '</label>';
                        html += '</div>';
                    });
                    $('#lokasi_selam').html(html);

                    // uncheck all jam_id
                    $('input[name="jam_id[]"]').prop('checked', false);
                }
            });

            getDisabledDates(cluster_id, function(data) {
                if (data !== null) {
                    initializeDatepicker(data, cluster_id);
                }
            });

            uncheckJam();
            uncheckDiveSpot();

            $('#tanggal').val('');
        });

        $(document).on('change', 'input[name="dive_spot_id[]"]', function() {
            if ($(this).prop('checked')) {
                // Uncheck all other checkboxes
                $('input[name="dive_spot_id[]"]').not(this).prop('checked', false);
            }

            var dive_spot_id = $('input[name="dive_spot_id[]"]:checked').val();
            uncheckJam();
            checkDisabledJam(dive_spot_id);
        });

        $('#tanggal').on('change', function() {
            $('input[name="jam_id[]"]').prop('disabled', false);
            uncheckJam();
            uncheckDiveSpot();
        });

        function initializeDatepicker(disabledDates, cluster_id) {
            // Check if datepicker is already initialized, then destroy it
            if ($("#tanggal").data('datepicker')) {
                $("#tanggal").datepicker('destroy');
            }

            var maxHari = 3; // default
            if (cluster_id == 1 || cluster_id == 2) {
                maxHari = 3;
            } else if (cluster_id == 3 || cluster_id == 4) {
                maxHari = 2;
            }

            var today = new Date();
            var maxDate = new Date();
            maxDate.setDate(today.getDate() + maxHari);

            var dateInput = $("#tanggal").datepicker({
                format: 'yyyy-mm-dd',
                startDate: today,
                endDate: maxDate,
                autoclose: true,
                datesDisabled: disabledDates,
            });

            $('#calendar-icon').on('click', function() {
                dateInput.datepicker('show');
            });
        }

        function checkLokasiJam(dive_spot_id, jam_id) {
            if (dive_spot_id) {
                $.each(dive_spot_id, function(i, item) {
                    $('#dive_spot' + item).prop('disabled', true);
                });
            } else {
                $('input[name="dive_spot_id[]"]').prop('disabled', false);
            }

            if (jam_id) {
                $.each(jam_id, function(i, item) {
                    $('#jam' + item).prop('disabled', true);
                });
            } else {
                $('input[name="jam_id[]"]').prop('disabled', false);
            }
        }

        function uncheckDiveSpot() {
            $('input[name="dive_spot_id[]"]').prop('checked', false);
        }

        function uncheckJam() {
            $('input[name="jam_id[]"]').prop('checked', false);
        }

        function checkDisabledJam(dive_spot_id) {
            var cluster_id = $('input[name="cluster_id"]:checked').val();
            var tanggal = $('#tanggal').val();

            $.ajax({
                url: "<?= base_url('registrasi/getJam') ?>",
                type: "POST",
                data: {
                    dive_spot_id: dive_spot_id,
                    cluster_id: cluster_id,
                    tanggal: tanggal
                },
                dataType: "json",
                success: function(data) {
                    $('input[name="jam_id[]"]').prop('disabled', false);

                    $.each(data, function(i, jam_id) {
                        $('#jam' + jam_id).prop('disabled', true);
                    });

                }
            });
        }

        function getDisabledDates(cluster_id, callback) {
            $.ajax({
                url: "<?= base_url('registrasi/getTotalKapal') ?>",
                type: "POST",
                data: {
                    cluster_id: cluster_id
                },
                dataType: "json",
                success: function(data) {
                    callback(data);
                },
                error: function() {
                    callback(null);
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>
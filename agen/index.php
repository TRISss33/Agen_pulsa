<?php
require 'functions.php';
$pdo = pdo_connect_mysql();

$sql = 'SELECT * FROM agen_pulsa';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-label {
            margin-bottom: 0.5rem;
        }
        .form-check {
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-check-label {
            margin-left: 0.5rem;
        }
        .form-control, .form-check-input {
            margin-left: 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="mt-3">
        <h3 class="text-right">Data Agen Pulsa</h3>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">NEW</button>
        <table class="table table-bordered table-hover">
            <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>No Ktp</th>
                <th>Alamat</th>
                <th>Jenis Keanggotaan</th>
                <th>Aksi</th>
            </tr>
            <?php if ($results): ?>
                <?php foreach ($results as $index => $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($index + 1, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_lengkap'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['tanggal_lahir'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['no_ktp'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis_keanggotaan'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <?php if (isset($row['id'])): ?>
                                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo $row['id']; ?>">EDIT</button>
                                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo $row['id']; ?>">DELETE</button>
                            <?php else: ?>
                                <span class="text-danger">ID not found</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No data available</td>
                </tr>
            <?php endif; ?>
        </table>

        <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Pendaftaran Agen Pulsa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="form_pendaftaran.php">
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label text-nowrap form-label">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tanggal_lahir" class="col-sm-2 col-form-label text-nowrap form-label">Tanggal Lahir</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="no_ktp" class="col-sm-2 col-form-label text-nowrap form-label">No KTP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="No KTP" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label text-nowrap form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenis_keanggotaan" class="col-sm-2 col-form-label text-nowrap form-label">Jenis Keanggotaan</label>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_keanggotaan" id="biasa" value="Biasa" required>
                                        <label class="form-check-label" for="biasa">Biasa</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_keanggotaan" id="eksklusif" value="Eksklusif" required>
                                        <label class="form-check-label" for="eksklusif">Eksklusif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex justify-content-start w-100">
                                    <button type="button" class="btn btn-warning me-2" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Agen Pulsa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST" action="edit.php">
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-3 row">
                                <label for="edit_nama" class="col-sm-2 col-form-label text-nowrap form-label">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="edit_nama" name="nama" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="edit_tanggal_lahir" class="col-sm-2 col-form-label text-nowrap form-label">Tanggal Lahir</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="edit_no_ktp" class="col-sm-2 col-form-label text-nowrap form-label">No KTP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="edit_no_ktp" name="no_ktp" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="edit_alamat" class="col-sm-2 col-form-label text-nowrap form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="edit_jenis_keanggotaan" class="col-sm-2 col-form-label text-nowrap form-label">Jenis Keanggotaan</label>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_keanggotaan" id="edit_biasa" value="Biasa" required>
                                        <label class="form-check-label" for="edit_biasa">Biasa</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_keanggotaan" id="edit_eksklusif" value="Eksklusif" required>
                                        <label class="form-check-label" for="edit_eksklusif">Eksklusif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex justify-content-start w-100">
                                    <button type="button" class="btn btn-primary me-2" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Ganti</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Apakah anda yakin ingin menghapus data ini?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" id="confirmDeleteButton" class="btn btn-danger">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editModal = document.getElementById('editModal');
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');

            fetch('get_data.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nama').value = data.nama_lengkap;
                    document.getElementById('edit_tanggal_lahir').value = data.tanggal_lahir;
                    document.getElementById('edit_no_ktp').value = data.no_ktp;
                    document.getElementById('edit_alamat').value = data.alamat;
                    document.querySelector(`input[name="jenis_keanggotaan"][value="${data.jenis_keanggotaan}"]`).checked = true;
                })
                .catch(error => console.error('Error:', error));
        });

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            confirmDeleteButton.setAttribute('href', 'delete.php?id=' + id);
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

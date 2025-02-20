<?php

require "koneksi.php";

    $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';
    switch($aksi) {
        case 'read' :

?>

<div class="container my-4">
    <h2>Data Mahasiswa</h2>
    <a href="index.php?page=mahasiswa&aksi=create" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
    <div class="table-responsive">
        <table id="dataTableMahasiswa" class="table display">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Hobi</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $queryMhs = mysqli_query($koneksi, "
                SELECT m.*, p.nama_prodi 
                FROM mahasiswa m 
                LEFT JOIN prodi p ON m.prodi_id = p.id
                ");
            
                $no = 1;
                while ($data = mysqli_fetch_array($queryMhs)) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['nim'] ?></td>
                        <td><?= $data['gender'] ?></td>
                        <td><?= $data['hobi'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['nama_prodi'] ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="index.php?page=mahasiswa&aksi=update&id=<?= $data['id']; ?>" class="btn btn-warning me-2">Edit</a>
                                <a href="proses_mahasiswa.php?proses=delete&id=<?= $data['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableMahasiswa').DataTable();
    });
</script>

<?php
break ; 
    case 'create' : 

?>

<div class="container my-4">
    <h2>Input Data Mahasiswa</h2>
    <form action="proses_mahasiswa.php?proses=insert" method="POST" class="needs-validation" novalidate>
        <div class="row">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
                <div class="invalid-feedback">Nama tidak boleh kosong</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Anda</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Email tidak valid</div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="number" class="form-control" id="nim" name="nim" required>
                <div class="invalid-feedback">NIM tidak boleh kosong</div>
            </div>
            <div class="mb-3">
                <p>Jenis Kelamin</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="laki-laki" value="Laki-laki" required>
                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan" required>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
                <div class="invalid-feedback">Pilih jenis kelamin</div>
            </div>
        </div>
        <div class="mb-3">
            <p>Hobi</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="hobi[]" value="Salto" id="hobi-salto">
                <label class="form-check-label" for="hobi-salto">Salto</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="hobi[]" value="Terbang" id="hobi-terbang">
                <label class="form-check-label" for="hobi-terbang">Terbang</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="hobi[]" value="Khutbah" id="hobi-khutbah">
                <label class="form-check-label" for="hobi-khutbah">Khutbah</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            <div class="invalid-feedback">Alamat tidak boleh kosong</div>
        </div>

        <div class="mb-3">
    <label for="prodi" class="form-label">Program Studi</label>
    <select class="form-select" id="prodi" name="prodi_id" required>
        <option value="">Pilih Program Studi</option>
        <?php
        $queryProdi = mysqli_query($koneksi, "SELECT * FROM prodi");
        while ($prodi = mysqli_fetch_array($queryProdi)) {
        ?>
            <option value="<?= $prodi['id']; ?>"><?= $prodi['nama_prodi']; ?></option>
        <?php } ?>
    </select>
    
    <div class="invalid-feedback">Pilih program studi</div>
</div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

    </form>
</div>


<?php
break;
case 'update':
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $queryMahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
        $data = mysqli_fetch_array($queryMahasiswa);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Edit Data Mahasiswa</h2>
    <form action="proses_mahasiswa.php?proses=update" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email Anda</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $data['email']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="number" class="form-control" id="nim" name="nim" value="<?= $data['nim']; ?>" required>
        </div>
        
        <div class="mb-3">
            <p class="mb-1">Jenis Kelamin</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="laki-laki" value="Laki-laki" 
                    <?= ($data['gender'] == 'Laki-laki') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="laki-laki">Laki-laki</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan" 
                    <?= ($data['gender'] == 'Perempuan') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="perempuan">Perempuan</label>
            </div>
        </div>
        
        <div class="mb-3">
            <p class="mb-1">Hobi</p>
            <?php
            $hobiMahasiswa = explode(", ", $data['hobi']);
            $hobiOptions = ["Salto", "Terbang", "Khutbah"];
            foreach ($hobiOptions as $hobi) {
            ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="hobi[]" value="<?= $hobi; ?>" id="hobi-<?= strtolower($hobi); ?>" 
                    <?= in_array($hobi, $hobiMahasiswa) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="hobi-<?= strtolower($hobi); ?>"><?= $hobi; ?></label>
            </div>
            <?php } ?>
        </div>
        
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $data['alamat']; ?></textarea>
        </div>        
        <div class="mb-3">
    <label for="prodi" class="form-label">Program Studi</label>
    <select class="form-select" id="prodi" name="prodi_id" required>
        <option value="">Pilih Program Studi</option>
        <?php
        $queryProdi = mysqli_query($koneksi, "SELECT * FROM prodi");
        while ($prodi = mysqli_fetch_array($queryProdi)) {
            $selected = ($prodi['id'] == $data['prodi_id']) ? 'selected' : '';
        ?>
            <option value="<?= $prodi['id']; ?>" <?= $selected; ?>><?= $prodi['nama_prodi']; ?></option>
        <?php } ?>
    </select>
    <div class="invalid-feedback">Pilih program studi</div>
</div>

<div class="d-flex justify-content-between">
            <a href="index.php?page=mahasiswa" class="btn btn-secondary">Kembali</a>
            <button type="submit" name="submit" class="btn btn-success">Update</button>
        </div>

    </form>
</div>
      
<?php
    }
?>

<?php
    }
?>
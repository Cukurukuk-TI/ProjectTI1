<?php

require "koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';
switch($aksi) {
    case 'read' :
?>

<h2>Data Mata Kuliah</h2>
<a href="index.php?page=matkul&aksi=create" class="btn btn-primary">Tambah Mata Kuliah</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode Mata Kuliah</th>
      <th scope="col">Nama Mata Kuliah</th>
      <th scope="col">SKS</th>
      <th scope="col">Prodi</th>
      <th scope="col">Semester</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $queryMatkul = mysqli_query($koneksi, 
        "SELECT m.*, p.nama_prodi FROM mata_kuliah m 
         JOIN prodi p ON m.prodi_id = p.id");
      $no = 1;
      while($data = mysqli_fetch_array($queryMatkul)) {
      ?>
    <tr>
      <th scope="row"><?= $no++ ?></th>
      <td><?= $data['kode_mk'] ?></td>
      <td><?= $data['nama_mk'] ?></td>
      <td><?= $data['sks'] ?></td>
      <td><?= $data['nama_prodi'] ?></td>
      <td><?= $data['semester'] ?></td>
      <td>
          <div class="btn-group" role="group">
              <a href="index.php?page=matkul&aksi=update&kode_mk=<?= $data['kode_mk']; ?>"> 
                <button type="button" class="btn btn-warning me-2">Edit</button>
              </a>
              <a href="proses_matkul.php?proses=delete&kode_mk=<?= $data['kode_mk']; ?>" onclick="return confirm('Apakah Anda ingin menghapus data?')">
                <button type="button" class="btn btn-danger">Hapus</button>
              </a>
          </div>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<?php
break; 
case 'create':
?>

<h2>Tambah Mata Kuliah</h2>
<form action="proses_matkul.php?proses=insert" method="POST">
  <div class="mb-3">
    <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
    <input type="text" class="form-control" id="kode_mk" name="kode_mk" required>
  </div>
  <div class="mb-3">
    <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
    <input type="text" class="form-control" id="nama_mk" name="nama_mk" required>
  </div>
  <div class="mb-3">
    <label for="sks" class="form-label">SKS</label>
    <input type="number" class="form-control" id="sks" name="sks" required>
  </div>
  <div class="mb-3">
    <label for="prodi_id" class="form-label">Prodi</label>
    <select class="form-select" id="prodi_id" name="prodi_id" required>
      <option value="" selected disabled>Pilih Prodi</option>
      <?php
      $queryProdi = mysqli_query($koneksi, "SELECT * FROM prodi");
      while($prodi = mysqli_fetch_array($queryProdi)) {
          echo "<option value='{$prodi['id']}'>{$prodi['nama_prodi']}</option>";
      }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="semester" class="form-label">Semester</label>
    <input type="number" class="form-control" id="semester" name="semester" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php
case 'update':
if (isset($_GET['kode_mk'])) {
    $kode_mk = $_GET['kode_mk'];
    $queryMatkul = mysqli_query($koneksi, "SELECT * FROM mata_kuliah WHERE kode_mk='$kode_mk'");
    $data = mysqli_fetch_array($queryMatkul);
?>

<h2>Edit Mata Kuliah</h2>
<form action="proses_matkul.php?proses=update" method="POST">
    <input type="hidden" name="kode_mk" value="<?= $data['kode_mk'] ?>" />
    <div class="mb-3">
        <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
        <input type="text" class="form-control" id="kode_mk" name="kode_mk" value="<?= $data['kode_mk'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
        <input type="text" class="form-control" id="nama_mk" name="nama_mk" value="<?= $data['nama_mk'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="sks" class="form-label">SKS</label>
        <input type="number" class="form-control" id="sks" name="sks" value="<?= $data['sks'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="prodi_id" class="form-label">Prodi</label>
        <select class="form-select" id="prodi_id" name="prodi_id" required>
            <option value="" disabled>Pilih Prodi</option>
            <?php
            $queryProdi = mysqli_query($koneksi, "SELECT * FROM prodi");
            while($prodi = mysqli_fetch_array($queryProdi)) {
                $selected = ($data['prodi_id'] == $prodi['id']) ? 'selected' : '';
                echo "<option value='{$prodi['id']}' {$selected}>{$prodi['nama_prodi']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="semester" class="form-label">Semester</label>
        <input type="number" class="form-control" id="semester" name="semester" value="<?= $data['semester'] ?>" required>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Update</button>
    </form>

<?php
    }
    break;
  }
?>

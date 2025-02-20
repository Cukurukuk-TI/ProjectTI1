<?php

require "koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';
switch($aksi) {
    case 'read' :

?>

<h2>Data Dosen</h2>
<a href="index.php?page=dosen&aksi=create" class="btn btn-primary">Tambah Dosen</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">NIP</th>
      <th scope="col">Nama Dosen</th>
      <th scope="col">Prodi</th>
      <th scope="col">Foto</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

      <?php
      $queryDosen = mysqli_query($koneksi, "SELECT dosen.*, prodi.nama_prodi FROM dosen LEFT JOIN prodi ON dosen.prodi_id = prodi.id");
      $no = 1;
      while($data = mysqli_fetch_array($queryDosen)) {
      ?>

    <tr>
      <th scope="row"><?= $no++ ?></th>
      <td><?= $data['nip'] ?></td>
      <td><?= $data['nama_dosen'] ?></td>
      <td><?= $data['nama_prodi'] ?></td>
      <td><img src="uploads/<?= $data['foto'] ?>" alt="Foto Dosen" class="img-fluid" style="max-width: 150px;"></td>
      <td>
          <div class="btn-group" role="group">
              <a href="index.php?page=dosen&aksi=update&nip=<?= $data['nip']; ?>"> 
            <button type="button" class="btn btn-warning me-2">Edit</button> 
              </a>
              <a href="proses_dosen.php?proses=delete&nip=<?= $data['nip']; ?>" onclick="return confirm('Apakah anda ingin menghapus data?')">
            <button type="button" class="btn btn-danger">Hapus</button> 
             </a>
          </div>
      </td>
    </tr>
    <?php }
    ?>
  </tbody>
</table>

<?php
break; 

case 'create': 
?>

<h2>Input Data Dosen</h2>
<form action="proses_dosen.php?proses=insert" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" required>
    </div>
    <div class="mb-3">
        <label for="nama_dosen" class="form-label">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
    </div>
    <div class="mb-3">
        <label for="prodi_id" class="form-label">Prodi</label>
        <select class="form-select" id="prodi_id" name="prodi_id" required>
            <option value="" selected disabled>Pilih Prodi</option>
            <?php
            $queryProdi = mysqli_query($koneksi, "SELECT * FROM prodi");
            while ($prodi = mysqli_fetch_array($queryProdi)) {
                ?>
                <option value="<?= $prodi['id']; ?>"><?= $prodi['nama_prodi']; ?></option>
            <?php } ?>
            </select>
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<?php
break;

case 'update':
if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];
    $queryDosen = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nip='$nip'");
    $data = mysqli_fetch_array($queryDosen);
?>

<h2>Edit Data Dosen</h2>
<form action="proses_dosen.php?proses=update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="nip" value="<?= $data['nip']; ?>">
    <div class="mb-3">
        <label for="nama_dosen" class="form-label">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="<?= $data['nama_dosen']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="prodi_id" class="form-label">Prodi</label>
        <select class="form-select" id="prodi_id" name="prodi_id" required>
            <?php
            $queryProdi = mysqli_query($koneksi, "SELECT * FROM prodi");
            while ($prodi = mysqli_fetch_array($queryProdi)) {
                $selected = ($data['prodi_id'] == $prodi['id']) ? 'selected' : '';
                ?>
                <option value="<?= $prodi['id']; ?>" <?= $selected; ?>><?= $prodi['nama_prodi']; ?></option>
            <?php } ?>
            </select>
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto">
    </div>
    <button type="submit" name="submit" class="btn btn-success">Update</button>
</form>

<?php
}
break;
}
?>

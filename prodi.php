<?php

require "koneksi.php";

    $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';
    switch($aksi) {
        case 'read' :

?>

<h2>Data prodi</h2>
<a href="index.php?page=prodi&aksi=create" class="btn btn-primary">Tambah Prodi</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Prodi</th>
      <th scope="col">Jenjang</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

      <?php
      $queryMhs = mysqli_query($koneksi, "SELECT * FROM prodi");
      $no = 1;
      while($data = mysqli_fetch_array($queryMhs)) {
      ?>

    <tr>
      <th scope="row"><?= $no++ ?></th>
      <td><?=$data['nama_prodi'] ?></td>
      <td><?=$data['jenjang'] ?></td>
      <td><?=$data['keterangan'] ?></td>
      <td scope="row">
          <div class="btn-group" role="group">
              <a href="index.php?page=prodi&aksi=update&id=<?php echo $data['id']; ?>"> 
            <button type="button" class="btn btn-warning me-2">Edit</button> 
              </a>
              <a href="proses_prodi.php?proses=delete&id=<?php echo $data['id']; ?>" onclick="return confirm('Apakah anda ingin menghapus data?')">
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
break ; 
    case 'create' : 

?>

<h2>Input data Prodi</h2>
<form action="proses_prodi.php?proses=insert" method="POST">
      <div class="mb-3">
        <label for="nama_prodi" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi">
      </div>

      <div class="mb-3">
        <label for="jenjang" class="form-label">Jenjang</label>
        <select class="form-select" id="jenjang" name="jenjang" required>
            <option value="" selected disabled>Pilih Jenjang</option>
            <option value="D2">D2</option>
            <option value="D3">D3</option>
            <option value="D4">D4</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
        </select>
    </div>
      <p></p>

      <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
      </div>

      <button type="submit" name="submit" value="Simpan" class="btn btn-primary">Submit</button>
    </form>

<?php
break;
case 'update':
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $queryProdi = mysqli_query($koneksi, "SELECT * FROM prodi WHERE id='$id'");
        $data = mysqli_fetch_array($queryProdi);
?>

<h2>Edit Data Prodi</h2>
<div class="container">
    <form action="proses_prodi.php?proses=update" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <div class="mb-3">
            <label for="nama_prodi" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?= $data['nama_prodi']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="jenjang" class="form-label">Jenjang</label>
            <select class="form-select" id="jenjang" name="jenjang" required>
                <option value="" disabled>Pilih Jenjang</option>
                <option value="D2" <?= ($data['jenjang'] == 'D2') ? 'selected' : ''; ?>>D2</option>
                <option value="D3" <?= ($data['jenjang'] == 'D3') ? 'selected' : ''; ?>>D3</option>
                <option value="D4" <?= ($data['jenjang'] == 'D4') ? 'selected' : ''; ?>>D4</option>
                <option value="S1" <?= ($data['jenjang'] == 'S1') ? 'selected' : ''; ?>>S1</option>
                <option value="S2" <?= ($data['jenjang'] == 'S2') ? 'selected' : ''; ?>>S2</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" required><?= $data['keterangan']; ?></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-success">Update</button>
    </form>
</div>
      
<?php
    }
?>

<?php
    }
?>
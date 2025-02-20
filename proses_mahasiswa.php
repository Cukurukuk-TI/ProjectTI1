<?php
    require "koneksi.php" ;
    
    if ($_GET['proses'] == 'insert') {
      if (isset($_POST['submit'])) {
          $nama = $_POST['nama'];
          $email = $_POST['email'];
          $nim = $_POST['nim'];
          $gender = $_POST['gender'];
          $hobi = implode(", ", $_POST['hobi']);
          $alamat = $_POST['alamat'];
          $prodi_id = $_POST['prodi_id'];
  
          $cek_nim = mysqli_query($koneksi, "SELECT nim FROM mahasiswa WHERE nim='$nim'");
          if (mysqli_num_rows($cek_nim) > 0) {
              echo "<script>alert('NIM sudah terdaftar!');window.location='index.php?page=mahasiswa&aksi=create'</script>";
              exit(); 
          }
  
          $query = mysqli_query($koneksi, "INSERT INTO mahasiswa (nama, email, nim, gender, hobi, alamat, prodi_id) VALUES ('$nama', '$email', '$nim', '$gender', '$hobi', '$alamat', '$prodi_id')");
  
          if ($query == TRUE) {
              echo "<script>alert('Data berhasil disimpan!');window.location='index.php?page=mahasiswa'</script>";
          } else {
              echo "<script>alert('Data gagal disimpan!');window.location='index.php?page=mahasiswa'</script>";
          }
      } else {
          header("Location: index.php");
          exit;
      }
  }
  
    if ($_GET['proses'] == 'update') {
      if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $nama = $_POST['nama'];
          $email = $_POST['email'];
          $nim = $_POST['nim'];
          $gender = $_POST['gender'];
          $hobi = implode(", ", $_POST['hobi']);
          $alamat = $_POST['alamat'];

          $prodi_id = $_POST['prodi_id'];

          $query = mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', email='$email', nim='$nim', gender='$gender', hobi='$hobi', alamat='$alamat', prodi_id='$prodi_id' WHERE id='$id'");

  
          if ($query == TRUE) {
              echo "<script>alert('Data berhasil diupdate!');window.location='index.php?page=mahasiswa'</script>";
          } else {
              echo "<script>alert('Data gagal diupdate!');window.location='index.php?page=mahasiswa'</script>";
          }
      } else {

          $id = $_GET['id'];
          $queryMahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
          $data = mysqli_fetch_array($queryMahasiswa);  
      }
    }

    if ($_GET['proses'] == 'delete') {
      $id = $_GET['id'];
      $queryHapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");
  
      if ($queryHapus) {
          echo "<script>alert('Data berhasil dihapus'); window.location='index.php?page=mahasiswa';</script>";
      } else {
          echo "<script>alert('Data gagal dihapus'); window.location='index.php?page=mahasiswa';</script>";
      }
  
    }
?>
<?php
    require "koneksi.php" ;
    
    if ($_GET['proses'] == 'insert') {

        if(isset($_POST['submit'])) {
            $nama_prodi = $_POST['nama_prodi'];
            $jenjang = $_POST['jenjang'];
            $keterangan = $_POST['keterangan'];

            $query = mysqli_query($koneksi, 
            "INSERT INTO prodi (nama_prodi, jenjang, keterangan) 
             VALUES ('$nama_prodi', '$jenjang', '$keterangan') ") ;
            
            if ($query == TRUE) {
              echo "<script>alert('Data berhasil disimpan!');window.location='index.php?page=prodi'</script>";
            } else {
              echo "<script>alert('Data gagal disimpan!');window.location='index.php?page=prodi'</script>";
            }
            
          } else {
            header("Location: index.php");
            exit;
          }
            
    }

    if ($_GET['proses'] == 'update') {
      if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $nama_prodi = $_POST['nama_prodi'];
          $jenjang = $_POST['jenjang'];
          $keterangan = $_POST['keterangan'];
  
          $query = mysqli_query($koneksi, 
          "UPDATE prodi SET nama_prodi='$nama_prodi', jenjang='$jenjang', keterangan='$keterangan' 
          WHERE id='$id'");
  
          if ($query == TRUE) {
              echo "<script>alert('Data berhasil diupdate!');window.location='index.php?page=prodi'</script>";
          } else {
              echo "<script>alert('Data gagal diupdate!');window.location='index.php?page=prodi'</script>";
          }
      } else {
          // Ambil data prodi berdasarkan ID untuk ditampilkan di form
          $id = $_GET['id'];
          $queryProdi = mysqli_query($koneksi, "SELECT * FROM prodi WHERE id='$id'");
          $data = mysqli_fetch_array($queryProdi);  
      }
    }

    if ($_GET['proses'] == 'delete') {
      $id = $_GET['id'];
      $queryHapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE id='$id'");
  
      if ($queryHapus) {
          echo "<script>alert('Data berhasil dihapus'); window.location='index.php?page=prodi';</script>";
      } else {
          echo "<script>alert('Data gagal dihapus'); window.location='index.php?page=prodi';</script>";
      }
  
    }
?>
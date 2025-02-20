<?php
    require "koneksi.php" ;
    
    if ($_GET['proses'] == 'insert') {

      if (isset($_POST['kode_mk'])) {
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $sks = $_POST['sks'];
        $prodi_id = $_POST['prodi_id'];
        $semester = $_POST['semester'];

        $query = mysqli_query($koneksi, 
            "INSERT INTO mata_kuliah (kode_mk, nama_mk, sks, prodi_id, semester) 
             VALUES ('$kode_mk', '$nama_mk', '$sks', '$prodi_id', '$semester')");
            
            if ($query == TRUE) {
              echo "<script>alert('Data berhasil disimpan!');window.location='index.php?page=matkul'</script>";
            } else {
              echo "<script>alert('Data gagal disimpan!');window.location='index.php?page=matkul'</script>";
            }
            
          } else {
            header("Location: index.php");
            exit;
          }
            
    }

    if ($_GET['proses'] == 'update') {
      if (isset($_POST['submit'])) {
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $sks = $_POST['sks'];
        $prodi_id = $_POST['prodi_id'];
        $semester = $_POST['semester'];

        $queryUpdate = mysqli_query($koneksi, 
        "UPDATE mata_kuliah SET nama_mk='$nama_mk', sks='$sks', prodi_id='$prodi_id', semester='$semester' 
        WHERE kode_mk='$kode_mk'");
    
    if ($queryUpdate) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php?page=matkul';</script>";
    } else {
        echo "<script>alert('Data gagal diupdate!'); window.location='index.php?page=matkul';</script>";
        echo "Error: " . mysqli_error($koneksi); // Tambahkan untuk debugging
    }
          } else {
          // Ambil data prodi berdasarkan ID untuk ditampilkan di form
          $kode_mk = $_POST['kode_mk'];
          $queryMatkul = mysqli_query($koneksi, "SELECT * FROM mata_kuliah WHERE kode_mk='$kode_mk'");
          $data = mysqli_fetch_array($queryMatkul);  
      }
    }

    if ($_GET['proses'] == 'delete') {
      if (isset($_GET['kode_mk'])) {
        $kode_mk = $_GET['kode_mk'];
        $queryHapus = mysqli_query($koneksi, "DELETE FROM mata_kuliah WHERE kode_mk='$kode_mk'");
  
      if ($queryHapus) {
          echo "<script>alert('Data berhasil dihapus'); window.location='index.php?page=matkul';</script>";
      } else {
          echo "<script>alert('Data gagal dihapus'); window.location='index.php?page=matkul';</script>";
      }
  
    }
    }
?>
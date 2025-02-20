<?php
require "koneksi.php";

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $nip = $_POST['nip'];
        $nama_dosen = $_POST['nama_dosen'];
        $prodi_id = $_POST['prodi_id'];
        $foto = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp_name, "uploads/$foto");

        $cek_nip = mysqli_query($koneksi, "SELECT nip FROM dosen WHERE nip='$nip'");
        if (mysqli_num_rows($cek_nip) > 0) {
            echo "<script>alert('NIP sudah terdaftar!');window.location='index.php?page=dosen&aksi=create'</script>";
            exit(); 
        }

        $query = mysqli_query($koneksi, "INSERT INTO dosen (nip, nama_dosen, prodi_id, foto) VALUES ('$nip', '$nama_dosen', '$prodi_id', '$foto')");

        if ($query) {
            echo "<script>alert('Data berhasil disimpan!');window.location='index.php?page=dosen';</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!');window.location='index.php?page=dosen';</script>";
        }
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $nip = $_POST['nip'];
        $nama_dosen = $_POST['nama_dosen'];
        $prodi_id = $_POST['prodi_id'];
        $foto = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];

        if ($foto) {
            // Upload foto baru
            move_uploaded_file($tmp_name, "uploads/$foto");
            $query = mysqli_query($koneksi, "UPDATE dosen SET nama_dosen='$nama_dosen', prodi_id='$prodi_id', foto='$foto' WHERE nip='$nip'");
        } else {
            $query = mysqli_query($koneksi, "UPDATE dosen SET nama_dosen='$nama_dosen', prodi_id='$prodi_id' WHERE nip='$nip'");
        }

        if ($query) {
            echo "<script>alert('Data berhasil diupdate!');window.location='index.php?page=dosen';</script>";
        } else {
            echo "<script>alert('Data gagal diupdate!');window.location='index.php?page=dosen';</script>";
        }
    }
}

if ($_GET['proses'] == 'delete') {
    $nip = $_GET['nip'];
    $queryHapus = mysqli_query($koneksi, "DELETE FROM dosen WHERE nip='$nip'");

    if ($queryHapus) {
        echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=dosen';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');window.location='index.php?page=dosen';</script>";
    }
}
?>

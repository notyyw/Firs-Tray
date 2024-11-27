<?php
session_start();

require("koneksi.php");



// Mengambil foto
if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $tempatLahir = $_POST['tempatLahir'];
    $pendidikanTerakhir = $_POST['pendidikanTerakhir'];

    $image = $_FILES['foto']['tmp_name'];
    $imageData = file_get_contents($image); // Mengambil konten file
    $imageData = $conn->real_escape_string($imageData); // Menghindari karakter khusus

    // SQL untuk menyimpan gambar dan data lain ke database
    $sql = "INSERT INTO data (nama, jk, alamat, tgl, bulan, tahun, tempat_lahir, pendidikan, pict) 
            VALUES ('$nama', '$jenisKelamin', '$alamat', '$tanggal', '$bulan', '$tahun', '$tempatLahir', '$pendidikanTerakhir', '$imageData')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = 'success'; // Set session untuk alert sukses
        header("Location: ../");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM data WHERE id = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = 'deleted'; // Set session untuk alert hapus
        header("Location: ../");
        exit;

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

if (isset($_POST['update'])){
    var_dump($_POST);
    var_dump($_FILES);

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $tempatLahir = $_POST['tempatLahir'];
    $pendidikanTerakhir = $_POST['pendidikanTerakhir'];

    $image = $_FILES['foto']['tmp_name'];
    $imageData = file_get_contents($image); // Mengambil konten file
    $imageData = $conn->real_escape_string($imageData);
    
    $sql = "UPDATE data SET
                nama = '$nama',
                jk = '$jenisKelamin',
                alamat = '$alamat',
                tgl = '$tanggal',
                bulan = '$bulan', 
                tahun = '$tahun', 
                tempat_lahir = '$tempatLahir', 
                pendidikan = '$pendidikanTerakhir', 
                pict = '$imageData'
                WHERE id = $id
                ";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = 'update'; // Set session untuk alert sukses
        header("Location: ../");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();            

}

?>

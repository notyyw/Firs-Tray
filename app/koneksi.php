<?php 
$conn = new mysqli('localhost', 'root', '', 'bddaftar');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc( $result ) ) {
        $rows[] = $row;
    }
    return $rows;
}

function cari($search){
    global $conn;
    $search = $conn->real_escape_string($search);
    $query = "SELECT * FROM data WHERE nama LIKE '%$search%'";
    return $conn->query($query);
}

?>
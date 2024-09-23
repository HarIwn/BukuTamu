<?php
// panggil file koneksi.php 
require_once('koneksi.php');

// membuat query ke / dari database
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_tamu($data)
{
    global $koneksi;

    $kode = mysqli_real_escape_string($koneksi, $data["id_tamu"]);
    $tanggal = date("Y-m-d");
    $nama_tamu = mysqli_real_escape_string($koneksi, $data["nama_tamu"]);
    $alamat = mysqli_real_escape_string($koneksi, $data["alamat"]);
    $no_hp = mysqli_real_escape_string($koneksi, $data["no_hp"]);
    $bertemu = mysqli_real_escape_string($koneksi, $data["bertemu"]);
    $kepentingan = mysqli_real_escape_string($koneksi, $data["kepentingan"]);

    $query = "INSERT INTO buku_tamu VALUES ('$kode','$tanggal','$nama_tamu','$alamat','$no_hp','$bertemu','$kepentingan')";

    if (mysqli_query($koneksi, $query)) {
        return mysqli_affected_rows($koneksi);
    } else {
        echo "Error: " . mysqli_error($koneksi);
        return 0;
    }
}

// function hapus data kamu
function hapus_tamu($id)
{
    global $koneksi;

    $query = "DELETE FROM buku_tamu WHERE id_tamu = '$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function ubah_tamu($data)
{
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data["id_tamu"]);
    $nama_tamu = mysqli_real_escape_string($koneksi, $data["nama_tamu"]);
    $alamat = mysqli_real_escape_string($koneksi, $data["alamat"]);
    $no_hp = mysqli_real_escape_string($koneksi, $data["no_hp"]);
    $bertemu = mysqli_real_escape_string($koneksi, $data["bertemu"]);
    $kepentingan = mysqli_real_escape_string($koneksi, $data["kepentingan"]);

    $query = "UPDATE buku_tamu SET 
            nama_tamu = '$nama_tamu',
            alamat = '$alamat',
            no_hp = '$no_hp',
            bertemu = '$bertemu',
            kepentingan = '$kepentingan'
            WHERE id_tamu = '$id'";

    echo "Query: " . $query . "<br>"; // Display the actual query

    if (mysqli_query($koneksi, $query)) {
        return mysqli_affected_rows($koneksi);
    } else {
        echo "Error: " . mysqli_error($koneksi);
        return 0;
    }

}
?>
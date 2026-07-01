<?php
include "koneksi.php";

header('Content-Type: application/json');

if (isset($_GET['warna'])) {
    $warna = mysqli_real_escape_string($conn, $_GET['warna']);

    // Mengambil 1 ayat secara acak (RAND) berdasarkan warna
    $query = "SELECT * FROM ayat WHERE warna='$warna' ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Menggabungkan judul dan isi dengan " - " agar formatnya cocok dengan JavaScript kita
        $teksFull = $row['judul'] . " - " . $row['isi'];

        echo json_encode([
            "status" => "ok",
            "ayat" => $teksFull
        ]);
        exit;
    }
}

echo json_encode([
    "status" => "error",
    "ayat" => "Belum ada ayat untuk warna ini."
]);

<?php
include "data_ayat.php";

header('Content-Type: application/json');

if (isset($_GET['warna'])) {
    $warna = $_GET['warna'];

    if (isset($ayat[$warna])) {
        $list = $ayat[$warna];
        $hasil = $list[array_rand($list)];

        echo json_encode([
            "status" => "ok",
            "ayat" => $hasil
        ]);
        exit;
    }
}

echo json_encode([
    "status" => "error"
]);

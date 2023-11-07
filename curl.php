<?php
// Daftar URL yang akan diambil kontennya
$urls = array(
    'https://raw.githubusercontent.com/easylist/easylist/master/easyprivacy/easyprivacy_trackingservers.txt',
    'https://raw.githubusercontent.com/easylist/easylist/master/easyprivacy/easyprivacy_specific_international.txt',
    'https://raw.githubusercontent.com/easylist/easylist/master/easyprivacy/easyprivacy_thirdparty_international.txt'
);

// Buat atau buka file 'gabungan.txt' untuk penulisan
$file = fopen('gabungan.txt', 'w');

// Loop melalui setiap URL dan ambil kontennya menggunakan cURL
foreach ($urls as $url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($ch);
    curl_close($ch);

    // Tulis konten ke dalam file 'gabungan.txt'
    fwrite($file, $content);
}

// Tutup file 'gabungan.txt'
fclose($file);

echo 'Konten dari URL telah digabungkan ke dalam "gabungan.txt"';
?>


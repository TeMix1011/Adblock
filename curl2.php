<?php
// Daftar URL yang akan diambil
$urls = array(
    'https://raw.githubusercontent.com/easylist/easylist/master/easyprivacy/easyprivacy_thirdparty_international.txt',
    'https://raw.githubusercontent.com/easylist/easylist/master/easyprivacy/easyprivacy_trackingservers.txt'
);

// Inisialisasi cURL handler
$ch = curl_init();

// File tujuan untuk hasil penggabungan
$outputFile = 'gabungan.txt';

// Buka file untuk penulisan
$outputHandle = fopen($outputFile, 'w');

// Loop melalui setiap URL
foreach ($urls as $url) {
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FILE, $outputHandle);

    // Eksekusi cURL
    curl_exec($ch);

    // Setel kembali file penanganan
    curl_setopt($ch, CURLOPT_FILE, $outputHandle);
}

// Tutup cURL handler dan file penanganan
curl_close($ch);
fclose($outputHandle);

// Upload file ke GitHub
// Pastikan Anda memiliki Git diinstal dan sudah login ke akun GitHub di terminal.
shell_exec('git init');
shell_exec('git add ' . $outputFile);
shell_exec('git commit -m "Menambahkan gabungan.txt"');
shell_exec('git remote add origin https://github.com/TeMix1011/Adblock.git');
shell_exec('git push -u origin master');
?>


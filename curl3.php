<?php
// URL website yang akan di-curl
$websiteUrl = 'https://example.com';

// Jalankan curl ke website
$curl = curl_init($websiteUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

if ($response) {
    // Nama file untuk hasil curl
    $outputFile = 'gabungan.txt';

    // Simpan hasil curl ke dalam file
    file_put_contents($outputFile, $response);

    // Konfigurasi GitHub
    $githubUsername = 'TeMix1011';
    $githubToken = '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';
    $githubRepo = 'https://github.com/TeMix1011/Adblock.git';
    $githubFilePath = 'gabungan.txt';

    // Menggunakan GitHub API untuk mengunggah file
    $githubUrl = "https://api.github.com/repos/$githubUsername/$githubRepo/contents/$githubFilePath";
    $githubData = array(
        'message' => 'Update gabungan.txt',
        'content' => base64_encode(file_get_contents($outputFile))
    );

    $ch = curl_init($githubUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($githubData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: token ' . $githubToken,
        'User-Agent: YourApp'
    ));
    $githubResponse = curl_exec($ch);
    curl_close($ch);

    if ($githubResponse) {
        echo "Berhasil mengunggah ke GitHub.";
    } else {
        echo "Gagal mengunggah ke GitHub.";
    }
} else {
    echo "Gagal mengambil data dari website.";
}
?>


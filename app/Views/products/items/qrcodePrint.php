<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR-Code Product <?= esc($item['name']); ?></title>
</head>

<body>
    <?php
    require 'vendor/autoload.php'; // Sesuaikan path ini sesuai dengan struktur proyek Anda
    
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;

    // Data untuk QR code
    $data = $item['barcode'];  // Ganti dengan data yang diinginkan
    
    // Buat instance QR Code
    $qrCode = new QrCode($data);
    $qrCode->setSize(150);

    // Generate QR code image string
    $writer = new PngWriter();
    $qrCodeImage = base64_encode($writer->write($qrCode)->getString());
    echo '<div style="max-width: 6cm;  text-align: center">';
    echo '<img src="data:image/png;base64,' . $qrCodeImage . '" alt="QR Code" style="width: 2.2cm; display: block; margin: 0 auto;">';
    echo '<div style="font-size: 0.6em;">' . esc($item['barcode']) . '</div>';
    echo '<div style="font-size: 0.6em;">' . esc($item['name']) . ' - Rp.' . $item['price'];'</div>';
    echo '</div>';
    ?>
    


</body>

</html>
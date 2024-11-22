<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Product <?= esc($item['name']); ?></title>
</head>

<body>
    <?php
    require 'assets/vendor/autoload.php';
    $generatorPNG = new \Picqer\Barcode\BarcodeGeneratorPNG();
    $barcode = base64_encode($generatorPNG->getBarcode($item['barcode'], $generatorPNG::TYPE_CODE_128));
    echo '<div style="min-width: 2cm; max-width: 3cm;  text-align: center">';
    echo '<img src="data:image/png;base64,' . $barcode . '" alt="Barcode" style="width: 2.3cm; height: 1.3cm; display: block; margin: 0 auto;">';
    echo '<div style="font-size: 0.6em;">' . esc($item['barcode']) . '</div>';
    echo '<div style="font-size: 0.6em;">' . esc($item['name']) . ' - Rp.' . $item['price'];'</div>';
    echo '</div>';
    ?>
</body>

</html>
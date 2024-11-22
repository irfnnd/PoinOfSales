<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Items <small class="breadcrumb-item active"> Barang</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Items</a></li>
                    <li class="breadcrumb-item active">Barcode-QRCode Generate</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">Barcode Generator <i class="fas fa-barcode"></i></h3>
                <div class="ml-auto">
                    <a href="<?= base_url('products/items') ?>" id="items" class="btn btn-sm btn-warning"
                        style="color: white;">
                        <i class="fas fa-undo"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body " id="printableArea">
                <?php
                require 'assets/vendor/autoload.php';
                $generatorPNG = new \Picqer\Barcode\BarcodeGeneratorPNG();
                $barcode = base64_encode($generatorPNG->getBarcode($item['barcode'], $generatorPNG::TYPE_CODE_128));
                echo '<img src="data:image/png;base64,' . $barcode . '" alt="Barcode" style="width: 2in; height: .8in">';
                ?>
                <br>
                <?= esc($item['barcode']); ?><br>
                <?= esc($item['name']); ?>
                Rp.<?= esc($item['price']); ?> <br>
                <a href="<?= site_url('products/items/barcode_print/'.$item['item_id']) ?>" id="items" class="btn btn-sm btn-default mt-2">
                        <i class="fas fa-print"></i> Print
                    </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">QR-Code Generator <i class="fas fa-qrcode"></i></h3>
                <div class="ml-auto">
                </div>
            </div>
            <div class="card-body" id="printableArea">
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
                echo '<img src="data:image/png;base64,' . $qrCodeImage . '" alt="QR Code" style="width: 1.7in;">';
                ?>
                <br>
                <?= esc($data); ?><br>
                <?= esc($item['name'] ?? 'Nama Item'); ?>
                Rp.<?= esc($item['price'] ?? 'Harga Item'); ?> <br>
                <a href="<?= site_url('products/items/qrcode_print/'.$item['item_id']) ?>" id="items" class="btn btn-sm btn-default mt-2" >
                        <i class="fas fa-print"></i> Print
                    </a>
            </div>
        </div>
    </div>
</section>
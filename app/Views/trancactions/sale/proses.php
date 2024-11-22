<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari request POST
    $item_id = $_POST['item_id'];
    $barcode = $_POST['barcode'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $stock = $_POST['stock'];

    // Hitung total harga
    $total = $price * $qty;

    // Format HTML untuk baris baru tabel
    echo "
    <tr>
        <td></td> <!-- Nomor akan otomatis -->
        <td>$barcode</td>
        <td>$item_name</td>
        <td>$price</td>
        <td>$qty</td>
        <td>0</td> <!-- Discount belum diterapkan -->
        <td>$total</td>
        <td>
            <button class='btn btn-xs btn-danger'><i class='fas fa-trash'></i> Delete</button>
        </td>
    </tr>
    ";
}
?>

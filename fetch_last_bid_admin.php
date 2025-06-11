<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "lelang_vga");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data bid terakhir untuk setiap item
$sql = "SELECT item_id, MAX(bid_amount) AS bid_amount FROM bid GROUP BY item_id";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'item_id' => $row['item_id'],
            'bid_amount' => $row['bid_amount']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>

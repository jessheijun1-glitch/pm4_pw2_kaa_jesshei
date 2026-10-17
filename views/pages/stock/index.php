<h1>Daftar Stok Barang</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Stok</th>
    </tr>

    <?php foreach ($stocks as $item): ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= $item['stock'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
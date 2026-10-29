<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Segoe UI, sans-serif;
        }

        body{
            background: linear-gradient(135deg,#667eea,#764ba2);
            min-height:100vh;
            padding:40px;
        }

        .container{
            max-width:900px;
            margin:auto;
            background:#fff;
            padding:30px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
        }

        h1{
            text-align:center;
            color:#333;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:10px;
        }

        thead{
            background:#4f46e5;
            color:white;
        }

        th{
            padding:15px;
        }

        td{
            padding:15px;
            text-align:center;
        }

        tbody tr:nth-child(even){
            background:#f5f5f5;
        }

        tbody tr:hover{
            background:#e0e7ff;
            transition:0.3s;
        }

        .harga{
            color:#16a34a;
            font-weight:bold;
        }

        .stok{
            background:#dcfce7;
            color:#166534;
            padding:5px 10px;
            border-radius:20px;
            font-weight:bold;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>🛒 Daftar Produk</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= htmlspecialchars($product['nama_produk']) ?></td>
                <td class="harga">
                    Rp <?= number_format($product['harga'],0,',','.') ?>
                </td>
                <td>
                    <span class="stok">
                        <?= $product['stok'] ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Barcode</title>
</head>
<body style="padding: 0; margin: 0;">
    <table width="100%">
        <tr>
        @foreach ($dataproduk as $data)
            <td align="center" style="border: 1px solid #ccc">
                {{ $data->nama_produk }} <br/>
                Rp. {{ format_uang($data->harga_jual) }} <br/>
                <?php
                    $kode_produk = str_pad($data->kode_produk, 8, '0', STR_PAD_LEFT);
                ?>
                <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG($kode_produk, 'C39') }}" height="60" width="180"><br>
                {{ $kode_produk }}
            </td>
            @if($no++ % 3 == 0)
            </tr><tr>
            @endif
        @endforeach
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Barcode</title>
</head>
<body>
    <table width="100%">
        @foreach ($dataproduk as $data)
            <tr>
            <td align="center" style="border: 1px solid #ccc">
                {{ $data->nama_produk }} - Rp. {{ format_uang($data->harga_jual) }} <br/> <br/>
                <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG($data->kode_produk, 'C39') }}" height="60" width="180"><br>
                {{ $data->kode_produk }}
            </td>
            @if($no++ % 3 == 0)
            </tr><tr>
            @endif
        @endforeach
    </table>
</body>
</html>
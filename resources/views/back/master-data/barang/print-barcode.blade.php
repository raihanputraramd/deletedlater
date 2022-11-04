<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barcode</title>
</head>
<body>
    @foreach ($barang as $b)
        <img style="margin-bottom: 24px; margin-right: 24px;" src="data:image/png;base64,{!! DNS1D::getBarcodePNG($b->kode, 'C39',1,55,array(1,1,1), true)  !!}" />
    @endforeach
</body>
</html>
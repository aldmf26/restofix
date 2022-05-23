
<?php

header('Content-type: application/vnd-ms-excel');
header('Content-Disposition: attachmen; filename=Absensi Resto.xls');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT DENDA</title>
</head>

<body>
    <table class="table  " id="table" border="1">
        <thead>
            <tr>#</tr>
            <tr>NAMA</tr>
            <tr>ALASAN</tr>
            <tr>NOMINAL</tr>
            <tr>TANGGAL</tr>
        </thead>
    </table>
</body>

<script>
    window.print()
</script>

</html>
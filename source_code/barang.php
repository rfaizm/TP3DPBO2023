<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Barang.php');

$view = new Template('templates/skintable.html');

$mainTitle = 'Barang';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Barang</th>
<th scope="row">Aksi</th>
</tr>';

$data = null;
$add = null;

$add = 'barang-add.php';

$barang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$barang->open();
$barang->getBarang();
$no = 1;

while ($div = $barang->getResult()){
    $data .= '<tr>
    <th scope="row">' . $no .'</th>
    <td>' .$div['nama_barang']. '</td>
    <td style="font-size: 22px;">
        <a href="barang-add.php?edit='. $div['id'] .'" title="Edit Data">Edit</a>&nbsp;
        <a href="barang.php?hapus='. $div['id'] .'" title="Delete Data">Delete</a>
    </td>
    </tr>';
    $no++;
}

if (isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($barang->deleteBarang($id) > 0) {
            echo 
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'barang.php';
            </script>
            ";
        } else {
            echo 
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'barang.php';
            </script>
            ";
        }
    }
}

$barang->close();


    $view->replace('DATA_MAIN_TITLE', $mainTitle);
    $view->replace('DATA_ADD', $add);
    $view->replace('DATA_TABEL_HEADER', $header);
    $view->replace('DATA_TABEL', $data);
    $view->write();
?>
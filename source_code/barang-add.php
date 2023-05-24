<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Barang.php');

$barang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$view = new Template('templates/skinform.html');

$mainTitle = 'Tambah Barang';
$barang->open();

$data = null;



    if (!isset($_GET['edit'])){
        if(isset($_POST['submit'])){
            if ($barang->addBarang($_POST) > 0) {
                echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'barang.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = 'barang-add.php';
                </script>
                ";
            }
        }
        $data .= '<div class="mb-3 m-auto col-8">
            <label for="name">Nama</label> <input type="text" class="form-control" name="name" id="name" required>
            </div>';
    } else if(isset($_GET['edit'])){
        $_ID = $_GET['edit'];

        if(isset($_POST['submit'])){
            if ($barang->updateBarang($_ID ,$_POST) > 0) {
                echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'barang.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = 'barang-add.php';
                </script>
                ";
            }
        }

        $barang->getBarangById($_ID);
        $row1 = $barang->getResult();
        $edit_barang = $row1['nama_barang'];

        $data .= '<div class="mb-3 m-auto col-8">
            <label for="name">Nama</label> <input type="text" class="form-control" name="name" id="name" value="' . $edit_barang . '" required>
            </div>';
    }
    

    $barang->close();

    $view->replace('DATA_MAIN_TITLE', $mainTitle);
    $view->replace('DATA_TABEL', $data);
    $view->write();
?>
<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Peminjaman.php');

$listPeminjaman = new Peminjaman($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listPeminjaman->open();
$listPeminjaman->getPeminjamanJoin();

$data = null;

if (isset($_POST['for-cari'])){
    $listPeminjaman->searchPeminjaman($_POST['cari']);
} else if(isset($_POST['for-filter'])){
    $listPeminjaman->filterPeminjaman();
} 
else {
    $listPeminjaman->getPeminjamanJoin();
}

while($row = $listPeminjaman->getResult()){
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto_peminjam'] .'" class="card-img-top" alt="' . $row['foto_peminjam'] .'">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">'. $row['nama_peminjam'] .'</p>
                <p class="card-text divisi-nama">'. $row['role'] .'</p>
                <p class="card-text jabatan-nama my-0">' . $row['nama_barang'] .'</p>
            </div>
        </a>
    </div>    
    </div>';
}



    $listPeminjaman->close();

    $home = new Template('templates/skin.html');
    $home->replace('DATA_PENGURUS', $data);
    $home->write();


?>
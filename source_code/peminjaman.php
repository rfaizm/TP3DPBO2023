<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Peminjaman.php');
include('classes/Barang.php');
include('classes/Role.php');


$view = new Template('templates/skinform.html');


$mainTitle = null;
$data = null;
$tabel_barang = null;
$tabel_role = null;
$role_options = null;
$barang_options = null;
$listbarang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listrole = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$peminjaman = new Peminjaman($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$tmp_image = new Peminjaman($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$peminjaman->open();
$listbarang->open();
$listrole->open();
$tmp_image->open();

$listbarang->getBarang();
$listrole->getRole();

$mainTitle .= 'Tambah Peminjaman';

while ($row = $listbarang->getResult()){
    $tabel_barang .= '<option value="' . $row['id'] . '">' . $row['nama_barang'] . '</option>';
}

while ($row = $listrole->getResult()){
    $tabel_role .= '<option value=" ' . $row['id'] . '">' . $row['role'] . '</option>';
}


    if (!isset($_GET['edit'])){
        if(isset($_POST['submit'])){
            if ($peminjaman->addPeminjaman($_POST, $_FILES) > 0) {
                    echo "
                    <script>
                        alert('Data berhasil ditambahkan!');
                        document.location.href = 'index.php';
                    </script>
                    ";
            } else {
                    echo "
                    <script>
                        alert('Data gagal ditambahkan!');
                        document.location.href = 'form.php';
                    </script>
                    ";
            }

        }
        $data .= '<div class="mb-3 m-auto col-8">
                <label for="name">Nama</label> <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3 m-auto col-8">
                <label for="nis">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" required>
                </div>
                <div class="mb-3 m-auto col-8">
                <label for="gender">Gender</label>
                <select name="barang" id="barang" class="form-control" required>
                    <option value="">--- Select One ---</option>
                    ' . $tabel_barang . '
                </select>
                </div>
                <div class="mb-3 m-auto col-8">
                <label for="class">Class</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="">--- Select One ---</option>
                    ' . $tabel_role . '
                </select>
                </div>

                <div class="mb-3 m-auto col-8">
                <label for="photo">Foto</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="photo" name = "photo">
                </div>
                </div>';
        }else if (isset($_GET['edit'])){
            $_ID = $_GET['edit'];
            $tmp_image->getPeminjaman();
            $tmp_image->getPeminjamanById($_ID);
            $temp_fix = $tmp_image->getResult();
            $temp_img = $temp_fix['foto_peminjam'];

            if (isset($_POST['submit'])) {
                if ($peminjaman->updatePeminjaman($_ID, $_POST, $_FILES, $temp_img) > 0) {
                    echo "
                    <script>
                        alert('Data berhasil diubah!');
                        document.location.href = 'index.php';
                    </script>
                    ";
                } else {
                    echo "
                    <script>
                        alert('Data gagal diubah!');
                        document.location.href = 'index.php';
                    </script>
                    ";
                }
            }



            $peminjaman->getPeminjamanById($_ID);

            $row1 = $peminjaman->getResult();
            $nama_edit = $row1['nama_peminjam'];
            $nis_edit = $row1['nis_peminjam'];
            $img_edit = $row1['foto_peminjam'];
            $role_edit = $row1['role_id'];
            $barang_edit = $row1['barang_id'];

            $listbarang->getBarang();
            $listrole->getRole();

            while ($row = $listrole->getResult()) {
                $select = ($row['id'] == $role_edit) ? 'selected' : "";
                $role_options .= "<option value=". $row['id']. " . $select . >" . $row['role'] . "</option>";
            }

            while ($row = $listbarang->getResult()){
                $select = ($row['id'] == $barang_edit) ? 'selected' : "";
                $barang_options .= "<option value=". $row['id']. " . $select . >" . $row['nama_barang'] . "</option>";
            }
            
            $data .= '<div class="mb-3 m-auto col-8">
                <label for="name">Nama</label> <input type="text" class="form-control" name="name" id="name" value="'. $nama_edit .'" required>
                </div>
                <div class="mb-3 m-auto col-8">
                <label for="nis">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" value="'. $nis_edit .'" required>
                </div>
                <div class="mb-3 m-auto col-8">
                <label for="gender">Gender</label>
                <select name="barang" id="barang" class="form-control" required>
                    ' . $barang_options . '
                </select>
                </div>
                <div class="mb-3 m-auto col-8">
                <label for="class">Class</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="">--- Select One ---</option>
                    ' . $role_options . '
                </select>
                </div>

                <div class="mb-3 m-auto col-8">
                <label for="photo">Foto</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="photo" name = "photo" value="'. $img_edit .'">
                </div>
                </div>';

                
        }

        $peminjaman->close();
        $listrole->close();
        $listbarang->close();
        $tmp_image->close();
    
    $view->replace('DATA_MAIN_TITLE', $mainTitle);
    $view->replace('DATA_TABEL', $data);
    $view->write();
?>
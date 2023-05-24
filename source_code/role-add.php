<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Role.php');

$role = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$view = new Template('templates/skinform.html');

$role->open();

$mainTitle = 'Tambah Role';

$data = null;

    if (!isset($_GET['edit'])){

        if(isset($_POST['submit'])){
            if ($role->addRole($_POST, $_FILES) > 0) {
                echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'role.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = 'role-add.php';
                </script>
                ";
            }

        }
        $data .= '<div class="mb-3 m-auto col-8">
        <label for="name">Nama</label> <input type="text" class="form-control" name="name" id="name" required>
        </div>';
    }else if(isset($_GET['edit'])){
        $_ID = $_GET['edit'];

        if(isset($_POST['submit'])){
            if ($role->updateRole($_ID ,$_POST) > 0) {
                echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'role.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data gagal diubah!');
                    document.location.href = 'role-add.php';
                </script>
                ";
            }
        }

        $role->getRoleById($_ID);
        $row1 = $role->getResult();
        $edit_role = $row1['role'];

        $data .= '<div class="mb-3 m-auto col-8">
            <label for="name">Nama</label> <input type="text" class="form-control" name="name" id="name" value="' . $edit_role . '" required>
            </div>';
    }

    $role->close();

    $view->replace('DATA_MAIN_TITLE', $mainTitle);
    $view->replace('DATA_TABEL', $data);
    $view->write();
?>
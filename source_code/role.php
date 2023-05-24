<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Role.php');

$view = new Template('templates/skintable.html');

$mainTitle = 'Role';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Role</th>
<th scope="row">Aksi</th>
</tr>';

$data = null;
$add = 'role-add.php';

$role = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$role->open();
$role->getRole();
$no = 1;

while ($div = $role->getResult()){
    $data .= '<tr>
    <th scope="row">' . $no .'</th>
    <td>' .$div['role']. '</td>
    <td style="font-size: 22px;">
        <a href="role-add.php?edit='. $div['id'] .'" title="Edit Data">Edit</a>&nbsp;
        <a href="role.php?hapus='. $div['id'] .'" title="Delete Data">Delete</a>
    </td>
    </tr>';
    $no++;
}


if (isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($role->deleteRole($id) > 0) {
            echo 
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'role.php';
            </script>
            ";
        } else {
            echo 
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'role.php';
            </script>
            ";
        }
    }
}
    $role->close();


    $view->replace('DATA_MAIN_TITLE', $mainTitle);
    $view->replace('DATA_ADD', $add);
    $view->replace('DATA_TABEL_HEADER', $header);
    $view->replace('DATA_TABEL', $data);
    $view->write();
?>
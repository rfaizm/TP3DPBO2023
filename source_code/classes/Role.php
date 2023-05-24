<?php

class Role extends DB{
    function getRole(){
        $query = "SELECT * FROM role_peminjam";
        return $this->execute($query);
    }

    function getRoleById($id){
        $query = "SELECT * FROM role_peminjam WHERE id=$id";
        return $this->execute($query);
    }

    function addRole($data){
        $nama = $data['name'];
        $query = "INSERT INTO role_peminjam VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function deleteRole($id){
        $query = "DELETE FROM role_peminjam WHERE id = $id";

        return $this->executeAffected($query);
    }

    function updateRole($id, $data){

        $nama = $data['name'];

        $query = "UPDATE role_peminjam SET role = '$nama' WHERE id = '$id'";

        return $this->executeAffected($query);
    }
}

?>
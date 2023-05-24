<?php

class Barang extends DB{
    function getBarang(){
        $query = "SELECT * FROM barang";
        return $this->execute($query);
    }

    function getBarangById($id){
        $query = "SELECT * FROM barang WHERE id=$id";

        return $this->execute($query);
    }

    function addBarang($data){
        $nama = $data['name'];
        $query = "INSERT INTO barang VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function deleteBarang($id){
        $query = "DELETE FROM barang WHERE id = $id";

        return $this->executeAffected($query);
    }

    function updateBarang($id, $data){

        $nama = $data['name'];

        $query = "UPDATE barang SET nama_barang = '$nama' WHERE id = '$id'";

        return $this->executeAffected($query);
    }
}

?>
<?php

class Peminjaman extends DB{
    function getPeminjaman(){
        $query = "SELECT * FROM peminjaman";

        return $this->execute($query);
    }

    function getPeminjamanJoin(){
        $query = "SELECT barang.nama_barang, role_peminjam.role, peminjaman.id, peminjaman.foto_peminjam, peminjaman.nis_peminjam, peminjaman.nama_peminjam FROM peminjaman JOIN barang ON peminjaman.barang_id = barang.id JOIN role_peminjam ON peminjaman.role_id = role_peminjam.id ORDER BY peminjaman.id";

        return $this->execute($query);
    }

    function getPeminjamanById($id){
        $query = "SELECT peminjaman.id, peminjaman.nama_peminjam, peminjaman.nis_peminjam, peminjaman.foto_peminjam, peminjaman.role_id, peminjaman.barang_id ,barang.nama_barang, role_peminjam.role FROM peminjaman JOIN barang ON peminjaman.barang_id=barang.id JOIN role_peminjam ON peminjaman.role_id=role_peminjam.id WHERE peminjaman.id=$id";

        return $this->execute($query);
    }

    function addPeminjaman($data, $file){
        $tmp_file = $file['photo']['tmp_name'];
        $foto = $file['photo']['name'];

        $dir = "assets/images/$foto";
        move_uploaded_file($tmp_file, $dir);

        $nama = $data['name'];
        $nis = $data['nis'];
        $role_id = $data['role'];
        $barang_id = $data['barang'];
        $query = "INSERT INTO peminjaman VALUES('', '$nama', '$nis', '$foto', '$role_id', '$barang_id')";
        
        return $this->executeAffected($query);
    }

    function deletePeminjaman($id){
        $query = "DELETE FROM peminjaman WHERE id = $id";

        return $this->executeAffected($query);
    }

    function updatePeminjaman($id, $data, $file, $img){
        $tmp_file = $file['photo']['tmp_name'];
        $foto = $file['photo']['name'];
        
        if ($foto == "") {
            $foto = $img;
        }

        $dir = "assets/images/$foto";
        move_uploaded_file($tmp_file, $dir);


        $nama = $data['name'];
        $nis = $data['nis'];
        $role_id = $data['role'];
        $barang_id = $data['barang'];



        $query = "UPDATE peminjaman SET nama_peminjam = '$nama', nis_peminjam = '$nis', foto_peminjam = '$foto', role_id = '$role_id', barang_id = '$barang_id' WHERE id = '$id'";
        
        return $this->executeAffected($query);
    }

    function searchPeminjaman($keyword)
    {
        $query = "SELECT peminjaman.id, peminjaman.nama_peminjam, peminjaman.nis_peminjam, peminjaman.foto_peminjam, peminjaman.role_id, peminjaman.barang_id ,barang.nama_barang, role_peminjam.role FROM peminjaman JOIN barang ON peminjaman.barang_id=barang.id JOIN role_peminjam ON peminjaman.role_id=role_peminjam.id WHERE nama_peminjam LIKE '%".$keyword."%'";
        return $this->execute($query);
    }

    function filterPeminjaman()
    {
        $query = "SELECT peminjaman.id, peminjaman.nama_peminjam, peminjaman.nis_peminjam, peminjaman.foto_peminjam, peminjaman.role_id, peminjaman.barang_id ,barang.nama_barang, role_peminjam.role FROM peminjaman JOIN barang ON peminjaman.barang_id=barang.id JOIN role_peminjam ON peminjaman.role_id=role_peminjam.id ORDER BY peminjaman.nama_peminjam ASC";
        return $this->execute($query);
    }

}

?>
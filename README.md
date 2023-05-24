# TP3DPBO2023C2
## Identitas
- Nama  : Rachman Faiz Maulana
- NIM   : 2106791
- Kelas : C2 2021
## Janji
Saya [Rachman Faiz Maulana] dengan nim 2106791 mengerjakan TP 3 DPBO dalam mata kuliah [Desain Pemrograman Berorientasi Objek] untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.
## Requirement Soal
Buatlah program menggunakan bahasa pemrograman PHP dengan
spesifikasi sebagai berikut:
● Program bebas, kecuali program Ormawa
● Menggunakan minimal 3 buah tabel
● Terdapat proses Create, Read, Update, dan Delete data
● Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas)
● Menggunakan template/skin form tambah data dan ubah data yang sama
● 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel sisanya
ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)
● Menggunakan template/skin tabel yang sama untuk menampilkan tabel
## Desain Program
![desain_database](https://github.com/rfaizm/TP3DPBO2023/assets/100756074/ad474c4c-8109-4dac-a310-9811e54b2acb)

## Alur Program
Halaman Peminjaman :
  1. Pada halaman awal akan ditampilkan halaman index (list peminjaman)
  2. jika ingin melihat detail, tinggal klik bagian card pada data yang ingin diinginkan
    a. tekan edit data jika ingin melakukan edit
      1) Isi dengan data baru kemmudian tekan tambah data untuk mengupadate
    b. tekan delete jika ingin menghapus
  3. Dapat melakukan searching berdasarkan nama, bisa penggalannya saja atau full namanya
  4. Tekan button filter ascending untuk menampilkan data berdasarkan nama secara ascending
  5. Tekan Peminjaman pada navbar jika ingin menambah data peminjaman baru
 
Halaman Barang
  1. Tekan Dropdown Daftar Barang pada navbar untuk mengakses halaman Barang
  2. Ditampilkan semua data barang
  3. Jika ingin isi data pergi ke Add Data untuk menambah data baru
  4. Tekan icon edit pada aksi untuk melakukan update, ketika update ditekan maka akan ditampilkan data yang ditekan pada form yang telah tersedia, jika ingin edit maka tinggal ubah form tersebut dengan isian baru
  5. Jika ingin menghapus, langsung tekan icon delete pada colum yg telah tersedia, jika ditekan maka akan langsung terhapus
 
Halaman Role:
  1. Tekan Daftar Role Dropdown pada navbar untuk mengakses halaman Role
  2. Ditampilkan semua data role
  3. Langsung isi form pada form yang ada di samping untuk menambah data baru
  4. Tekan icon edit pada aksi untuk melakukan update, ketika update ditekan maka akan ditampilkan data yang ditekan pada form yang telah tersedia, jika ingin edit maka tinggal ubah form tersebut dengan isian baru
  5. Jika ingin menghapus, langsung tekan icon delete pada colum yg telah tersedia, jika ditekan maka akan langsung terhapus

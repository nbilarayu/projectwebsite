<?php
//koneksi database
$db = mysqli_connect("localhost", "root", "", "Project1");

//fungsi untuk menampilkan query
function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $db;

    $namabarang = htmlspecialchars($data["namabarang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $ruang = htmlspecialchars($data["ruang"]);
    $petugas = htmlspecialchars($data["petugas"]);

   //upload gambar
   $gambar = upload();
   if (!$gambar) {
       return false;
   }

    $query = "INSERT INTO data_barang VALUES 
            ('', '$namabarang', '$jumlah', '$ruang', '$petugas', '$gambar')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM data_barang WHERE id = $id");
    return mysqli_affected_rows($db);
}

function upload()
{
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    //cek yang di upload gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namafile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
        </script>";
        return false;
    }

    //cek jika ukuran gambarnya terlalu besar
    if ($ukuranfile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    //jika lolos pengecekan gambar sip di upload
    //generate nama file gambar baru ketika di upload
    $namafileBaru = uniqid();
    $namafileBaru .= '.';
    $namafileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namafileBaru);
    return $namafileBaru;
}


function edit($data)
{
    global $db;

    $id = $data["id"];
    $namabarang = htmlspecialchars($data["namabarang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $ruang = htmlspecialchars($data["ruang"]);
    $petugas = htmlspecialchars($data["petugas"]);
    $gambarLama = htmlspecialchars($data["gambarlama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE data_barang SET 
            namabarang = '$namabarang',
            jumlah = '$jumlah',
            ruang = '$ruang',
            petugas = '$petugas',
            gambar = '$gambar'
            WHERE id = $id
            ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function cari($keyword)
{
    $query = "SELECT * FROM data_barang 
                WHERE 
                namabarang LIKE '%$keyword%' OR
                jumlah LIKE '%$keyword%' OR
                ruang LIKE '%$keyword%' OR
                petugas LIKE '%$keyword%' 
            ";
    return query($query);
}

function registrasi($data)
{
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);
   
    // cek username sudah ada atau belum
    $result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar');
        </script>";
        return false;
    }

    // cek konfirmasi password

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($db, "INSERT INTO user VALUES('', '$username', '$password')
    ");

    return mysqli_affected_rows($db);
}

?>
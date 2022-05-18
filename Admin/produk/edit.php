<?php

session_start();

require '../../conn.php';

if ( !isset($_SESSION["login"]) ){
    
    header("location:login.php");
    exit;
}


$id = $_GET["id"];

if(isset($_POST["edit"])){
    if(edit_menu($_POST) > 0 ){
        echo "
            <script>
                alert('Data Berhasil diubah....!');
                document.location.href = 'produk.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Data Gagal diubah....!');
                document.location.href = 'produk.php';
            </script>
        ";
    }
}

$produk = query("SELECT * FROM produk WHERE id_produk= $id")[0];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Boastofent</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow bg-danger">
        <div class="container ">
            <a class="navbar-brand text-white" href="#"><b>Boastofent</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="navbar-nav text-center">
                            <li><a class="nav-link active text-white" aria-current="page" href="../index.php">Home</a>
                            </li>
                            <li><a class="nav-link active text-white" aria-current="page" href="produk.php">Daftar
                                    produk</a></li>
                            <li><a class="nav-link active text-white" aria-current="page"
                                    href="../order/order.php">Transaksi</a></li>
                        </div>
                    </div>
                    <ul class="nav navbar-nav navbar-right navbar-light">
                        <li class="nav-item dropdown text-center">
                            <a class="nav-link dropdown-toggle active text-white" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="bi bi-person-circle me-2 "></i>
                                Profil
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../user/edit.php"><i
                                            class="bi bi-gear-fill me-2"></i>Edit Profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="../logout.php" onclick="
                return confirm('Yakin akan logout?')"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>

    <div class="container mt-5">
        <div class="pt-5 pb-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Edit produk</h1>
            </div>

            <form action="" class="mt-3" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="id" id="id" value="<?= $produk['id_produk'] ?>"
                    required>
                <div class="mb-3">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Fasilitas"
                        value="<?= $produk['nama'] ?>" required>
                </div>

                <div class="mb-3">
                    <img width="200px" class="rounded-3" src="../../upload/img/<?php echo $produk['foto'] ?>">
                </div>

                <div class="mb-3">
                    <input type="hidden" class="form-control" name="oldphoto" id="oldphoto"
                        value="<?php echo $produk["foto"] ?>">
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control" name="foto" id="foto">
                </div>

                <div class="mb-3">
                    <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" placeholder="Deskripsi"
                        required><?= $produk['deskripsi'] ?></textarea>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga"
                        value="<?= $produk['harga'] ?>" required>
                </div>

                <button type="submit" class="btn btn-outline-primary" name="edit" id="edit">Edit
                </button>
            </form>
        </div>
    </div>

    <script src="../../js/bootstrap.js"></script>
</body>

</html>
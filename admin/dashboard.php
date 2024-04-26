<?php

// include '../func.php';
// include '../settings/db.php';
// if (@$is_admin == 0) {
//         echo '<p class="alert alert-danger">Admin Paneline erişim izniniz bulunmamaktadır!</p>';
//         header("refresh:1;url=../index.php");
//         exit;
//     }
?>
<?php
include '../func.php';
include '../settings/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OZKANMOVIE | DASHBOARD</title>
    <link rel="stylesheet" href="../admin/adminStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-secondary">

<div class="header bg-dark">
    <h1>OZKANMOVIE Dashboard</h1>
</div>

<div class="sidebar bg-dark">
    <ul>
        <li><a href="#section1"><i class="bi bi-plus-square"></i> Kategori Ekle</a></li>
        <li><a href="#section2"><i class="bi bi-film"></i> Film Ekle</a></li>
        <li><a href="#section3"><i class="bi bi-arrow-clockwise"></i> Film & Kategori Düzenle</a></li>
    </ul>
</div>

<div class="content">

    <section id="section1">
        <h2 class="text-center">Kategori Ekle</h2>
        <form class="w-50 m-auto" method="post">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["categoryName"]) && isset($_POST["categoryDesc"])) {
                    $categoryName = $_POST["categoryName"];
                    $categoryDesc = $_POST["categoryDesc"];

                    $sql = "INSERT INTO categories (name, description, self_link) VALUES (:name, :description, :self_link)";
                    $self_link = selflink($categoryName);
                    $dbst = $db->prepare($sql);

                    $dbst->bindParam(':name', $categoryName, PDO::PARAM_STR);
                    $dbst->bindParam(':description', $categoryDesc, PDO::PARAM_STR);
                    $dbst->bindParam(':self_link', $self_link, PDO::PARAM_STR);

                    if ($dbst->execute()) {
                        echo '<p class="alert alert-success">Kategori başarıyla eklendi.</p>';
                        header("REFRESH:1;URL=../admin/dashboard.php");
                    } else {
                        echo '<p class="alert alert-danger">Kategori eklenirken hata oluştu.</p>';
                        header("REFRESH:1;URL=../admin/dashboard.php");
                    }
                }
            }
        ?>
            <div class="form-group">
                <label class="form-label" for=""><strong>Kategori Adı</strong></label>
                <input class="form-control" type="text" name="categoryName" id="">
            </div>
            <div class="form-group">
                <label class="form-label" for=""><strong>Kategori Açıklaması</strong></label>
                <textarea name="categoryDesc" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="buttons">
                <input type="submit" value="Ekle" class="btn btn-primary mt-2 w-100">
            </div>
        </form>
    </section>
    <section id="section2">
    <h2 class="text-center">Film Ekle</h2>
        <form class="w-50 m-auto" action="" method="post" enctype="multipart/form-data">
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["movieName"]) && isset($_POST["movieDesc"]) && isset($_POST["movieRelease"]) && isset($_POST["movieCategoryID"])) {
        $movieName = $_POST["movieName"];
        $movieDesc = $_POST["movieDesc"];
        $movieRelease = $_POST["movieRelease"];
        $movieCategoryID = $_POST["movieCategoryID"];

        $bannerFile = $_FILES["movieBanner"];
        $backgroundFile = $_FILES["movieBackground"];

        $targetDir = "../images/movieBanner/";
        $bannerFileName = time() . '_' . basename($bannerFile["name"]);
        $targetFile = $targetDir . $bannerFileName;
        $relativeBannerFilePath = str_replace('../', '', $targetFile);
        $uploadOk = 1;
        $bannerImageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($bannerImageFileType != "jpg" && $bannerImageFileType != "png" && $bannerImageFileType != "jpeg") {
            echo '<p class="alert alert-danger">Sadece JPG, JPEG, PNG dosyaları yüklenebilir.</p>';
            $uploadOk = 0;
        }

        $backgroundDir = "../images/movieBackground/";
        $backgroundFileName = time() . '_' . basename($backgroundFile["name"]);
        $backgroundTargetFile = $backgroundDir . $backgroundFileName;
        $relativeBackgroundFilePath = str_replace('../', '', $backgroundTargetFile);
        $backgroundUploadOk = 1;
        $backgroundImageFileType = strtolower(pathinfo($backgroundTargetFile, PATHINFO_EXTENSION));

        if ($backgroundImageFileType != "jpg" && $backgroundImageFileType != "png" && $backgroundImageFileType != "jpeg") {
            echo '<p class="alert alert-danger">Sadece JPG, JPEG, PNG dosyaları yüklenebilir.</p>';
            $backgroundUploadOk = 0;
        }

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (!file_exists($backgroundDir)) {
            mkdir($backgroundDir, 0777, true);
        }

        if ($uploadOk && move_uploaded_file($bannerFile["tmp_name"], $targetFile) && $backgroundUploadOk && move_uploaded_file($backgroundFile["tmp_name"], $backgroundTargetFile)) {
            $selfLink = selflink($movieName);

            $sql = "INSERT INTO movies (title, description, category_id, release_date, self_link, banner_url, background_url) VALUES (:name, :description, :category_id, :release_date, :self_link, :banner_url, :background_url)";
            $dbst = $db->prepare($sql);

            $dbst->bindParam(':name', $movieName, PDO::PARAM_STR);
            $dbst->bindParam(':description', $movieDesc, PDO::PARAM_STR);
            $dbst->bindParam(':category_id', $movieCategoryID, PDO::PARAM_INT);
            $dbst->bindParam(':release_date', $movieRelease, PDO::PARAM_STR);
            $dbst->bindParam(':self_link', $selfLink, PDO::PARAM_STR);
            $dbst->bindParam(':banner_url', $relativeBannerFilePath, PDO::PARAM_STR);
            $dbst->bindParam(':background_url', $relativeBackgroundFilePath, PDO::PARAM_STR);

            if ($dbst->execute()) {
                echo '<p class="alert alert-success">Film başarıyla eklendi.</p>';
                header("Refresh: 5; URL=../admin/dashboard.php");
                exit;
            } else {
                echo '<p class="alert alert-danger">Film eklenirken hata oluştu.</p>';
            }
        } else {
            echo '<p class="alert alert-danger">Dosya yükleme hatası.</p>';
        }
    } else {
        echo '<p class="alert alert-danger">Lütfen tüm alanları doldurun.</p>';
    }
}
?>
            <div class="form-group">
                <label class="form-label" for=""><strong>Film Adı</strong></label>
                <input class="form-control" type="text" name="movieName" id="">
            </div>
            <div class="form-group">
                <label class="form-label" for=""><strong>Film Açıklaması</strong></label>
                <textarea name="movieDesc" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for=""><strong>Çıkış Tarihi</strong></label>
                <input class="form-control" type="date" name="movieRelease" id="">
            </div>
            <div class="form-group">
                <label class="form-label" for=""><strong>Film Türü</strong></label>
                <?php 
                    include '../settings/db.php';

                    $sql = "SELECT id, name FROM categories";
                    $dbst = $db->prepare($sql);
                    $dbst->execute();

                    if ($dbst->rowCount() > 0) {
                        echo '<select name="movieCategoryID" class="form-select">'; 

                        while ($row = $dbst->fetch(PDO::FETCH_ASSOC)) {
                            $categoryId = $row['id'];
                            $categoryName = $row['name'];
                            echo '<option value="' . $categoryId . '">' . $categoryName . '</option>';
                        }

                        echo '</select>'; 
                    } else {
                        echo 'Veritabanında kategori bulunamadı.';
                    }
                ?>
            </div>
            <div class="form-group">
                <label class="form-label" for=""><strong>Film Afişi</strong></label>
                <input class="form-control" type="file" name="movieBanner" id="">
            </div>
            <div class="form-group">
                <label class="form-label" for=""><strong>Film Arkaplanı</strong></label>
                <input class="form-control" type="file" name="movieBackground" id="">
            </div>
            <div class="buttons">
                <input type="submit" value="Ekle" class="btn btn-primary mt-2 w-100">
            </div>
        </form>
    </section>
    <section id="section3">
        <h2 class="text-center">Düzenle & Değiştir</h2>
        <div class="movie-edit">
            <?php
            if (isset($_GET['delete']) && !empty($_GET['delete'])) {
                $movieId = $_GET['delete'];
            
                $deleteQuery = $db->prepare("DELETE FROM movies WHERE id = ?");
                $result = $deleteQuery->execute([$movieId]);
            
                if ($result) {
                    echo "<script>alert('Film başarıyla silindi.'); window.location.href = 'dashboard.php';</script>";
                } else {
                    echo "<script>alert('Film silinirken bir hata oluştu.'); window.location.href = 'dashboard.php';</script>";
                }
            }
            
            $movieListQuery = $db->query("SELECT * FROM movies");
            $movies = $movieListQuery->fetchAll(PDO::FETCH_ASSOC);
            
            echo '<h2>Film Listesi</h2>';
            echo '<table class="table table-dark table-striped">';
            echo '<tr><th>ID</th><th>Film Adı</th><th>Açıklaması</th><th>İşlemler</th></tr>';
            foreach ($movies as $movie) {
                echo '<tr>';
                echo '<td>' . $movie['id'] . '</td>';
                echo '<td>' . $movie['title'] . '</td>';
                echo '<td>' . $movie['description'] . '</td>';
                echo '<td><a class="btn btn-primary" href="dashboard.php?delete=' . $movie['id'] . '" onclick="return confirm(\'Bu filmi silmek istediğinizden emin misiniz?\')">Sil</a></td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>  
        </div>
        <div class="categorie-edit">
        <?php
            // Kategori silme işlemi
            if (isset($_GET['delete']) && !empty($_GET['delete'])) {
                $categoryId = $_GET['delete'];

                $deleteQuery = $db->prepare("DELETE FROM categories WHERE id = ?");
                $result = $deleteQuery->execute([$categoryId]);

                if ($result) {
                    echo "<script>alert('Kategori başarıyla silindi.'); window.location.href = 'dashboard.php';</script>";
                    
                } else {
                    echo "<script>alert('Kategoriyi silerken bir hatayla karşılaştık.'); window.location.href = 'dashboard.php';</script>";
                }
            }

            // Tüm kategorileri listeleme
            $categoryListQuery = $db->query("SELECT * FROM categories");
            $categories = $categoryListQuery->fetchAll(PDO::FETCH_ASSOC);

            echo '<h2>Kategori Listesi</h2>';
            echo '<table class="table table-dark table-striped">';
            echo '<tr><th>ID</th><th>Kategori Adı</th><th>Açıklaması</th><th>İşlemler</th></tr>';
            foreach ($categories as $category) {
                echo '<tr>';
                echo '<td>' . $category['id'] . '</td>';
                echo '<td>' . $category['name'] . '</td>';
                echo '<td>' . $category['description'] . '</td>';
                echo '<td><a class="btn btn-primary" href="dashboard.php?delete=' . $category['id'] . '" onclick="return confirm(\'Bu kategoriyi silmek istediğinizden emin misiniz?\')">Sil</a></td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>
        </div>
        <script>
    // Silme işlemi başarılı olduğunda sayfayı yenile
    function reloadPage() {
        location.reload(); // Sayfayı yenile
    }
</script>
    </section>
</div>

<script src="../admin/adminJs.js"></script>
</body>
</html>

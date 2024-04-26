<?php
session_start();
if(isset($_SESSION["user"])){
    echo '<p class="alert alert-danger">Zaten Giriş Yapmışsınız!</p>';
    header("refresh:2,url = index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
        body {
            background-color: #343a40;
            color: #fff;
        }

        .login-form {
            background-color: #454d55;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
        }

        .login-form h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .login-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .register-link {
            color: #cfcfcf;
        }

        .register-link:hover {
            color: #9c9c9c;
            text-decoration: none;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-form">
                    <h4>Giriş Yap</h4>
                    <?php
                        if($_POST){
                            
                            include 'settings/db.php';
                            
                            $email = $_POST["email"];
                            $password = md5($_POST["password"]);
    
                            if ($email != "" and $password != ""){
                                $userQueryControl = $db->prepare("SELECT * FROM users WHERE email = ? and password = ?");
                                $userQueryControl->execute([$email,$password]);
                                $userQueryControlNumber = $userQueryControl->rowCount();
                                if ($userQueryControlNumber > 0){
                                    $_SESSION['user'] = $email;
                                    echo '<div class = "alert alert-success">Giriş İşlemi Başarılı! Yönlendiriliyorsunuz...</div>';
                                    header("refresh:2,url = index.php");
                                    exit;
                                }
                                else{
                                    echo '<div class = "alert alert-danger">Bu Bilgilere Ait Kullanıcı Bulunamadı!</div>';
                                }
    
                            }else{
                                echo '<div class = "alert alert-danger">Lütfen Boş Değer Göndermeyiniz!</div>';
                            }
                        }
                        ?>
                    <form action="#" method="post">
                        <input class="form-control" type="email" name="email" placeholder="E-Mail Adresiniz" required>
                        <input class="form-control" type="password" name="password" placeholder="Şifreniz" required>
                        <input class="form-control" type="submit" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=ozkanmovie;","root","");
} catch (PDOException $error) {
    echo("Bağlantı Hatası".@$error);
}
if (isset($_SESSION["user"])){
    $userinfos = $db->prepare("select * from users where email = ? LIMIT 1");
    $userinfos->execute([$_SESSION["user"]]);
    $userinfocount = $userinfos->rowCount();
    $userinfo = $userinfos->fetch(PDO::FETCH_ASSOC);
    if ($userinfocount > 0){
    $user = $userinfo["username"];
    $email = $userinfo["email"];
    $id = $userinfo["id"];
    $is_admin = $userinfo["is_admin"];  
    }
    else{

    }
}
?>
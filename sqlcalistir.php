<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="static/plugin/owl-carousel/css/owl.carousel.min.css" rel="stylesheet">
    <link href="static/css/style.css" rel="stylesheet">
    <link href="static/css/color/default.css" rel="stylesheet" id="color_theme">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <style type="text/css">
        .uyari{
            width: 100%;
            margin-bottom: 10px;
            position: relative;
            line-height: 30px;
            border-radius: 5px;
            font-family: "Arial";
            padding: 0px 10px 0px 10px;
            opacity: 0;
            height: 0px;
            text-align: center;
        }
        .uyari:empty{
            display: none;
        }
        
        .hata{
            background: #dd2a3b;
        }
        
        .basari{
            background: #009157;
        }

        .butonlar{
            margin: 0px auto;
            margin: 10px;
            max-width: 200px;
            margin-top: 25px;
            text-align: center;
            font-family: "arial";
            line-height: 30px;
        }
        .buton{
            color: #f4eed8;
            border-style: none;
            width: 80px;
            height: 30px;
            border-radius: 4px;
            text-shadow: 1px 5px 5px rgba(244, 238, 216, 0.1);
            background: #1a1e24;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease-in-out;
            font-size: 15px;
            transform: scale(1.2, 1.2);
        }
        
        .buton:hover {    
            transform: scale(1.5, 1.5);
        }
    </style>
</head>
<body class="grey-bg">
	<?php
	if (empty($_SESSION["ok_giris_yapildi"])) {
		header("Refresh:2; url=index.php");
		die("Lammer ATTACK!");
	}
	require (/*ROOT.*/'php/Database.php');
    $db=new Database();
    $_DURUM["mesaj"]="";
    if (isset($_POST["sqlbuton"])) {
        $sonuc=$db->calistir($_POST["sqlkodu"]);
        if($sonuc){
            $_DURUM["mesaj"]="Kod başarıyla çalıştı.";
            echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
        }
        else{
           $_DURUM['mesaj']="Kod çalışmadı.";
           echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
        }
    }
    ob_flush();
?>
<center>
    <div class="uyari" id="uyari-kutusu" style="opacity: 0;height: 30px;"> <?= $_DURUM['mesaj']; ?> </div> 
    <form action="" method="post">
        <textarea name="sqlkodu" id="kodlar" cols="100" rows="5"></textarea><br>
        <input type="submit" class="buton butonlar" style="width: 140px" value="ÇALIŞTIR" name="sqlbuton">
    </form>
</center>
<pre>
    <?php isset($sonuc) ? print_r($sonuc) :"";?>
</pre>
</body>
</html>
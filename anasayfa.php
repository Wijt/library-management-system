<?php session_start();
if (empty($_SESSION["ok_giris_yapildi"])) {
        header("Refresh:0; url=403.php");
        die("Lammer ATTACK!");
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Yönetim paneline hoşgeldiniz.</title>
	<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="../static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../static/plugin/owl-carousel/css/owl.carousel.min.css" rel="stylesheet">
    <link href="../static/css/style.css" rel="stylesheet">
    <link href="../static/css/color/default.css" rel="stylesheet" id="color_theme">
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
<body>
	<center><span style="margin-top: 250px;position: absolute;left: 40%;text-shadow: 0 0 25px black;color: black;font-family:  cursive;font-size: 50px;">HOŞGELDİNİZ</span></center>
</body>
</html>
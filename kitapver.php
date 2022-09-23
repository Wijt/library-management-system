<?php session_start();
if (empty($_SESSION["ok_giris_yapildi"])) {
		header("Refresh:2; url=index.php");
		die("Lammer ATTACK!");
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Projelerini gir!</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
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
		    font-weight: bolder;
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
<?php
date_default_timezone_set('Europe/Istanbul');
	if (isset($_POST["kitap_ver"])) {
		$barkod=htmlspecialchars(trim($_POST["barkod"]));
		$ogr_no=htmlspecialchars(trim($_POST["ogr_no"]));
		$turu=htmlspecialchars(trim($_POST["turu"]));
        if ($barkod!=""&&$ogr_no!=""&&$turu!="") {
			include 'php/Database.php';
			$db=new Database();
            if ($turu=="9") {
                $ogr_bilgileri=$db->row("*","ogrenciler",array('numarasi' => $ogr_no));
            }else{
                $ogr_bilgileri=$db->row("*","ogrenciler",array('numarasi' => $ogr_no,"turu"=>$turu));
            }
            if(!$ogr_bilgileri){
                $_DURUM['mesaj']="Öğrenci bulunamadı.";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
            }else{
                $ktp_bilgileri=$db->row("*","kitaplar",array("barkod"=>$barkod));
                if (!$ktp_bilgileri || $ktp_bilgileri["kopya_sayisi"]<0) {
                    $_DURUM['mesaj']="Sistemde böyle bir kitap yok. Lütfen önce kaydediniz.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                }else{
                    $kayit=$db->insert("alinan_kitaplar",array("ogrenci_id" => $ogr_bilgileri["id"], "kitap_id" => $ktp_bilgileri["id"], "alis_tarihi" => date("Y-m-d H:i:s")));
                    if($kayit){
                        $db->update("kitaplar",array("kopya_sayisi"=>$ktp_bilgileri["kopya_sayisi"]-1),array("id"=>$ktp_bilgileri["id"]));
                        $_DURUM['mesaj']="İşlem tamam kitabı teslim edebilirsiniz.";
                        echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                    }else{
                        $_DURUM['mesaj']="Teknik bir arıza var lütfen sonra deneyiniz.";
                        echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                    }
                }
            }
		}else{
			$_DURUM['mesaj']="İşlem yapılması için tüm alanların doldurulması zorunludur!";
            echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').css({'line-height':'17px', 'padding-top':'4px', 'color':'#ffe8e8'}).animate({opacity:'1',height:'40px'}, 1000)});</script>";
		}
	}
?>

</head>
<body>
	    <section id="iletisim" class="section contact-us">
        <div class="container">
            <div class="section-title" style="padding-bottom: 15px;">
                <h2>Kitap<span> Ver</span></h2>
            </div>
                <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="uyari col-md-12" id="uyari-kutusu" style="opacity: 0;height: 30px;"> <?= $_DURUM['mesaj']; ?> </div> 
                    </div>
                    <div class="contact-form">
                        <form id="kitap_ver" method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Barkod:</label>
                                        <input class="form-control" name="barkod" placeholder="Barkod" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Öğrenci no:</label>
                                        <input class="form-control" name="ogr_no" placeholder="Öğrenci no" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="tur">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Sınıf türü:</label>
                                        <select class="form-control" name="turu" style="border-radius: 6px;" required>
                                            <option value="" disabled selected>Sınıf türünü seçiniz</option>
                                            <option value="9">9. sınıf</option>
                                            <option value="atp">ATP</option>
                                            <option value="amp">AMP</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group action">
                                        <input type="submit" name="kitap_ver" class="m-btn" value="İŞLEMİ KAYDET">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
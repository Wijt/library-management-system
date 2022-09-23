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
		    text-shadow: 1px 5px 5px rgba(244, 238, 216, 0.1);;
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
    $_DURUM['mesaj']="";
		if (isset($_POST["eklebuton"])) {
			$adi=htmlspecialchars(trim($_POST["adi"]));
			$soyadi=htmlspecialchars(trim($_POST["soyadi"]));
            $sinifi=htmlspecialchars(trim($_POST["sinifi"]));
            $subesi=htmlspecialchars(strtoupper(trim($_POST["subesi"])));
            $turu=empty($_POST["turu"])?"":htmlspecialchars(trim($_POST["turu"]));
			$numarasi=htmlspecialchars(trim($_POST["numarasi"]));
			$tel_no=htmlspecialchars(trim($_POST["tel_no"]));
			$eposta=htmlspecialchars(trim($_POST["eposta"]));
            if($sinifi=="9"){
                $turu="-";
            }
			if ($adi!=""&&$soyadi!=""&&$sinifi!=""&&$numarasi!=""&&$turu!="") {
				include 'php/Database.php';
				$db=new Database();
				$result=$db->insert("ogrenciler", array('adi' => $adi, 'soyadi' => $soyadi, 'sinif' => $sinifi, 'turu' => $turu, 'sube' => $subesi, 'numarasi' => $numarasi, 'telefon' => $tel_no, 'eposta' => $eposta));
				if ($result) {
					$_DURUM['mesaj']="Öğrenci kaydedildi.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
				}else{
					$_DURUM['mesaj']="Öğrenci kaydedilmedi lütfen tekrar deneyiniz!";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'40px'}, 1000)});</script>";
				}
			}else{
				$_DURUM['mesaj']="Adı, soyadı, sınıfı, sınıf türü ve numarası olmak zorundadır!";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'40px'}, 1000)});</script>";
			}
		}
    ?>

</head>
<body>
	    <section id="iletisim" class="section contact-us">
        <div class="container">
            <div class="section-title" style="padding-bottom: 15px;">
                <h2>Öğrenci<span> Kaydet</span></h2>
            </div>
                <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="uyari col-md-12" id="uyari-kutusu" style="line-height: 17px;padding-top: 4px;color: rgb(255, 232, 232);opacity: 1;height: 40px;"> <?= $_DURUM['mesaj']; ?> </div> 
                    </div>
                    <div class="contact-form">
                        <form id="admin_giris" method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Adı:</label>
                                        <input class="form-control" name="adi" placeholder="Adı" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Soyadı:</label>
                                        <input class="form-control" name="soyadi" placeholder="Soyadı" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Sınıfı:</label>
                                        <select id="sinif" class="form-control" name="sinifi" style="border-radius: 6px;">
                                            <option value="" disabled selected>Sınıf seçiniz</option>
                                            <option value="9">9. sınıf</option>
                                            <option value="10">10. sınıf</option>
                                            <option value="11">11. sınıf</option>
                                            <option value="12">12. sınıf</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                 $("#sinif").change(function(event) {
                                    if ($(this).val()==9) {
                                        $("#tur").animate({
                                            height: '0px',
                                            opacity: '0'
                                        },400, function() {
                                            $(this).css('display', 'none');
                                        });

                                    }else{
                                        $("#tur").css('display', 'block');
                                        $("#tur").animate({
                                            height: '34px',
                                            opacity: '1'
                                        },400, function() {
                                           
                                        });
                                    }
                                });
                            </script>
                            <div class="row" id="tur" style="height: 0px;opacity: 0;display: none">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Sınıf türü:</label>
                                        <select class="form-control" name="turu" style="border-radius: 6px;">
                                            <option value="" disabled selected>Sınıf türünü seçiniz</option>
                                            <option value="atp">ATP</option>
                                            <option value="amp">AMP</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Şubesi:</label>
                                        <input class="form-control" name="subesi" style="text-transform: uppercase;" placeholder="Şubesi" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Numarası:</label>
                                        <input class="form-control" name="numarasi" placeholder="Numarası" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Telefon numarası:</label>
                                        <input class="form-control" name="tel_no" placeholder="Telefon numarası (05123428584)" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">E-posta:</label>
                                        <input class="form-control" name="eposta" placeholder="E-posta" type="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group action">
                                        <input type="submit" name="eklebuton" class="m-btn" value="ÖĞRENCİYİ KAYDET">
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
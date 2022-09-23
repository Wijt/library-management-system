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
		    font-family: "Arial"
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
		    border-radius: 4px;/
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
	if (isset($_POST["eklebuton"])) {
		$kitap_adi=htmlspecialchars(trim($_POST["kitap_adi"]));
		$yazar=htmlspecialchars(trim($_POST["yazar"]));
		$sayfa_sayisi=htmlspecialchars(trim($_POST["sayfa_sayisi"]));
		$cevirmen=htmlspecialchars(trim($_POST["cevirmen"]));
		$yayin_evi=htmlspecialchars(trim($_POST["yayin_evi"]));
		$basim_yili=htmlspecialchars(trim($_POST["basim_yili"]));
		$kopya_sayisi=htmlspecialchars(trim($_POST["kopya_sayisi"]));
		$barkod=htmlspecialchars(trim($_POST["barkod"]));
		if ($kitap_adi!=""&&$yazar!=""&&$sayfa_sayisi!="") {
			include 'php/Database.php';
			$db=new Database();
			$kitap=$db->row("*","kitaplar",array("barkod"=>$barkod));
			if (!$kitap) {
				$result=$db->insert("kitaplar",array('kitap_adi' => $kitap_adi, 'yazar' => $yazar, 'sayfa_sayisi' => $sayfa_sayisi, 'ceviren' => $cevirmen, 'basim_yili' => $basim_yili, 'yayin_evi' => $yayin_evi, 'kopya_sayisi' => $kopya_sayisi,'barkod' => $barkod));				
				if ($result) {
					$_DURUM['mesaj']="Eklendi.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
				}else{
					$_DURUM['mesaj']="Eklenemedi.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
				}	
			}else{
				$sayiarttirma=$db->update("kitaplar",array("kopya_sayisi"=>$kitap["kopya_sayisi"]+1),array("id"=>$kitap["id"]));
				if($sayiarttirma){
					$_DURUM['mesaj']="Eklendi.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
				}
			}
		}else{
			$_DURUM['mesaj']="Kitap adı, yazar ve sayfa sayısı olmak zorundadır!";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
		}
	}
?>

</head>
<body>
	    <section id="iletisim" class="section contact-us" style="paddingding-top: 40px;">
        <div class="container">
            <div class="section-title" style="padding-bottom: 15px;">
                <h2>Kitap<span> Ekle</span></h2>
            </div>
                <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="uyari col-md-12" id="uyari-kutusu" style="opacity: 0;height: 30px;"> <?= $_DURUM['mesaj']; ?> </div> 
                    </div>
                    <div class="contact-form">
                        <form id="admin_giris" method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Kitap adı:</label>
                                        <input class="form-control" name="kitap_adi" placeholder="Kitap adı" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Yazar:</label>
                                        <input class="form-control" name="yazar" placeholder="Yazar" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Sayfa sayısı:</label>
                                        <input class="form-control" name="sayfa_sayisi" placeholder="Sayfa sayısı" type="number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Çevirmen:</label>
                                        <input class="form-control" name="cevirmen" placeholder="Çevirmen" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Yayın evi:</label>
                                        <input class="form-control" name="yayin_evi" placeholder="Yayın evi" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Basım yılı:</label>
                                        <input class="form-control" name="basim_yili" placeholder="Basım yılı" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Kopya sayısı:</label>
                                        <input class="form-control" name="kopya_sayisi" placeholder="Kopya sayısı (varsayılan: 1)" type="text">
                                    </div>
                                </div>
                            </div>
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
                                   <div class="form-group action">
                                        <input type="submit" name="eklebuton" class="m-btn" value="KİTABI KAYDET">
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
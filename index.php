<?php 
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hoşgeldiniz!</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="static/plugin/owl-carousel/css/owl.carousel.min.css" rel="stylesheet">
    <link href="static/css/style.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
    <script>
        history.pushState(null,"null","");
    </script>
</head>
<body class="grey-bg">
        
<?php
    error_reporting( 0 );   
    require ('php/Database.php');
    $db=new Database();
    $_DURUM["mesaj"]="";
    if(isset($_POST["girisbuton"]))
    {
        if(!empty($_POST['kuladi']) and !empty($_POST['sifre']))
        {
            $kuladi=htmlspecialchars(trim(strtolower($_POST["kuladi"])));
            $sifre=htmlspecialchars(trim($_POST["sifre"]));
            $result = $db->row('*','yetkililer',array('kullanici_adi' => $kuladi));
            if ($result) 
            {
                $kriptolusifre=hash('sha512', $sifre, FALSE);
                if ($kuladi === strtolower($result['kullanici_adi']) and $kriptolusifre === $result['sifre'])
                {
                    $_SESSION["kul-adi"]=$result['kullanici_adi'];
                    $_SESSION["kul-sifre"]=$sifre;
                    $_SESSION["ok_giris_yapildi"]=true;
                    $_POST = array();
                    header('Location: '.$_SERVER['PHP_SELF']);
                    $_DURUM['mesaj']="Giriş başarılı.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                }
                else
                {
                    $_DURUM['mesaj']="Şifre yanlış. Tekrar deneyiniz.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                }
            }
            else
            {
    
                $_DURUM['mesaj']="Kullanıcı bulunamadı. <span style='color:wheat;'>Adminle iletişime geç.</span>";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                //header("Refresh:2; url=php/kayitsayfasi.php");
            }
        }
        else{
            $_DURUM['mesaj']="Herhangi bir hesap bilgisi girilmedi.";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
        }}
?>
<?php
if($_SESSION["ok_giris_yapildi"]==true):
?>
<div class="komple" style="display: flex;">
    <div class="solmenu">
        <div class="logo-conteynir">
            <div class="logo"></div><div class="logo-baslik">Yönetim Paneli</div>
        </div>
        <div class="sayfalar">
            <div class="sayfa acik" onclick="sayfadegis('anasayfa.php')"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp; Anasayfa</div>
            <div class="sayfa" onclick="sayfadegis('ogrenciekle.php')"><i class="fas fa-address-book"></i>&nbsp;&nbsp;&nbsp; Öğrenci kaydet</div>
            <div class="sayfa" onclick="sayfadegis('kitapekle.php')"><i class="fas fa-book"></i>&nbsp;&nbsp;&nbsp; Kitap ekle</div>
            <div class="sayfa" onclick="sayfadegis('kitapver.php')"><i class="fas fa-book-reader"></i>&nbsp;&nbsp;&nbsp; Kitap ver</div>
            <div class="sayfa" onclick="sayfadegis('kitapgerial.php')"><i class="fas fa-book-open"></i>&nbsp;&nbsp;&nbsp; Kitap geri al</div>
            <div class="sayfa" onclick="sayfadegis('yapilanislemler.php')"><i class="fas fa-archive"></i>&nbsp;&nbsp;&nbsp; Yapılan işlemler</div>
            <div class="sayfa" onclick="sayfadegis('ogrencilistesi.php')"><i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp; Öğrenci Listesi</div>
            <div class="sayfa" onclick="sayfadegis('kitaplistesi.php')"><i class="fas fa-atlas"></i>&nbsp;&nbsp;&nbsp; Kitap listesi</div>
            <div class="kapa"><i onclick="kapa()" id="kapa" class="fas fa-caret-square-left"></i></div>
            <i class="fas fa-power-off cikis"></i>
        </div>
    </div>
    <div class="sag">
        <iframe id="iframe" src="anasayfa.php" frameborder="0" style="overflow:scroll;" height="100%" width="100%"></iframe>
    </div>
</div>
    <script>
        history.pushState(null,"null","");
        var acik=true;
        function sayfadegis(sayfa){
            $("#iframe").attr('src',sayfa);
            sessionStorage.setItem('ok_kalinanSayfa', sayfa);

        }

        if (sessionStorage.getItem("ok_kalinanSayfa")) {
          $("#iframe").attr('src', sessionStorage.getItem("ok_kalinanSayfa"));
        }

        $(".sayfa").click(function(event) {
            $(".sayfa").each(function(index, el) {
                $(this).removeClass('acik');
            });
            $(this).addClass('acik')
        });
        $(".cikis").click(function(event) {
        	if (confirm("Gerçekten çıkış yapmak istiyor musunuz?")) {
        		$.post('cikis.php', {}, function(data, textStatus, xhr) {
        			location.reload();
        		});
        	}
        });

        function kapa(){
            acik=!acik;
            if(acik){
                $(".solmenu").removeClass('kapali').animate({width:"15%"}, 1000, function() {
                        $(".logo-conteynir").html("").append('<div class="logo"></div><div class="logo-baslik">Yönetim Paneli</div>');
                        $(".logo-conteynir").css({
                            "padding-left": '15px',
                            "padding-right": '15px'
                        });
                });
                $(".sag").animate({width:"85%"}, 1000)
                $("#kapa").removeClass('fa-caret-square-right').addClass('fa-caret-square-left');
            }else{
                $(".solmenu").addClass('kapali').animate({width:"65px"}, 1000);
                $(".sag").animate({width:"96%"}, 1000)
                $(".logo-conteynir").html("").append('<div class="logo"></div>');
                $(".logo-conteynir").css({
                            "padding-left": '0px',
                            "padding-right": '0px'
                        });
                $("#kapa").removeClass('fa-caret-square-left').addClass('fa-caret-square-right');
            }
        }
    </script>
<?php 
else:
?>
    <section id="iletisim" class="section contact-us">
        <div class="container">
            <div class="section-title">
                <h2>Yetkili<span> Girişi</span></h2>
            </div>
                <div class="row">
                <div class="col-sm-4 col-xs-4 col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="uyari col-md-12" id="uyari-kutusu" style="opacity: 0;height: 30px;"> <?= $_DURUM['mesaj']; ?> </div> 
                    </div>
                    <div class="contact-form">
                        <form id="admin_giris" method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Kullanıcı adı</label>
                                        <input class="form-control" name="kuladi" placeholder="Kullanıcı adı" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="sr-only">Şifre</label>
                                        <input class="form-control" name="sifre" placeholder="Şifre" type="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group action">
                                        <input type="submit" name="girisbuton" class="m-btn" value="GİRİŞ YAP">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
endif; ?>
</body>
</html>
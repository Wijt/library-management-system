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
    <link href="static/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="static/plugin/owl-carousel/css/owl.carousel.min.css" rel="stylesheet">
    <link href="static/css/style.css" rel="stylesheet">
    <link href="static/css/color/default.css" rel="stylesheet" id="color_theme">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="datatables/datatables.min.css" rel="stylesheet">
    <script src="datatables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script>
<style type="text/css">
    .uyari {
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

    .uyari:empty {
        display: none;
    }

    .hata {
        background: #dd2a3b;
    }

    .basari {
        background: #009157;
    }

    .butonlar {
        margin: 0px auto;
        margin: 10px;
        max-width: 200px;
        margin-top: 25px;
        text-align: center;
        font-family: "arial";
        line-height: 30px;
    }

    .buton {
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
    include 'php/Database.php';
    $db=new Database();
    $liste=$db->calistir("select * from alinan_kitaplar a inner join ogrenciler o on a.ogrenci_id=o.id inner join kitaplar k on k.id=a.kitap_id");
?>
</head>

<body>
    <section id="iletisim" class="section contact-us">
        <center>
            <div class="section-title">
                <h2><span>????lem</span> Kay??tlar??</h2>
            </div>
        <div class="tableconteynir contact-form" style="width: 90%;padding-left: 40px;padding-right: 40px;">
            <table id="kitapalanlar" class="table table-hover">
                <thead>
                    <tr>
                        <th>??sim</th>
                        <th>S??n??f</th>
                        <th>Telefon no</th>
                        <th>Kitap ad??</th>
                        <th>Al???? tarihi</th>
                        <th>Veri?? tarihi</th>
                    </tr>
                </thead>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#kitapalanlar').DataTable({
                            language:{
                                "sDecimal":        ",",
                                "sEmptyTable":     "Tabloda herhangi bir veri mevcut de??il",
                                "sInfo":           "_TOTAL_ kay??ttan _START_ - _END_ aras??ndaki kay??tlar g??steriliyor",
                                "sInfoEmpty":      "Kay??t yok",
                                "sInfoFiltered":   "(_MAX_ kay??t i??erisinden bulunan)",
                                "sInfoPostFix":    "",
                                "sInfoThousands":  ".",
                                "sLengthMenu":     "Sayfada _MENU_ kay??t g??ster",
                                "sLoadingRecords": "Y??kleniyor...",
                                "sProcessing":     "????leniyor...",
                                "sSearch":         "Ara:",
                                "sZeroRecords":    "E??le??en kay??t bulunamad??",
                                "oPaginate": {
                                    "sFirst":    "??lk",
                                    "sLast":     "Son",
                                    "sNext":     "Sonraki",
                                    "sPrevious": "??nceki"
                                },
                                "oAria": {
                                    "sSortAscending":  ": artan s??tun s??ralamas??n?? aktifle??tir",
                                    "sSortDescending": ": azalan s??tun s??ralamas??n?? aktifle??tir"
                                },
                                "select": {
                                    "rows": {
                                        "_": "%d kay??t se??ildi",
                                        "0": "",
                                        "1": "1 kay??t se??ildi"
                                    }
                                }}
                        }); 
                    } );
                </script>
                <tbody>
                    <?php 
                        foreach ($liste as $ogrenci) {
                            echo "<tr>";
                            echo "<td>".$ogrenci["adi"]." ".$ogrenci["soyadi"]."</td>";
                            echo "<td>".$ogrenci["sinif"]."/".$ogrenci["sube"]." ".strtoupper($ogrenci["turu"])."</td>";
                            echo "<td>".$ogrenci["telefon"]."</td>";
                            echo "<td>".$ogrenci["kitap_adi"]."</td>";
                            echo "<td>".$ogrenci["alis_tarihi"]."</td>";
                            if($ogrenci["veris_tarihi"]==null){
                                if (date("Y-m-d H:i:s")<date('Y-m-d H:i:s', strtotime($ogrenci["alis_tarihi"].' + 15 days')))    {
                                    echo "<td class='warning'>S??resi var</td>";
                                }else{
                                    echo "<td class='danger'>15 g??n?? dolmu??</td>";
                                }
                            }
                            else
                                echo "<td class='success'>Teslim edildi: ".$ogrenci["veris_tarihi"]."</td>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </center>
    </section>
</body>

</html>
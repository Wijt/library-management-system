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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="datatables/datatables.min.css" rel="stylesheet">
    <script src="datatables/datatables.min.js"></script>
    <link href="static/css/style.css" rel="stylesheet">
    <link href="static/css/color/default.css" rel="stylesheet" id="color_theme">

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
        $liste=$db->calistir("select * from kitaplar");
    ?>
</head>

<body>
    <section id="iletisim" class="section contact-us">
        <center>
            <div class="section-title">
                <h2><span>Kitap</span> Kayıtları</h2>
            </div>
        <div class="tableconteynir contact-form" style="width: 90%;padding-left: 40px;padding-right: 40px;">
            <table id="kitapalanlar" class="table table-hover">
                <thead>
                    <tr>
                        <th>Kitap adı</th>
                        <th>Yazar</th>
                        <th>Sayfa sayısı</th>
                        <th>Çeviren</th>
                        <th>Yayın evi</th>
                        <th>Basım yılı</th>
                        <th>Kopya sayısı</th>
                        <th>Barkod</th>
                    </tr>
                </thead>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#kitapalanlar').DataTable({
                            language:{
                                "sDecimal":        ",",
                                "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
                                "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                                "sInfoEmpty":      "Kayıt yok",
                                "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
                                "sInfoPostFix":    "",
                                "sInfoThousands":  ".",
                                "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
                                "sLoadingRecords": "Yükleniyor...",
                                "sProcessing":     "İşleniyor...",
                                "sSearch":         "Ara:",
                                "sZeroRecords":    "Eşleşen kayıt bulunamadı",
                                "oPaginate": {
                                    "sFirst":    "İlk",
                                    "sLast":     "Son",
                                    "sNext":     "Sonraki",
                                    "sPrevious": "Önceki"
                                },
                                "oAria": {
                                    "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                                    "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
                                },
                                "select": {
                                    "rows": {
                                        "_": "%d kayıt seçildi",
                                        "0": "",
                                        "1": "1 kayıt seçildi"
                                    }
                                }}
                        }); 
                    } );
                </script>
                <tbody>
                    <?php 
                        foreach ($liste as $satir) {
                            echo "<tr>";
                            echo "<td>".$satir["kitap_adi"]."</td>";
                            echo "<td>".$satir["yazar"]."</td>";
                            echo "<td>".$satir["sayfa_sayisi"]."</td>";
                            echo "<td>".$satir["ceviren"]."</td>";
                            echo "<td>".$satir["yayin_evi"]."</td>";
                            echo "<td>".$satir["basim_yili"]."</td>";
                            echo "<td>".$satir["kopya_sayisi"]."</td>";
                            echo "<td>".$satir["barkod"]."</td>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </center>
    </section>
</body>

</html>
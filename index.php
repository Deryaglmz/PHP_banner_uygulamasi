<?php
try {
    $VeritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=bannerlar;charset=utf8", "root", "9900");
} catch (PDOException $Hata) {
    echo "Bağlantı Hatası<br>" . $Hata->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $ReklamSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM bannerlar ORDER BY gosterimsayisi ASC LIMIT 1");
    $ReklamSorgusu->execute();
    $ReklamSayisi = $ReklamSorgusu->rowCount();
    $ReklamKaydi = $ReklamSorgusu->fetch(PDO::FETCH_ASSOC);
    ?>
    <table width="1000" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center"><img src="resim/<?php echo $ReklamKaydi["bannerdosyasi"]; ?>" border="0"></td>
        </tr>
    </table>
</body>
</html>
<?php
$ReklamGuncelle = $VeritabaniBaglantisi->prepare("UPDATE bannerlar SET gosterimsayisi=gosterimsayisi+1 WHERE id = ? LIMIT 1");
$ReklamGuncelle->execute([$ReklamKaydi["id"]]);
$VeritabaniBaglantisi = null;
?>

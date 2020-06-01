<?php
header('Access-Control-Allow-Origin: *');
include "polacz.php"; //wzór pliku we wpisie "Pełny panel administracyjny MySQLi"
if ($sql = $baza->prepare( "SELECT DISTINCT name,id FROM klienci ORDER BY nazwisko "))
{
    $sql->execute(); //wykonaj SQL
    $sql->bind_result($nazwisko,$id);
    while ($sql->fetch())
        $nazwiska[] = array(
            "id" => $id,
            "nazwisko" => iconv("ISO-8859-2", "UTF-8", $nazwisko)
        ); //dla każdego nazwiska tworzy 2 pary, nazwiska przekonwertowane do UTF
    $sql->close();
}
$baza->close();
echo json_encode($nazwiska, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);



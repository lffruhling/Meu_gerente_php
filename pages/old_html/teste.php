<?php
function getVoucher(){
    // Monta yymmddhhiisslll e converte para hexadecimal
    $micro = explode(".",(float)microtime(true)/1000);
    $mili = substr($micro[1],0,3);
    $modelo = date("ymdHis");
    $modelo = $modelo.$mili;
    $voucher = base_convert('2190964402', 10, 16);

    $micro = explode(".",(float)microtime(true)/1000);
    echo "<br>".$micro."<br>";
    $mili = substr($micro[1],0,3);
    echo "<br>".$mili."<br>";

    $modelo = date("ymdHis");
    echo "<br>".$modelo."<br>";

    $modelo = $modelo.$mili;
    echo "<br>".$modelo."<br>";

    $voucher = dechex($modelo);
    echo "<br>".$voucher."<br>";

    return $voucher;
}


echo "\n\n".getVoucher()."\n\n";
?>
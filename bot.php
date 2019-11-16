<?php
require_once('knowledge.php');
$botToken = "922074332:AAHwXJq-MW_Mz1V0Fv5HGOVo-41OI_8ssU8"; // token bot api telegram
$website = "https://api.telegram.org/bot".$botToken;
$update = file_get_contents("php://input");
$updateArray = json_decode($update, TRUE);
$chatId = $updateArray['message']['chat']['id'];
$pesan = $updateArray['message']['text'];
$brain = new Knowledge();
$data = $brain->getKnowledge();
  
    function scanner($pesan){
        $ilang = preg_replace("/[^a-zA-Z0-9]+/", " ", $pesan);
        $kecil = strtolower($ilang);
        return $kecil;
    }
    $scan = scanner($pesan);

    function BoyerMoore($text, $pattern) {
        require_once('oh.php');
        require_once('mh.php');
        $oh = new OH();
        $mh = new MH();
        $patlen = strlen($pattern);
        $textlen = strlen($text);
        $table_oh = $oh->preBmBc($pattern);
        $table_mh = $mh->preBmGs($pattern);
        for ($i=$patlen-1; $i < $textlen;) { 
            $t = $i;
            for ($j=$patlen-1; $pattern[$j]==$text[$i]; $j--,$i--) { 
                if($j == 0) return $i;
            }
            $i = $t;
            if(array_key_exists($text[$i], $table_oh))
                $i = $i + max($table_oh[$text[$i]], $table_mh[$text[$i]]);
            else
                $i += $patlen;
        }
        return -1;
    }
    
    foreach ($data as $key => $value) {
        $kata_kunci = $value['kata_kunci'];
        $hasil = BoyerMoore($scan,$kata_kunci);
        if ($hasil != -1) {
            $ketemu = true;
            $jawaban =  $value['jawaban'];
            break;
        }else{
            $ketemu = false;
            $jawaban = "Maaf data ".$pesan." yang dicari tidak ditemukan";
        }
    }
    

sendMessage($chatId,urlencode($jawaban));
function sendMessage($id, $message) {
    file_get_contents($GLOBALS['website']."/sendMessage?chat_id=".$id."&text=".$message);
}

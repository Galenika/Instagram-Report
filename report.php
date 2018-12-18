<?php
require_once __DIR__. "/config.php";
require_once __DIR__. "/func.php";

echo "Masukkan Username Target yang akan di Report\nInput : ";
$target = trim(fgets(STDIN));
$curl = curl("https://api.instakuy.com/instagram/user/".$target);
$getInfo = json_decode($curl);
$userId = $getInfo->id;

echo "Target Dengan Username ".$target." Yang Ber-ID".$userId." Siap dI Report Ea\n";
$query = mysqli_query($conn,"SELECT * FROM likeforlike");

while($row = mysqli_fetch_assoc($query)){
	$report = instagram(1, $row['useragent'], 'users/'.$userId.'/flag_user/', $row['cookies'], generateSignature('{"source_name":"profile","reason_id":1}'));
	$reportStatus = json_decode($report[1]);
	if($reportStatus->status == 'ok'){
		echo "Akun ".$target." Berhasil Direport Oleh : ".$row['username']."\n";
		$fileRead = fopen("$target.ig","w");
		fwrite($fileRead, "User : ".$row['username']." Berhasil Mereport akun -> ".$target.PHP_EOL);
		fclose($fileRead);
		sleep(rand(5,10));
	}else{
		echo "Akun ".$target." Gagal Direport Oleh : ".$row['username']."Karena Kesalahan : ".$reportStatus->message."\n";
		$fileRead = fopen("$target.ig","w");
		fwrite($fileRead, "User : ".$row['username']." Gagal Mereport Mereport akun -> ".$target." Karena Kesalahan -> ".$reportStatus->message.PHP_EOL);
		fclose($fileRead);
		sleep(rand(5,10));
	}
}
?>
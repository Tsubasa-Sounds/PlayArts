<meta charset="utf-8">
<?php

//送信先アドレス
$mailto = 'mars_softail_deluxe09@yahoo.co.jp';
// IPアドレスを取得して変数にセットする
$ip = $_SERVER["REMOTE_ADDR"];

//エラー出力。必要なくなったら削除
//error_reporting(-1);

$home = $_POST["home"];
$familyname = $_POST["familyname"];
$firstname = $_POST["firstname"];
$kanafamily = $_POST["kanafamily"];
$kanafirst = $_POST["kanafirst"];
$tel = $_POST["tel"];
$emai = $_POST["email"];
$performance = $_POST["performance"];
$month = $_POST["month"];
$day = $_POST["day"];
$time = $_POST["time"];
$pseattype = $_POST["seattype"];
$ticket = $_POST["ticket"];
$postcode = $_POST["postcode"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$building = $_POST["building"];

//XSS対策
$home = htmlentities($_POST["home"],ENT_QUOTES);
$familyname = htmlentities($_POST["familyname"],ENT_QUOTES);
$firstname = htmlentities($_POST["firstname"],ENT_QUOTES);
$kanafamily = htmlentities($_POST["kanafamily"],ENT_QUOTES);
$kanafirst = htmlentities($_POST["kanafirst"],ENT_QUOTES);
$tel = htmlentities($_POST["tel"],ENT_QUOTES);
$email = htmlentities($_POST["email"],ENT_QUOTES);
$performance = htmlentities($_POST["performance"],ENT_QUOTES);
$month = htmlentities($_POST["month"],ENT_QUOTES);
$day = htmlentities($_POST["day"],ENT_QUOTES);
$time = htmlentities($_POST["time"],ENT_QUOTES);
$seattype = htmlentities($_POST["seattype"],ENT_QUOTES);
$ticket = htmlentities($_POST["ticket"],ENT_QUOTES);
$postcode = htmlentities($_POST["postcode"],ENT_QUOTES);
$address1 = htmlentities($_POST["address1"],ENT_QUOTES);
$address2 = htmlentities($_POST["address2"],ENT_QUOTES);
$building = htmlentities($_POST["building"],ENT_QUOTES);


$userInput=array();

//文字化け対策
$userInput["home"] =  mb_convert_encoding($home, "UTF-8");
$userInput["familyname"] =  mb_convert_encoding($familyname, "UTF-8");
$userInput["fristname"] =  mb_convert_encoding($firstname, "UTF-8");
$userInput["kanafamily"] =  mb_convert_encoding($kanafamily, "UTF-8");
$userInput["kanafirst"] =  mb_convert_encoding($kanafirst, "UTF-8");
$userInput["tel"] =  mb_convert_encoding($tel, "UTF-8");
$userInput["email"] =  mb_convert_encoding($email, "UTF-8");
$userInput["performance"] =  mb_convert_encoding($performance, "UTF-8");
$userInput["month"] =  mb_convert_encoding($month, "UTF-8");
$userInput["day"] =  mb_convert_encoding($day, "UTF-8");
$userInput["time"] =  mb_convert_encoding($time, "UTF-8");
$userInput["seattype"] =  mb_convert_encoding($seattype, "UTF-8");
$userInput["ticket"] =  mb_convert_encoding($ticket, "UTF-8");
$userInput["postcode"] =  mb_convert_encoding($postcode, "UTF-8");
$userInput["address1"] =  mb_convert_encoding($address1, "UTF-8");
$userInput["address2"] =  mb_convert_encoding($address2, "UTF-8");
$userInput["building"] =  mb_convert_encoding($building, "UTF-8");


// 確認画面と送信完了画面の分岐
if($_POST["mode"]==="conf"){
	
	//自宅か劇場受取かのチェック
	$home = intval($home);
	if($home === 0){
		$uketori="ご自宅にお届け";
	}else{
		$uketori="劇場で受取り";
	}
	
	confirm();
}else if($_POST["mode"]==="send"){
	send_mail();
	complete();
}

//確認画面
function confirm(){
	global $userInput;
	global $home;
	global $familyname;
	global $firstname;
	global $kanafamily;
	global $kanafirst;
	global $tel;
	global $email;
	global $performance;
	global $month;
	global $day;
	global $time;
	global $seattype;
	global $ticket;
	global $postcode;
	global $address1;
	global $address2;
	global $building;
	global $uketori;

	//ファイル読み込み
	$file=fopen("tmpl/conf.html","r") or die;
	$size=filesize("tmpl/conf.html");
	$conf_tmp=fread($file,$size);
	fclose($file);

	//文字の置き換え
	$conf_tmp=str_replace("!home!",$uketori,$conf_tmp);
	$conf_tmp=str_replace("!familyname!",$familyname,$conf_tmp);
	$conf_tmp=str_replace("!firstname!",$firstname,$conf_tmp);
	$conf_tmp=str_replace("!kanafamily!",$kanafamily,$conf_tmp);
	$conf_tmp=str_replace("!kanafirst!",$kanafirst,$conf_tmp);
	$conf_tmp=str_replace("!tel!",$tel,$conf_tmp);
	$conf_tmp=str_replace("!email!",$email,$conf_tmp);
	$conf_tmp=str_replace("!performance!",$performance,$conf_tmp);
	$conf_tmp=str_replace("!month!",$month,$conf_tmp);
	$conf_tmp=str_replace("!day!",$day,$conf_tmp);
	$conf_tmp=str_replace("!time!",$time,$conf_tmp);
	$conf_tmp=str_replace("!seattype!",$seattype,$conf_tmp);
	$conf_tmp=str_replace("!ticket!",$ticket,$conf_tmp);
	$conf_tmp=str_replace("!postcode!",$postcode,$conf_tmp);
	$conf_tmp=str_replace("!address1!",$address1,$conf_tmp);
	$conf_tmp=str_replace("!address2!",$address2,$conf_tmp);
	$conf_tmp=str_replace("!building!",$building,$conf_tmp);

	//成功時の画面表示
	echo $conf_tmp;

	//中断
	exit;
}

//送信完了
function complete(){
	global $month;
	
	//ファイル読み込み
	$file=fopen("tmpl/send.html","r") or die;
	$size=filesize("tmpl/send.html");
	$send_tmp=fread($file,$size);
	fclose($file);
	
	//送信完了画面
	echo $send_tmp;

	//中断
	exit;
}

//メール送信
function send_mail(){
    # 時間取得
	$date = date("Y/m/d H:i:s");
 
	global $userInput;
	global $home;
	global $familyname;
	global $firstname;
	global $kanafamily;
	global $kanafirst;
	global $tel;
	global $email;
	global $performance;
	global $month;
	global $day;
	global $time;
	global $seattype;
	global $ticket;
	global $postcode;
	global $address1;
	global $address2;
	global $building;
	global $uketori;
	global $ip;
	
	//お客様に送信
	$body1 = <<< EOM
	チケットのご購入ありがとうございます。
	下記の内容で、チケットを承りました。

	日時 ： $date
	名前 ： {$familyname} {$firstname} 様
	チケット受取り方法 : {$home}
	電話番号 : $tel
	メールアドレス ： $email
	公演名 : $performance
	日時 : {$month}月 {$day}日 {$time}時
	席種 : {$seattype}席
	枚数 : {$ticket}枚
	住所 : {$postcode} {$address1} {$address2} {$building}
EOM;

	mb_language("japanese");
	mb_internal_encoding("UTF-8");
	$subject = "【PlayArts】チケットのご購入ありがとうございます";
	$mailFrom = "\nFrom PlayArts STAFF<mars_softail_deluxe09@yahoo.co.jp>\n";
	mb_send_mail($email,$subject,$body1,$mailFrom);

    //スタッフに送信
	$body2 = <<< EOM
	フォームメールより、次のとおり連絡がありました。

	日時 ： $date
	IP情報 ： $ip
	名前 ： {$familyname} {$firstname} 様
	チケット受取り方法 : {$home}
	電話番号 : $tel
	メールアドレス ： $email
	公演名 : $performance
	日時 : {$month}月 {$day}日 {$time}時
	席種 : {$seattype}席
	枚数 : {$ticket}枚
	住所 : {$postcode} {$address1} {$address2} {$building}
EOM;

	global $mailto;
	mb_language("japanese");
	mb_internal_encoding("UTF-8");
	$subject = "チケットが購入されました";
	mb_send_mail($mailto,$subject,$body2);
}
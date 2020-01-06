<?php
//**************************************************
// 初期処理
//**************************************************
    //データベース接続関数の定義ファイルを読み込み
    require_once('../model/dbconnect.php');

    //データベース操作関数の定義ファイルを読み込み
    require_once('../model/dbfunction.php');

//**************************************************
// 変数取得
//**************************************************
    //ID
    $sItemId = isset($_GET['id']) ? $_GET['id'] : "";
    if($sItemId == ""){
        header( "HTTP/1.1 301 Moved Permanently" ); 
        header( "Location: /kinpakuEC/ctrl/index.php" ); 
        exit;
    }

//**************************************************
// 検索処理
//**************************************************
    //値を取得
    $arrResult = selectMember($sItemId, "");
    $selectItem = $arrResult[0];
    $image = $selectItem['image'];
    $imageUri = !empty($image) ? "data:image/jpg;base64," . base64_encode($item['image']) : "../assets/images/NOIMAGE.jpeg";

//**************************************************
// HTMLを出力
//**************************************************
    //画面へ表示
    if(count($arrResult) > 0){
        require_once('../view/itemDetail.html');
    } else {
        header( "HTTP/1.1 301 Moved Permanently" ); 
        header( "Location: /index.php" ); 
        exit;
    }
?>
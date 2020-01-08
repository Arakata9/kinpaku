<?php
//**************************************************
// 初期処理
//**************************************************
    //データベース接続関数の定義ファイルを読み込み
    require_once('../model/dbconnect.php');

    //データベース操作関数の定義ファイルを読み込み
    require_once('../model/dbusers.php');

//**************************************************
// 変数取得
//**************************************************
    //ID
    $sUserId = isset($_POST['userId']) ? $_POST['userId'] : "";

    //商品名
    $sUserName = isset($_POST['userName']) ? $_POST['userName'] : "";


//**************************************************
// 検索処理
//**************************************************
    //値を取得
    $arrResultUsers = selectUser($sUserId, $sUserName);


//**************************************************
// HTMLを出力
//**************************************************
    //画面へ表示
    if(count($arrResultUsers) > 0){
        require_once('../view/userManage.html');
    } else {
        require_once('../view/none.html');
    }
?>
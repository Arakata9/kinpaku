<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
//**************************************************
// 初期処理
//**************************************************
    //データベース接続関数の定義ファイルを読み込み
    require_once('../model/dbconnect.php');

    //データベース操作関数の定義ファイルを読み込み
    require_once('../model/dbusers.php');

//**************************************************
// 変数定義
//**************************************************
    //エラー検知用
    $bRet = false;

    //エラーメッセージ用
    $arrErr = array();

//**************************************************
// 変数取得
//**************************************************

    $nStepFlg = isset($_POST['step']) ? $_POST['step'] : "";

    //ID
    $sUserId = isset($_POST['userId']) ? $_POST['userId'] : "";

    //名前
    $sUserName = isset($_POST['userName']) ? $_POST['userName'] : "";

    //メール
    $sMail = isset($_POST['mail']) ? $_POST['mail'] : "";

    //パスワード
    $sPassword = isset($_POST['password']) ? $_POST['password'] : "";

    //住所
    $sAddress = isset($_POST['address']) ? $_POST['address'] : "";
    
    //電話番号
    $sTel = isset($_POST['tel']) ? $_POST['tel'] : "";    

    //処理ステップ


//**************************************************
// STEP0（検索処理）
//**************************************************
    if($nStepFlg == ""){
        //メンバー情報の取得
        $arrResultUsers = selectUser($sUserId);

        //名前
        $sUserName = $arrResultUsers[0]['userName'];

        //メール
        $sMail = $arrResultUsers[0]['mail'];
        
        //パスワード
        $sPassword = $arrResultUsers[0]['password'];

        //住所
        $sAddress = $arrResultUsers[0]['address'];
        
        //電話番号
        $sTel = $arrResultUsers[0]['tel'];
    }

//**************************************************
// STEP1（確認画面）
//**************************************************
    if($nStepFlg == 1 || $nStepFlg == 2){

        // 名前チェック
        if($sUserName == ""){
            $arrErr['name'] = "名前を入力してください";
        }


        // メールチェック
        if($sMail == ""){
            $arrErr['mail'] = "メールアドレスを入力してください";
        }

        
         // パスワードチェック
        if($sPassword== ""){
            $arrErr['password'] = "パスワードを入力してください";
        }
   
         // 住所チェック
        if($sAddress == ""){
            $arrErr['address'] = "住所を入力してください";
        }
        
         // 電話番号チェック
        if($sTel == ""){
            $arrErr['tel'] = "電話番号を入力してください";
        }

        //入力エラーがある場合は最初のステップに戻す
        if(count($arrErr) > 0){
            $nStepFlg = "";
        }
    }

//**************************************************
// STEP2（完了画面）
//**************************************************
    if($nStepFlg == 2 && count($arrErr) == 0){
        //データ登録
        $bRet = updateUser($sUserId, $sMail, $sUserName,$sPassword, $sAddress, $sTel);

        //DB登録エラーがある場合は最初のステップに戻す
        if($bRet == false){
            $nStepFlg = "";
        }
    }

//**************************************************
// HTMLを出力
//**************************************************
    if($nStepFlg == ""){
        require_once('../view/userUpdate.html');
    } else if ($nStepFlg == 1) {
        require_once('../view/userUpdateCheck.html');
    } else if ($nStepFlg == 2) {
        require_once('../view/userUpdateOK.html');
    }
?>

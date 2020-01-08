<?php
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

//**************************************************
// 変数取得
//**************************************************
    //ID
    $sUserId = isset($_POST['userId']) ? $_POST['userId'] : "";

    //処理ステップ
    $nStepFlg = isset($_POST['step']) ? $_POST['step'] : "";

//**************************************************
// STEP0（検索処理）
//**************************************************
    if($nStepFlg == ""){
        //商品情報の取得
        $arrResultUsers = selectUser($sUserId);

        //名前
        $sUserName = $arrResultUsers[0]['userName'];
        
        //メール
        $sMail = $arrResultUsers[0]['mail'];
        
        //パスワード
        $sPassword = $arrResultUsers[0]['password'];
        
        //住所
        $sAddress  = $arrResultUsers[0]['address'];
        
        //電話番号
        $sTel  = $arrResultUsers[0]['tel'];
    }

//**************************************************
// STEP1（削除処理）
//**************************************************
    if ($nStepFlg == "1"){
        //確認画面でOKなら削除
        $bRet = deleteUser($sUserId);

        //DB登録エラーがある場合は最初のステップに戻す
        if($bRet == false){
            $nStepFlg = "";
        }
    }

//**************************************************
// HTMLを出力
//**************************************************
    if($nStepFlg == ""){
        require_once('../view/userDelete.html');
    } else if ($nStepFlg == 1) {
        require_once('../view/userDeleteOK.html');
    }

?>

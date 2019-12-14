<?php
//**************************************************
// 初期処理
//**************************************************
    //データベース接続関数の定義ファイルを読み込み
    require_once('../model/dbconnect.php');

    //データベース操作関数の定義ファイルを読み込み
    require_once('../model/dbfunction.php');

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
    //苗字
    $sName = isset($_POST['name']) ? $_POST['name'] : "";

    //価格
    $sPrice = isset($_POST['price']) ? $_POST['price'] : "";

    //在庫
    $sInventory = isset($_POST['inventory']) ? $_POST['inventory'] : "";
    
     //タグ
    $sTag = isset($_POST['tag']) ? $_POST['tag'] : "";
    
    //処理ステップ
    $nStepFlg = isset($_POST['step']) ? $_POST['step'] : "";


//**************************************************
// STEP1（確認画面）
//**************************************************
    if($nStepFlg == 1 || $nStepFlg == 2){

        // 苗字チェック
        if($sName == ""){
            $arrErr['name'] = "商品名を入力してください";
        }
        // else if(mb_strlen($sName, "UTF-8") > 10) {
        //     $arrErr['name'] = "苗字は10文字以内で入力してください";
        // }

        // 価格チェック
        if($sPrice == ""){
            $arrErr['price'] = "価格を入力してください";
        }
        // else if(mb_strlen($sPrice, "UTF-8") > 10) {
        //     $arrErr['price'] = "価格は10文字以内で入力してください";
        // }
        
        // 在庫チェック
        if($sInventory == ""){
            $arrErr['inventory'] = "在庫を入力してください";
        }
        
        //  // タグチェック
        // if($sTag == ""){
        //     $arrErr['tag'] = "タグを追加してください";
        // }

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
        $bRet = insertMember($sPrice, $sName,$sInventory, $sTag);

        //DB登録エラーがある場合は最初のステップに戻す
        if($bRet == false){
            $nStepFlg = "";
        }
    }

//**************************************************
// HTML表示
//**************************************************
    if($nStepFlg == ""){
        require_once('../view/insert.html');
    } else if ($nStepFlg == 1) {
        require_once('../view/insertCheck.html');
    } else if ($nStepFlg == 2) {
        require_once('../view/insertOK.html');
    }
?>
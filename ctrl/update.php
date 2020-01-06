<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
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

    $nStepFlg = isset($_POST['step']) ? $_POST['step'] : "";

    //ID
    $sItemId = isset($_POST['id']) ? $_POST['id'] : "";

    //商品名
    $sName = isset($_POST['name']) ? $_POST['name'] : "";

    //価格
    $sPrice = isset($_POST['price']) ? $_POST['price'] : "";
    
     //在庫
    $sInventory = isset($_POST['inventory']) ? $_POST['inventory'] : "";

    if($nStepFlg == 2){
        $sImage = isset($_POST['image']) ? $_POST['image'] : null;
    }
    else{
        if(!empty($_FILES['image'])  && !empty($_FILES['image']['name'])){
            $fp = fopen($_FILES['image']['tmp_name'], "rb");
            $sImage = fread($fp, filesize($_FILES['image']['tmp_name']));
            fclose($fp);
        }
        else{
            $itemArr = selectMember($sItemId);
            $sImage = $itemArr[0]['image'];
        }
    }

    
     //タグ
    $sTag = isset($_POST['tag']) ? $_POST['tag'] : "";

    //処理ステップ


//**************************************************
// STEP0（検索処理）
//**************************************************
    if($nStepFlg == ""){
        //メンバー情報の取得
        $arrResult = selectMember($sItemId);

        //商品名
        $sName = $arrResult[0]['name'];

        //価格
        $sPrice = $arrResult[0]['price'];
        
        //在庫
        $sInventory = $arrResult[0]['inventory'];

        $sImage = $arrResult[0]['image'];
        
        //タグ
        $sTag = $arrResult[0]['tag'];
    }

//**************************************************
// STEP1（確認画面）
//**************************************************
    if($nStepFlg == 1 || $nStepFlg == 2){

        // 商品名チェック
        if($sName == ""){
            $arrErr['name'] = "商品名を入力してください";
        }
        // else if(mb_strlen($sName, "UTF-8") > 10) {
        //     $arrErr['name'] = "商品名は10文字以内で入力してください";
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
        
         // タグチェック
        if($sTag == ""){
            $arrErr['tag'] = "タグを入力してください";
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
        $imageBinary = file_get_contents($sImage);
        //データ登録
        $bRet = updateMember($sItemId, $sPrice, $sName,$sInventory, $imageBinary, $sTag);

        //DB登録エラーがある場合は最初のステップに戻す
        if($bRet == false){
            $nStepFlg = "";
        }
    }

//**************************************************
// HTMLを出力
//**************************************************
    if($nStepFlg == ""){
        require_once('../view/update.html');
    } else if ($nStepFlg == 1) {
        require_once('../view/updateCheck.html');
    } else if ($nStepFlg == 2) {
        require_once('../view/updateOK.html');
    }
?>

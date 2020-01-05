<?php
/****************************************
 * 商品取得
 * $sItemId：商品ID（未指定は空白）
 * $sName：苗字（未指定は空白）
 ****************************************/
function selectMember($sItemId = "", $sName = ""){

	//初期化
	$arrResult = array();

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {
		//変数の準備
		$sSql  = "";
		$sWhere = "";
	
		//データ検索のSQLを作成
		$sSql .= "SELECT ";
		$sSql .= "	 * ";
		$sSql .= "FROM ";
		$sSql .= "	 items ";
		
		//データ検索の条件
		if($sItemId != ""){
			//ID
			$sWhere .= ($sWhere == "") ? "WHERE " : "AND ";
			$sWhere .= "id = :id ";
		}
		if($sName != ""){
			//商品名
			$sWhere .= ($sWhere == "") ? "WHERE " : "AND ";
			$sWhere .= "name LIKE :name ";
		}
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sSql.$sWhere);
		
		//バインドの実行
		if($sItemId != ""){
			//ID
			$stmh->bindValue(':id',  $sItemId, PDO::PARAM_INT);
		}
		if($sName != ""){
			//商品名
			$stmh->bindValue(':name',  "%".$sName."%", PDO::PARAM_STR);
		}

		//SQL文の実行
		$stmh->execute();
		
		//実行結果を取得
		$arrResult = $stmh->fetchAll(PDO::FETCH_ASSOC);
	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");
	}
	
	return $arrResult;

}

/****************************************
 * 商品登録
 * $sPrice：価格
 * $sName：商品名
 ****************************************/
function insertMember($sPrice, $sName, $sInventory, $sTag){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {
		//データ検索の条件
		$sql = "INSERT INTO items (name, price, inventory, tag)
				VALUES (:name, :price, :inventory, :tag)";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':name',  $sName,  PDO::PARAM_STR);
		$stmh->bindValue(':price', $sPrice, PDO::PARAM_STR);
		$stmh->bindValue(':inventory', $sInventory, PDO::PARAM_STR);
		$stmh->bindValue(':tag', $sTag, PDO::PARAM_STR);
		
		//SQL文の実行
		$stmh->execute();

		//登録成功を返却
		return true;

	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");
	
		//登録失敗����返却
		return false;

	}

}

/****************************************
 * 商品更新
 * $sItemId：商品ID
 * $sPrice：価格
 * $sName：商品名
 ****************************************/
function updateMember($sItemId, $sPrice, $sName, $sInventory, $sTag){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {

		//データ検索の条件
		$sql = "UPDATE items 
				SET
					name = :name, 
				    price = :price,
				    inventory = :inventory,
				    tag = :tag
				WHERE
					id = :id
		";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':id',  $sItemId,  PDO::PARAM_INT);
		$stmh->bindValue(':name',  $sName,  PDO::PARAM_STR);
		$stmh->bindValue(':price', $sPrice, PDO::PARAM_STR);
		$stmh->bindValue(':inventory', $sInventory, PDO::PARAM_STR);
		$stmh->bindValue(':tag', $sTag, PDO::PARAM_STR);
		
		//SQL文の実行
		$stmh->execute();
		
		//登録成功を返却
		return true;
	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");

		//登録失敗を返却
		return false;

	}

}

/****************************************
 * 商品削除
 * $sItemId：商品ID
 ****************************************/
function deleteMember($sItemId){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {

		//データ検索の条件
		$sql = "DELETE FROM items 
				WHERE  id = :id
		";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':id', $sItemId,  PDO::PARAM_INT);
		
		//SQL文の実行
		$stmh->execute();
		
		//登録成功を返却
		return true;
	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");
	
		//登録失敗を返却
		return false;

	}

}

?>
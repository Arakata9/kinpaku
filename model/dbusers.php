<?php
/****************************************
 * 会員取得
 * $sUserId：会員userId（未指定は空白）
 * $sUserName：苗字（未指定は空白）
 ****************************************/
function selectUser($sUserId = "", $sUserName = ""){

	//初期化
	$arrResultUsers = array();

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
		$sSql .= "	users ";
		
		//データ検索の条件
		if($sUserId != ""){
			//userId
			$sWhere .= ($sWhere == "") ? "WHERE " : "AND ";
			$sWhere .= "userId = :userId ";
		}
		if($sUserName != ""){
			//会員名
			$sWhere .= ($sWhere == "") ? "WHERE " : "AND ";
			$sWhere .= "userName LIKE :userName ";
		}
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sSql.$sWhere);
		
		//バインドの実行
		if($sUserId != ""){
			//userId
			$stmh->bindValue(':userId',  $sUserId, PDO::PARAM_INT);
		}
		if($sUserName != ""){
			//会員名
			$stmh->bindValue(':userName',  "%".$sUserName."%", PDO::PARAM_STR);
		}

		//SQL文の実行
		$stmh->execute();
		
		//実行結果を取得
		$arrResultUsers = $stmh->fetchAll(PDO::FETCH_ASSOC);
	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");
	}
	
	return $arrResultUsers;

}

/****************************************
 * 会員登録
 * $sMail：価格
 * $sUserName：会員名
 ****************************************/
function insertUser($sMail, $sUserName, $sPassword, $sAddress ,$sTel){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {
		//データ検索の条件
		$sql = "INSERT INTO users (userName, mail, password, address, tel)
				VALUES (:userName, :mail, :password, :address, :tel)";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':userName',  $sUserName,  PDO::PARAM_STR);
		$stmh->bindValue(':mail', $sMail, PDO::PARAM_STR);
		$stmh->bindValue(':password', $sPassword, PDO::PARAM_STR);
		$stmh->bindValue(':address', $sAddress, PDO::PARAM_LOB);
		$stmh->bindValue(':tel', $sTel, PDO::PARAM_STR);
		
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
 * 会員更新
 * $sUserId：会員userId
 * $sMail：価格
 * $sUserName：会員名
 ****************************************/
function updateUser($sUserId, $sMail, $sUserName, $sPassword, $sAddress, $sTel){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {

		//データ検索の条件
		$sql = "UPDATE users 
				SET
					userName = :userName, 
				    mail = :mail,
				    password = :password,
					address = :address,
				    tel = :tel
				WHERE
					userId = :userId
		";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':userId',  $sUserId,  PDO::PARAM_INT);
		$stmh->bindValue(':userName',  $sUserName,  PDO::PARAM_STR);
		$stmh->bindValue(':mail', $sMail, PDO::PARAM_STR);
		$stmh->bindValue(':password', $sPassword, PDO::PARAM_STR);
		$stmh->bindValue(':address', $sAddress, PDO::PARAM_STR);
		$stmh->bindValue(':tel', $sTel, PDO::PARAM_STR);
		
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
 * 会員削除
 * $sUserId：会員userId
 ****************************************/
function deleteUser($sUserId){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {

		//データ検索の条件
		$sql = "DELETE FROM users 
				WHERE  userId = :userId
		";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':userId', $sUserId,  PDO::PARAM_INT);
		
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
<?php

//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("funcs.php");
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    sql_error();
}else{
    $r = $stmt->fetch(); //1行だけ取得
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>bookit|edit data</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>本を編集するか？</legend>
     <label>書籍名：<input  value="<?=$r["book"]?>" type="text" name="book"></label><br>
     <label>url：<input type="text" name="url" value="<?=$r["url"]?>"></label><br>
     <label>comment:<br><textArea name="memo" rows="4" cols="40"><?=$r["memo"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$r["id"]?>">
     <input type="submit" value="この内容でUPDATEする">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<div><a href="select.php">一覧 selectへ飛ぶ</a></div>
</body>
</html>

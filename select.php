<?php
//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    // $view .= '<p>'.$r["id"].$r["book"].$r["url"].$r["memo"].$r["indate"].'</p>';
    // $view .= '<tr><th>'.$r["id"].'</th><th>'.$r["book"].'</th><th><a href="'.$r["url"].'">'.$r["book"].'</a></th><th>'.$r["memo"].'</th><th>'.$r["indate"].'</th><th><a href="delete.php?id='.$r["id"].'">削除</a>'.'</th></tr>';
    $view .= '<th>'.$r["id"].'</th>';
    $view .= '<th><a href="'.$r["url"].'">'.$r["book"].'</a></th>';
    $view .= '<th><a href="detail.php?id='.$r["id"].'">詳細</a>'.'</th>';
    // $view .= '<th>'.$r["book"].'</th>';
    $view .= '<th>'.$r["memo"].'</th>';
    // $view .= '<th>'.$r["indate"].'</th>';
    $view .= '<th><a href="delete.php?id='.$r["id"].'">削除</a>'.'</th></tr>';
    
    $json .= json_encode($r);//jsonに渡す実験（JavaScript）
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>bookit|details</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <table border="1" width="auto" cellspacing="0" cellpadding="5" bordercolor="#333333">
    <tr><th>id</th><th>book name</th><th>detail</th><th>memo</th><th>del</th><th>edit</th><tr>
    <?=$view?>
    </table>
    </div>
</div>
<!-- Main[End] -->

<!-- JavaScriptテスト -->
<script>

const data = JSON.parse('<?=$json?>');
console log(data);

</script>
<!-- JavaScriptテスト -->

<div><a href="index.php">登録画面へ戻る</a></div>

</body>
</html>

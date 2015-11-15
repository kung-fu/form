<?php



include_once "validation/ValidateManager.php";

// POSTで送信されたデータを取得
if( is_array($_POST) ){
    $data = array();
    foreach($_POST AS $key=>$str){
        $str = htmlspecialchars($str , ENT_QUOTES , "UTF-8");
        $data[$key] = $str;
    }
}

// Validation判定 ここはプロジェクトごとに変更うすr
$manager = new ValidateManager();
$manager->isCompany($data);
$manager->isName($data);
$manager->isNameKana($data);
$manager->isMail($data);
$manager->isType($data);
$manager->isMessage($data);

$manager->isTel($data);
$manager->isAge($data);
$manager->isSex($data);
$manager->isCategory($data);

// 出力
header('Content-Type: application/json');
if($manager->isSuccess()){
    $json[] = array("success" => $manager->isSuccess());
    $json[] = array("error" => $manager->getErrors());
    echo json_encode( $json );
}
else {
    $json[] = array("error" => $manager->getErrors());
    // http_response_code(400);
    header('HTTP/1.1 400 error');
    echo json_encode( $json );
}

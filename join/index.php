<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

if (empty($_SESSION['join'])) {
    $_SESSION['join']['name'] = "";
    $_SESSION['join']['email'] = "";
    $_SESSION['join']['password'] = "";
}

// index.html内のキーワードをまとめた配列
$keywords = [
    'post_name' => $_SESSION['join']['name'],
    'post_email' => $_SESSION['join']['email'],
    'post_password' => $_SESSION['join']['password'],
    'err_name' => '',
    'err_email' => '',
    'err_password' => '',
    'err_password_length' => '',
    'err_image' => '',
    'err_image_type' => ''
];

// エラーが発生したかどうか判定するフラグ
$error = false;
$duplicatecheck = false;

if (!empty($_POST)) {

    //エラー項目の確認
    if ($_POST['name'] == '') {
        $keywords['err_name'] = 'ニックネームを入力してください';
        $error = true;
    }else{
        $keywords['post_name'] = $_POST['name'];
    }

    if ($_POST['email'] == '') {
        $keywords['err_email'] = 'メールアドレスを入力してください';
        $error = true;
    }else{
        $keywords['post_email'] = $_POST['email'];
    }

    if (strlen($_POST['password']) < 4) {
        $keywords['err_password_length'] = 'パスワードは４文字以上で入力してください';
        $error = true;
    }else{
        $keywords['post_password'] = $_POST['password'];
    }

    if ($_POST['password'] == '') {
        $keywords['err_password'] = 'パスワードを入力してください';
        $error = true;
    }else{
        $keywords['post_password'] = $_POST['password'];
    }

    if(isset($_FILES['image']['name'])){
        $fileName = $_FILES['image']['name'];
    }

    if (!empty($fileName)) {
        $ext = substr($fileName , -3);
        if ($ext != 'jpg' && $ext != 'gif') {
            $keywords['err_image_type'] = '* 写真などは「.gif」または「.jpg」の画像を設定してください';
            $error = true;
        }
    }

    if(!$error){
        $db = new database();
        $db->setSQL('SELECT * FROM `users` WHERE `email` = :email');
        $db->setBindArray(['email' => $_POST['email']]);
        $db->execute();
        $record = $db->fetch();
        if($record){
            $keywords['err_email'] = '指定されたメールアドレスはすでに登録されています';
            $duplicatecheck = true;
        }
    }

    // $error != true の省略
    if (!$error && !$duplicatecheck) {
        //画像をアップロードする
        if (!empty($fileName)) {
            $fp = fopen($_FILES['image']['tmp_name'], "rb");
            $img = fread($fp, filesize($_FILES['image']['tmp_name']));
            fclose($fp);

            $enc_img = base64_encode($img);

            $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);

            $image = date('YmdHis') . $_FILES['image']['name'];
            //move_uploaded_file($_FILES['image']['tmp_name'] , '../member_picture/'. $image); //ファイルパス変更。
            move_uploaded_file($_FILES['image']['tmp_name'] , '../member_picture/'. $image);
        }
        $_SESSION['join'] = $_POST;
        $_SESSION['join']['path'] = $imginfo['mime'];
        $_SESSION['join']['path_img'] = $enc_img;
        //$_SESSION['join']['image'] =  $_FILES['image']['tmp_name'];
        $_SESSION['join']['image'] =  $_FILES['image'];
        $_SESSION['join']['img_name'] = date('YmdHis') . $_FILES['image']['name'];

        header('Location: check.php');
        exit();
    }else{
        $keywords['err_image'] = '* 恐れ入りますが、画像を改めて指定してください';
    }
}

$html = create_page(
    $root . 'join/templates/join.html',
    'ユーザー登録',
    [],
    $keywords
);

// 中身を置き換え終わったファイルを出力する
print($html);

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

$keywords = [
    'member_name' => '',
    'member_picture' => '',
    'follow' => '',
    'follower' => '',
];

if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //ログインしている
    $_SESSION['time'] = time();
    $db = new database();
    $db->setSQL('SELECT * FROM `users` WHERE `id`=?;');
    $db->setBindArray([$_SESSION['id']]);
    $db->execute();
    $member = $db->fetch();

    $db->setSQL('SELECT * FROM `follows` WHERE `from_id` = ?');
    $db->setBindArray([$_SESSION['id']]);
    $db->execute();
    $follow = $db->fetchAll();

    $db->setSQL('SELECT * FROM `follows` WHERE `to_id` = ?;');
    $db->setBindArray([$_SESSION['id']]);
    $db->execute();
    $follower = $db->fetchAll();
} else {
    //ログインしていない
    header('Location: ../login/index.php');
    exit;
}

$ext = substr($member['picture'] , -3);

if($ext == 'jpg' or $ext == 'gif') {
    //$keywords['member_picture'] = $member['picture'];?>
    <img src="../member_picture/<?php echo($member['picture']);?>" height="200" width="200">
<?php
}

$keywords['member_name'] = $member['name'];
//$keywords['member_picture'] = $member['picture'];

$keywords['follow'] = count($follow);
$keywords['follower'] = count($follower);
$html = create_page(
    $root . 'account/templates/user_page.html',
    'ユーザーページ',
    [],
    $keywords
);

print($html);

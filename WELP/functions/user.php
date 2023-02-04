<?php

/**
 * 
 * ユーザーに関する関数ファイル。
 * 
 * 作成者：西島
 * 
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'classes/database.php');
require_once($root . 'classes/user.php');

function createUser(string $name, string $email, string $password, int $picture_id) : void
{
    $db = new Database();
    $db->setSQL('INSERT INTO `users` SET `name`=:name, `email`=:email, `password`=:password, `picture_id`=:picture_id;');
    $db->setBindArray([
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'picture_id' => $picture_id
    ]);
    $db->execute();
}

function deleteUser(User $user) : void
{
    $db = new Database();
    $db->setSQL('DELETE FROM `users` WHERE `id` = ?;');
    $db->setBindArray([$user->getId()]);
    $db->execute();
}

function getAllUsers() : array
{
    $db = new Database();
    $db->setSQL('SELECT * FROM `users`;');
    $db->execute();
    $users = $db->fetchAll();
    $list = [];

    foreach($users as $user){
        $list[] = new User(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['picture_id'],
            $user['is_admin'],
            $user['created_at'],
            $user['updated_at']
        );
    }

    return $list;

}

function getUserFromEmail(string $email) : ?User
{

    $db = new Database();
    $db->setSQL('SELECT * FROM `users` WHERE `email` LIKE ?;');
    $db->setBindArray([$email]);
    $db->execute();
    $user = $db->fetch();

    if(!$user){
        return null;
    }

    return new User(
        $user['id'],
        $user['name'],
        $user['email'],
        $user['picture_id'],
        $user['is_admin'],
        $user['created_at'],
        $user['updated_at']
    );

}

function getUserFromId(int $id) : ?User
{

    $db = new Database();
    $db->setSQL('SELECT * FROM `users` WHERE `id` = ?;');
    $db->setBindArray([$id]);
    $db->execute();
    $user = $db->fetch();

    if(!$user){
        return null;
    }

    return new User(
        $user['id'],
        $user['name'],
        $user['email'],
        $user['picture_id'],
        $user['is_admin'],
        $user['created_at'],
        $user['updated_at']
    );

}

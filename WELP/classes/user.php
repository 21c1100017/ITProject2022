<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'classes/database.php');

class User
{
    private $id;
    private $name;
    private $email;
    private $picture;
    private $created_at;
    private $updated_at;

    public function __construct($id, $name, $email, $picture, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->picture = $picture;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function favorite(int $post_id) : void
    {
        $db = new Database();
        $db->setSQL('INSERT IGNORE INTO `favorites` (`user_id`, `post_id`) VALUES (?, ?);');
        $db->setBindArray([$this->id, $post_id]);
        $db->execute();
    }

    public function isFavorite(int $post_id) : bool
    {
        $db = new Database();
        $db->setSQL('SELECT `id` FROM `favorites` WHERE `user_id` = ? AND `post_id` = ?;');
        $db->setBindArray([$this->id, $post_id]);
        $db->execute();
        $res = $db->fetch();

        if(!$res){
            return false;
        }else{
            return true;
        }
    }

    public function unFavorite(int $post_id) : void
    {
        $db = new Database();
        $db->setSQL('DELETE FROM `favorites` WHERE `post_id` = ?;');
        $db->setBindArray([$post_id]);
        $db->execute();
    }

    public function follow(User $to_user) : void
    {
        $db = new Database();
        $db->setSQL('INSERT INTO `follows` (`from_id`, `to_id`) VALUES (?, ?)');
        $db->setBindArray([$this->id, $to_user->getId()]);
        $db->execute();
    }

    public function unFollow(User $to_user) : void
    {
        $db = new Database();
        $db->setSQL('DELETE FROM `follows` WHERE `from_id` = ? AND `to_id` = ?');
        $db->setBindArray([$this->id, $to_user->getId()]);
        $db->execute();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
        $this->save();
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
        $this->save();
    }

    public function setPicture(string $picture) : void
    {
        $this->picture = $picture;
        $this->save();
    }

    public function save() : void
    {
        $db = new Database();
        $db->setSQL('UPDATE `users` SET `name` = :name, `email` = :email, `picture` = :picture, `updated_at` = NOW();');
        $db->setBindArray([
            'name' => $this->name,
            'email' => $this->email,
            'picture' => $this->picture
        ]);
        $db->execute();
    }
}

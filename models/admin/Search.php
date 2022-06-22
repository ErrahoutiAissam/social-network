<?php

namespace App\Admin\Models;

class Search extends Model
{
    public function __construct()
    {
    }

    public function getUsers($query)
    {
        $users = $this->requete("SELECT * FROM users
        WHERE users.firstname LIKE '%$query%'
          OR users.lastname LIKE '%$query%'
          OR users.username LIKE '%$query%'
          OR users.email LIKE '%$query%'")->fetchAll();

        return $users;
    }

    public function getPosts($query)
    {
        $posts = $this->requete("SELECT posts.id, posts.create_at, posts.content, posts.id_user, users.firstname, users.lastname FROM posts
        INNER JOIN users ON users.id = posts.id_user
        WHERE posts.content LIKE '%$query%'
          OR users.firstname LIKE '%$query%'
          OR users.lastname LIKE '%$query%'
          OR users.username LIKE '%$query%'")->fetchAll();

        return $posts;
    }
}

<?php

  class Posts extends Model {
    public function __construct() {
      $this->table = 'posts';
    }

    public function findByFollowers($id) {
      return $this->requete('SELECT T.id, T.content, T.id_user, T.create_at, T.nbr_likes, T.liked, F.id_following, users.username, users.lastname, users.firstname
        FROM (SELECT * FROM follows WHERE follows.id_follower = ?) F
        INNER JOIN (SELECT P.id, P.content, P.id_user, P.create_at, COUNT(*) as `nbr_likes`,
          (? IN (SELECT likes.id_user FROM likes WHERE likes.id_post = P.id)) as `liked`
          FROM posts P
          INNER JOIN likes ON likes.id_post = P.id
          GROUP BY P.id
          
          UNION
          
          SELECT posts.id, posts.content, posts.id_user, posts.create_at, 0 as `nbr_likes`, false as `liked`
          FROM posts WHERE posts.id NOT IN (SELECT likes.id_post FROM likes)) T
        ON T.id_user = F.id_following
        INNER JOIN users
          ON users.id = F.id_following
        ORDER BY T.create_at DESC', [$id, $id])->fetchAll();
    }
  }
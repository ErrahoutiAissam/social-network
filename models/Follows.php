<?php

  class Follows extends Model {
    public function __construct() {
      $this->table = 'follows';
    }

    public function findAll() {
      return $this->requete('SELECT follows.id, follows.id_follower, follows.id_following, follows.follow_at,
          T.firstname as `follower_firstname`, T.lastname as `follower_lastname`,
          U.firstname as `following_firstname`, U.lastname as `following_lastname`
        FROM follows
        INNER JOIN users U ON U.id = follows.id_follower
        INNER JOIN users T ON T.id = follows.id_following')->fetchAll();
    }

    public function find(int $id) {
      return $this->requete('SELECT follows.id, follows.id_follower, follows.id_following, follows.follow_at,
          T.firstname as `follower_firstname`, T.lastname as `follower_lastname`,
          U.firstname as `following_firstname`, U.lastname as `following_lastname`
        FROM follows
        INNER JOIN users U ON U.id = follows.id_follower
        INNER JOIN users T ON T.id = follows.id_following
        WHERE follows.id = ?', [$id])->fetch();
    }

    public function findBy(array $criteres) {
      $champs = [];
      $valeurs = [];

      // On boucle pour "éclater le tableau"
      foreach($criteres as $champ => $valeur){
          $champs[] = "$champ = ?";
          $valeurs[]= $valeur;
      }

      // On transforme le tableau en chaîne de caractères séparée par des AND
      $liste_champs = implode(' AND ', $champs);

      // On exécute la requête
      return $this->requete("SELECT follows.id, follows.id_follower, follows.id_following, follows.follow_at,
          T.firstname as `follower_firstname`, T.lastname as `follower_lastname`, T.username as `follower_username`,
          U.firstname as `following_firstname`, U.lastname as `following_lastname`, U.username as `following_username`
        FROM follows
        INNER JOIN users U ON U.id = follows.id_follower
        INNER JOIN users T ON T.id = follows.id_following
        WHERE $liste_champs", $valeurs)->fetchAll();
    }
  }
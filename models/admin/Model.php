<?php

  namespace App\Admin\Models;

  use App\Db\Db;

  abstract class Model extends Db {
    protected $table;

    private $db;

    public function requete(string $sql, array $attributs = null) {
        $this->db = Db::getInstance();

        if ($attributs !== null) {
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else
            return $this->db->query($sql);
    }

    public function findAll() {
        $query = $this->requete('SELECT * FROM '.$this->table);
        return $query->fetchAll();
    }

    public function findWithLimit($limit, $order = 'ASC') {
        if ($order != 'ASC' && $order != 'DESC')
            $order = 'ASC';

        $query = $this->requete('SELECT * FROM ' . $this->table . ' ORDER BY ' . $order . ' LIMIT ' . $limit);
        return $query->fetchAll();
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
        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }

    public function find(int $id) {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    public function create($model) {
        $champs = [];
        $inter = [];
        $valeurs = [];

        foreach($model as $champ => $valeur){
            $champs[] = $champ;
            $inter[] = "?";
            $valeurs[] = $valeur;
        }

        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        return $this->requete('INSERT INTO '.$this->table.' ('. $liste_champs.') VALUES('.$liste_inter.')', $valeurs);
    }

    public function update(int $id, $array = []) {
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($array as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        $valeurs[] = $id;

        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);

        // On exécute la requête
        return $this->requete('UPDATE '. $this->table .' SET '. $liste_champs.' WHERE id = ?', $valeurs);
    }

    /**
     * Suppression d'un enregistrement
     * @param int $id id de l'enregistrement à supprimer
     * @return bool 
     */
    public function delete(int $id) {
      return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }
  }

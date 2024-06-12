<?php

class RecetteDB
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajout_recette($nom, $description, $nbre_part, $temps, $idchef, $niveau, $categorie)
    {
        try {
            $query = "select ajout_recette(:nom,:description,:nbre_part,:temps,:idchef,:niveau,:categorie)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':nom', $nom);
            $res->bindValue(':description', $description);
            $res->bindValue(':nbre_part', $nbre_part);
            $res->bindValue(':temps', $temps);
            $res->bindValue(':idchef', $idchef);
            $res->bindValue(':niveau', $niveau);
            $res->bindValue(':categorie', $categorie);
            $res->execute();
            $data = $res->fetch();
            $this->_bd->commit();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
            return 0;
        }
    }
    public function noter($recette,$note){
        try {
            $query = "select noter(:recette,:note)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':recette', $recette);
            $res->bindValue(':note', $note);
            $res->execute();
            $data = $res->fetch();
            $this->_bd->commit();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
            return 0;
        }


    }

    public function getRecttes($cond)
    {
        try {
            $query = "select * from recette";
            $query.=$cond;
            $query.=" order by nom_recette ";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetchAll();
            if (!empty($data)) {
                foreach ($data as $d) {
                    $_array[] = new Recette($d);
                }
                return $_array;
            } else {
                return null;
            }

            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }

    }
    public function getNote($rec)
    {
        try {
            $query = "select AVG(note) from note where id_recette=:id";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id', $rec);
            $res->execute();
            $data = $res->fetchAll();
            if (!empty($data)) {
                foreach ($data as $d) {
                    $_array[] = $d;
                }
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }

    }


}


<?php

class CompositionDB
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajout_ingredient($idrecette, $ingredient, $quantite, $unite)
    {
        try {
            $query = "select ajout_ingredient(:idrecette,:ingredient,:quantite,:unite)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':idrecette', $idrecette);
            $res->bindValue(':ingredient', $ingredient);
            $res->bindValue(':quantite', $quantite);
            $res->bindValue(':unite', $unite);
            $res->execute();
            $this->_bd->commit();
            $data = $res->fetch();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }

    public function derniereRecette()
    {
        try {
            $query = "select max(id_recette) from recette";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetch();
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

    public function getIngredients($id_rec)
    {
        $query = "select * from composition";
        $query .= " where id_recette = :id_rec";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':id_rec', $id_rec);
            $resultset->execute();
            $data = $resultset->fetchAll();
            //var_dump($data);
            if (!empty($data)) {
                foreach ($data as $d) {
                    $_array[] = new Composition($d);
                }
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print "Echec de la requête " . $e->getMessage();
        }

    }
    public function getDetailRecette($id_rec)
    {
        $query = "select * from recette";
        $query .= " where id_recette = :id_rec";
        try {
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':id_rec', $id_rec);
            $resultset->execute();
            $data = $resultset->fetchAll();
            //var_dump($data);
            if (!empty($data)) {
                foreach ($data as $d) {
                    $_array[] = new Recette($d);
                }
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print "Echec de la requête " . $e->getMessage();
        }

    }
}


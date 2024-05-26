<?php

class RecetteDB
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajout_recette($nom,$description,$nbre_part,$photo,$temps,$idchef,$niveau,$categorie){
        try{
            $query="select ajout_recette(:nom,:description,:nbre_part,:photo,:temps,:idchef,:niveau,:categorie)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':nom',$nom);
            $res->bindValue(':desciption',$description);
            $res->bindValue(':nbre_part',$nbre_part);
            $res->bindValue(':photo',$photo);
            $res->bindValue(':temps',$temps);
            $res->bindValue(':idchef',$idchef);
            $res->bindValue(':niveau',$niveau);
            $res->bindValue(':categorie',$categorie);
            $res->execute();
            $this->_bd->commit();
            $data = $res->fetch();
            return $data;
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }

}


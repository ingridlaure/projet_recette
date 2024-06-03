<?php

class CompositionDB
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajout_ingredient($idrecette,$ingredient,$quantite,$unite){
        try{
            $query="select ajout_ingredient(:idrecette,:ingredient,:quantite,:unite)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':idrecette',$idrecette);
            $res->bindValue(':ingredient',$ingredient);
            $res->bindValue(':quantite',$quantite);
            $res->bindValue(':unite',$unite);
            $res->execute();
            $this->_bd->commit();
            $data = $res->fetch();
            return $data;
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }

    public function derniereRecette(){
        try{
            $query="select max(id_recette) from recette";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetch();
            if(!empty($data))  {
                foreach($data as $d) {
                    $_array[] = $d;
                }
                return $_array;
            }
            else{
                return null;
            }
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();

        }
    }

}


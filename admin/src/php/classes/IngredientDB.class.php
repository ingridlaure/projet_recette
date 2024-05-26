<?php

class IngredientDB
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function deleteIngredient($id){
        $query="select delete_ingredient(:id)";
        try{
            $this->_bd->beginTransaction();
            $res=$this->_bd->prepare($query);
            $res->bindValue(':id',$id);
            $res->execute();
            $this->_bd->commit();
        }catch(PDOException $e){
            print("Echec ".$e->getMessage());

        }
    }

    public function getAllIngredient(){
        try{
            $query="select * from ingredient order by nom_ingredient";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetchAll();
            if(!empty($data))  {
                foreach($data as $d) {
                    $_array[] = new Ingredient($d);
                }
                return $_array;
            }
            else{
                return null;
            }

            return $data;
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }

}


<?php

class ChefDB
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajout_chef($nom,$prenom,$experience,$email,$telephone,$adresse){
        try{
            $query="select ajout_chef(:nom,:prenom,:experience,:email,:telephone,:adresse)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':nom',$nom);
            $res->bindValue(':prenom',$prenom);
            $res->bindValue(':experience',$experience);
            $res->bindValue(':email',$email);
            $res->bindValue(':telephone',$telephone);
            $res->bindValue(':adresse',$adresse);
            $res->execute();
            $this->_bd->commit();
            $data = $res->fetch();
            return $data;
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }
    public function updateChef($id,$champ,$valeur){
        //$query= "update client set $champ='$valeur' where id_client=$id";
        $query="select update_chef(:id,:champ,:valeur)";
        try{
            $this->_bd->beginTransaction();
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id',$id);
            $res->bindValue(':champ',$champ);
            $res->bindValue(':valeur',$valeur);
            $res->execute();
            $this->_bd->commit();
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }

    public function deleteChef($id){
        $query="select delete_chef(:id)";
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

    public function getAllChefs(){
        try{
            $query="select * from chef order by nom_chef";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetchAll();
            if(!empty($data))  {
                foreach($data as $d) {
                    $_array[] = new Chef($d);
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


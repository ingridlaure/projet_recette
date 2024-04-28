<?php

class UserDB extends User
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getUser($login,$password)
    {
        $query = "select verifier_user(:login,:password) as retour"; //retour pour 1 ou 0 retourné
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':login',$login);
            $resultset->bindValue(':password',$password);
            $resultset->execute();
            return $resultset->fetchColumn(0);
            //$this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Echec de la requête " . $e->getMessage();
        }
    }



}

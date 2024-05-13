<?php


class Autoloader
{
//fonction avec callback
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

//méthode appelée par register()
    static function autoload($classname)
    {
        require $classname . ".class.php";
    }
}
/*
 *  SYNTHAXE POUR CREER DES FONCTIONS DANS POSTGRE SQL
 * create or replace function ajout_chef(vnom text,vprenom text, vanneeexp integer, vemail text, vtelephone integer,vadresse text)
returns int
language plpgsql
as

$$
declare
retour integer;
num integer;
begin
	select id_chef into num from chef where email=vemail;
	if not found then
		insert into chef(nom_chef,prenom_chef,annee_exp,email,telephone,adresse)
		values(vnom,vprenom,vanneeexp,vemail,vtelephone,vadresse);
		select id_chef into num from chef where email=vemail;
		if not found then
	 		retour=-1;--/echec de la rquete
		 else
	 		retour =1;--réussite de la requette
		end if ;
	else
		retour=0; -- déja existant
	end if;
	return 0;
end;
$$
$$;
 *
 * */

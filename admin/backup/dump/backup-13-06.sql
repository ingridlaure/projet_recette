--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1
-- Dumped by pg_dump version 16.1

-- Started on 2024-06-13 18:52:53

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 4906 (class 1262 OID 25095)
-- Name: projet_recette; Type: DATABASE; Schema: -; Owner: anonyme
--

CREATE DATABASE projet_recette WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'French_Belgium.1252';


ALTER DATABASE projet_recette OWNER TO anonyme;

\connect projet_recette

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- TOC entry 4907 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 230 (class 1255 OID 25183)
-- Name: ajout_chef(text, text, integer, text, integer, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_chef(vnom text, vprenom text, vanneeexp integer, vemail text, vtelephone integer, vadresse text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
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
	return retour;
end;
$$;


ALTER FUNCTION public.ajout_chef(vnom text, vprenom text, vanneeexp integer, vemail text, vtelephone integer, vadresse text) OWNER TO anonyme;

--
-- TOC entry 233 (class 1255 OID 25193)
-- Name: ajout_chef(text, text, text, text, text, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_chef(vnom text, vprenom text, vanneeexp text, vemail text, vtelephone text, vadresse text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
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
$$;


ALTER FUNCTION public.ajout_chef(vnom text, vprenom text, vanneeexp text, vemail text, vtelephone text, vadresse text) OWNER TO anonyme;

--
-- TOC entry 229 (class 1255 OID 25209)
-- Name: ajout_ingredient(integer, text, integer, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_ingredient(vidrecette integer, vingredient text, vquantite integer, vunite text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
retour integer;
num integer;
begin
	insert into composition(ingredient,quantite,unite,id_recette)
	values(vingredient,vquantite,vunite,vidrecette);
	select max(id_composition) into retour from composition;
	if not found then 
	retour=-1;
	else
	retour=1;
	end if;
	return retour;
end;
$$;


ALTER FUNCTION public.ajout_ingredient(vidrecette integer, vingredient text, vquantite integer, vunite text) OWNER TO anonyme;

--
-- TOC entry 245 (class 1255 OID 33413)
-- Name: ajout_note(integer, integer); Type: PROCEDURE; Schema: public; Owner: anonyme
--

CREATE PROCEDURE public.ajout_note(IN vid_recette integer, IN vnote integer)
    LANGUAGE plpgsql
    AS $$
declare

begin
insert into note(id_recette,note) values(vid_recette,vnote);
	
end;
$$;


ALTER PROCEDURE public.ajout_note(IN vid_recette integer, IN vnote integer) OWNER TO anonyme;

--
-- TOC entry 238 (class 1255 OID 33405)
-- Name: ajout_recette(text, text, text, text, integer, text, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_recette(vnom text, vdescription text, vnbre_part text, vtemps text, vchef integer, vniveau text, vcategorie text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
retour integer;
num integer;
begin
	insert into recette(nom_recette,description,nbre_part,temp_cuiss,id_chef,niveau,categorie)
	values(vnom,vdescription,vnbre_part,vtemps,vchef,vniveau,vcategorie);
	select max(id_recette) into retour from recette;
	return retour;
end;
$$;


ALTER FUNCTION public.ajout_recette(vnom text, vdescription text, vnbre_part text, vtemps text, vchef integer, vniveau text, vcategorie text) OWNER TO anonyme;

--
-- TOC entry 232 (class 1255 OID 25192)
-- Name: delete_chef(integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.delete_chef(vid integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
	declare retour integer;
	--declarer id integer;
	
Begin
	delete from chef where id_chef=vid;
	-- verifier le delete
	return 1;
end;
$$;


ALTER FUNCTION public.delete_chef(vid integer) OWNER TO anonyme;

--
-- TOC entry 247 (class 1255 OID 33414)
-- Name: noter(integer, integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.noter(vid_recette integer, vnote integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare

begin
insert into note(id_recette,note) values(vid_recette,vnote);
return 1;
	
end;
$$;


ALTER FUNCTION public.noter(vid_recette integer, vnote integer) OWNER TO anonyme;

--
-- TOC entry 231 (class 1255 OID 25190)
-- Name: update_chef(integer, text, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.update_chef(vid integer, vchamp text, vvaleur text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare

begin
	execute format('UPDATE chef set %I=%L where id_chef=%L',vchamp,vvaleur,vid);
	return 1;
end;
$$;


ALTER FUNCTION public.update_chef(vid integer, vchamp text, vvaleur text) OWNER TO anonyme;

--
-- TOC entry 228 (class 1255 OID 25181)
-- Name: verifier_user(text, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.verifier_user(vlogin text, vpassword text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
num integer;
begin
	select type_user into num from utilisateur where login=vlogin and password=vpassword;
	return num;
end;
$$;


ALTER FUNCTION public.verifier_user(vlogin text, vpassword text) OWNER TO anonyme;

--
-- TOC entry 217 (class 1259 OID 25105)
-- Name: categorie_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.categorie_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categorie_seq OWNER TO anonyme;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 220 (class 1259 OID 25129)
-- Name: categorie; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.categorie (
    id_categorie integer DEFAULT nextval('public.categorie_seq'::regclass) NOT NULL,
    nom_categorie text NOT NULL
);


ALTER TABLE public.categorie OWNER TO anonyme;

--
-- TOC entry 216 (class 1259 OID 25104)
-- Name: chef_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.chef_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.chef_seq OWNER TO anonyme;

--
-- TOC entry 219 (class 1259 OID 25121)
-- Name: chef; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.chef (
    id_chef integer DEFAULT nextval('public.chef_seq'::regclass) NOT NULL,
    nom_chef text NOT NULL,
    prenom_chef text,
    annee_exp text,
    email text,
    telephone text,
    adresse text
);


ALTER TABLE public.chef OWNER TO anonyme;

--
-- TOC entry 225 (class 1259 OID 25195)
-- Name: composition; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.composition (
    id_composition integer NOT NULL,
    ingredient text,
    quantite integer,
    unite text,
    id_recette integer
);


ALTER TABLE public.composition OWNER TO anonyme;

--
-- TOC entry 224 (class 1259 OID 25194)
-- Name: composition_id_composition_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.composition_id_composition_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.composition_id_composition_seq OWNER TO anonyme;

--
-- TOC entry 4908 (class 0 OID 0)
-- Dependencies: 224
-- Name: composition_id_composition_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.composition_id_composition_seq OWNED BY public.composition.id_composition;


--
-- TOC entry 215 (class 1259 OID 25103)
-- Name: ingredient_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.ingredient_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.ingredient_seq OWNER TO anonyme;

--
-- TOC entry 227 (class 1259 OID 33407)
-- Name: note; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.note (
    id_note integer NOT NULL,
    id_recette integer,
    note integer
);


ALTER TABLE public.note OWNER TO anonyme;

--
-- TOC entry 226 (class 1259 OID 33406)
-- Name: note_id_note_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.note_id_note_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.note_id_note_seq OWNER TO anonyme;

--
-- TOC entry 4909 (class 0 OID 0)
-- Dependencies: 226
-- Name: note_id_note_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.note_id_note_seq OWNED BY public.note.id_note;


--
-- TOC entry 218 (class 1259 OID 25106)
-- Name: recette_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.recette_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.recette_seq OWNER TO anonyme;

--
-- TOC entry 221 (class 1259 OID 25139)
-- Name: recette; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.recette (
    id_recette integer DEFAULT nextval('public.recette_seq'::regclass) NOT NULL,
    nom_recette text NOT NULL,
    description text,
    nbre_part text,
    temp_cuiss text,
    id_chef integer NOT NULL,
    niveau text,
    categorie text
);


ALTER TABLE public.recette OWNER TO anonyme;

--
-- TOC entry 223 (class 1259 OID 25173)
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.utilisateur (
    id_user integer NOT NULL,
    login text,
    password text,
    type_user integer
);


ALTER TABLE public.utilisateur OWNER TO anonyme;

--
-- TOC entry 222 (class 1259 OID 25172)
-- Name: utilisateur_id_user_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.utilisateur_id_user_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.utilisateur_id_user_seq OWNER TO anonyme;

--
-- TOC entry 4910 (class 0 OID 0)
-- Dependencies: 222
-- Name: utilisateur_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.utilisateur_id_user_seq OWNED BY public.utilisateur.id_user;


--
-- TOC entry 4727 (class 2604 OID 25198)
-- Name: composition id_composition; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.composition ALTER COLUMN id_composition SET DEFAULT nextval('public.composition_id_composition_seq'::regclass);


--
-- TOC entry 4728 (class 2604 OID 33410)
-- Name: note id_note; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.note ALTER COLUMN id_note SET DEFAULT nextval('public.note_id_note_seq'::regclass);


--
-- TOC entry 4726 (class 2604 OID 25176)
-- Name: utilisateur id_user; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN id_user SET DEFAULT nextval('public.utilisateur_id_user_seq'::regclass);


--
-- TOC entry 4893 (class 0 OID 25129)
-- Dependencies: 220
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: anonyme
--



--
-- TOC entry 4892 (class 0 OID 25121)
-- Dependencies: 219
-- Data for Name: chef; Type: TABLE DATA; Schema: public; Owner: anonyme
--

INSERT INTO public.chef VALUES (7, 'Wansi', 'simeon', '5', 'someonwansi@gmail.com', '0455221154', 'rue royale 344');
INSERT INTO public.chef VALUES (1, 'ngoune kenfack', 'ingrid', '5', 'ngouneingridee@gmail.com', '466117860', '138 Boulevard Brand Whitlock');
INSERT INTO public.chef VALUES (8, 'nguego', 'raiissa', '3', 'nguegoraissaa@gmail.com', '000022222', '138 Boulevard Brand Whitlock');
INSERT INTO public.chef VALUES (13, 'Desvarieux', 'Piiiierre', '3', 'pierredesvarieux@gmail.com', '0231452123', 'rue de desvarieux 123,1200 woluwe');
INSERT INTO public.chef VALUES (15, 'nom test', 'prenom test', '10', 'test@gmail.com', '000000000', 'adresse test');
INSERT INTO public.chef VALUES (17, 'Nguimfackk', 'jeannette ', '10', 'jeannettengoune@gmail.com', '058796541', 'rue de jeannette, 3000 Mons');


--
-- TOC entry 4898 (class 0 OID 25195)
-- Dependencies: 225
-- Data for Name: composition; Type: TABLE DATA; Schema: public; Owner: anonyme
--

INSERT INTO public.composition VALUES (86, 'cuisses de poulet', 12, 'unité', 49);
INSERT INTO public.composition VALUES (87, 'beurre', 50, 'g', 49);
INSERT INTO public.composition VALUES (88, 'feuille de coriande', 50, 'g', 49);
INSERT INTO public.composition VALUES (89, 'yaourt', 30, 'cl', 49);
INSERT INTO public.composition VALUES (90, 'sel', 1, 'pincée', 49);
INSERT INTO public.composition VALUES (92, 'beurre de cacahouète', 1, 'cuillère à soupe', 50);
INSERT INTO public.composition VALUES (93, 'fleur de sel', 1, 'pincée', 50);
INSERT INTO public.composition VALUES (95, 'philadelphia', 200, 'g', 51);
INSERT INTO public.composition VALUES (96, 'vanille', 1, 'gousse', 51);
INSERT INTO public.composition VALUES (97, 'sucre', 60, 'g', 51);
INSERT INTO public.composition VALUES (98, 'farine', 440, 'g', 51);
INSERT INTO public.composition VALUES (99, 'oeuf', 8, 'pièce', 51);
INSERT INTO public.composition VALUES (101, 'jaune d''oeuf', 2, 'unite', 52);
INSERT INTO public.composition VALUES (102, 'crème', 10, 'cl', 52);
INSERT INTO public.composition VALUES (103, 'carotte', 8, 'unité', 52);
INSERT INTO public.composition VALUES (104, 'cirton vert', 1, 'unité', 52);
INSERT INTO public.composition VALUES (106, 'laitue effeuillé', 2, 'coeurs', 53);
INSERT INTO public.composition VALUES (107, 'parmesan', 25, 'g', 53);
INSERT INTO public.composition VALUES (108, 'huile', 2, 'cuillère à soup', 53);
INSERT INTO public.composition VALUES (115, 'oeufs', 4, 'unité', 55);
INSERT INTO public.composition VALUES (116, 'ail', 5, 'gousse', 55);
INSERT INTO public.composition VALUES (117, 'huile d''olive', 50, 'cl', 55);
INSERT INTO public.composition VALUES (118, 'tomate mure', 3, 'unité', 55);
INSERT INTO public.composition VALUES (119, 'vinaigre', 2, 'cuillère à soupe', 55);
INSERT INTO public.composition VALUES (120, 'chocolat noir', 50, 'g', 56);
INSERT INTO public.composition VALUES (121, 'levure cimique', 8, 'g', 56);
INSERT INTO public.composition VALUES (122, 'sucre roux', 75, 'g', 56);
INSERT INTO public.composition VALUES (123, 'farine', 200, 'g', 56);
INSERT INTO public.composition VALUES (124, 'beurre pommae', 75, 'g', 56);
INSERT INTO public.composition VALUES (125, 'banane bien mure', 3, 'unité', 56);
INSERT INTO public.composition VALUES (132, 'oeuf', 1, 'unité', 58);
INSERT INTO public.composition VALUES (133, 'gruyère', 1, 'sachet', 58);
INSERT INTO public.composition VALUES (134, 'petit pois', 1, 'boite', 58);
INSERT INTO public.composition VALUES (135, 'carotte', 1, 'boite', 58);
INSERT INTO public.composition VALUES (137, 'jambon haché', 100, 'g', 59);
INSERT INTO public.composition VALUES (138, 'pomme', 1, 'kg', 59);
INSERT INTO public.composition VALUES (140, 'tomate', 100, 'unité', 60);
INSERT INTO public.composition VALUES (141, 'laitue', 100, 'g', 60);


--
-- TOC entry 4900 (class 0 OID 33407)
-- Dependencies: 227
-- Data for Name: note; Type: TABLE DATA; Schema: public; Owner: anonyme
--

INSERT INTO public.note VALUES (1, 49, 5);
INSERT INTO public.note VALUES (2, 49, 5);
INSERT INTO public.note VALUES (3, 49, 2);
INSERT INTO public.note VALUES (4, 49, 3);
INSERT INTO public.note VALUES (5, 53, 1);
INSERT INTO public.note VALUES (6, 51, 0);
INSERT INTO public.note VALUES (7, 53, 5);
INSERT INTO public.note VALUES (8, 49, 5);
INSERT INTO public.note VALUES (9, 50, 3);
INSERT INTO public.note VALUES (10, 55, 3);
INSERT INTO public.note VALUES (11, 50, 2);
INSERT INTO public.note VALUES (12, 56, 2);
INSERT INTO public.note VALUES (13, 53, 5);
INSERT INTO public.note VALUES (14, 50, 2);
INSERT INTO public.note VALUES (15, 52, 2);


--
-- TOC entry 4894 (class 0 OID 25139)
-- Dependencies: 221
-- Data for Name: recette; Type: TABLE DATA; Schema: public; Owner: anonyme
--

INSERT INTO public.recette VALUES (48, 'Gigot d''agneau au four à l''ail', ' La veille, salez le gigot généreusement sur toutes ses faces et mettez-le au frais sur une grille pendant 2 ou 3 h, le temps que le sel soit absorbé.2.Pelez l’ail et taillez-le en tout petits cubes. Effeuillez le romarin et ciselez-le. Dans une casserole, versez 10 cl d’huile d’olive, ajoutez l’ail et le romarin, puis laissez chauffer 10 min à feu très doux sans laisser l’ail brûler ni même brunir. Laissez refroidir.3.À l''issue des 2 ou 3 h, sortez le gigot et essuyez-le avec du papier absorbant. Mettez-le dans un grand plat, enduisez-le uniformément avec l''huile infusée et remettez-le au frais.4.Le jour J, sortez le gigot. Récupérez la marinade en raclant délicatement la surface de la viande avec une cuillère. Essuyez le gigot avec du papier absorbant et ramenez-le à température ambiante en immersion pendant 25 min, en suivant la méthode indiquée plus bas dans nos astuces.5.Enfournez le gigot dans le four froid à mi-hauteur. Réglez la température à 120 °C en mode sole et voûte. Laissez-le cuire 1 h 45 (ajoutez 15 min si vous le préférez plus cuit).6.Sortez le gigot et laissez-le reposer 30 min, enveloppé d’une triple feuille d’aluminium – la température va encore monter de 4 ou 5 °C au centre. Vous pouvez le garder ainsi jusqu’à 1 h, la température ne chutera que de 5 °C au centre, passant de 55 à 50 °C.7.Réglez le four en mode gril à température maximum. Passez un léger film d’huile d’olive au pinceau sur toute la surface du gigot. Enfournez-le à 15 cm du gril brûlant et faites-le dorer sur toutes ses faces pendant 3 ou 4 min, en le tournant toutes les 30 à 45 s.8.Sortez le gigot et découpez-le en tranches fines de 5 à 7 mm d’épaisseur. Servez dans un plat chaud en arrosant du jus de cuisson.', '8', '160', 13, 'facile', 'plat_chaud');
INSERT INTO public.recette VALUES (49, 'cuisses de poulet roties aux herbes', ' Préparez la marinade. Utilisez un mixeur plongeant pour mélanger tous les ingrédients.Mettez le poulet dans un bol et versez la marinade pour le recouvrir complètement. Couvrez et laissez-le au réfrigérateur pendant 2 h au minimum.Sortez le poulet mariné du réfrigérateur une demi-heure avant de le cuire.Préchauffez le four à 160 °/180 °C en chaleur tournante. Recouvrez un plat allant au four d’une grande feuille de papier aluminium.Salez le poulet mariné et mettez-le dans le plat.Parsemez du beurre en morceaux. Repliez le papier aluminium sur le poulet et laissez cuire pendant 30 mn. Ouvrez le papier aluminium et laissez cuire pendant 15 mn supplémentaires.Servez avec des tranches d', '6', '45', 7, 'facile', 'plat_chaud');
INSERT INTO public.recette VALUES (50, 'glace crémeuse banane cachouete', ' Pelez les bananes la veille et coupez-les en rondelles. Placez à plat dans un sachet de congélation et congelez-les pendant 12 h minimum.Déposez le jour même les bananes dans le blender avec les autres ingrédients. Mixez à haute vitesse pendant 3 à 4 m (le mélange doit être lisse).Versez dans un plat allant au congélateur, et congelez pendant 30 mn pour que la glace se raffermisse.', '2', '10', 13, 'facile', 'dessert');
INSERT INTO public.recette VALUES (51, 'cheesecake à l''amande', ' ', '4', '85', 13, 'moyen', 'patisserie');
INSERT INTO public.recette VALUES (52, 'Blanquette de veaux', ' Épluchez les carottes. Ôtez la base et les premières feuilles des poireaux. Lavez les légumes puis coupez-les en rondelles. Pelez et émincez les gousses d’ail, l’oignon et les échalotes.Taillez le veau en cubes grossiers. Faites-les revenir dans une cocotte, dans un peu d’huile d’olive. Enlevez la viande, rajoutez de l’huile et faites revenir les légumes. Lorsqu’ils sont colorés, remettez la viande, mouillez d’eau à hauteur et portez à toute petite ébullition. Ajoutez le thym, couvrez et laissez mijoter 1 h 30.Faites revenir les champignons nettoyés et coupés en lamelles dans 30 g de beurre. Réservez-les.Au bout de 1 h 30 de cuisson, ôtez la viande et les légumes ; filtrez le jus de cuisson, réservez-le dans une casserole. Remettez la viande et les légumes dans la cocotte. Faites réduire le jus de cuisson d’un tiers. Préparez un roux : faites fondre 50 g de beurre dans une casserole. Ajoutez la Maïzena et mélangez pendant environ 1 min. Versez du jus de cuisson progressivement, en remuant vivement, jusqu’à ce que la sauce nappe la cuillère. Versez sur la viande et remettez à cuire 15 min à feu doux. Zestez le citron vert au-dessus d', '6', '135', 8, 'facile', 'plat_chaud');
INSERT INTO public.recette VALUES (53, 'salade cesar', ' Épluchez les carottes. Ôtez la base et les premières feuilles des poireaux. Lavez les légumes puis coupez-les en rondelles. Pelez et émincez les gousses d’ail, l’oignon et les échalotes.Taillez le veau en cubes grossiers. Faites-les revenir dans une cocotte, dans un peu d’huile d’olive. Enlevez la viande, rajoutez de l’huile et faites revenir les légumes. Lorsqu’ils sont colorés, remettez la viande, mouillez d’eau à hauteur et portez à toute petite ébullition. Ajoutez le thym, couvrez et laissez mijoter 1 h 30.Faites revenir les champignons nettoyés et coupés en lamelles dans 30 g de beurre. Réservez-les.Au bout de 1 h 30 de cuisson, ôtez la viande et les légumes ; filtrez le jus de cuisson, réservez-le dans une casserole. Remettez la viande et les légumes dans la cocotte. Faites réduire le jus de cuisson d’un tiers. Préparez un roux : faites fondre 50 g de beurre dans une casserole. Ajoutez la Maïzena et mélangez pendant environ 1 min. Versez du jus de cuisson progressivement, en remuant vivement, jusqu’à ce que la sauce nappe la cuillère. Versez sur la viande et remettez à cuire 15 min à feu doux. Zestez le citron vert au-dessus d', '5', '20', 13, 'facile', 'plat_chaud');
INSERT INTO public.recette VALUES (54, 'lasagne', ' ÉTAPE 1Faire revenir gousses hachées d''ail et les oignons émincés dans un peu d''huile d''olive.ÉTAPE 2Ajouter la carotte et la branche de céleri hachée puis la viande et faire revenir le tout.ÉTAPE 3Au bout de quelques minutes, ajouter le vin rouge. Laisser cuire jusqu''à évaporation.ÉTAPE 4Ajouter la purée de tomates, l''eau et les herbes. Saler, poivrer, puis laisser mijoter à feu doux 45 minutes.ÉTAPE 5Préparer la béchamel : faire fondre 100 g de beurre.ÉTAPE 6Hors du feu, ajouter la farine d''un coup.ÉTAPE 7Remettre sur le feu et remuer avec un fouet jusqu''à l''obtention d''un mélange bien lisse.ÉTAPE 8Ajouter le lait peu à peu.ÉTAPE 9Remuer sans cesse, jusqu''à ce que le mélange s''épaississe.ÉTAPE 10Ensuite, parfumer avec la muscade, saler, poivrer. Laisser cuire environ 5 minutes, à feu très doux, en remuant. Réserver.ÉTAPE 11Préchauffer le four à 200°C (thermostat 6-7). Huiler le plat à lasagnes. Poser une fine couche de béchamel puis des feuilles de lasagnes, de la bolognaise, de la béchamel et du parmesan. Répéter l''opération 3 fois de suite.ÉTAPE 12Sur la dernière couche de lasagnes, ne mettre que de la béchamel et recouvrir de fromage râpé. Parsemer quelques noisettes de beurre.ÉTAPE 13Enfourner pour environ 25 minutes de cuisson.ÉTAPE 14Déguster', '8', '125', 13, 'difficile', 'plat_chaud');
INSERT INTO public.recette VALUES (55, 'Flan aubergine', ' ', '4', '105', 8, 'facile', 'plat_froid');
INSERT INTO public.recette VALUES (56, 'muffin facon banana bread', 'ÉTAPE 1Écraser le beurre et le mélanger vivement avec les deux sucres.ÉTAPE 2Ajouter les œufs au fur et à mesure en mélangeant bien.ÉTAPE 3Écraser la banane dans un bol et mettre un peu de jus de citron. Ajouter la banane à la préparation précédente.ÉTAPE 4Incorporer ensuite la farine et la levure et mélanger le tout.ÉTAPE 5Répartir la préparation dans des moules à muffins.ÉTAPE 6Faire fondre le chocolat au bain marie et en verser un peu sur chaque muffin. Former des marbrures avec la pointe d''un coûteau ou un pic à brochette.ÉTAPE 7Enfourner à 200°C pour 15 minutes (  ou - en fonction du four) et vérifier la cuisson à l''aide de la pointe d''un couteau.', '12', '35', 1, 'facile', 'patisserie');
INSERT INTO public.recette VALUES (57, 'roulé au chocolat', ' ', '8', '30', 8, 'facile', 'patisserie');
INSERT INTO public.recette VALUES (58, 'quiche au peti pois et carottes', ' Etaler la pâte dans un moule à tarte, piquer le fond de tarte et préchauffer le four. Dans une jatte mettre la crème fraîche l’œuf et le gruyère et bien remuer ensuite rajouter les petits pois carottes préalablement rincés. Mettre la préparation dans le fond de tarte et cuire 30 minutes environ déguster chaud ou froid.', '5', '40', 8, 'facile', 'plat_froid');
INSERT INTO public.recette VALUES (59, 'gribouilli', ' t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2', '20', 17, 'facile', 'plat_froid');
INSERT INTO public.recette VALUES (60, 'salade cesar', ' description fffffffffffffffffffffffffffffffffffffffffffffffffffffff', '3', '25', 1, 'moyen', 'salade');


--
-- TOC entry 4896 (class 0 OID 25173)
-- Dependencies: 223
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: anonyme
--

INSERT INTO public.utilisateur VALUES (2, 'ngoune', 'ngoune', 1);
INSERT INTO public.utilisateur VALUES (3, 'simeon', 'simeon', 0);
INSERT INTO public.utilisateur VALUES (1, 'ingrid', 'ingrid', 0);
INSERT INTO public.utilisateur VALUES (4, 'wansi', 'wansi', 1);


--
-- TOC entry 4911 (class 0 OID 0)
-- Dependencies: 217
-- Name: categorie_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.categorie_seq', 1, false);


--
-- TOC entry 4912 (class 0 OID 0)
-- Dependencies: 216
-- Name: chef_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.chef_seq', 19, true);


--
-- TOC entry 4913 (class 0 OID 0)
-- Dependencies: 224
-- Name: composition_id_composition_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.composition_id_composition_seq', 141, true);


--
-- TOC entry 4914 (class 0 OID 0)
-- Dependencies: 215
-- Name: ingredient_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.ingredient_seq', 22, true);


--
-- TOC entry 4915 (class 0 OID 0)
-- Dependencies: 226
-- Name: note_id_note_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.note_id_note_seq', 15, true);


--
-- TOC entry 4916 (class 0 OID 0)
-- Dependencies: 218
-- Name: recette_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.recette_seq', 60, true);


--
-- TOC entry 4917 (class 0 OID 0)
-- Dependencies: 222
-- Name: utilisateur_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.utilisateur_id_user_seq', 4, true);


--
-- TOC entry 4732 (class 2606 OID 25138)
-- Name: categorie categorie_nom_categorie_key; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_nom_categorie_key UNIQUE (nom_categorie);


--
-- TOC entry 4734 (class 2606 OID 25136)
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (id_categorie);


--
-- TOC entry 4730 (class 2606 OID 25128)
-- Name: chef chef_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.chef
    ADD CONSTRAINT chef_pkey PRIMARY KEY (id_chef);


--
-- TOC entry 4740 (class 2606 OID 25202)
-- Name: composition composition_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.composition
    ADD CONSTRAINT composition_pkey PRIMARY KEY (id_composition);


--
-- TOC entry 4742 (class 2606 OID 33412)
-- Name: note note_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT note_pkey PRIMARY KEY (id_note);


--
-- TOC entry 4736 (class 2606 OID 25146)
-- Name: recette recette_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.recette
    ADD CONSTRAINT recette_pkey PRIMARY KEY (id_recette);


--
-- TOC entry 4738 (class 2606 OID 25180)
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (id_user);


--
-- TOC entry 4744 (class 2606 OID 25203)
-- Name: composition id_recette_fk; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.composition
    ADD CONSTRAINT id_recette_fk FOREIGN KEY (id_recette) REFERENCES public.recette(id_recette) NOT VALID;


--
-- TOC entry 4743 (class 2606 OID 25152)
-- Name: recette recette_id_chef_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.recette
    ADD CONSTRAINT recette_id_chef_fkey FOREIGN KEY (id_chef) REFERENCES public.chef(id_chef);


-- Completed on 2024-06-13 18:52:53

--
-- PostgreSQL database dump complete
--


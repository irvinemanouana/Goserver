<?php

/**
* 
*/
class DbHandler
{
	 private $connexion;
 
    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        //Ouverture connexion db
        $db = new DbConnect();
        $this->connexion = $db->connect();
    }

    //Création d'un utilisateur
	public function createUser($name, $lastname, $email, $password) {
		require_once dirname(__FILE__) .'/PassHash.php';
           $stmt = $this->connexion->prepare("INSERT INTO user(name, lastname, email,password) values(:name, :lastname, :email,:password)");
            $result = $stmt->execute(array(
            		'name'=> $name,
            		'lastname' => $lastname,
            		'email'=> $email,
            		'password'=>$password
            	 ));

            return $result;
 
        }

       //Connexion d'un utilisateur
        public function connexionUser($email, $password){
        	require_once dirname(__FILE__) .'/PassHash.php';

        	$stmt = $this->connexion->prepare("SELECT iduser, email, name, lastname FROM user WHERE email= '".$email."' AND password='".$password."' ");
        	$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
			
        }

        //suppression d'un compte utilisateur
        public function deleteUser($email){
        	$stmt = $this->connexion->prepare("DELETE FROM user WHERE email='".$email."' ");
        	$stmt->execute();
        	return $stmt;

        }

        //Update d'un user
        public function updateUser($name, $lastname, $email,$iduser){
         $stmt = $this->connexion->prepare('UPDATE user SET name = ?, lastname = ?, email = ? WHERE iduser = ?');
         $stmt->execute(array($name, $lastname, $email, $iduser));
 

        }
/*
*
*
*FAVORIS
*
*/
        //Ajout de favoris
        public function addFavoris($longi, $lat, $user_iduser){
            $stmt = $this->connexion->prepare('INSERT INTO favori(longi, lat, user_iduser) values(:longi, :lat, :user_iduser)');
            $result = $stmt->execute(array(
                    'longi'=> $longi,
                    'lat' => $lat,
                    'user_iduser'=> $user_iduser
                 ));

            return $result;
           
        }

        //Delete favori
        public function deleteFavori($id_fav){
            $stmt = $this->connexion->prepare("DELETE FROM favori WHERE id_fav='".$id_fav."' ");
            $stmt->execute();
            return $stmt;

        }


        //get All Favoris
         //Connexion d'un utilisateur
        public function getAllFavoris($user_iduser){
            require_once dirname(__FILE__) .'/PassHash.php';
        $stmt = $this->connexion->prepare("SELECT id_fav, longi, lat FROM favori WHERE user_iduser= '".$user_iduser."'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;*
            
        }


 

 }//FIN


    



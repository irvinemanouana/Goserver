<?php
//require_once '../config_app/DbHandler.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require __DIR__.'../vendor/autoload.php';
require __DIR__.'../config_app/DbHandler.php';

$app = new \Slim\App;


$app->post('/create/user', function(Request $request, Response $response) use ($app){
	
    $data = $request->getParsedBody();
    $rep = $response->getBody();

    $name = $data['name'];
    $lastname = $data['lastname'];
    $email = $data['email'];
    $password = $data['password'];
   

	$db = new DbHandler();
	$res = $db->CreateUser($name, $lastname, $email, $password);

    if ($res) {
        echo json_encode($data);
    }else{
        echo json_encode('{success : 0 }');
    }
});


$app->post('/login/user', function(Request $request, Response $response) use ($app){
     $data = $request->getParsedBody();
     $email = $data['email'];
     $password = $data['password'];

     
     $db = new DbHandler();
     $res = $db->connexionUser($email, $password);
     if ($res) {
        echo json_encode($res);
         
        }else{
            $arr = array('success' =>0 ,"message" =>"Erreur de connexion");
            
        echo json_encode($arr);
     }

});

$app->post('/delete/user', function(Request $request, Response $response) use ($app){
    $data = $request->getParsedBody();
    $email = $data['email'];

    $db = new DbHandler();
    $res = $db->deleteUser($email);
    if ($res) {
         $arr = array('success' =>0 ,"message" =>"User delete");
         echo json_encode($arr);
    }

    if (!$res) {
        $arr = array('success' =>1 ,"message" =>"Erreur de suppression");
         echo json_encode($arr);
    }
        
    

});

$app->put('/update/user', function(Request $request, Response $response) use ($app){
    $data = $request->getParsedBody();
    $iduser = $data['iduser'];
    $name = $data['name'];
    $lastname = $data['lastname'];
    $email = $data['email'];

    $db = new DbHandler();
    $res = $db->updateUser($name, $lastname, $email,$iduser);
   
    if ($res) {
       echo json_encode($data);
    }

});


$app->post('/add/favoris', function(Request $request, Response $response) use ($app){
    $data = $request->getParsedBody();
    $rep = $response->getBody();

    $longi = $data['longi'];
    $lat = $data['lat'];
    $iduser = $data['user_iduser'];


    $db = new DbHandler();
    $res = $db->addFavoris($longi, $lat, $iduser);

    if ($res) {
        echo json_encode($data);
    }else{
        echo json_encode('{success : 0 }');
    }


});

//Delete Favoris
$app->post('/delete/favoris', function(Request $request, Response $response) use ($app){
    $data = $request->getParsedBody();
    $id_fav = $data['id_fav'];

    $db = new DbHandler();
    $res = $db->deleteFavori($id_fav);
    if ($res) {
         $arr = array('success' =>0 ,"message" =>"Favoris delete");
         echo json_encode($arr);
    }

    if (!$res) {
        $arr = array('success' =>1 ,"message" =>"Erreur de suppression");
         echo json_encode($arr);
    }
        
    

});

//Get Favorisavoris


$app->post('/getall/favoris', function(Request $request, Response $response) use ($app){
     $data = $request->getParsedBody();
     $id_fav = $data['user_iduser'];
     
     $db = new DbHandler();
     $res = $db->getAllFavoris($id_fav);
     if ($res) {
        echo json_encode($res);
         
        }else{
            $arr = array('success' =>0 ,"message" =>"Erreur pas de favoris pour cet user");
            
        echo json_encode($arr);
     }

});























$app->post('/search/favoris', function(Request $request, Response $response) use ($app){
    $data = $request->getParsedBody();
    $city = $data['city'];
    $api = "https://api.aerisapi.com/indices/bees/".$city.",fr?client_id=JUocoqwJV2AUQeQyniusl&client_secret=7kzfvSMUkQnDVpFAJ533E6bV7W8MhdqbTAxkFJWG";
    $res = file_get_contents($api);
    echo $res;
});







$app->run();
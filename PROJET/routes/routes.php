<?php

$db = new PDO(   //Définition de la base de donnée qu'on va utiliser pour insérer et récupérer des données
  "mysql:host = localhost;
   port=3306;dbname=festival;charset=utf8",
   "root",
   "",
);

Flight::route('./', function(){ 
  //La route de l'index qui est celle de la page d'accueil 
  session_start();  
  //session_start sera utiliser pour récupérer les données de l'utilisateur s'il est connecté
    Flight::render("index.tpl",array( 'SESSION'=>$_SESSION ));
});

Flight::route('GET /candidature', function(){
    Flight::render("candidature.tpl",array());
});

Flight::route('POST /candidature', function(){
    $data = Flight::request()->data;
    $db = new PDO(  //Initialisation de db dans la route /register 
        "mysql:host = localhost;
         port=3306;dbname=festival;charset=utf8",
         "root",
         "",
      );

    $request = $db->prepare("insert into candidature values(:ID_responsable,:Nom_groupe,:Départementorigine,:Scene_groupe,:Année_création,:Style_musical,:Presentation,:Expériences_scéniques,:Page_groupe,:Soundcloud,:Youtube,:Statutassociatif,:Sacem,:Producteur,:Music1,:DossierPressePDF,:Music3,:Music2,:Photo1,:Photo2,:Fiche_TechniquePDF,:DocumentsSacemPDF)"); 
    //Préparation de la requête SQL
    $request->execute(array( ':ID_responsable'=>$data->name,':Nom_groupe'=>$data->name,':Départementorigine'=>$data->departement,':Scene_groupe'=>$data->scene,':Année_création'=>$data->creation,':Style_musical'=>$data->stylemusical,':Presentation'=>$data->textepresentation,':Expériences_scéniques'=>$data->experience,':Page_groupe'=>$data->sitefb,':Soundcloud'=>$data->soundcloud,':Youtube'=>$data->youtube,':Statutassociatif'=>$data->status,':Sacem'=>$data->sacem,':Producteur'=>$data->producteur,':Music1'=>$data->music1,':Music2'=>$data->music2,':Music3'=>$data->music3,':Photo1'=>$data->photo1,':Photo2'=>$data->photo2,':DossierPressePDF'=>$data->presse,':Fiche_TechniquePDF'=>$data->fiche,':DocumentsSacemPDF'=>$data->docsacem));

    //Flight::render("candidature.tpl",array());
});

Flight::route('GET /register', function(){ 
   //La route qui permet d'aller sur la page pour créer un compte 
    Flight::render("register.tpl",array());
});

Flight::route('POST /register' , function()  { 
  //La route qui permet d'enregistrer les données de la création de compte

  $db = new PDO(  //Initialisation de db dans la route /register 
    "mysql:host = localhost;
     port=3306;dbname=festival;charset=utf8",
     "root",
     "",
  );
     $count_error=0;  
     // Déclaration variable du nombre d'erreur 
     //qui vont survenir envers l'utilisateur

    //récupérer les données en POST
    $data = Flight::request()->data; 
    //data est la variable qui va contenir 
    //toutes les valeurs saisis par l'utilisateur 
    $messages=array(); //Tableau qui va contenir les erreurs afin de montrer 
    //les erreurs données à l'utilisateur

    if (empty( $data->Nom_Utilisateur )) {  //Si le nom est vide alors erreur
    $messages ['nom']="Le nom doit être rempli!";
 
    $count_error+=1;
    }
    if (empty( $data->Prenom_utilisateur )) {  //Si le prénom est vide alors erreur
      $messages ['prenom']="Le prenom doit être rempli!";
   
      $count_error+=1;
      }

    if (empty( $data->Adresse_utilisateur ) ){  //Si l'adresse est vide alors erreur
        $messages ['adresse_user']="L'adresse doit être remplie";
     
        $count_error+=1;
    }

    if (empty( $data->Code_postal ) ){ //Si le code postal est vide alors erreur
        $messages ['code_postal']="Le code postal doit être remplie";
     
        $count_error+=1;
    }
    else if ( !( preg_match("#^[0-9]{5}$#", $data->Code_postal) )  ) {
     //Si le code postal fait plus ou moins de 5 chiffres ou pas de chiffres 
     //mais des caractères. Si non respect du format alors erreur
      $messages ['code_postal']="Le code postal n'est pas au bon format";
     
      $count_error+=1;

    }

    if (empty( $data->motdepasse )) { //Si le mot de passe est vide alors erreur
        $messages ['motdepasse']="Le mot de passe doit être rempli!";
    
        $count_error+=1;
        }
    else if ( strlen( $data->motdepasse ) < 8 ) {
       //Si le mot de passe fait moins de 8 caractères alors erreur
        $messages ['motdepasse']="Le mot de passe doit être plus long";
     
        $count_error+=1;
    }
    if (empty( $data->courriel )) { 
      //Si le courriel est vide alors erreur
            $messages ['email']="L'email doit être rempli!";
        
            $count_error+=1;
            }
    else if ( filter_var( $data->courriel , FILTER_VALIDATE_EMAIL) == FALSE )  { 
      //Si le courriel est mauvais par rapport au filtre alors erreur
        $messages ['email']="L'email n'est pas un email!";
     
        $count_error+=1;
    }
    
    $email = $data->courriel; 
    //Définition d'Email, une variable équivalente à $data->courriel ( pour la simplification )
    $verif = $db->prepare("SELECT * FROM utilisateur WHERE Email = ?"); 
    //Préparation de la requête SQL afin de vérifier à la fin l'adresse e-mail
   //récupère si une donnée est déjà existante dans la base avec $email 
    $verif->execute([$email]); //On execute la requête SQL
    $verifemail = $verif->fetch(); 
    //Vérification si $email existe déjà ou non, $verifemail étant un booléen

   if ($verifemail) { //Si l'email existe déjà alors erreur
    $messages['email']="L'email existe déjà";
    $count_error+=1;
   }

 if ($count_error == 0 ) {   

//Si tout va bien, qu'il n'y a pas d'erreur alors 
//on va pouvoir rentrer les données dans la base
//et afficher que c'est un succés!

$options = [
  'cost' => 12,
];
 
$data->motdepasse = password_hash($data->motdepasse , PASSWORD_BCRYPT, $options);
 // Hashage du mot de passe de tels manières à ce que 
 //le mot de passe ne soit pas visible dans la base de donnée
$request = $db->prepare("insert into utilisateur values(:Mail_utilisateur,:Nom_Utilisateur,:Prenom_utilisateur,:Adresse_utilisateur,:Admin,:mot_de_passe,:Code_postal)"); 
//Préparation de la requête SQL
$request->execute(array( ':Admin'=> 0 , ':Adresse_utilisateur'=> $data->Adresse_utilisateur , 
':Code_postal'=> $data->Code_postal , ':Mail_utilisateur' => $data->courriel , ':mot_de_passe' => $data->motdepasse ,   
':Nom_Utilisateur' => $data->Nom_Utilisateur, ':Prenom_utilisateur'=> $data->Prenom_utilisateur   ));
// Execution de la requête SQL qui va insérer les données d'inscription dans la base de donnée

  session_start();  // On ouvre la session

  $_SESSION['courriel'] = $data->courriel;  // On enregistre le courriel en session
  $_SESSION['Nom'] = $data->Nom_Utilisateur;  // On enregistre le Nom en session

 Flight::redirect('./sucess'); 
 //On redirige vers une page de succès qui annonce 
 //à l'utilisateur que son inscription a fonctionné

     }  
else {
//Va dans register.tpl, si une erreur dans l'inscription est observé
  Flight::render("register.tpl",array('messages'=>$messages, 'data'=> $_POST));

}

});





Flight::route('POST /login' , function()  { 
  //La route qui permet d'enregistrer les données de la connexion au compte d'un utilisateur

  $db = new PDO(  //Initialisation de db dans la route /login
    "mysql:host = localhost;
     port=3306;dbname=festival;charset=utf8",
     "root",
     "",
  );

  $data = Flight::request()->data; 
  //Récupère les données provenant de la page login.tpl
  $messages=array();
  //Initialisation du tableau messages pour afficher les erreurs 
  $count_error=0; 
  //Initialisation du nombre d'erreur si l'utilisateur se trompe

  if (empty( $data->courriel )) { //Si la case courriel est vide alors erreur
    $messages ['email']="L'email doit être rempli!";
    $count_error+=1;
    }

else if ( filter_var( $data->courriel , FILTER_VALIDATE_EMAIL) == FALSE )  { 
  //Si mauvais format du courriel alors erreur
$messages ['email']="L'email n'est pas un email!";
$count_error+=1;
}

if (empty( $data->motdepasse )) { //Si le mot de passe est vide alors erreur
  $messages ['motdepasse']="Le mot de passe doit être rempli!";;
  $count_error+=1;
  }

  $email = $data->courriel; 
  //$email variable correpondant à $data->courriel ( simplification )

  $verif = $db->prepare("SELECT * FROM utilisateur WHERE Mail_utilisateur = ?"); 
  //Préparation de la requête SQL afin devoir si l'email existe ou non
 //récupère si une donnée est déjà existante dans la base
  $verif->execute([$email]);  //exécute la requête SQL 
  $verifemail = $verif->fetch(); //Retourne dans $verifemail si la variable est vrais 

 
  $motdepasse = $data->motdepasse;
  $verif2 = $db->prepare("SELECT mot_de_passe FROM utilisateur WHERE Mail_utilisateur = ?");
  //récupère si une donnée est déjà existante dans la base  
  $verif2->execute([$email]);
  $passd = $verif2->fetchColumn();
  $verifmdp = password_verify( $motdepasse , $passd );
 
if (  filter_var( $data->courriel , FILTER_VALIDATE_EMAIL) == TRUE ) {
    if ( !empty($email) ) {
        if ( ($verifemail) == FALSE ) { //Si le courriel n'est pas dans la base
    $count_error+=1;
    $messages ['email']="L'email est inexistant!";
 }
 else if ( $verifmdp == FALSE ) { //Si l'email existe mais que le mot de passe est mauvais

  $count_error+=1;
  $messages ['motdepasse']="Mauvais Mot de Passe";

       }  
   }
}  

if ($count_error == 0 ) {   
  //Si il n'y a pas d'erreur alors on peut insérer 
  //les données de l'inscription dans la base

  $recupNom = $db->prepare("SELECT Nom_Utilisateur FROM utilisateur WHERE Mail_utilisateur = ?");
  //récupère si une donnée est déjà existante dans la base  
  $recupNom->execute([$email]);
  $Nom = $recupNom->fetchColumn();

  session_start();

  $_SESSION['courriel'] = $data->courriel;
  $_SESSION['Nom'] = $Nom;

  Flight::render("index.tpl",array('SESSION'=>$_SESSION, 'data'=> $_POST));
 
 
       }

else {
 //Va dans login.tpl, si une erreur dans l'inscription est observé
  Flight::render("login.tpl",array('messages'=>$messages, 'data'=> $_POST));
        
     } 

});

Flight::route('GET /', function(){
  Flight::render("index.tpl",array('SESSION'=>$_SESSION));
});

Flight::route('GET /logout', function(){
  session_start(); 
  $_SESSION = array(); //On vide le tableau de session
  session_destroy(); //On détruit la session
  unset($_SESSION); //On retire la session

  Flight::render("index.tpl",array());
});

Flight::route('GET /login', function(){
  session_start(); 
  Flight::render("login.tpl",array());
});

Flight::route('GET /sucess', function(){
  session_start(); 
  Flight::render("sucess.tpl",array());
});

Flight::route('GET /profil', function(){

  session_start(); 

  if (!empty($_SESSION['courriel'])) {

 $Email = $_SESSION['courriel']; 
 //Définition de la variable Email qui est le courriel de SESSION
  $db = new PDO(
    "mysql:host = localhost;
     port=3306;dbname=festival;charset=utf8",
     "root",
     "",
  );

  $recupNom = $db->prepare("SELECT Nom FROM utilisateur WHERE Email = ?");
  //récupère si une donnée est déjà existante dans la base  
  $recupNom->execute([$Email]);
  $_SESSION['Nom']= $recupNom->fetchColumn();

  $recupVille = $db->prepare("SELECT Ville FROM utilisateur WHERE Email = ?");
  //récupère si une donnée est déjà existante dans la base  
  $recupVille->execute([$Email]);
  $_SESSION['Ville'] = $recupVille->fetchColumn();

  $recupPays = $db->prepare("SELECT Pays FROM utilisateur WHERE Email = ?");
  //récupère si une donnée est déjà existante dans la base  
  $recupPays->execute([$Email]);
  $_SESSION['Pays'] = $recupPays->fetchColumn();

        Flight::render("profil.tpl",array('SESSION'=> $_SESSION));

     }
     else {

      Flight::render("login.tpl",array());

     }

});

?>

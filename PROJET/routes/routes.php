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
    $verif = $db->prepare("SELECT * FROM utilisateur WHERE Mail_utilisateur = ?"); 
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
':Nom_Utilisateur' => $data->Nom_Utilisateur, ':Prenom_utilisateur'=> $data->Prenom_utilisateur ) );
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
 else if ( $verifmdp == FALSE && !empty( $data->motdepasse ) ) { //Si l'email existe mais que le mot de passe est mauvais

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

Flight::route('GET /candidature', function() {
  session_start(); 

  if ( empty( $_SESSION['courriel'] ) ) {
    Flight::render("login.tpl",array());
  }
  else {
    $db = new PDO(  //Initialisation de db dans la route /login
      "mysql:host = localhost;
       port=3306;dbname=festival;charset=utf8",
       "root",
       "",
    );


    for ( $Nb = 1; $Nb < 7; $Nb++  ) {
      $recupDep = $db->prepare("SELECT Nom_Departement FROM département WHERE ID_Departement = ?");
      //récupère si une donnée est déjà existante dans la base  
      $recupDep->execute([$Nb]);
      $tabdep[$Nb]= $recupDep->fetchColumn();
    }
      
for ( $Nb2 = 1; $Nb2 < 4; $Nb2++  ) {
  $recupscene = $db->prepare("SELECT Nom_scene FROM scene WHERE ID_scene = ?");
  //récupère si une donnée est déjà existante dans la base  
  $recupscene->execute([$Nb2]);
  $tabscene[$Nb2]= $recupscene->fetchColumn();
}

  Flight::render("candidature.tpl",array('tabdep' => $tabdep , 'tabscene' => $tabscene ));
  }
});

Flight::route('POST /candidature', function() {
  //La route qui permet d'enregistrer les données de la création de groupe ( Candidature )

  $db = new PDO(  //Initialisation de db dans la route /candidature
    "mysql:host = localhost;
     port=3306;dbname=festival;charset=utf8",
     "root",
     "",
  );
  $_FILES = Flight::request()->files;
  //Récupère les données fichiers provenant de la page candidature.tpl
  $data = Flight::request()->data; 
  //Récupère les données provenant de la page candidature.tpl
  $messages=array();
  //Initialisation du tableau messages pour afficher les erreurs 
  $count_error=0; 
  //Initialisation du nombre d'erreur si l'utilisateur se trompe

  if (empty( $data->name )) { //Si la case name est vide alors erreur
    $messages['name']="Le nom doit être remplis!";
    $count_error+=1;
    }
    if (empty( $data->departement )) { //Si la case departement est vide alors erreur
      $messages['departement']="Le département doit être remplis!";
      $count_error+=1;
      }
      if ( empty ( $data->stylemusical ) ) { //Si la case style musical est vide alors erreur
        $messages['stylemusical']="Le stylemusical doit être remplis!";
        $count_error+=1;
        }
        if (empty( $data->scene )) { //Si la case scène est vide alors erreur
          $messages['scene']="La scène doit être remplis!";
          $count_error+=1;
          }
          $now = date("Y-m");
          $year_user = $data->creation;
          if (empty( $data->creation )) { //Si la case scène est vide alors erreur
            $messages['creation']="La création doit être remplis!";
            $count_error+=1;
            }
    else if ( $now < $year_user ) { //Si la date est dans le futur
  $messages['creation']="Votre date est dans le futur, mettez votre date de création de groupe!";
  $count_error+=1;
  }
  if ( empty( $data->status ) ) { //Si la case status est vide
    $messages['status']="Veuillez sélectionner Oui ou Non";
    $count_error+=1;
  }
  if ( empty( $data->sacem) ) { //Si la case Sacem est vide
    $messages['sacem']="Veuillez sélectionner Oui ou Non";
    $count_error+=1;
  }
  if ( empty( $data->producteur )  ) { //Si la case Producteur est vide
    $messages['producteur']="Veuillez sélectionner Oui ou Non";
    $count_error+=1;
  }
  if ( empty( $data->textexperience )  ) { //Si la case Texte Expérience est vide
    $messages['textexperience']="Veuillez écrire votre expérience scénique";
    $count_error+=1;
  }
  if ( empty( $data->textepresentation )  ) { //Si la case Texte Présentation est vide
    $messages['textepresentation']="Veuillez écrire votre présentation";
    $count_error+=1;
  }

  if (empty($_FILES['fmp3']) || empty($_FILES['smp3']) || empty($_FILES['tmp3'] ) ) {
    $messages['mp3']="Veuillez mettre tous les fichiers demandés";
    $count_error+=1; //Si les cases des fichiers MP3 sont vides
  }
  else if ($_FILES['fmp3']['name']== $_FILES['smp3']['name'] 
  || $_FILES['fmp3']['name'] == $_FILES['tmp3']['name'] 
  || $_FILES['smp3']['name'] == $_FILES['tmp3']['name'] ) {
    $messages['mp3']="Veuillez ne pas mettre plusieurs fois le même fichier";
    $count_error+=1; //Si les cases des fichiers MP3 ont les mêmes fichiers
  }
  if ( empty(  $_FILES['fphoto']) || empty( $_FILES['sphoto'] ) ) {
    $messages['photo']="Veuillez mettre tous les fichiers demandés";
    $count_error+=1; //Si les cases des photos sont vides
  }
  else if ($_FILES['fphoto']['name'] == $_FILES['sphoto']['name'] ) {
    $messages['photo']="Veuillez ne pas mettre plusieurs fois le même fichier";
    $count_error+=1; //Si les cases des photos ont les mêmes photos
  }
  if (  empty( $_FILES['fiche'] )  ) {
    $messages['fiche']="Veuillez mettre le fichier demandé";
    $count_error+=1;
  }
  if (  empty( $_FILES['docsacem'] )  ) {
    $messages['docsacem']="Veuillez mettre le fichier demandé";
    $count_error+=1;
  }
$titre=$_FILES['fmp3']['name'];


 if ($count_error==0) {

  $namef = $_FILES['fphoto']['name']; //Modification du nom de fphoto
  function NomPhoto1($namef){ 
    $transliterator = Transliterator::createFromRules(
   ':: NFD; :: [:Nonspacing Mark:] Remove; ::NFC;', Transliterator::FORWARD
    );
    $normalized = $transliterator->transliterate($namef);
    return ( $_FILES['fphoto']['name']=preg_replace("/[^a-zA-Z0-9\.]/","-",$normalized) );
   }
   $namef=$_FILES['fphoto']['name'];
  move_uploaded_file($_FILES['fphoto']['tmp_name'], "./files/Photos/$namef");
 //Upload du fichier fphoto sur le serveur et plus précisément dans le fichier Photos

  $names = $_FILES['sphoto']['name']; //Modification du nom de sphoto
  function NomPhoto2($names){ 
    $transliterator = Transliterator::createFromRules(
   ':: NFD; :: [:Nonspacing Mark:] Remove; ::NFC;', Transliterator::FORWARD
    );
    $normalized = $transliterator->transliterate($names);
    return ( $_FILES['sphoto']['name']=preg_replace("/[^a-zA-Z0-9\.]/","-",$normalized) );
   }
   $names=$_FILES['sphoto']['name'];
   move_uploaded_file($_FILES['sphoto']['name'], "./files/Photos/$names");
  //Upload du fichier sphoto sur le serveur et plus précisément dans le fichier Photos

  $namefi = $_FILES['fiche']['name']; //Modification du nom de fiche
  function NomFiche($namefi){ 
    $transliterator = Transliterator::createFromRules(
   ':: NFD; :: [:Nonspacing Mark:] Remove; ::NFC;', Transliterator::FORWARD
    );
    $normalized = $transliterator->transliterate($namefi);
    return ( $_FILES['fiche']['name']=preg_replace("/[^a-zA-Z0-9\.]/","-",$normalized) );
   }
   $namefi=$_FILES['fiche']['name'];
  move_uploaded_file($_FILES['fiche']['name'], "./files/Fiche/$namefi");
 //Upload du fichier fiche sur le serveur et plus précisément dans le fichier Fiche

  $namesa = $_FILES['docsacem']['name']; //Modification du nom de docsacem
  function NomSacem($namesa){ 
    $transliterator = Transliterator::createFromRules(
   ':: NFD; :: [:Nonspacing Mark:] Remove; ::NFC;', Transliterator::FORWARD
    );
    $normalized = $transliterator->transliterate($namesa);
    return  $_FILES['docsacem']['name']=preg_replace("/[^a-zA-Z0-9\.]/","-",$normalized);
   }
   $namesa=$_FILES['docsacem']['name'];
  move_uploaded_file($_FILES['docsacem']['name'], "./files/Sacem/$namesa");
  //Upload du fichier docsacem sur le serveur et plus précisément dans le fichier Sacem

  $namefmp3 = $_FILES['fmp3']['name']; //Modification du nom de fmp3
  function NomFMP3($namefmp3){ 
    $transliterator = Transliterator::createFromRules(
   ':: NFD; :: [:Nonspacing Mark:] Remove; ::NFC;', Transliterator::FORWARD
    );
    $normalized = $transliterator->transliterate($namefmp3);
    return $_FILES['fmp3']['name']=preg_replace("/[^a-zA-Z0-9\.]/","-",$normalized);
   }
   $namefmp3=$_FILES['fmp3']['name'];
  move_uploaded_file($_FILES['fmp3']['name'], "./files/MP3/$namefmp3");
 //Upload du fichier fmp3 sur le serveur et plus précisément dans le fichier MP3

  $namesmp3 = $_FILES['smp3']['name']; //Modification du nom de smp3
  function NomSMP3($namesmp3){ 
    $transliterator = Transliterator::createFromRules(
   ':: NFD; :: [:Nonspacing Mark:] Remove; ::NFC;', Transliterator::FORWARD
    );
    $normalized = $transliterator->transliterate($namesmp3);
    return  $_FILES['smp3']['name']=preg_replace("/[^a-zA-Z0-9\.]/","-",$normalized);
   }
   $namesmp3=$_FILES['smp3']['name'];
  move_uploaded_file($_FILES['smp3']['name'], "./files/MP3/$namesmp3");
 //Upload du fichier smp3 sur le serveur et plus précisément dans le fichier MP3

  $nametmp3 = $_FILES['tmp3']['name']; //Modification du nom de tmp3
  function NomTMP3($nametmp3){ 
    $transliterator = Transliterator::createFromRules(
   ':: NFD; :: [:Nonspacing Mark:] Remove; ::NFC;', Transliterator::FORWARD
    );
    $normalized = $transliterator->transliterate($nametmp3);
    return $_FILES['tmp3']['name']=preg_replace("/[^a-zA-Z0-9\.]/","-",$normalized);
   }
   $nametmp3=$_FILES['tmp3']['name'];
  move_uploaded_file($_FILES['tmp3']['name'], "./files/MP3/$nametmp3");
  //Upload du fichier tmp3 sur le serveur et plus précisément dans le fichier MP3

  if ( !empty( $_FILES['presse']['name'] ) ) {

    $namePresse = $_FILES['presse']['name']; //Modification du nom de presse
    function NomPresse($namePresse){ 
      $transliterator = Transliterator::createFromRules(
     ':: NFD; :: [:Nonspacing Mark:] Remove; ::NFC;', Transliterator::FORWARD
      );
      $normalized = $transliterator->transliterate($namePresse);
      return $_FILES['presse']['name']=preg_replace("/[^a-zA-Z0-9\.]/","-",$normalized);
     }
     $namePresse = $_FILES['presse']['name'];
    move_uploaded_file($_FILES['presse']['tmp_name'], "./files/Presse/$namePresse");
     //Upload du fichier presse sur le serveur et plus précisément dans le fichier Presse

    }
    else {
      
    $namePresse='Pas de fichier presse';

    }
    if ($data->status =='OUI' ) { //Réécriture de la variable status en un booléen
      $data->status=1;
    }
    else {
      $data->status=0;
    }

    if ($data->sacem =='OUI' ) {  //Réécriture de la variable Sacem en un booléen
      $data->sacem=1;
    }
    else {
      $data->sacem=0;
    }

    if ($data->producteur =='OUI' ) { //Réécriture de la variable Producteur en un booléen
      $data->producteur=1;
    }
    else {
      $data->producteur=0;
    }

    if ( empty($data->Soundcloud) ) {

      $data->Soundcloud='Pas de SoundCloud';

    }

    if ( empty($data->Youtube) ) {

      $data->Youtube='Pas de chaîne';

    }
    session_start();
    $mail=$_SESSION['courriel'];

  $request = $db->prepare("insert into candidature values( :Nom_groupe ,
  :Departement_origine , :Scene_groupe , :Annee_creation , :Style_musical , :Presentation ,
  :Experiences_sceniques , :Page_groupe , :Soundcloud , :Youtube , :Statut_associatif , :Sacem ,
  :Producteur, :Music1 , :DossierPressePDF , :Music3 , :Music2 , :Photo1 , :Photo2 ,
  :Fiche_TechniquePDF , :DocumentSacemPDF , :Mail_Responsable )"); 
     //Préparation de la requête SQL

     $request->execute( array ( ':Nom_groupe'=> $data->name , ':Departement_origine'=> $data->departement , ':Scene_groupe' => $data->scene , ':Annee_creation' => $data->creation ,   
     ':Style_musical' => $data->stylemusical , ':Presentation'=> $data->textepresentation , ':Experiences_sceniques'=>$data->texteexpericence , 
     ':Page_groupe'=> $data->sitefb ,  ':Soundcloud'=> $data->soundcloud , ':Youtube'=> $data->youtube ,
      ':Statut_associatif'=> $data->status , ':Sacem'=>$data->sacem , ':Producteur'=> $data->producteur , ':Music1'=>  $_FILES['fmp3']['name'] , 
      ':DossierPressePDF'=> $namePresse , ':Music3' => $_FILES['tmp3']['name'] , ':Music2' => $_FILES['smp3']['name']  , 
      ':Photo1' => $_FILES['fphoto']['name'] , ':Photo2' => $_FILES['sphoto']['name'] , ':Fiche_TechniquePDF' => $_FILES['fiche']['name'] , 
      ':DocumentSacemPDF' => $_FILES['docsacem']['name'] , ':Mail_Responsable'=> $mail ) );
     // Execution de la requête SQL qui va insérer les données d'inscription dans la base de donnée

  Flight::redirect('./sucess');

  }

 else {

  $db = new PDO(  //Initialisation de db dans la route /candidature
    "mysql:host = localhost;
     port=3306;dbname=festival;charset=utf8",
     "root",
     "",
  );

  for ( $Nb = 1; $Nb < 7; $Nb++  ) {
    $recupDep = $db->prepare("SELECT Nom_Departement FROM département WHERE ID_Departement = ?");
    //récupère si une donnée est déjà existante dans la base 7 fois 
    $recupDep->execute([$Nb]);
    $tabdep[$Nb]= $recupDep->fetchColumn();
  }
    
for ( $Nb2 = 1; $Nb2 < 4; $Nb2++  ) {
$recupscene = $db->prepare("SELECT Nom_scene FROM scene WHERE ID_scene = ?");
//récupère si une donnée est déjà existante dans la base 4 fois
$recupscene->execute([$Nb2]);
$tabscene[$Nb2]= $recupscene->fetchColumn();
}

  Flight::render("candidature.tpl",array('messages'=>$messages, 'data'=> $_POST , 
  'tabdep' => $tabdep , 'tabscene' => $tabscene , 'files'=>$_FILES ));
  }
});

Flight::route('GET /vuecandidature', function(){
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
     $recupAdd = $db->prepare("SELECT Adresse_utilisateur FROM utilisateur WHERE Mail_utilisateur = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupAdd->execute([$Email]);
     $_SESSION['Adresse_utilisateur']= $recupAdd->fetchColumn();

     $recupCP = $db->prepare("SELECT Code_postal FROM utilisateur WHERE Mail_utilisateur = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupCP->execute([$Email]);
     $_SESSION['Code_postal']= $recupCP->fetchColumn();

     $recupNom = $db->prepare("SELECT Nom_Utilisateur FROM utilisateur WHERE Mail_utilisateur = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupNom->execute([$Email]);
     $_SESSION['Nom_utilisateur']= $recupNom->fetchColumn();
   
     $recupPrem = $db->prepare("SELECT Prenom_Utilisateur FROM utilisateur WHERE Mail_utilisateur = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupPrem->execute([$Email]);
     $_SESSION['Prenom_utilisateur']= $recupPrem->fetchColumn();
    
     $recupPrem = $db->prepare("SELECT Nom_groupe FROM candidature  WHERE Mail_responsable = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupPrem->execute([$Email]);     
     $_SESSION['Nom_groupe']= $recupPrem->fetchColumn();
     
     $recupPrem = $db->prepare("SELECT Photo1 FROM candidature  WHERE Mail_responsable = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupPrem->execute([$Email]);     
     $_SESSION['Photos'][0] = $recupPrem->fetchColumn();
     $recupPrem = $db->prepare("SELECT Photo2 FROM candidature  WHERE Mail_responsable = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupPrem->execute([$Email]);     
     $_SESSION['Photos'][1] = $recupPrem->fetchColumn();

     $recupPrem = $db->prepare("SELECT Music1 FROM candidature  WHERE Mail_responsable = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupPrem->execute([$Email]);     
     $_SESSION['Musiques'][0] = $recupPrem->fetchColumn();
     $recupPrem = $db->prepare("SELECT Music2 FROM candidature  WHERE Mail_responsable = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupPrem->execute([$Email]);     
     $_SESSION['Musiques'][1] = $recupPrem->fetchColumn();
     $recupPrem = $db->prepare("SELECT Music3 FROM candidature  WHERE Mail_responsable = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupPrem->execute([$Email]);     
     $_SESSION['Musiques'][2] = $recupPrem->fetchColumn();
    
  Flight::render("vuecandidature.tpl",array('SESSION'=> $_SESSION));

    }
    else {
      Flight::render("login.tpl",array());
    }
});

Flight::route('GET /listecandidature', function(){
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

     $recupAdmin = $db->prepare("SELECT Admin FROM utilisateur WHERE Mail_utilisateur = ?");
     //récupère si une donnée est déjà existante dans la base  
     $recupAdmin->execute([$Email]);
     $_SESSION['Admin']= $recupAdmin->fetchColumn();

     if ($_SESSION['Admin']==1) {

       $table=Flight::get('db')->query(
        'select candidature.Nom_groupe , candidature.Page_groupe , candidature.Année_création , 
        candidature.Département_origine , candidature.Presentation , candidature.Style_musical
        , candidature.Soundcloud , candidature.Scene_groupe , candidature.Expériences_scéniques
        , candidature.Scene_groupe , candidature.Youtube from candidature');
       flight::render ('listecandidature.tpl' , array( 'donnees' =>$table));
         
      }
      else {

        Flight::render("index.tpl",array('SESSION'=> $_SESSION));

      }
    }
   else {
    Flight::render("index.tpl",array());
   }


});

?>

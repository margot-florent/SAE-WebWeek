<?php

$connection = new PDO('mysql:host=localhost;port=3306;dbname=webweek','root','');
                require_once("class_animation.php");
                require_once("class_personne.php");
                
// ***********************************    Création POO pour l'affichage des animations  *********************************************





// ***********************************    Récuperation des donnée de la bdd  *********************************************


            $requete = 'SELECT * FROM personne';
            $resultat = $connection ->query($requete);
            $tabPersonne = $resultat -> fetchAll();
            $resultat -> closeCursor();

            $requete = 'SELECT * FROM animation';
            $resultat = $connection ->query($requete);
            $tabAnimation = $resultat -> fetchAll();
            $resultat -> closeCursor();

            $requete = 'SELECT * FROM preinscrit';
            $resultat = $connection ->query($requete);
            $tabInscri = $resultat -> fetchAll();
            $resultat -> closeCursor();
            // print_r($tabInscri);
            // print_r($tabAnimation);

            
// ***********************************    Création des tableau d'objet  *********************************************
           
            if ($tabPersonne!= null){
                foreach ($tabPersonne as $j) {
                //crée des objets de la classe Personne via la base de donnée
                     $listePerso[]= new Personne($j["id_personne"], $j["nom_personne"], $j["prenom_personne"], $j["email_personne"]);
                }
            }

            if ($tabInscri!= null){
                for($i=0; $i<count($tabAnimation); $i++){
                    $listeInscri=[];
                    for($j=0; $j<count($tabInscri); $j++){
                        
                        if ($tabAnimation[$i]["id_animation"]== $tabInscri[$j]["id_animation"]){
                            // Liste des id des inscrits aux animations 
                            // echo("coucouuuuuuuu<br>");
                            // echo($tabAnimation[$i]["id_animation"]."anim<br>");
                            // echo("coucoufgbojdfjg".$tabInscri[$j]["id_personne"]);
                            // echo($tabInscri[$j]["id_animation"]."inscri<br>");
                            $listeInscri[$j]["id_personne"]= $tabInscri[$j]["id_personne"];
                            $listeInscri[$j]["nb_personne"]= $tabInscri[$j]["nb_personne"];
                            
                        }
                        
                }
                if (isset($listeInscri)== false){
                    $listeInscri=[];
                }
                // print_r($listeInscri);
               
                //création des animations, avec listeInscrit qui est composer des id des personnes
                $listeAnim[$i]= new Animation($tabAnimation[$i]["id_animation"],$tabAnimation[$i]["nom_animation"] , $tabAnimation[$i]["type_animation"], $tabAnimation[$i]["description_animation"], $tabAnimation[$i]["id_animation"],$tabAnimation[$i]["date_animation"], $tabAnimation[$i]["horaire_debut"], $tabAnimation[$i]["horaire_fin"], $tabAnimation[$i]["nb_places"], $listeInscri);
                // print_r($listeInscri);
                
            }
            }

           
// ***********************************    Création de la fonction d'affichage  *********************************************

        function affichage($idAnim, $listeAnim, $listePerso){
            //Création des animation
          

            for($i=0;$i<count($listeAnim); $i++){
                if ($listeAnim[$i]->id == $idAnim){
                    
                    $listeAnim[$i]->affichePerso($listePerso);
                }
            }
        }
            
            
            
           
                    
?>           
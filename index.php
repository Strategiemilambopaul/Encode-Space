<?php
require "Cryptography.php";
$Alphabet= (new Cryptography())->Alphabet();

$codeMessage=[];
$verify = false;
$show=false;
$message1="";
$message2="";
$i = 0;
$pair = false;
if(isset($_POST) and !empty($_POST)){
    
    if($_POST['choix']=='coder'){ 
        if(isset($_POST['nom'])){
            $message1="Encodage Numérique";
            $message2="Encodage AlphaStick";

            [$TableOfCriptName,$pair,$longueur] = (new Cryptography())->Encode($_POST['nom']);
            
          
        }
    }
    if($_POST['choix']=='decoder'){
        
        if(isset($_POST['nom'])){
            $message1="Décodage Numérique";
            $message2="Décodage Alphabetique";

            [$TableOfCriptName,$pair,$longueur] = (new Cryptography())->Decode($_POST['nom']);
        }

    }
}

if(isset($longueur) and is_array($TableOfCriptName) and $pair==true){ 
  
    for($i=0; $i <= $longueur -1 ; $i++){              
        foreach($Alphabet as $place => $letter ){                       
            if(isset($TableOfCriptName[$i]) and $TableOfCriptName[$i] == $place){
                $verify = true;            
                $codeMessage[] = $letter;            
            }    
        }
        if($verify==false){
            $codeMessage[] = "⛔";        
        }
        $verify=false;
    }
    $show=true;
    $longueur = $longueur-1;
}
if(isset($longueur) and is_array($TableOfCriptName) and $pair==false){ 

    ($_POST['choix']=="coder") ? $longueur = $longueur -2 :  $longueur = $longueur -1;
    
    for($i=0; $i <= $longueur; $i++){   
                   
        foreach($Alphabet as $place => $letter ){   
                            
            if(isset($TableOfCriptName[$i]) and $TableOfCriptName[$i] == $place){
                $verify = true; 
                
                $codeMessage[] = $letter;  
                      
            }    
        }
        if($verify==false){
            
            $codeMessage[] = "⛔";        
        }
        $verify=false;
    }
    $show=true;
   
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP Math</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<h2 class="bg-info w-20 text-center text-white py-2">Bienvenu sur EncodeSpace 🎃</h2> 
  <!-- Button trigger modal -->
  <?php if(isset($show) and !$show==true):?>
    <div class="text-center mb-2">   <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Help system</button></div>
  <?php endif?>
<?php if(isset($show) and $show==true):?>
 <div class="text-center" id="message">   
        <div class="btn btn-secondary mb-3">
            <span class="badge rounded-pill bg-success"><?=$message1?>: </span>
            <h6>
            <?php for($i=0; $i <= $longueur ; $i++):?>
               <span class="badge bg-primary"> <?=$TableOfCriptName[$i]." "?></span>
            <?php endfor ?>
            </h6> 
            
            <span class="badge rounded-pill bg-info"><?= $message2?>:</span>
            <h6>
                <?= implode(' ' ,$codeMessage)?>
            </h6>
        </div>
 </div>
 <?php endif?>

  <div class="form-group" id="formulaire">
    <form action="" method="post" >
        <span class="badge bg-warning text-dark mb-1">Remplissez la matrice</span>
       <div class="matrice">
        <div class="mb-1 bg-secondaire mx-4 py-2 ">
                <input type="number"  name="m1" placeholder="a" required>
                <input type="number"  name="m2" placeholder="b" required><br>
                <input type="number"  name="m3" placeholder="c" required>
                <input type="number"  name="m4" placeholder="d" required><br>
        </div>
       </div>
       <span class="badge bg-warning text-dark mb-1">Taper Du text</span>

       <div class="mb-3">
        <input type="text" name="nom"  placeholder="Entrez le message" class="form-control" required>
       </div>
      
       <span class="badge bg-warning text-dark mb-1">selectionner une action</span>
       <div class="mb-3">
            <select name="choix" id="" required class="form-control">
                <option value="">Quelle transformation voulez-vous?</option>
                <option value="coder">EnCoder 🔐</option>
                <option value="decoder">Decoder 🔓</option>
            </select>
       </div>
       <div class="mb-3 text-center">
        <input type="submit" value="Appliquer ⚙"class="btn btn-warning ">
       </div>
      
   </form>
  </div>
  <?php if(isset($show) and $show==true):?>
    <hr>
    <div class="text-center mt-2">   <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Help system</button></div>
  <?php endif?>



<!-- Modal -->

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Mode d'utilisation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h5> Bienvenu sur EncodeSpace,
            </h5>
            <p class="text-secondary">
                Encodespace vous permet de coder et décoder un message avec une matrice carrée que vous allez définir comme mot de passe du codage ou décodage.
            </p>   
            <p class="text-secondary">
                <span class="text-success">Coder un message 🔐</span>: il suffit de remplir la matrice et ainsi entrer un messsage dans la zone appropriée pour le message . En suite selectionner Encoder <br>
                <span class="text-danger">Décoder un message 🔓</span>: il suffit de remplir la matrice avec laquelle le message a été codé et ainsi entrez l'encodage numérique dans la zone appropriée pour le message. En suite selectionner Décoder
            </p> .
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Voir Les contraintes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Contraintes d'utilisations</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="btn btn-info text-white">
            <span class="btn btn-danger ">⛔ En effet, l'encodage et le décodage des caractères spécial ne pas pris en charge</span>
            Example: <span class="badge bg-warning"> $/%@*é"'(-èçà")+&é_è('')'*=àé'-| ^@~#{{}} ...</span>
            Veuillez respecter cette conterainte pour une meilleur utilisation de l'outil.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back Mode d'utilisation</button>
      </div>
    </div>
  </div>
</div>

<style>
    #formulaire{
        margin-left: 32%;
        border-radius : 10px;
        background: teal;
        padding: 15px;
        width: 40%;
        border: 2px black solid;
    }
    label{
        text: White;
        size: 20px;
    }
    .matrice{

        border-radius : 10px;
        background-color:;
        margin-bottom: 3px;
        border: 2px black solid;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<footer>
<i class="bg-info w-20 text-center">@all right <i>stg mil's</i> 🎃</i> 
</footer>
</body>
</html>
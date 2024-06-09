<?php
$Alphabet=[
    1 => "A",
    2 => "B",
    3 => "C",
    4 => "D",
    5 => "E",
    6 => "F",
    7 => "G",
    8 => "H",
    9 => "I",
    10 => "J",
    11 => "K",
    12 => "L",
    13 => "M",
    14 => "N",
    15 => "O",
    16 => "P",
    17 => "Q",
    18 => "R",
    19 => "S",
    20 => "T",
    21 => "U",
    22 => "V",
    23 => "W",
    24 => "X",
    25 => "Y",
    26 => "Z",
    27 => "0"

];
$TableOfCriptName=[];
$NameSplit = [];
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
            $longueur = strlen(htmlentities($_POST['nom']));
            
            if( $longueur % 2 == 0 ){
                $pair=ture;
                $text =strtoupper($_POST['nom']);
                $tableauNom=preg_split('//', $text, -1, PREG_SPLIT_NO_EMPTY);
           
                foreach($tableauNom as $letterOfName){
                    
                    foreach($Alphabet as $place => $letter ){
                        
                        if($letterOfName == $letter){
                            
                            $NameSplit[] = $place;
                            
                        }
                    }
                }
                if(is_array($NameSplit)){
                    $Running = $longueur - 2;
                    for($i=0; $i <= $Running; $i=$i+2){
                        
                    $NumberPlace1 = $_POST["m1"] * $NameSplit[$i] +  $_POST["m2"] * $NameSplit[$i+1];
                    $NumberPlace2 = $_POST["m3"] * $NameSplit[$i] +  $_POST["m4"] * $NameSplit[$i+1];
                        $TableOfCriptName[]=$NumberPlace1;
                        $TableOfCriptName[]=$NumberPlace2;
                    
                    }
                }
            }else{
                $pair = false;
                $longueur = $longueur + 1;
                $text =strtoupper($_POST['nom'])."0";
                $tableauNom=preg_split('//', $text, -1, PREG_SPLIT_NO_EMPTY);
           
                foreach($tableauNom as $letterOfName){
                    
                    foreach($Alphabet as $place => $letter ){
                        
                        if($letterOfName == $letter){
                            
                            $NameSplit[] = $place;
                            
                        }
                    }
                }
              
                if(is_array($NameSplit)){
                    $Running = $longueur - 2;
                    for($i=0; $i <= $Running; $i=$i+2){
                        
                    $NumberPlace1 = $_POST["m1"] * $NameSplit[$i] +  $_POST["m2"] * $NameSplit[$i+1];
                    $NumberPlace2 = $_POST["m3"] * $NameSplit[$i] +  $_POST["m4"] * $NameSplit[$i+1];
                        $TableOfCriptName[]=$NumberPlace1;
                        $TableOfCriptName[]=$NumberPlace2;
                    
                    }
                }
                // $TableOfCriptName=($TableOfCriptName);
                    // echo "<script>alert('entrer le mot avec paire des littres')</script>";
            }


        }


    }
    if($_POST['choix']=='decoder'){
        
        if(isset($_POST['nom'])){
            $message1="Décodage Numérique";
            $message2="Décodage Alphabetique";

            $Determinant = $_POST['m1'] * $_POST['m4'] - $_POST['m2'] * $_POST['m3'];
            $InverseDet = (1/$Determinant);
                $m1= $_POST['m4']*$InverseDet;
                $m2= -($_POST['m2']*$InverseDet);
                $m3= -($_POST['m3']*$InverseDet);
                $m4= $_POST['m1']*$InverseDet;
               

            $longueur = count(explode(' ',$_POST['nom']));
            if($longueur % 2 == 0){ 
               $pair= true;
                $tableauNom= explode(' ',$_POST['nom']);
                
                    if($tableauNom){
                        $Running = $longueur - 2;
                      
                        for($i=0; $i <= $Running; $i=$i+2){
                          
                        $NumberPlace1 = $m1 * (int)$tableauNom[$i] +  $m2 * (int)$tableauNom[$i+1];
                        $NumberPlace2 = $m3 * (int)$tableauNom[$i] +  $m4 * (int)$tableauNom[$i+1];
                            $TableOfCriptName[]=$NumberPlace1;
                            $TableOfCriptName[]=$NumberPlace2;
                            
                    }
                    
                }
            }else{
                $pair = false;
                $nom = $_POST['nom']." 0";
                $tableauNom= explode(' ',$nom);
                
                if($tableauNom){
                    
                    $Running = $longueur - 1;
                    for($i=0; $i <= $Running; $i=$i+2){
                        
                    $NumberPlace1 = $m1 * $tableauNom[$i] +  $m2 * $tableauNom[$i+1];
                    $NumberPlace2 = $m3 * $tableauNom[$i] +  $m4 * $tableauNom[$i+1];
                        $TableOfCriptName[]=$NumberPlace1;
                        $TableOfCriptName[]=$NumberPlace2;
                        
                }
                
            }
            }
        }

    }
}

if(isset($longueur) and is_array($TableOfCriptName) and $pair=true){ 
  
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
if(isset($longueur) and is_array($TableOfCriptName) and $pair=false){ 
  
    for($i=0; $i <= $longueur -2 ; $i++){   
                   
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
    $longueur = $longueur -2;
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
<h2 class="bg-info w-20 text-center">Bienvenu sur EncodeSpace 🎃</h2> 
<?php if(isset($show) and $show==true):?>
 <div class="text-center" id="message">   
        <div class="btn btn-secondary mb-2">
            <span class="badge rounded-pill bg-success"><?=$message1?>: </span>
            <h6>
            <?php for($i=0; $i <= $longueur ; $i++):?>
                <?=$TableOfCriptName[$i]." "?>
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
        <input type="text" name="nom"  placeholder="entrer le mot" class="form-control" required>
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

<footer>
<i class="bg-info w-20 text-center">@all right <i>stg mil's</i> 🎃</i> 
</footer>
</body>
</html>
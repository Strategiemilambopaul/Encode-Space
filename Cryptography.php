<?php

class Cryptography{
    private $name;
    public $NameSplit = [];
    public $codeMessage=[];
    public  $TableOfCriptName=[];
    public $verify = false;
    public $show=false;
    public $message1="";
    public $message2="";
    public $i = 0;
    public $pair = false;

    public function Alphabet(): array
    {
        return $Alphabet=[
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

    }
    public function Encode($name): array
    {
       $this->name=$name;
      
                $longueur = strlen(htmlentities($this->name));
                
                if( $longueur % 2 == 0 ){
                    $this->pair=true;
                    $text =strtoupper($this->name);
                    $tableauNom=preg_split('//', $text, -1, PREG_SPLIT_NO_EMPTY);
               
                    foreach($tableauNom as $letterOfName){
                        
                        foreach($this->Alphabet() as $place => $letter ){
                            
                            if($letterOfName == $letter){
                                
                                $this->NameSplit[] = $place;
                                
                            }
                        }
                    }
                    if(is_array($this->NameSplit)){
                        $Running = $longueur - 2;
                        for($i=0; $i <= $Running; $i=$i+2){
                            
                        $NumberPlace1 = $_POST["m1"] * $this->NameSplit[$i] +  $_POST["m2"] * $this->NameSplit[$i+1];
                        $NumberPlace2 = $_POST["m3"] * $this->NameSplit[$i] +  $_POST["m4"] * $this->NameSplit[$i+1];
                            $this->TableOfCriptName[]=$NumberPlace1;
                            $this->TableOfCriptName[]=$NumberPlace2;
                        
                        }
                    }
                }else{
                    $pair = false;
                    $longueur = $longueur + 1;
                    $text =strtoupper($this->name)."0";
                    $tableauNom=preg_split('//', $text, -1, PREG_SPLIT_NO_EMPTY);
               
                    foreach($tableauNom as $letterOfName){
                        
                        foreach($this->Alphabet() as $place => $letter ){
                            
                            if($letterOfName == $letter){
                                
                                $this->NameSplit[] = $place;
                                
                            }
                        }
                    }
                  
                    if(is_array($this->NameSplit)){
                        $Running = $longueur - 2;
                        for($i=0; $i <= $Running; $i=$i+2){
                            
                        $NumberPlace1 = $_POST["m1"] * $this->NameSplit[$i] +  $_POST["m2"] * $this->NameSplit[$i+1];
                        $NumberPlace2 = $_POST["m3"] * $this->NameSplit[$i] +  $_POST["m4"] * $this->NameSplit[$i+1];
                            $this->TableOfCriptName[]=$NumberPlace1;
                            $this->TableOfCriptName[]=$NumberPlace2;
                        
                        }
                    }
                    // $TableOfCriptName=($TableOfCriptName);
                        // echo "<script>alert('entrer le mot avec paire des littres')</script>";
                }
    
    return [$this->TableOfCriptName,$this->pair,$longueur];
            
        
    }
    public function Decode($name)
    {
        $this->name = $name;
          

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
                            $this->TableOfCriptName[]=$NumberPlace1;
                            $this->TableOfCriptName[]=$NumberPlace2;
                            
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
                            $this->TableOfCriptName[]=$NumberPlace1;
                            $this->TableOfCriptName[]=$NumberPlace2;
                        
                    }
                
                }
            }

        return [$this->TableOfCriptName,$this->pair,$longueur];
    }
}

?>
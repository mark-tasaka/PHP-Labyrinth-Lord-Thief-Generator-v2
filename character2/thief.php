<!DOCTYPE html>
<html>
<head>
<title>Labyrinth Lord Thief Character Generator Version 2</title>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
	<meta charset="UTF-8">
	<meta name="description" content="Dungeon Crawl Classics Thief Character Generator..">
	<meta name="keywords" content="Dungeon Crawl Classics,,HTML5,CSS,JavaScript">
	<meta name="author" content="Mark Tasaka 2022">
    
    <link rel="icon" href="../../../../images/favicon/icon.png" type="image/png" sizes="16x16"> 
		

	<link rel="stylesheet" type="text/css" href="css/thief.css">
    
    
    
    
</head>
<body>
    
    <!--PHP-->
    <?php
    
    include 'php/armour.php';
    include 'php/checks.php';
    include 'php/weapons.php';
    include 'php/gear.php';
    include 'php/classDetails.php';
    include 'php/abilityScoreGen.php';
    include 'php/xp.php';
    include 'php/diceRoll.php';
    include 'php/wealth.php';
    include 'php/nameSelect.php';
    include 'php/gender.php';
    include 'php/movementRate.php';
    include 'php/thiefSkills.php';
    


        if(isset($_POST["theCharacterName"]))
        {
            $characterName = $_POST["theCharacterName"];
            
    
        }

        if(isset($_POST["theGivenName"]))
        {
            $givenName = $_POST["theGivenName"];

        }

        if($givenName == '100')
        {
            $givenName = rand(0, 49);
        }
        else
        {
            $givenName = $givenName;
        }
        


        if(isset($_POST["theSurname"]))
        {
            $surname = $_POST["theSurname"];

        }

        if($surname == '100')
        {
            $surname = rand(0, 37);
        }
        else
        {
            $surname = $surname;
        }


        if(isset($_POST['theCheckBoxCustomName']) && $_POST['theCheckBoxCustomName'] == 1) 
        {
            $givenName = 200;
            $surname = 200;
            
        } 
    
            
        if(isset($_POST["theGender"]))
        {
            $gender = $_POST["theGender"];
        }
        
        $genderName = getGenderName($gender);
        $genderNameIdentifier = genderNameGeneration ($gender);
        
        $fullName = getName($givenName, $surname, $genderNameIdentifier);
        
        


        if(isset($_POST["theAlignment"]))
        {
            $alignment = $_POST["theAlignment"];
        }
    
        if(isset($_POST["theLevel"]))
        {
            $level = $_POST["theLevel"];
        
        } 

        
        
        if(isset($_POST["thePlayerName"]))
        {
            $playerName = $_POST["thePlayerName"];
    
        }


        
        $xpNextLevel = getXPNextLevel ($level);
        

        if(isset($_POST["theWealth"]))
        {
            $wealthOption = $_POST["theWealth"];
        
        } 
        
        $coinsArray = array();
        $coinCount = 0;

        $silverCoins = getSilver($wealthOption);
        $coinCount += $silverCoins;
        array_push($coinsArray, $silverCoins);
        
        $electrumCoins = getElectrum($wealthOption);
        $coinCount += $electrumCoins;
        array_push($coinsArray, $electrumCoins);
        
        $goldCoins = getGold($wealthOption);
        $coinCount += $goldCoins;
        array_push($coinsArray, $goldCoins);
        
        $platnumCoins = getPlatnum($wealthOption);
        $coinCount += $platnumCoins;
        array_push($coinsArray, $platnumCoins);

        $coinWeightDecimal = $coinCount * 0.1;

        $coinWeight = ceil($coinWeightDecimal);

        $wealth = getWealth($wealthOption, $coinsArray);

        if(isset($_POST['theCustomAbilityScore']) && $_POST['theCustomAbilityScore'] == 1) 
        {        
            
            if(isset($_POST["theStrength"]))
            {
                $strengthString = $_POST["theStrength"];
                $strength = intval($strengthString);
            }      

            if(isset($_POST["theDexterity"]))
            {
                $dexterityString = $_POST["theDexterity"];
                $dexterity = intval($dexterityString);
            }     

            if(isset($_POST["theConstitution"]))
            {
                $constitutionString = $_POST["theConstitution"];
                $constitution = intval($constitutionString);
            }       

            if(isset($_POST["theIntelligence"]))
            {
                $intelligenceString = $_POST["theIntelligence"];
                $intelligence = intval($intelligenceString);
            }  

            if(isset($_POST["theWisdom"]))
            {
                $wisdomString = $_POST["theWisdom"];
                $wisdom = intval($wisdomString);
            }  

            if(isset($_POST["theCharisma"]))
            {
                $charismaString = $_POST["theCharisma"];
                $charisma = intval($charismaString);
            }  

            $generationMessage = "Custom Ability Scores;";

        }
        else
        {        if(isset($_POST["theAbilityScore"]))
            {
                $abilityScoreGen = $_POST["theAbilityScore"];
            
            }
            
            
            $abilityScoreArray = array();
            
            for($i = 0; $i < 6; ++$i)
            {
                $abilityScore = rollAbilityScores ($abilityScoreGen);
    
                array_push($abilityScoreArray, $abilityScore);
    
            }       
    
            $strength = $abilityScoreArray[0];
            $dexterity = $abilityScoreArray[1];
            $constitution = $abilityScoreArray[2];
            $intelligence = $abilityScoreArray[3];
            $wisdom = $abilityScoreArray[4];
            $charisma = $abilityScoreArray[5];
            
            
            $generationMessage = generationMesssage ($abilityScoreGen);

        } 

        if($surname == 200)
        {
            $nameGenMessage = "Custom Name";
        }
        else
        {
            $nameGenMessage = getNameDescript($givenName, $surname);
        }

        
        $strengthMod = getAbilityModifier($strength);
        $dexterityMod = getAbilityModifier($dexterity);
        $constitutionMod = getAbilityModifier($constitution);
        $intelligenceMod = getAbilityModifier($intelligence);
        $wisdomMod = getAbilityModifier($wisdom);
        $charismaMod = getAbilityModifier($charisma);


        if(isset($_POST["theArmour"]))
        {
            $armour = $_POST["theArmour"];
        }
    
        $armourName = getArmour($armour)[0];
        
        $armourACBonus = getArmour($armour)[1];
        $armourWeight = getArmour($armour)[2];
/*
        if(isset($_POST['theCheckBoxShield']) && $_POST['theCheckBoxShield'] == 1) 
        {
            $shield = 1;
        }
        else
        {
            $shield = 0;
        }
        */
    /*
        $shieldName = getShield($shield)[0];
        
        $shieldACBonus = getShield($shield)[1];
        $shieldWeight = getShield($shield)[2];*/

       $totalAcDefense = $armourACBonus;

       $baseArmourClass = 9 - $dexterityMod;

       $armourClass = $baseArmourClass + $totalAcDefense;


       //Hit Points
       $hitPoints = getHitPoints($level, $constitutionMod);



        $weaponArray = array();
        $weaponNames = array();
        $weaponDamage = array();
        $weaponWeight = array();
    
    
    //For Random Select weapon
    if(isset($_POST['thecheckBoxRandomWeaponsV3']) && $_POST['thecheckBoxRandomWeaponsV3'] == 1) 
    {
        $weaponArray = getRandomWeapons();

    }
    else
    {
        if(isset($_POST["theWeapons"]))
        {
            foreach($_POST["theWeapons"] as $weapon)
            {
                array_push($weaponArray, $weapon);
            }
        }
    }

    
    
    foreach($weaponArray as $select)
    {
        array_push($weaponNames, getWeapon($select)[0]);
    }
        
    foreach($weaponArray as $select)
    {
        array_push($weaponDamage, getWeapon($select)[1]);
    }
        
    $totalWeaponWeight = 0;
    
    foreach($weaponArray as $select)
    {
        array_push($weaponWeight, getWeapon($select)[2]);
        $totalWeaponWeight += getWeapon($select)[2];
    }

    $armourAndWeapomWeight = $totalWeaponWeight + $armourWeight;
    
        $gearArray = array();
        $gearNames = array();
        $gearWeight = array();
    
    

    //For Random Select gear
    if(isset($_POST['theCheckBoxRandomGear']) && $_POST['theCheckBoxRandomGear'] == 1) 
    {
        $gearArray = getRandomGear();


    }
    else
    {
        //For Manually select gear
        if(isset($_POST["theGear"]))
            {
                foreach($_POST["theGear"] as $gear)
                {
                    array_push($gearArray, $gear);
                }
            }

    }

    
        foreach($gearArray as $select)
        {
            array_push($gearNames, getGear($select)[0]);
        }
        
        foreach($gearArray as $select)
        {
            array_push($gearWeight, getGear($select)[1]);
        }
        
        $totalWeightGear = 0;

        foreach($gearArray as $select)
        {
            $totalWeightGear += getGear($select)[1];
        }

        $totalWeightCarried = $armourAndWeapomWeight + $totalWeightGear + $coinWeight;

        $turnMovement = turnMovement($totalWeightCarried);
        $encounterMovement = encounterMovement($totalWeightCarried);
        $runningMovement = runningMovement($totalWeightCarried);

        $saveBreath = saveBreathAttack($level);
        $savePoisonDeath = savePoisonDeath($level);
        $savePetrify = savePetrify($level);
        $saveWands = saveWands($level);
        $saveWands -= $wisdomMod;
        $saveSpells = saveSpells($level);
        $saveSpells -= $wisdomMod;

        $primeReq = primeReq($dexterity);
        $thiefMessage = thiefMessage($level);

        $strengthDescription = strengthModifierDescription($strength);
        $dexterityDescription = dexterityModifierDescription($dexterity);
        $constitutionDescription = constitutionModifierDescription($constitution);
        $intelligenceDescription = intelligenceModifierDescription($intelligence);
        $wisdomDescription = wisdomModifierDescription($wisdom);
        $charismaDescription = charismaModifierDescription($charisma);

        $meleeHitAC0 = getThaco($level, $strengthMod);
        $meleeHitAC1 = $meleeHitAC0  - 1;
        $meleeHitAC1 = getThacoCheck($meleeHitAC1);
        $meleeHitAC2 = $meleeHitAC0  - 2;
        $meleeHitAC2 = getThacoCheck($meleeHitAC2);
        $meleeHitAC3 = $meleeHitAC0  - 3;
        $meleeHitAC3 = getThacoCheck($meleeHitAC3);
        $meleeHitAC4 = $meleeHitAC0  - 4;
        $meleeHitAC4 = getThacoCheck($meleeHitAC4);
        $meleeHitAC5 = $meleeHitAC0  - 5;
        $meleeHitAC5 = getThacoCheck($meleeHitAC5);
        $meleeHitAC6 = $meleeHitAC0  - 6;
        $meleeHitAC6 = getThacoCheck($meleeHitAC6);
        $meleeHitAC7 = $meleeHitAC0  - 7;
        $meleeHitAC7 = getThacoCheck($meleeHitAC7);
        $meleeHitAC8 = $meleeHitAC0  - 8;
        $meleeHitAC8 = getThacoCheck($meleeHitAC8);
        $meleeHitAC9 = $meleeHitAC0  - 9;
        $meleeHitAC9 = getThacoCheck($meleeHitAC9);

        $missileHitAC0 = getThaco($level, $dexterityMod);
        $missileHitAC1 = $missileHitAC0  - 1;
        $missileHitAC1 = getThacoCheck($missileHitAC1);
        $missileHitAC2 = $missileHitAC0  - 2;
        $missileHitAC2 = getThacoCheck($missileHitAC2);
        $missileHitAC3 = $missileHitAC0  - 3;
        $missileHitAC3 = getThacoCheck($missileHitAC3);
        $missileHitAC4 = $missileHitAC0  - 4;
        $missileHitAC4 = getThacoCheck($missileHitAC4);
        $missileHitAC5 = $missileHitAC0  - 5;
        $missileHitAC5 = getThacoCheck($missileHitAC5);
        $missileHitAC6 = $missileHitAC0  - 6;
        $missileHitAC6 = getThacoCheck($missileHitAC6);
        $missileHitAC7 = $missileHitAC0  - 7;
        $missileHitAC7 = getThacoCheck($missileHitAC7);
        $missileHitAC8 = $missileHitAC0  - 8;
        $missileHitAC8 = getThacoCheck($missileHitAC8);
        $missileHitAC9 = $missileHitAC0  - 9;
        $missileHitAC9 = getThacoCheck($missileHitAC9);

        $pickLock = getPickLocks($level);
        $findTrap = getFindTrap($level);
        $pickPockets = getPickPockets($level);
        $moveSilently = getMoveSilently($level);
        $climbWall = getClimbWall($level);
        $hideShadow = getHideShadows($level);
        $hearNoise = getHearNoise($level);

    
    ?>

    
	
<!-- JQuery -->
  <img id="character_sheet"/>
   <section>
       
           
        <span id="strength">
        <?php
            echo $strength;
            ?>
        </span>

        
        <span id="strengthMod">
        <?php
            echo $strengthDescription;
            ?>
        </span>

		<span id="dexterity">
        <?php
            echo $dexterity;
            ?>
        </span>

          <span id="dexterityMod">
        <?php
            echo $dexterityDescription;
            ?>
        </span>

           
		<span id="constitution">
        <?php
            echo $constitution;
            ?>
        </span>

          <span id="constitutionMod">
        <?php
            echo $constitutionDescription;
            ?>
        </span>
        
		<span id="intelligence">
        <?php
            echo $intelligence;
            ?>
        </span>

         <span id="intelligenceMod">
        <?php
            echo $intelligenceDescription;
            ?>
        </span>

		<span id="wisdom">
        <?php
            echo $wisdom;
            ?>
        </span>

         <span id="wisdomMod">
        <?php
            echo $wisdomDescription;
            ?>
        </span>


		<span id="charisma">
        <?php
            echo $charisma;
            ?>
        </span>

         <span id="charismaMod">
        <?php
            echo $charismaDescription;
            ?>
        </span>
        
        <span id="meleeHitAC0">
        <?php
            echo $meleeHitAC0;
            ?>
        </span>
        
        <span id="meleeHitAC1">
        <?php
            echo $meleeHitAC1;
            ?>
        </span>

        
        <span id="meleeHitAC2">
        <?php
            echo $meleeHitAC2;
            ?>
        </span>

        
        <span id="meleeHitAC3">
        <?php
            echo $meleeHitAC3;
            ?>
        </span>

        
        <span id="meleeHitAC4">
        <?php
            echo $meleeHitAC4;
            ?>
        </span>

        
        <span id="meleeHitAC5">
        <?php
            echo $meleeHitAC5;
            ?>
        </span>

        
        <span id="meleeHitAC6">
        <?php
            echo $meleeHitAC6;
            ?>
        </span>

        
        <span id="meleeHitAC7">
        <?php
            echo $meleeHitAC7;
            ?>
        </span>

        
        <span id="meleeHitAC8">
        <?php
            echo $meleeHitAC8;
            ?>
        </span>

        
        <span id="meleeHitAC9">
        <?php
            echo $meleeHitAC9;
            ?>
        </span>

        
        <span id="missileHitAC0">
        <?php
            echo $missileHitAC0;
            ?>
        </span>
        
        <span id="missileHitAC1">
        <?php
            echo $missileHitAC1;
            ?>
        </span>

        
        <span id="missileHitAC2">
        <?php
            echo $missileHitAC2;
            ?>
        </span>

        
        <span id="missileHitAC3">
        <?php
            echo $missileHitAC3;
            ?>
        </span>

        
        <span id="missileHitAC4">
        <?php
            echo $missileHitAC4;
            ?>
        </span>

        
        <span id="missileHitAC5">
        <?php
            echo $missileHitAC5;
            ?>
        </span>

        
        <span id="missileHitAC6">
        <?php
            echo $missileHitAC6;
            ?>
        </span>

        
        <span id="missileHitAC7">
        <?php
            echo $missileHitAC7;
            ?>
        </span>

        
        <span id="missileHitAC8">
        <?php
            echo $missileHitAC8;
            ?>
        </span>

        
        <span id="missileHitAC9">
        <?php
            echo $missileHitAC9;
            ?>
        </span>



       
       <span id="gender">
           <?php
           echo $genderName;
           ?>
       </span>
       
       
       
       <span id="class">Thief</span>
       
       <span id="armourClass">
           <?php
           echo $armourClass;
           ?>
           </span>

       
           <span id="armourClassBase">
           <?php
           echo '(' . $baseArmourClass . ')';
           ?>
           </span>
       
       <span id="hitPoints">
           <?php
           echo $hitPoints;
           ?>
           </span>


       

       <span id="wealth">
       <?php
           echo $wealth;
           ?>
       </span>

       
       <span id="coinWeight">
       <?php
           echo $coinWeight;
           ?>
       </span>

       
       <span id="level">
           <?php
                echo $level;
           ?>
        </span>

        
       <span id="xpNextLevel">
           <?php
                echo $xpNextLevel;
           ?>
        </span>

       

       
       <span id="characterName">
           <?php
                echo $characterName;
           ?>
        </span>

             
       <span id="characterName2">
           <?php
                echo $fullName;
           ?>
        </span>

              
       <span id="playerName">
           <?php
                echo $playerName;
           ?>
        </span>
       
       
       
              
         <span id="alignment">
           <?php
                echo $alignment;
           ?>
        </span>
        
        <span id="speed">
           <?php
           ?></span>
        


              
       <span id="armourName">
           <?php
                echo $armourName;
           ?>
        </span>

        <span id="armourACBonus">
            <?php
                echo $armourACBonus;
            ?>
        </span>

        
        <span id="armourWeight">
            <?php
                echo $armourWeight;
            ?>
        </span>
       
        <span id="weaponsList">
           <?php
           $val1 = 0;
           $val2 = 0;
           $val3 = 0;
           
           foreach($weaponNames as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
               $val1 = isWeaponTwoHanded($theWeapon, $val1);
               $val2 = isWeaponBastardSword($theWeapon, $val2);
           }
           
           $val3 = $val1 + $val2;
           
           $weaponNotes = weaponNotes($val3);
           
           ?>  
        </span>
       
       <span id="weaponNotes">
           <?php
                echo $weaponNotes;
           ?>
        </span>
            
       <span id="weaponsList2">
           <?php
           foreach($weaponDamage as $theWeaponDam)
           {
               echo $theWeaponDam;
               echo "<br/>";
           }
           ?>        
        </span>
       

            
       <span id="weaponsList3">
           <?php
           foreach($weaponWeight as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
           }
           ?>        
        </span>
       
       <span id="totalWeaponWeight">
           <?php
           echo $armourAndWeapomWeight;
           ?>
       </span>

       

       <span id="gearList">
           <?php
           foreach($gearNames as $theGear)
           {
               echo $theGear;
               echo "<br/>";
           }
           ?>
       </span>

       
       <span id="gearList2">
           <?php
           foreach($gearWeight as $theGear)
           {
               echo $theGear;
               echo "<br/>";
           }
           ?>
       </span>

       <span id="totalWeightCarried">
           <?php
                echo $totalWeightCarried . " lbs.";
           ?>
       </span>



       <span id="totalWeightGear">
           <?php
                echo $totalWeightGear;
           ?>
       </span>

        <span id="turnMovement">
           <?php
                echo $turnMovement;
           ?>
       </span>
       
       <span id="encounterMovement">
           <?php
                echo $encounterMovement;
           ?>
       </span>

       <span id="runningMovement">
           <?php
                echo $runningMovement;
           ?>
       </span>



       <span id="abilityScoreGeneration">
            <?php
           echo $generationMessage . ' ' . $nameGenMessage;
           ?>
       </span>
       
       <span id="saveBreath">
           <?php
                echo $saveBreath;
           ?>
       </span>

       <span id="savePoisonDeath">
           <?php
                echo $savePoisonDeath;
           ?>
       </span>

       <span id="savePetrify">
           <?php
                echo $savePetrify;
           ?>
       </span>

        <span id="saveWands">
            <?php
                echo $saveWands;
            ?>
        </span>

        <span id="saveSpells">
            <?php
                echo $saveSpells;
            ?>
        </span>

        
        <span id="classAbilities">
            <?php
                echo $primeReq;
                echo "Backstab: +4 attack bonus; x2 damage.";
                echo "</br></br>" . $thiefMessage;
            ?>
        </span>

        <span id="pickLock">
            <?php
                echo $pickLock . "%";
            ?>
        </span>

        
        <span id="findTrap">
            <?php
                echo $findTrap . "%";
            ?>
        </span>
        
        
        <span id="pickPockets">
            <?php
                echo $pickPockets . "%";
            ?>
        </span>
        
        <span id="moveSilently">
            <?php
                echo $moveSilently . "%";
            ?>
        </span>
        
        <span id="climbWall">
            <?php
                echo $climbWall . "%";
            ?>
        </span>
        
        <span id="hideShadow">
            <?php
                echo $hideShadow . "%";
            ?>
        </span>
        
        <span id="hearNoise">
            <?php
                echo $hearNoise;
            ?>
        </span>


       
	</section>
	

		
  <script>
      

  
       let imgData = "images/thief.png";
      
        $("#character_sheet").attr("src", imgData);
      

    
	 
  </script>
		
	
    
</body>
</html>
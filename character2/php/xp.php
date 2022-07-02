<?php

function getXPNextLevel ($level)
{
    $xpNext = "";


    switch ($level) 
    {
        case "1":
            $xpNext = "1,251";
          break;

        case "2":
            $xpNext = "2,501";
        break;
        
        case "3":
            $xpNext = "5,001";
        break;
        
        case "4":
            $xpNext = "10,001";
        break;
        
        case "5":
            $xpNext = "20,001";
        break;
        
        case "6":
            $xpNext = "40,001";
        break;        

        case "7":
            $xpNext = "80,001";
        break;
                
        case "8":
            $xpNext = "160,001";
        break;
                
        case "9":
            $xpNext = "280,001";
        break;
                
        case "10":
            $xpNext = "400,001";
        break;
                
        case "11":
            $xpNext = "520,001";
        break;
                
        case "12":
            $xpNext = "640,001";
        break;
                
        case "13":
            $xpNext = "760,001";
        break;
                
        case "14":
            $xpNext = "880,001";
        break;
                
        case "15":
            $xpNext = "1,000,001";
        break;
                
        case "16":
            $xpNext = "1,120,001";
        break;
                
        case "17":
            $xpNext = "1,240,001";
        break;
                
        case "18":
            $xpNext = "1,360,001";
        break;
                
        case "19":
            $xpNext = "1,480,001";
        break;
                
        case "20":
            $xpNext = "---";
        break;


        default:
          $xpNext = " =P ";
      }

      return $xpNext;
}


?>
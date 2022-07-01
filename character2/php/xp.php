<?php

function getXPNextLevel ($level)
{
    $xpNext = "";


    switch ($level) 
    {
        case "1":
            $xpNext = "1,565";
          break;

        case "2":
            $xpNext = "3,125";
        break;
        
        case "3":
            $xpNext = "6,251";
        break;
        
        case "4":
            $xpNext = "12,501";
        break;
        
        case "5":
            $xpNext = "25,001";
        break;
        
        case "6":
            $xpNext = "50,001";
        break;        

        case "7":
            $xpNext = "100,001";
        break;
                
        case "8":
            $xpNext = "200,001";
        break;
                
        case "9":
            $xpNext = "300,001";
        break;
                
        case "10":
            $xpNext = "400,001";
        break;
                
        case "11":
            $xpNext = "500,001";
        break;
                
        case "12":
            $xpNext = "600,001";
        break;
                
        case "13":
            $xpNext = "700,001";
        break;
                
        case "14":
            $xpNext = "800,001";
        break;
                
        case "15":
            $xpNext = "900,001";
        break;
                
        case "16":
            $xpNext = "1,000,001";
        break;
                
        case "17":
            $xpNext = "1,100,001";
        break;
                
        case "18":
            $xpNext = "1,200,001";
        break;
                
        case "19":
            $xpNext = "1,300,001";
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
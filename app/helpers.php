<?php

function ___($xVariable, $bBreakPoint = true, $bDumpMode = false, $type = '000')
  {
      echo "<pre style='font-size: 1em; color: #{$type}; line-height: 18px; font-weight:bold;'>";
      if (!$bDumpMode)
      {
         print_r($xVariable);
      }
      else {
         var_dump($xVariable);
      }
      echo '</pre>';

      if ($bBreakPoint)
      {
         exit();
     }
  }

?>


<?php
        echo "asdf";
    
        $tempo = isset($_GET['tempo']) ? $_GET('tempo') : 80;
        $score = isset($_GET['score']) ? $_GET('score') : "r";
        
        $scoreString = $tempo.";".$score;
        
        // echo $scoreString;
        echo $scoreString;
    
        return $scoreString;
    

?>
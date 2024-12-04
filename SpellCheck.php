<!DOCTYPE html>
<html>
    <head>
        <title>Spell Check</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>
        <header class="w3-center w3-black w3-container">
            <h1>Spell Check - Results</h1>
        </header>
    </body>
    <body>
        <?php 
            function isVowel($letter) {
                if ($letter == "a" || $letter == "e"  ||  $letter == "i" || $letter == "o" || $letter == "u") {
                    return true;
                }
                
                return false;
            }
        
            function spellCheck($inputWord, $inputLen, $dictWord, $dictWordLen) {
                $spellCheckArr = array(array());
                $numCount = 0;
                for ($i = 0; $i <= $inputLen; $i++) {
                    $spellCheckArr[0][$i] = $numCount;
                    $numCount += 2;
                }

                $numCountB = 2;
                for ($i = 1; $i <= $dictWordLen; $i++) {
                    $spellCheckArr[$i][0] = $numCount;
                    $numCountB += 2;
                }
        
                for ($row = 1; $row <= $dictWordLen; $row++) {
                    for ($col = 1; $col <= $inputLen; $col++) {
                        $cost = 0;
                        $costRight = 2 + $spellCheckArr[$row][$col-1];
                        $costUp = 2 + $spellCheckArr[$row-1][$col];
                        $costAcr = $spellCheckArr[$row-1][$col-1];
                        
                        if ($dictWord[$row-1] == $inputWord[$col-1]) { // perfect match
                            $costAcr += 0;
                        }
                        else if (isVowel($dictWord[$row-1]) && isVowel($inputWord[$col-1])) { // v/v
                            $costAcr += 1;
                        }
                        else if (!isVowel($dictWord[$row-1]) && !isVowel($inputWord[$col-1])) { // c/c
                            $costAcr += 1;
                        }
                        else {  // mismatch
                            $costAcr += 3;
                        }
        
                        if (($costAcr <= $costRight) && ($costAcr <= $costUp)) {
                            $cost = $costAcr;
                        }
                        else if (($costRight <= $costAcr) && ($costRight <= $costUp)) {
                            $cost = $costRight;
                        }
                        else {
                            $cost = $costUp;
                        }
        
                        $spellCheckArr[$row][$col] = $cost;
                    }
                }
                return $spellCheckArr[$dictWordLen][$inputLen];
            }

            $wordCheck = $_POST["input"];
            $checked = array();
            $dictionary = fopen("dictionary.txt", "r");

            while(!feof($dictionary)) {
                $curWord = fgets($dictionary);
                $scCost = spellCheck($wordCheck, strlen($wordCheck), $curWord, strlen($curWord));

                if (count($checked) < 10) {
                    $checked += [$curWord => $scCost];
                }
                else {
                    asort($checked);
                    
                    if($scCost < end($checked)) {
                        $lastWord = array_key_last($checked);

                        unset($checked[$lastWord]);

                        $checked += [$curWord => $scCost];
                    }
                }
            }

            fclose($dictionary);
            asort($checked);

            echo "Best words that match <b>$wordCheck</b>:<br><ol>";
            foreach($checked as $k => $v) {
                echo "<li>Word: $k - Cost: $v</li>";
            }

            echo "</ol>";

        ?>
// test

    </body>
    <footer class= "w3-center w3-monospace w3-dark-grey w3-container">
        <?php
        $date = date_create();

        echo "Today's date is ".date_format($date, "M j, Y");
        ?>
    </footer>
</html>
<?php
//header("Cache-Control: post-check=0, pre-check=0", FALSE);
$fileName = $_GET["liste"];
$sprachAuswahl = 1;
   
    if(isset($_POST["sprachAuswahl"])) {
    $sprachAuswahl = $_POST["sprachAuswahl"];  
        }



if (($handle = @fopen("./uploads/" . $fileName, "r")) != FALSE) { 
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        for ($c = 0; $c < $num; $c++) {
            $inhalt[] = $data[$c];
        }
    }
    fclose($handle);

    
   if($sprachAuswahl ){
    for ($i = 0; $i < sizeof($inhalt); $i++) {
        $sprache1[] = $inhalt[$i++];
        $sprache2[] = $inhalt[$i];
    }   
    shuffle($sprache1);
    $vokabel1 = $sprache1[0];

    for ($i = 0; $i < sizeof($inhalt); $i++) {
        if ($vokabel1 == $inhalt[$i]) {
            $vokabel2 = $inhalt[$i + 1];
            //array_splice($inhalt, [$i+1], [$i+1]);
        }
    }
    shuffle($sprache2);
    for ($i = 0; $i < 5; $i++) {
        if($sprache2[$i]!= $vokabel2){ // nicht die gleiche vokabel 2 mal in den antwortmöglichkeiten
        $ausgabe[] = $sprache2[$i];
        }
    }
    $ausgabe[5] = $vokabel2;
    shuffle($ausgabe);
   }


    //Sprachauswahl 2
   if(!$sprachAuswahl)
  {
       for ($i = 0; $i < sizeof($inhalt); $i++) {
            $sprache1[] = $inhalt[$i++];
            $sprache2[] = $inhalt[$i];
        }
          shuffle($sprache2);
            $vokabel1 = $sprache2[0];

            for ($i = 0; $i < sizeof($inhalt); $i++) {
                if ($vokabel1 == $inhalt[$i]) {
                    $vokabel2 = $inhalt[$i - 1];
                }
            }
       
            shuffle($sprache1);
            for($i = 0 ; $i < sizeof($sprache1); $i++){
                if($vokabel2 == $sprache1[$i]){
                    unset($sprache[$i]);
                }
            }
            for ($i = 0; $i < 5; $i++) {
                //if($sprache1[$i] != vokabel2){
                $ausgabe[] = $sprache1[$i];
                //}
            }
            $ausgabe[5] = $vokabel2;
            shuffle($ausgabe);
        
        
  }
}
?>

    <div id = "fragenAjax" >
       
        
        
        
        <input type="button" onclick="myFunction(1)" value="a">
        <input type="button" onclick="myFunction(0)" value="b">
        
        <button onclick="myFunction()">Click me to change my text color.</button>

    <script>
    function myFunction(sprache) {
        alert("fragen.php?liste=<?php echo $_GET["liste"];?>".replace(/\s/g,"%20"));
        //$("#fragenAjax").load("fragen.php?liste=<?php echo $_GET["liste"];?>".replace(/\s/g,"%20"),{sprachAuswahl: sprache});
        $("#fragenAjax").load(window.location.href+" #fragenAjax",{sprachAuswahl: sprache});
    }
    </script>
        <?php
        var_dump($vokabel2);
        ?>
        
        <div data-role="content">            
           <center> 
            <form>
                <fieldset data-role="controlgroup" data-type="horizontal" >
                    <input type="button" onchange="sprachwechsel(this)"  name="radio-choice-h-2" id="radio-choice-h-2a" value="on" checked="checked">
                    <label for="radio-choice-h-2a">   <?php echo "A < - > B"; ?></label>
                    <input type="button" onchange="sprachwechsel(this)"  name="radio-choice-h-2" id="radio-choice-h-2b" value="off">
                    <label for="radio-choice-h-2b">   <?php echo "B < - > A"; ?></label>
                </fieldset>
            </form>
           </center>
  
    <div class="ui-grid-a ui-responsive">
    <div class="ui-block-a">                
    <div class="ui-content">
            <div class="wordbox" >
                <span><?php echo $vokabel1 ?></span>
            </div>
    </div>
    </div>
        <div class="ui-block-b">
        <div class="ui-content">
            <div data-role="main" class="ui-content">
                <form method="post" action="antwort.php?lektion=<?php echo $fileName ?>">
                    <fieldset data-role="controlgroup">
                        <?php
                        for ($i = 0; $i < 5; $i++) {

                            $currentInputId = "radio-choice-v-" . $i;
                            ?>

                            <input type='radio' name='antwort_klickt' id='<?php echo $currentInputId; ?>' value="<?php echo $ausgabe[$i]; ?>"><label for='<?php echo $currentInputId; ?>'><?php echo $ausgabe[$i];?></label>

                            <?php
                        }
                        ?>
                    </fieldset>
                    <?php 
                    echo "<input style='display: none; visibility: hidden;' type='text' name='vokabel1' value='{$vokabel1}'>";
                    echo "<input style='display: none; visibility: hidden;' type='text' name='vokabel2' value='{$vokabel2}'>";
                    echo "<input id='sprachAuswahl' style='display: none; visibility: hidden;' type='text' name='richtung' value='$sprachAuswahl'>";
                    ?>
                    <center><input type="submit" data-inline="true" value="Submit"></center>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
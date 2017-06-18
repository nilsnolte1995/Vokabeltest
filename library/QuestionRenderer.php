<?php

class QuestionRenderer
{
    public static function renderQuestion($rootPath, $fileName)
    {
        $language = $_SESSION[SessionUtilities::getSessionName($fileName)];
        
        if (($handle = @fopen($rootPath."uploads/" . $fileName, "r")) != FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                for ($c = 0; $c < $num; $c++) {
                    $inhalt[] = $data[$c];
                }
            }
            fclose($handle);


            if($language == 1){
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
            else
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

                for ($i = 0; $i < 5; $i++) {
                    if($sprache1[$i] != $vokabel2){
                        $ausgabe[] = $sprache1[$i];
                    }
                }
                $ausgabe[5] = $vokabel2;
                shuffle($ausgabe);


            }

            ?>

            <div class="ui-block-a">
                <div class="ui-content">
                    <div class="wordbox">
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

                                    <input type='radio' name='antwort_klickt' id='<?php echo $currentInputId; ?>'
                                           value="<?php echo $ausgabe[$i]; ?>"><label
                                        for='<?php echo $currentInputId; ?>'><?php echo $ausgabe[$i]; ?></label>

                                    <?php
                                }
                                ?>
                            </fieldset>
                            <?php
                            echo "<input style='display: none; visibility: hidden;' type='text' name='vokabel1' value='{$vokabel1}'>";
                            echo "<input style='display: none; visibility: hidden;' type='text' name='vokabel2' value='{$vokabel2}'>";
                            ?>
                            <center><input type="submit" data-inline="true" value="Submit"></center>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
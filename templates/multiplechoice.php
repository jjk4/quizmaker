<?php $number = $_GET["number"];?>
<div class="question" id="frage<?php echo $number;?>">
    <h1>Frage <?php echo $number;?></h1>
    <h3>(Multiple Choice)</h3>
    <input type="hidden" name="<?php echo $number;?>_type" value="multiplechoice">
    Frage: <input name="<?php echo $number;?>_question" type="text" style="width: 40%;"><br><br>
    <div class="answers_<?php echo $number;?>">
        Antwort: <input name="<?php echo $number;?>_1" type="text">
        Richtig? <input name="<?php echo $number;?>_1_correct" type="checkbox"><br>
        Antwort: <input name="<?php echo $number;?>_2" type="text">
        Richtig? <input name="<?php echo $number;?>_2_correct" type="checkbox"><br>
        Antwort: <input name="<?php echo $number;?>_3" type="text">
        Richtig? <input name="<?php echo $number;?>_3_correct" type="checkbox"><br>
        Antwort: <input name="<?php echo $number;?>_4" type="text">
        Richtig? <input name="<?php echo $number;?>_4_correct" type="checkbox"><br>
        Antwort: <input name="<?php echo $number;?>_5" type="text">
        Richtig? <input name="<?php echo $number;?>_5_correct" type="checkbox"><br>
    </div>
</div>

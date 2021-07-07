<?php $number = $_GET["number"];?>
<div class="question" id="frage<?php echo $number;?>">
    <h1>Frage <?php echo $number;?></h1>
    <h3>(Wahr/Falsch)</h3>
    <input type="hidden" name="<?php echo $number;?>_type" value="truefalse">
    Frage: <input name="<?php echo $number;?>_question" type="text" style="width: 40%;"><br><br>
    <div class="answers_<?php echo $number;?>">
        Wahr? <input name="<?php echo $number;?>_true" type="checkbox"><br>
        Falsch? <input name="<?php echo $number;?>_false" type="checkbox"><br>
    </div>
    <script>
        $("input[name='<?php echo $number;?>_true']").click(function() {
            if(this.checked) {
                $("input[name='<?php echo $number;?>_false']").prop('checked', false);
            }

        });
        $("input[name='<?php echo $number;?>_false']").click(function() {
            if(this.checked) {
                $("input[name='<?php echo $number;?>_true']").prop('checked', false);
            }

        });
    </script>

</div>

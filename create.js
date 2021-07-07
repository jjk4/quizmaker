let fragennummer = 0;
$( document ).ready(function() {
    $( "#multiplechoice" ).click(function() {
        fragennummer += 1;
        jQuery.get('templates/multiplechoice.php?number=' + fragennummer, function(data) {
            $("#questions").append(data);
        });
        $("input[name='numberofquestions']").val(fragennummer);
    });
    $( "#truefalse" ).click(function() {
        fragennummer += 1;
        jQuery.get('templates/truefalse.php?number=' + fragennummer, function(data) {
            $("#questions").append(data);
        });
        $("input[name='numberofquestions']").val(fragennummer);
    });
    $( "#onechoice" ).click(function() {
        fragennummer += 1;
        jQuery.get('templates/onechoice.php?number=' + fragennummer, function(data) {
            $("#questions").append(data);
        });
        $("input[name='numberofquestions']").val(fragennummer);
    });
});

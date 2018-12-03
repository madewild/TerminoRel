$(document).ready(function () {
    $("#source").change(function () {
        var val = $(this).val();
        if (val == "en") {
            $("#cible").html("<option value='fr'>français</option>");
        } else if (val == "fr") {
            $("#cible").html("<option value='en'>anglais</option>");
        }
    });
});
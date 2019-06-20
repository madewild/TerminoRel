$(document).ready(function () {
    $("#source").change(function () {
        var val = $(this).val();
        if (val == "en") {
            $("#target").html("<option value='fr'>français</option>");
        } else if (val == "fr") {
            $("#target").html("<option value='en'>anglais</option>");
        }
    });
});
function validate() {
    if(document.getElementById('term').value.trim()=="") {
        alert("Veuillez entrer au moins un caractère !");
        return false;
    }
    return true;
}
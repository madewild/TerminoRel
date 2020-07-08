$(document).ready(function(){
    $('#domain').on('change', function(){
        var domainID = $(this).val();
        if(domainID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'domain_id='+domainID,
                success:function(html){
                    $('#fiche').html(html);
                }
            }); 
        } else {
            $('#fiche').html('<option value="">Choisissez un domaine</option>');
        }
    });
});
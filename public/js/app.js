$(function(){
    $('#delete-item').hide();
    $table = $("#table");
    $table.find('th').css('cursor','pointer');
    $table.dataTable({
        "bStateSave": true,
        "oLanguage": {
            "sSearch": "Buscar : ",
            "sZeroRecords" : "No Hay Resultados Con tu B&uacute;squeda"
        },
        "bPaginate": false,
        "bInfo": false,
    });  
    
    $(document).on('click', '.check-all', function () {
        var parent = $(this).parents('.table');
        if($(this).is(':checked'))
        {
            parent.find("tbody tr td input:checkbox").prop('checked', true);
            $('#delete-item').css('display', 'inline-block');
        }
        else
        {
            parent.find("tbody > tr > td > input:checkbox").prop("checked", false);
            $('#delete-item').hide();
        }

    }).on('change', '.table tbody tr td input:checkbox', function()
    {
        var parent = $(this).parents('.table'); 
        if(parent.find("tbody tr td input:checkbox:checked").length >= 1)
        {
            $('#delete-item').css('display', 'inline-block');
        }
        else
        {
             $('#delete-item').hide();
        }
    })
    
});
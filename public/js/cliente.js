$(function () { 
    $(document).on('click', '#delete-item', function()
    {
        $('#confirm-modal').modal();
    }).on('click','.confirm-action', function () {
        $.each($('.table tbody tr td input:checkbox:checked'), function( key, value ) 
        {
            $.ajax(
            {
                "url": window.location.href.toString()+"/../clientes/"+$(this).data('user-id'),
                "type": "DELETE",
                "datatype" : 'json',
                success : function (data){
                    window.location.replace(data)
                }
            });
        });
    });
});
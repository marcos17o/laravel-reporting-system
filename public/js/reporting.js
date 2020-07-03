$(document).ready( function(){
    $('.btn-enviar-data').click(function (e){
        e.preventDefault();
        
        let form = $('#formulario-reporte-1');

        let data = form.serialize();

        let url = form.attr('action');

        console.log(data.includes('users'));
        if (data.includes('users')) {
            $.post(url, data, function(result){
                // console.log(result);
                console.log(JSON.stringify(result));
            });
        } else {
            console.log('Debe selecionar un elemento en la lista de usuarios');
        } ;

    });
});

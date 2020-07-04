$('#grafica').hide();

$(document).ready( function(){
    $('.btn-enviar-data').click(function (e){
        e.preventDefault();
        
        let form = $('#formulario-reporte-1');

        let data = form.serialize();

        let url = form.attr('action');

        console.log(data.includes('users'));
        console.log(data);

        if (data.includes('users')) {
            for (let index = 0; index < 2; index++) {
                    
                $.post(url, data, function(result){
                        // console.log(JSON.stringify(result));
                        
                    console.log(result);
                    $('#grafica').html(result);
                    // $('#grafica').html(result);
                    // $('.btn-enviar-data').click();
                    // $('#grafica').load();
                    $('#grafica').append(result);
                    $('#grafica').show();
                });
            }
        } else {
            console.log('Debe selecionar un elemento en la lista de usuarios');
        } ;

    });
});

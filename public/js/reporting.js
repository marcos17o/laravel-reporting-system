$('#grafica').hide();

function no_select_user_formulario(){
    $('.msg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> Debe selecionar al menos a un usuario</div>');
    $('#list1').focus();
    $('.alert-dismissible').delay(3200).fadeOut(300);
}

$(document).ready( function(){
    $('.btn-data-grafica').click(function (e){
        e.preventDefault();

        let form = $('#formulario-reporte');

        let data = form.serialize();

        // console.log(data.includes('users'));
        // console.log(data);

        if (data.includes('users')) {
            $('#grafica').html('<i class="fas fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            $.ajax({
                type: "POST",
                url: '/get_data_grafica',
                data: data,
                success: function(result) {
                    // console.log(result);
                    console.log(true);
                    $('.loading').hide();
                    $('#grafica').html(result);
                    $('#grafica').show();
                }
            }).fail(function() {

                // alert( 'Error!!' );

            }).fail( function( jqXHR, textStatus, errorThrown ) {
                console.log('Uncaught Error: ' + jqXHR.responseText);
                // $('#grafica').html(jqXHR.responseText);
                $('#grafica').html('An error occurred, try again');
            });
        } else {
            console.log('Debe selecionar un elemento en la lista de usuarios');
            no_select_user_formulario();

        } ;

    });

    $('.btn-data-torta').click(function (e){
        e.preventDefault();

        let form = $('#formulario-reporte');

        let data = form.serialize();

        console.log(data.includes('users'));
        console.log(data);

        if (data.includes('users')) {
            $('#grafica').html('<i class="fas fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            $.ajax({
                type: "POST",
                url: '/get_data_grafica_torta',
                data: data,
                success: function(result) {
                    // console.log(result);
                    console.log(true);
                    $('.loading').hide();
                    $('#grafica').html(result);
                    $('#grafica').show();
                }
            }).fail( function( jqXHR, textStatus, errorThrown ) {
                console.log('Uncaught Error: ' + jqXHR.responseText);
                // $('#grafica').html(jqXHR.responseText);
                $('#grafica').html('An error occurred, try again');
            });
        } else {
            console.log('Debe selecionar un elemento en la lista de usuarios');
            no_select_user_formulario();
        } ;

    });
    $('.btn-data-relatorio').click(function (e){
            e.preventDefault();

            let form = $('#formulario-reporte');

            let data = form.serialize();

            console.log(data.includes('users'));
            console.log(data);

            if (data.includes('users')) {
                $('#grafica').html('<i class="fas fa-spinner fa-pulse fa-5x fa-fw"></i><span class="sr-only">Loading...</span>');
                $.ajax({
                    type: "POST",
                    url: '/get_data_relatorio',
                    data: data,
                    success: function(result) {
                        console.log(true);
                        console.log(result);
                        $('.loading').hide();
                        $('#grafica').html(result);
                        $('#grafica').show();
                    }
                }).fail( function( jqXHR, textStatus, errorThrown ) {
                    console.log('Uncaught Error: ' + jqXHR.responseText);
                    // $('#grafica').html(jqXHR.responseText);
                    $('#grafica').html('An error occurred, try again');
                });
            } else {
                console.log('Debe selecionar un elemento en la lista de usuarios');
                no_select_user_formulario();
            } ;

        });
    });

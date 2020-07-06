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
            $('#grafica').html('<div class="loading">Un momento, por favor...</div>');
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
            $('#grafica').html('<div class="loading">Un momento, por favor...</div>');
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
            });
        } else {
            console.log('Debe selecionar un elemento en la lista de usuarios');
            no_select_user_formulario();
        } ;

    });
});

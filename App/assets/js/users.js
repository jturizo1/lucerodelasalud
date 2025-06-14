function userCreateOK (id)
{
    swal("EXCELENTE!", "SE HA CREADO EL USUARIO EXITOSAMENTE!", "success");
}

function userDeleteOK(id)
{
    swal(
        {
            title: "ESTÁ SEGURO?",
            text: "¡ESTÁS INTENTANDO ELIMINAR UN USUARIO!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
    .then((willDelete) => 
        {
            if (willDelete) {
                swal("!EL USUARIO FUE ELIMINADO CON ÉXITO!", 
                    {
                        icon: "success",
                    });
            } else {
                swal("UD A CANCELADO LA OPERACIÓN");
            }
        });
}
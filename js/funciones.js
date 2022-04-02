//Mensajes alert
window.setTimeout(function(){
    $(".alert").fadeTo(1500, 0).slideDown(1000,function(){
        $(this).remove();
    })
}, 1500);
 
function eliminar(id){
    let opcion = confirm("¿Esta seguro que quiere eliminar el usario?");
    if(opcion){ 
        location.href = "eliminar.php?id="+id;    
    }
}
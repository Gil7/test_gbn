$(document).ready(function(e){

	$("#table-categories").on('click','.delete', function(e){
        e.preventDefault();
        var id = $(this).data('id')
        swal({
          title: "Confirm",
          text: `Do you really want to remove this category: ${$(this).data('name')}`,
          icon: "warning",
          buttons: ["Cancelar", "Eliminar"],
          dangerMode: true,
        })
        .then((eliminar) => {
          if (eliminar) {
            $('#delete_form').attr('action',`/categories/${$(this).data('id')}`);  
            $('#delete_form').submit();
            return false
          } 
          throw null;
        })
        .catch(err => {
        	console.log(err)
        })

    })

})
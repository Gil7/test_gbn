$(document).ready(function(e){

	$("#table-books").on('click','.delete', function(e){
        e.preventDefault();
        var id = $(this).data('id')
        swal({
          title: "Confirm",
          text: `Do you really want to remove this book: ${$(this).data('name')}`,
          icon: "warning",
          buttons: ["Cancelar", "Eliminar"],
          dangerMode: true,
        })
        .then((eliminar) => {
          if (eliminar) {
            $('#delete_form').attr('action',`/books/${$(this).data('id')}`);  
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
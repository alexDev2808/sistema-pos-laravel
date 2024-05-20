<script>
    $('.tblscroll').nicescroll({
        cursorcolor: "#515365",
        cursorwidth: "30px",
        background: "rgba(20,20,20,0.3)",
        cursorborder: "0px",
        cursorborderradius: 3
    })

    function Confirm(id, eventName, text) {


        swal({
            title: 'Confirmar',
            text: text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#FFF',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#FF204E'
        }).then(function(res) {
            if (res.value) {
                window.livewire.emit(eventName, id)
                swal.close()
            }
        })
    }
</script>

<script>
    var listener = new window.keypress.Listener();


    listener.simple_combo("f9", function() {

        livewire.emit('saveSale')

    })


    listener.simple_combo("f8", function() {

        document.getElementById('cash').value = ''

        document.getElementById('cash').focus()

    })


    listener.simple_combo("f4", function() {

        var total = parseFloat(document.getElementById('hiddenTotal').value)

        if (total > 0) {

            Confirm(0, 'clearCart', '¿Deseas eliminar el carrito?')

        } else {

            noty('Agrega Productos a la Venta')

        }

    })
</script>

<script src="{{ asset('plugins/dmauro-keypress/keypress-2.1.5.min.js') }}"></script>

            <div class="modal-footer mt-5 ">
                <button 
                    wire:click.prevent="resetUI()"
                    type="button" 
                    class="btn btn-outline-secondary close-btn mb-2" 
                    data-dismiss="modal">
                    Cerrar
                </button>

                @if( $selected_id < 1 )
                    <button 
                        wire:click.prevent="Store()"
                        type="button" 
                        class="btn text-white close-modal font-weight-bold mb-2 " 
                        style="background: #378CE7"
                        >
                        Guardar
                    </button>
                @else
                    <button 
                        wire:click.prevent="Update()"
                        type="button" 
                        class="btn close-modal font-weight-bold mb-2" 
                        style="background: #FFC700"
                        >
                        Actualizar
                    </button>    
                @endif
            </div>
        </div>
    </div>
</div>

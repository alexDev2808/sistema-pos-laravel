            <div class="modal-footer">
                <button 
                    wire:click.prevent="resetUI()"
                    type="button" 
                    class="btn btn-secondary close-btn" 
                    data-dismiss="modal">
                    Cerrar
                </button>

                @if( $selected_id < 1 )
                    <button 
                        wire:click.prevent="Store()"
                        type="button" 
                        class="btn btn-dark close-modal" 
                        >
                        Guardar
                    </button>
                @else
                    <button 
                        wire:click.prevent="Update()"
                        type="button" 
                        class="btn btn-dark close-modal" 
                        >
                        Actualizar
                    </button>    
                @endif
            </div>
        </div>
    </div>
</div>

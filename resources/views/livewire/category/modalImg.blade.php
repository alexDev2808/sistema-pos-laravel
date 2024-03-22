
  
  <!-- Modal Imagen ampliada -->
  <div id="theModalImg" wire:ignore.self class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-wrap">Imagen ampliada de {{ $img_name }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img 
            src="{{ asset( $img_path ) }}" 
            class="img-fluid"
            alt="Imagen ampliada de {{ $img_name }}"
            >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  
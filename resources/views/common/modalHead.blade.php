<div id="theModal" wire:ignore.self class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #378CE7">
          <h5 class="modal-title text-white">
            <b>{{ $componentName }}</b> | {{ $selected_id > 0 ? 'Editar' : 'Crear' }}
          </h5>
          <h6 class="text-center text-warning " wire:loading >Por favor espere...</h6>
        </div>
        <div class="modal-body">

  
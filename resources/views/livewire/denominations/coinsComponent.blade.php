<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a 
                            href="javascript:void(0)" 
                            class="tabmenu" 
                            data-toggle="modal" 
                            data-target="#theModal"
                            style="background: #5356FF">
                            Agregar
                        </a>
                    </li>
                </ul>
            </div>
            
            {{-- SearchBox --}}
            @include('common.searchBox')


            <div class="widget-content">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #378CE7">
                            <tr>
                                <th class="table-th text-white ">Tipo</th>
                                <th class="table-th text-white ">Valor</th>
                                <th class="table-th text-white ">Imagen</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coins as $coin)
                                <tr>
                                    <td>
                                        <h6>{{ $coin->type }}</h6>
                                    </td>
                                    <td>
                                        <h6>${{ number_format( $coin->value, 2 )}}</h6>
                                    </td>
                                    <td>
                                        <span>
                                            <img 
                                                src="{{ asset('storage/monedas/' . $coin->imagen ) }}" 
                                                alt="Imagen de la moneda" 
                                                height="70" 
                                                width="80"
                                                class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center ">
                                            <a 
                                                href="javascript:void(0)" 
                                                wire:click="Edit({{ $coin->id }})"
                                                class="btn mt-mobile mr-2" 
                                                title="Edit"
                                                style="background: #FFC700">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a 
                                                href="javascript:void(0)" 
                                                onclick="Confirm('{{ $coin->id }}')"
                                                class="btn text-white" 
                                                title="Delete"
                                                style="background: #FF204E">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    
                    {{-- Paginacion --}}
                    {{ $coins->links() }}
                </div>

            </div>

        </div>
    </div>

    {{-- Formulario --}}
    @include('livewire.denominations.form')

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        window.livewire.on('item-added', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })

        window.livewire.on('item-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })

        window.livewire.on('item-deleted', msg => {
            noty(msg)
        })

        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide');
        })

        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        })

        $('#theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none');
        })

    });

    function Confirm( id ) {
        
        swal({
            title: 'Confirmar',
            text: 'Confirmas eliminar el registro?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#FFF',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#FF204E'
        }).then(function( res ) {
            if( res.value ){
                window.livewire.emit( 'deleteRow', id )
                swal.close()
            }
        })
    }

</script>

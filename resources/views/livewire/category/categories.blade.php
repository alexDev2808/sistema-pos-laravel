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
            Search


            <div class="widget-content">

                <div class="table-responsive ">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #378CE7">
                            <tr>
                                <th class="table-th text-white ">Descripcion</th>
                                <th class="table-th text-white ">Imagen</th>
                                <th class="table-th text-white ">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <h6>{{ $category->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            <img 
                                                src="{{ asset('storage/categories/' . $category->image ) }}" 
                                                alt="Img de ejemplo" 
                                                height="70" 
                                                width="80"
                                                class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a 
                                            href="javascript:void(0)" 
                                            wire:click="Edit({{ $category->id }})"
                                            class="btn mt-mobile" 
                                            title="Edit"
                                            style="background: #FFC700">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a 
                                            href="javascript:void(0)" 
                                            onclick="Confirm('{{ $category->id }}')"
                                            class="btn text-white" 
                                            title="Delete"
                                            style="background: #FF204E">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    Pagination
                </div>

            </div>

        </div>
    </div>

    {{-- Formulario --}}
    @include('livewire.category.form')

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        window.livewire.on('category-added', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })

        window.livewire.on('category-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })

        window.livewire.on('category-deleted', msg => {
            noty(msg)
        })

        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide');
        })

        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        })

        window.livewire.on('hidden.bs.modal', msg => {
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
            confirmButtonColor: '#5356FF'
        }).then(function( res ) {
            if( res.value ){
                window.livewire.emit( 'deleteRow', id )
                swal.close()
            }
        })
    }

</script>

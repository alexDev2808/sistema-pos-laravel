<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }}| {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a 
                            href="javascript:void(0)" 
                            class="tabmenu bg-dark " 
                            data-toggle="modal " 
                            data-target="#theModal" 
                            style="background: #5356FF"
                            >
                            Agregar
                        </a>
                    </li>
                </ul>
            </div>
            @include('common.searchBox')


            <div class="widget-content">

                <div class="table-responsive ">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #378CE7">
                            <tr>
                                <th class="table-th text-white ">Descripcion</th>
                                <th class="table-th text-white ">Codigo</th>
                                <th class="table-th text-white ">Categoria</th>
                                <th class="table-th text-white ">Precio</th>
                                <th class="table-th text-white ">Stock</th>
                                <th class="table-th text-white ">Inv. min</th>
                                <th class="table-th text-white ">Imagen</th>
                                <th class="table-th text-white ">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                
                                <tr>
                                    <td><h6>{{ $product->name }}</h6></td>
                                    <td><h6>{{ $product->barcode }}</h6></td>
                                    <td><h6>{{ $product->category }}</h6></td>
                                    <td><h6>{{ $product->price }}</h6></td>
                                    <td><h6>{{ $product->stock }}</h6></td>
                                    <td><h6>{{ $product->alerts }}</h6></td>
                                    <td class="text-center">
                                        <span>
                                            <img 
                                                src="{{ asset( 'storage/products/' . $product->image ) }}" 
                                                alt="Imagen de {{ $product->name }}" 
                                                height="70" 
                                                width="80" 
                                                class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center ">

                                            <a 
                                                href="javascript:void(0)"
                                                wire:click.prevent="Edit({{ $product->id }})"
                                                class="btn btn-dark mt-mobile mr-2"
                                                title="Edit"
                                                style="background: #FFC700"
                                                >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a 
                                                href="javascript:void(0)"
                                                onclick="Confirm('{{ $product->id }}')"
                                                class="btn text-white"
                                                title="Delete"
                                                style="background: #FF204E"
                                                >
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                    {{-- Paginacion --}}
                    {{ $products->links() }}

                </div>

            </div>

        </div>
    </div>

    @include('livewire.products.form')

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.livewire.on('product-added', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })

        window.livewire.on('product-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })

        window.livewire.on('product-deleted', msg => {
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
    })

    function Confirm( id ) {
        
        // if( products > 0 ) {
        //     swal({
        //         title: 'Advertencia',
        //         text: `No se puede eliminar la categoria porque tiene ${products} productos asociados`,
        //         type: 'warning',
        //         confirmButtonText: 'Aceptar',
        //         confirmButtonColor: '#FFC700'
        //     });
        //     return;
        // }

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
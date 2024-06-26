

<div class="row mt-3">
	<div class="col-sm-12">

		<div class="connect-sorting">

			<h5 class="text-center mb-2">Denominaciones</h5>

			<div class="container">
				<div class="row">
					@foreach($denominations as $d)
                        <div class="col-sm mt-2">

                            <button 
                                wire:click.prevent="ACash({{$d->value}})" 
                                class="btn btn-dark btn-block den"
                                >
                                    {{ $d->value > 0 ? '$' . number_format($d->value,2, '.', '') : 'Exacto' }}
                            </button>
                        </div>
					@endforeach
				</div>
			</div>

			<div class="connect-sorting-content mt-4">
				<div class="card simple-title-task ui-sortable-handle">
					<div class="card-body">
						<div class="input-group input-group-md mb-3">

							<div class="input-group-prepend">
								<span 
                                    class="input-group-text hideonsm font-weight-bold" 
                                    style="background: #343a40; color:white">                                  
                                    Efectivo F8
								</span>
							</div>

							<input 
                                type="number" 
                                id="cash" 
                                wire:model="efectivo" 
                                wire:keydown.enter="save-sale" 
                                class="form-control text-center" 
                                value="{{$efectivo}}">

							<div class="input-group-append">
								<span 
                                    wire:click="$set('efectivo', 0)" 
                                    class="input-group-text" 
                                    style="background: #343a40; color:white">
									<i class="fas fa-backspace fa-2x"></i>
								</span>
							</div>

						</div>

						<h4 class="text-muted">Cambio: ${{number_format($change,2)}}</h4>

						<div class="row justify-content-between mt-5">
							<div class="col-sm-12 col-md-12 col-lg-6">
								@if($total > 0)
                                    <button 
                                        onclick="Confirm('','clear-cart','¿Confirma eliminar carrito?')" 
                                        class="btn mtmobile"
                                        style="background: #FF204E; color:white"
                                        >
                                        Cancelar F4
                                    </button>
								@endif
							</div>

							<div class="col-sm-12 col-md-12 col-lg-6">
								@if($efectivo > $total && $total >= 0)
								    <button 
                                        wire:click.prevent="save-sale" 
                                        class="btn btn-md btn-block font-weight-bold"
                                        style="background: #5356ff; color:white"
                                        >
                                        Guardar F6
                                    </button>
								@endif
							</div>


						</div>




					</div>
					<div class="col-sm-12 mt-1 text-center">
						<p class="text-muted">Reimprimir Última F7</p>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
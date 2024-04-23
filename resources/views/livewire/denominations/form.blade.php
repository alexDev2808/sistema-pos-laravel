@include( 'common.modalHead' )

    <div class="row">
        
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Tipo</label>
                <select class="form-control" wire:model="type">
                    <option value="Elegir">Elegir</option>
                    <option value="BILLETE">Billete</option>
                    <option value="MONEDA">Moneda</option>
                    <option value="OTRO">Otro</option>
                </select>
                @error('type')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-12">
            <label>Valor:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>

                <input 
                    type="number" 
                    wire:model.lazy="value"
                    class="form-control"
                    placeholder="Ej. 99.99"
                    maxlength="25"
                    >
            </div>
            @error('value')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-sm-12 mt-3 ">
            <div class="form-group custom-file">
                <input 
                    type="file"
                    class="custom-file-input form-control "
                    wire:model="image"
                    accept="image/png,image/gif,image/jpeg"
                    >
                <label class="custom-file-label">Imagen {{ $image }}</label>
                @error('image')
                    <span class="text-danger er">{{ $message }}</span>              
                @enderror
            </div>
        </div>

    </div>



@include( 'common.modalFooter' )
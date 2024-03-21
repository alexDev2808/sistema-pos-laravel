@include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label class="text-secondary font-weight-bolder">Nombre</label>
            <input 
                type="text"
                wire:model.lazy="name"
                class="form-control"
                placeholder="Ej. Curso Laravel"
                >
                @error('name')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label class="text-secondary font-weight-bolder">Codigo</label>
            <input 
                type="text"
                wire:model.lazy="barcode"
                class="form-control"
                placeholder="Ej. 7803535033"
                >
                @error('barcode')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label class="text-secondary font-weight-bolder">Costo</label>
            <input 
                type="text"
                wire:model.lazy="cost"
                data-type='currency'
                class="form-control"
                placeholder="Ej. 200.00"
                >
                @error('cost')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label class="text-secondary font-weight-bolder">Precio</label>
            <input 
                type="text"
                wire:model.lazy="price"
                data-type='currency'
                class="form-control"
                placeholder="Ej. 250.00"
                >
                @error('price')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label class="text-secondary font-weight-bolder">Stock</label>
            <input 
                type="number"
                wire:model.lazy="stock"
                class="form-control"
                placeholder="Ej. 100"
                >
                @error('stock')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label class="text-secondary font-weight-bolder">Alertas/Inv. Minimo</label>
            <input 
                type="number"
                wire:model.lazy="alerts"
                class="form-control"
                placeholder="Ej. 20"
                >
                @error('alerts')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label class="text-secondary font-weight-bolder">Categoria</label>
            <select wire:model="category_id" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach ( $categories as $category )
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8 mt-3 ">
        <label class="text-secondary font-weight-bolder">Imagen: </label>
        <div class="form-group custom-file">
            <input 
                type="file"
                wire:model="image"
                class="custom-file-input form-control "
                accept="image/png,image/gif,image/jpeg"
                >
                <label class="custom-file-label">Imagen {{ $image }}</label>
                @error('image')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
        </div>
    </div>

</div>


@include('common.modalFooter')
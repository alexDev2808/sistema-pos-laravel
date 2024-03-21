@include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre</label>
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
            <label>Codigo</label>
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
            <label>Costo</label>
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
            <label>Precio</label>
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
            <label>Stock</label>
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

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Alertas/Inv. Minimo</label>
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

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Categoria</label>
            <select class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach ( $categories as $category )
                    <option value="{{ $category->id }}" disabled>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group custom-file">
            <label>Imagen</label>
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
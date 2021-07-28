<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button wire:click="back" class="btn btn-sm btn-outline-danger rounded-pill">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <form wire:submit.prevent="update">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="card-title">Update Menu</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="Masukan nama produk...">
                                    @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis Produk</label>
                                    <select wire:model="jenis_makanan" class="form-control">
                                        <option disable>Pilih Jenis Menu</option>
                                        <option value="0">Makanan</option>
                                        <option value="1">Minuman</option>
                                        <option value="2">Tambahan</option>
                                    </select>
                                    @error('jenis_makanan') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Stok Produk</label>
                                    <input type="number" class="form-control" wire:model="quantity" placeholder="Masukan stok produk...">
                                    @error('quantity') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga Produk</label>
                                    <input type="number" class="form-control" wire:model="price" placeholder="Masukan harga produk...">
                                    @error('price') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="card-title">Informasi Tambahan</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Deskripsi Produk</label>
                                    <input type="text" class="form-control" wire:model="description" placeholder="Masukan deskripsi produk...">
                                    @error('description') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto Produk</label>
                                    <div class="custom-file">
                                        <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                                        <label for="customFile" class="custom-file-label">Choose image</label>
                                    </div>
                                    @error('image') <small class="text-danger">{{ $message }}</small>@enderror
                                    <div wire:loading wire:target="image" class="mt-2">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    @if($image)
                                        <label class="mt-2">Preview</label><br>
                                        <img src="{{ $image->temporaryUrl() }}" style="max-height: 82.58px; max-width: 126.4px" alt="Image Preview">
                                    @else
                                        <label class="mt-2">Preview</label><br>
                                        <img src="{{ asset('storage/images/'.$imageProduct) }}" style="max-height: 82.58px; max-width: 126.4px" alt="{{ $name }}">
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
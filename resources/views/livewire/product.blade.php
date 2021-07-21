@push('css')
    .tambah{
        color: white;
    }
    .tambah:hover{
        background-color: white;
        color: #28a745;
    }
    .btn-outline-warning:hover{
        color: white;
    }
@endpush
<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Tambah Menu</div>
                        </div>
                        <form wire:submit.prevent="store">
                            <div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="Masukan nama produk...">
                                    @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Produk</label>
                                    <input type="text" class="form-control" wire:model="description" placeholder="Masukan deskripsi produk...">
                                    @error('description') <small class="text-danger">{{ $message }}</small>@enderror
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
                                        <img src="{{ $image->temporaryUrl() }}" class="img-fluid" alt="Image Preview">
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Makanan</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 25%">#</th>
                                        <th style="width: 20%">Nama</th>
                                        <th style="width: 15%">Harga</th>
                                        <th style="width: 10%">Stok</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($makanan as $row)
                                    <tr>
                                        <td><img src="{{ asset('storage/images/'.$row->image) }}" style="max-height: 82.58px; max-width: 126.4px" alt="{{ $row->name }}"></td>
                                        <td class="text-capitalize">
                                            {{ $row->name }}<br>
                                            <figcaption class="blockquote-footer">
                                                <b>{{ $row->description }}</b>
                                            </figcaption>
                                        </td>
                                        <td>Rp. {{ $row->price }}</td>
                                        <td>{{ $row->quantity }} pcs</td>
                                        <td>
                                            @if($row->quantity == 0)
                                                <span class="badge bg-danger">Habis</span>
                                            @elseif($row->quantity >= 1)
                                                <span class="badge bg-success">Tersedia</span>
                                            @else
                                                <span class="badge bg-warning">Error</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button wire:click="edit({{$row->id}})" class="btn btn-sm btn-outline-warning">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button wire:click="destroy({{$row->id}})" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Tidak ada Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Minuman</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 25%">#</th>
                                        <th style="width: 20%">Nama</th>
                                        <th style="width: 15%">Harga</th>
                                        <th style="width: 10%">Stok</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($minuman as $row)
                                    <tr>
                                        <td><img src="{{ asset('storage/images/'.$row->image) }}" style="max-height: 82.58px; max-width: 126.4px" alt="{{ $row->name }}"></td>
                                        <td class="text-capitalize">
                                            {{ $row->name }}<br>
                                            <figcaption class="blockquote-footer">
                                                <b>{{ $row->description }}</b>
                                            </figcaption>
                                        </td>
                                        <td>Rp. {{ $row->price }}</td>
                                        <td>{{ $row->quantity }} pcs</td>
                                        <td>
                                            @if($row->quantity == 0)
                                                <span class="badge bg-danger">Habis</span>
                                            @elseif($row->quantity >= 1)
                                                <span class="badge bg-success">Tersedia</span>
                                            @else
                                                <span class="badge bg-warning">Error</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button wire:click="edit({{$row->id}})" class="btn btn-sm btn-outline-warning">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button wire:click="destroy({{$row->id}})" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Tidak ada Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Tambahan</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 25%">#</th>
                                        <th style="width: 20%">Nama</th>
                                        <th style="width: 15%">Harga</th>
                                        <th style="width: 10%">Stok</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tambahan as $row)
                                    <tr>
                                        <td><img src="{{ asset('storage/images/'.$row->image) }}" style="max-height: 82.58px; max-width: 126.4px" alt="{{ $row->name }}"></td>
                                        <td class="text-capitalize">
                                            {{ $row->name }}<br>
                                            <figcaption class="blockquote-footer">
                                                <b>{{ $row->description }}</b>
                                            </figcaption>
                                        </td>
                                        <td>Rp. {{ $row->price }}</td>
                                        <td>{{ $row->quantity }} pcs</td>
                                        <td>
                                            @if($row->quantity == 0)
                                                <span class="badge bg-danger">Habis</span>
                                            @elseif($row->quantity >= 1)
                                                <span class="badge bg-success">Tersedia</span>
                                            @else
                                                <span class="badge bg-warning">Error</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button wire:click="edit({{$row->id}})" class="btn btn-sm btn-outline-warning">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button wire:click="destroy({{$row->id}})" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Tidak ada Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

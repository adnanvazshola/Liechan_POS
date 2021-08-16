@push('css')
    <style>
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
    </style>
@endpush
<div class="pr-3 pl-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button wire:click="create" class="btn btn-sm btn-outline-primary rounded-pill">+  Tambah Menu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @if (count($makanan) <= 0)
            @else  
                <div class="card card-primary">
                    <div class="card-header">
                        <h6 class="card-title">Makanan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table w-100">
                            <thead>
                                <tr>
                                    <th style="width: 25%">#</th>
                                    <th style="width: 25%">Nama</th>
                                    <th style="width: 20%">Harga</th>
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($makanan as $row)
                                    <tr>
                                        <td><img src="{{ asset('storage/images/'.$row->image) }}" style="max-height: 82.58px; max-width: 126.4px" alt="{{ $row->name }}"></td>
                                        <td class="text-capitalize">
                                            {{ $row->name }}<br>
                                            @if ($row->description)
                                                <figcaption class="blockquote-footer">
                                                    <b>{{ $row->description }}</b>
                                                </figcaption>
                                            @endif
                                        </td>
                                        <td>Rp. {{ $row->price }}</td>
                                        <td>
                                            @if($row->status == 0)
                                                <span class="badge bg-danger">Habis</span>
                                            @elseif($row->status == 1)
                                                <span class="badge bg-success">Tersedia</span>
                                            @else
                                                <span class="badge bg-warning">Error</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->status == 1)
                                                <button wire:click="changeStatus({{ $row->id }})" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-retweet"></i>
                                                </button>
                                            @elseif($row->status == 0)
                                                <button wire:click="changeStatus({{ $row->id }})" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-retweet"></i>
                                                </button>
                                            @endif
                                            <button wire:click="edit({{$row->id}})" class="btn btn-sm btn-outline-warning">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button wire:click="destroy({{$row->id}})" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if (count($minuman) <= 0)
            @else  
                <div class="card card-primary">
                    <div class="card-header">
                        <h6 class="card-title">Minuman</h6>
                        {{-- <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <table class="table w-100">
                            <thead>
                                <tr>
                                    <th style="width: 25%">#</th>
                                    <th style="width: 25%">Nama</th>
                                    <th style="width: 20%">Harga</th>
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
                                        @if ($row->description)
                                            <figcaption class="blockquote-footer">
                                                <b>{{ $row->description }}</b>
                                            </figcaption>
                                        @endif
                                    </td>
                                    <td>Rp. {{ $row->price }}</td>
                                    <td>
                                        @if($row->status == 0)
                                            <span class="badge bg-danger">Habis</span>
                                        @elseif($row->status == 1)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-warning">Error</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->status == 1)
                                            <button wire:click="changeStatus({{ $row->id }})" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-retweet"></i>
                                            </button>
                                        @elseif($row->status == 0)
                                            <button wire:click="changeStatus({{ $row->id }})" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-retweet"></i>
                                            </button>
                                        @endif
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
            @endif
            @if (count($tambahan) <= 0)
            @else  
                <div class="card card-primary">
                    <div class="card-header">
                        <h6 class="card-title">Tambahan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table w-100">
                            <thead>
                                <tr>
                                    <th style="width: 25%">#</th>
                                    <th style="width: 25%">Nama</th>
                                    <th style="width: 20%">Harga</th>
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
                                        @if ($row->description)
                                            <figcaption class="blockquote-footer">
                                                <b>{{ $row->description }}</b>
                                            </figcaption>
                                        @endif
                                    </td>
                                    <td>Rp. {{ $row->price }}</td>
                                    <td>
                                        @if($row->status == 0)
                                            <span class="badge bg-danger">Habis</span>
                                        @elseif($row->status == 1)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-warning">Error</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->status == 1)
                                            <button wire:click="changeStatus({{ $row->id }})" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-retweet"></i>
                                            </button>
                                        @elseif($row->status == 0)
                                            <button wire:click="changeStatus({{ $row->id }})" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-retweet"></i>
                                            </button>
                                        @endif
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
            @endif
        </div>
    </section>
</div>
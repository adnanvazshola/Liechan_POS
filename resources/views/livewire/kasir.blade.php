<div class="pr-3 pl-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    {{-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> --}}
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bold">Produk Habis</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menu as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td>Rp. {{ number_format($row->price,0,',','.') }}</td>
                                            <td>
                                                @if ($row->status == 0)
                                                    Habis
                                                @else
                                                    Tersedia
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary" wire:click="changeStatus({{ $row->id }})">
                                                    <i class="fas fa-retweet"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center">Semua menu tersedia</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title font-weight-bold">Reservation</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="time-label">
                                    <span class="bg-red">{{ $today->translatedFormat('d F Y') }}</span>
                                </div>
                                @if ($reservations->count() == 0)
                                <div>
                                    <i class="far fa-times-circle bg-gray"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i>{{ \Carbon\Carbon::now()->format('H:i') }}</span>
                                        <h3 class="timeline-header">
                                            <a href="#">
                                                Tidak ada reservasi
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                                @else
                                    @foreach ($reservations as $row)
                                        <div>
                                            @if ($row->type == 0)
                                                <i class="fas fa-box bg-blue"></i>
                                            @elseif($row->type == 1)
                                                <i class="fas fa-utensils bg-green"></i>
                                            @elseif($row->type == 2)
                                                <i class="fas fa-building bg-purple"></i>
                                            @else
                                                <i class="far fa-calendar-times bg-yellow"></i>
                                            @endif
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i>{{ \Carbon\Carbon::parse($row->time)->format('H:i') }}</span>
                                                <h3 class="timeline-header">
                                                    <a href="#">
                                                        @if ($row->type == 0)
                                                            Nasi Box
                                                        @elseif($row->type == 1)
                                                            Satuan
                                                        @elseif($row->type == 2)
                                                            Reservasi Tempat
                                                        @else
                                                            Lainnya
                                                        @endif
                                                    </a>
                                                </h3>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                        <div class="col-3">Nama</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-8">{{ $row->name }}</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3">Note</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-8">{!! $row->note !!}</div>
                                                    </div>
                                                </div>
                                                <div class="timeline-footer">
                                                    <a class="btn btn-success btn-sm" wire:click="detail({{ $row->id }})">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

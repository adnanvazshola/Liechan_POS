@push('css')
    <style>
        .btn-outline-warning:hover{
            color: white;
        }
        .clickable {
            cursor: pointer;
        }
        .right-col {
            text-align: center;
        }
    </style>
@endpush
<div class="pl-3 pr-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button wire:click="resetAbsen" class="btn btn-sm btn-outline-danger rounded-pill">Reset Absen</button>
                    </div>
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
                            <h6 class="card-title">{{ $titleForm }}</h6>
                        </div>
                        <form wire:submit.prevent="store">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="contoh : John Doe">
                                    @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Gaji</label>
                                    <input type="text" class="form-control" wire:model="salary" placeholder="contoh : 100000">
                                    @error('salary') <small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <input type="hidden" class="form-control" wire:model="attendance">
                                <input type="hidden" class="form-control" wire:model="date">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                    @if ($detailEmployee)
                        @include('livewire.employee.detail')
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Daftar Karyawan</h6>
                        </div>
                        <div class="card-body">
                            <table class="table w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No.</th>
                                        <th style="width: 45%">Nama</th>
                                        <th style="width: 20%">Absensi</th>
                                        <th style="width: 25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1
                                    @endphp
                                    @forelse($employee as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class="clickable font-weight-bold text-capitalize" wire:click="show({{ $row->id }})">{{ $row->name }}</td>
                                        <td>{{ $row->attendance }} hari</td>
                                        <td>
                                            @if ($row->date != \Carbon\Carbon::now()->format('Y-m-d'))
                                                <button wire:click="absen({{$row->id}})" class="btn btn-sm btn-outline-success">Absen</button>
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
                                            <td colspan="4" class="text-center">Tidak ada data</td>
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
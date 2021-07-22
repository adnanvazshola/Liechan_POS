<div class="card">
    <div class="card-primary">
        <div class="card-header">
            <div class="card-title">Detail Karyawan</div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">Nama</div>
                <div class="col-8 text-capitalize">: {{ $employeeName }}</div>
            </div>
            <div class="row">
                <div class="col-4">Absensi</div>
                <div class="col-8">: {{ $employeeAttendance }} hari</div>
            </div>
            <div class="row">
                <div class="col-4">Gaji</div>
                <div class="col-8">: Rp. {{ number_format($employeeSalary,0,',','.') }}</div>
            </div>
            <div class="row">
                <div class="col-4">Total Gaji</div>
                @php
                    $totalSalary = $employeeSalary*$employeeAttendance
                @endphp
                <div class="col-8">: Rp. {{ number_format($totalSalary,0,',','.') }}</div>
            </div>
        </div>  
    </div>
</div>
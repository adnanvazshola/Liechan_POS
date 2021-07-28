<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Transaction;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
    //Mengambil data hari ini
        $today = Carbon::today();
    //Mengambul data bulan lalu
        $bulanLalu = $today->month-1;
    
    //Penjumlahan total
        $pengeluaran = Transaction::where('type','0')->whereMonth('created_at',$today->month)->sum('amount');
        $pendapatan = Transaction::where('type','1')->whereMonth('created_at',$today->month)->sum('amount'); 
        $pesanan = Transaction::where('type',3)->whereMonth('created_at', $today->month)->count();
    
    //Bulan Lalu
        $pengeluaranBulanLalu = Transaction::where('type','0')->whereMonth('created_at',$bulanLalu)->sum('amount');
        $pendapatanBulanLalu = Transaction::where('type','1')->whereMonth('created_at',$bulanLalu)->sum('amount');
        $pesananBulanLalu = Transaction::where('type',3)->whereMonth('created_at', $bulanLalu)->count();
        
    //Persentase
        if ($pengeluaranBulanLalu > 0 && $pengeluaran > 0) {
            $untungPengeluaran = ($pengeluaran-$pengeluaranBulanLalu)/$pengeluaranBulanLalu*100;
        }else{
            $untungPengeluaran = 100;
        }

        if ($pendapatanBulanLalu > 0 && $pendapatan > 0) {
            $untungPendapatan = ($pendapatan-$pendapatanBulanLalu)/$pendapatanBulanLalu*100;
        }else{
            $untungPendapatan = 100;
        }

        if ($pesananBulanLalu > 0 && $pesanan > 0) {
            $untungPesanan = ($pesanan-$pesananBulanLalu)/$pesananBulanLalu*100;
        }else{
            $untungPesanan = 100;
        }

        return view('admin.home', compact(  'today',
                                            'pengeluaran', 'pendapatan', 'pesanan',
                                            'pendapatanBulanLalu', 'pengeluaranBulanLalu', 'pesananBulanLalu',
                                            'untungPendapatan', 'untungPengeluaran', 'untungPesanan'));
    }    
}

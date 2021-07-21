<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-condensed table-user-content">
                    <tbody>
                        <tr>
                            <td style="width: 25%;">Jumlah transaksi</td>
                            <td> : </td>
                            <td class="text-capitalized">Rp. {{ number_format($row->amount,0,',','.') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td> : </td>
                            <td>{{ date_format($row->created_at ,"d F Y") }}</td>
                        </tr>
                        <tr>
                            <td>Metode</td>
                            <td> : </td>
                            <td>
                                @if( $row->method == 0 )
                                    Tunai
                                @elseif( $row->method == 1)
                                    Transfer
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td> : </td>
                            <td>{{ $row->note ?? "tidak ada catatan" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
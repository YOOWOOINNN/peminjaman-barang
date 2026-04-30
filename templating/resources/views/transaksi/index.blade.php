@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <h6>Riwayat Pinjaman Saya</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $trx)
                        <tr>
                            <td>
                                <div class="d-flex px-3 py-1">
                                    <h6 class="mb-0 text-sm">{{ $trx->item->nama_barang ?? 'Barang Dihapus' }}</h6>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $trx->jumlah }}</p>
                            </td>
                            <td>
                                <span class="badge badge-sm {{ $trx->jenis == 'keluar' ? 'bg-gradient-warning' : 'bg-gradient-success' }}">
                                    {{ $trx->jenis == 'keluar' ? 'Dipinjam' : 'Dikembalikan' }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $trx->created_at->format('d/m/Y') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <p class="text-xs font-weight-bold mb-0">Anda belum memiliki riwayat peminjaman.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
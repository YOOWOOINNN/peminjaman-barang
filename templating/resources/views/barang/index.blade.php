@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')

<div class="container-fluid py-4">

  {{-- Notifikasi --}}
  @if(session('success'))
    <div class="alert alert-success text-white">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger text-white">
      {{ session('error') }}
    </div>
  @endif


  {{-- FORM TAMBAH TRANSAKSI --}}
  <div class="card mb-4">
    <div class="card-header">
      <h6>Tambah Transaksi</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label class="form-label">ID Barang</label>
          <input type="number" name="barang_id" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" name="jumlah" class="form-control" required min="1">
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Pinjam</label>
          <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Kembali</label>
          <input type="date" name="tanggal_kembali" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-control" required>
            <option value="dipinjam">Dipinjam</option>
            <option value="dikembalikan">Dikembalikan</option>
          </select>
        </div>

        <button type="submit" class="btn bg-gradient-primary">
          Tambah Transaksi
        </button>
      </form>
    </div>
  </div>


  {{-- TABEL DATA TRANSAKSI --}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Data Transaksi</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">

            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    ID Barang
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                    Jumlah
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Tanggal Pinjam
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Tanggal Kembali
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Status
                  </th>
                </tr>
              </thead>

              <tbody>
                @forelse($data as $t)
                  <tr>
                    <td>
                      <div class="px-3 py-2">
                        <h6 class="mb-0 text-sm">
                          {{ $t->barang_id }}
                        </h6>
                      </div>
                    </td>

                    <td>
                      <p class="text-sm font-weight-bold mb-0">
                        {{ $t->jumlah }}
                      </p>
                    </td>

                    <td>
                      <p class="text-sm text-secondary mb-0">
                        {{ $t->tanggal_pinjam }}
                      </p>
                    </td>

                    <td>
                      <p class="text-sm text-secondary mb-0">
                        {{ $t->tanggal_kembali ?? '-' }}
                      </p>
                    </td>

                    <td>
                      <span class="badge bg-gradient-info">
                        {{ $t->status }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center py-4">
                      <span class="text-secondary">
                        Belum ada data transaksi
                      </span>
                    </td>
                  </tr>
                @endforelse
              </tbody>

            </table>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
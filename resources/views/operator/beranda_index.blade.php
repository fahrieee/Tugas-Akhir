@extends('layouts.app_sneat', ['title' => 'Beranda Operator'])


@section('content')
<div class="row">
    <div class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Selamat Datang, {{ auth()->user()->name }}! 🎉</h5>
              <p class="mb-4">
                Kamu Dapat <span class="fw-bold">{{ auth()->user()->unreadNotifications->count() }}</span>
                Notifikasi yang belum kamu lihat. Klik tombol dibawah untuk melihat informasi Pembayaran
              </p>

              <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Data Pembayaran</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="../assets/img/illustrations/man-with-laptop-light.png"
                height="140"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img
                    src="../assets/img/icons/unicons/chart-success.png"
                    alt="chart success"
                    class="rounded"
                  />
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt3"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{ route('mandor.index') }}">Lihat Data Mandor</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total Data</span>
              <h4 class="card-title mb-1">{{ $mandor->count() }} Mandor</h4>
              <small class="text-success fw-semibold">Data Mandor</small>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img
                    src="../assets/img/icons/unicons/wallet-info.png"
                    alt="Credit Card"
                    class="rounded"
                  />
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt6"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                    <a class="dropdown-item" href="{{ route('pembayaran.index') }}">Lihat Total Pembayaran</a>
                  </div>
                </div>
              </div>
              <span>Total Sudah Bayar</span>
              <h4 class="card-title text-nowrap mb-1">{{ $totalMandorSudahBayar }} Mandor</h4>
              <small class="text-success fw-semibold">
                  {{ formatRupiah($totalPembayaran) }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!--/ Total Revenue -->
    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
      <div class="row">
      </div>
    </div>
  </div>
  <div class="row">

    <!-- Order Statistics -->
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Tagihan {{ $bulanTeks }} {{ $tahun }}</h5>
            <small class="text-muted">{{ date('d F Y H:i:s') }}</small>
          </div>
          <div class="dropdown">
            <button
              class="btn p-0"
              type="button"
              id="orederStatistics"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column align-items-center gap-1">
              <h2 class="mb-2">{{ $tagihanSudahBayar->count() }}/{{ $tagihanBelumBayar->count() }}</h2>
              <span>Total Tagihan {{ $totalTagihan }}</span>
            </div>
            {{ $tagihanChart->container() }}
          </div>
          <ul class="p-0 m-0">
            @foreach ($tagihanPerKategori as $key => $item)
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary">
                    {{ $item->count() }}
                  </span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Kategori {{ $key }}</h6>
                    <small class="text-muted">Sudah Bayar / Belum Bayar</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-semibold">
                      {{ $item->where('status', 'lunas')->count() }} /
                      {{ $item->where('status', '<>', 'lunas')->count() }}
                    </small>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <!--/ Order Statistics -->

    <div class="col-md-6 col-lg-4 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Tagihan Belum Bayar</h5>
          {{ $tagihanBelumBayar->count() }} / {{ $totalTagihan }}
          <div class="dropdown">
            <button
              class="btn p-0"
              type="button"
              id="transactionID"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
            </button>
          </div>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            @foreach ($tagihanBelumBayar->take(10) as $item)
            <li class="d-flex mb-4 pb-1">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">{{ $item->tanggal_tagihan->translatedFormat('F Y') }}</small>
                  <h6 class="mb-0">{{ $item->mandor->nama }}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">
                    <a href="{{ route('tagihan.show', [$item->id, 'mandor_id' => $item->mandor_id, 
                    'tahun' => $item->tanggal_tagihan->year]) }}">
                      <i class="fa fa-arrow-right-long text-danger"></i>
                    </a>
                  </h6>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <!-- Transactions -->
    <div class="col-md-6 col-lg-4 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Pembayaran Belum Dikonfirmasi</h5>
          <div class="dropdown">
            <button
              class="btn p-0"
              type="button"
              id="transactionID"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
            </button>
          </div>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            @foreach ($dataPembayaranBelumKonfirmasi->take(10) as $item)
            <li class="d-flex mb-4 pb-1">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/people.png" alt="User" class="rounded" />
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">{{ $item->tanggal_bayar->diffForHumans() }}</small>
                  <h6 class="mb-0">{{ $item->tagihan->mandor->nama }}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">
                    <a href="{{ route('pembayaran.show', $item->id) }}">
                      <i class="fa fa-arrow-right-long "></i>
                    </a>
                  </h6>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <!--/ Transactions -->
  </div>

  
@endsection

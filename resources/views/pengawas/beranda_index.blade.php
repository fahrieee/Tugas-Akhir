@extends('layouts.app_sneat_pengawas')

@section('content')
    <div class="row">
        <!-- Kolom utama untuk kartu selamat datang -->
        <div class="col-lg-10 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang, {{ auth()->user()->name }}! 🎉</h5>
                            <p class="mb-4">
                                Kamu Dapat <span class="fw-bold">{{ auth()->user()->unreadNotifications->count() }}</span>
                                Notifikasi yang belum kamu lihat. Klik tombol dibawah untuk melihat informasi Pembayaran
                            </p>
                            <a href="{{ route('pengawas.tagihan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Data Pembayaran</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom untuk kartu Total Mandor -->
        <div class="col-lg-2 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1 ">Total Data </span>
                            <h5 class="card-title mb-2 ">{{ auth()->user()->mandor->count() }} Mandor</h5>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Data Mandor</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Pembayaran --}}
    <div class="row">
        @foreach ($dataRekap as $item)
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">KARTU PEMBAYARAN {{ strtoupper($item['mandor']['nama']) }}</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <!-- Header untuk List Tagihan -->
                            <li class="list-group-item justify-content-between d-flex align-items-lg-center list-group-item-secondary">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Bulan</h6>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                </div>
                            </li>

                            <!-- Loop melalui data tagihan -->
                            @foreach ($item['dataTagihan'] as $itemTagihan)
                                <li class="list-group-item justify-content-between d-flex align-items-lg-center">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">{{ $itemTagihan['tahun'] }}</small>
                                            <h6 class="mb-0">{{ $itemTagihan['bulan'] }}</h6>
                                        </div>
                                        <div>
                                            @if ($itemTagihan['tagihan']) <!-- Cek apakah tagihan ada -->
                                            <h6 class="badge rounded-pill 
                                                @if ($itemTagihan['status_bayar_teks'] == 'lunas')
                                                    bg-success   <!-- Hijau untuk lunas -->
                                                @elseif ($itemTagihan['status_bayar_teks'] == 'belum dikonfirmasi')
                                                    bg-warning   <!-- Kuning untuk angsur -->
                                                @elseif ($itemTagihan['status_bayar_teks'] == 'baru')
                                                    bg-danger    <!-- Merah untuk baru -->
                                                @else
                                                    bg-secondary <!-- Default jika tidak ada status yang cocok -->
                                                @endif
                                                mb-0">
                                                <a class="text-white" href="{{ route('pengawas.tagihan.show', $itemTagihan['tagihan']->id) }}">
                                                    {{ $itemTagihan['status_bayar_teks'] }}
                                                </a>
                                            </h6>
                                        @else
                                        @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-6 col-lg-4 order-2 mb-2">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Notifikasi</strong>
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach (auth()->user()->unreadNotifications->take(8) as $notification )
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <a href="{{ url($notification->data['url'] . '?id=' . $notification->id) }}">
                          <div class="d-flex">
                            <div class="flex-grow-1">
                              <h6 class="small mb-0">{{ $notification->data['title'] }} 🎉</h6>
                              <small class="mb-1 d-block text-body">{{ ucwords($notification->data['messages']) }}</small>
                              <small class="text-muted">
                                {{ $notification->created_at->diffForHumans() }}
                              </small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              {!! Form::open([
                                'route' => ['pengawas.notifikasi.update', $notification->id],
                                'method' => 'PUT',
                            ]) !!}
                              <button class="btn dropdown-notifications-archive" type="submit">
                                <span class="bx bx-x"></span></button>
                              {!! Form::close() !!}
                            </div>
                          </div>
                          </a>
                        </li>
                        @endforeach
                      </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

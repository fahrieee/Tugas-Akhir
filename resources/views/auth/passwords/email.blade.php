@extends('auth.app_auth_sneat')

@section('content')

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <div class="app-brand justify-content-center">
              <a href="#" class="app-brand-link gap-2">
                <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="" width="170" height="50">
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Lupa Password? 🔒</h4>
            <p class="mb-4">Masukan email lalu kami akan mengirim langkah-langkah untuk mengubah password melalui Email</p>
            <div class="alert alert-primary" role="alert">
                Jika kesulitan dalam mengubah password, silahkan hubungi Bag.Keuangan
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" placeholder="Silahkan Masukan Email"
                type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                value="{{ old('email') }}" required autocomplete="email" autofocus>

              </div>
              <button type="submit" class="btn btn-primary d-grid w-100">Kirim Link Reset</button>
            </form>
            <div class="text-center">
              <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Kembali
              </a>
            </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>
  </div>
    
@endsection


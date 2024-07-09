<nav class="p-3 bg-dark text-white">
    <div class="container">    
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 d-flex align-items-center">
            <li>
                {{-- <li><a href="#" class="nav-link px-2 fs-4 text-white ">Horus</a></li> --}}
                {{-- <img src="{{ asset('images/profile.png') }}" alt="Avatar" class="avatar me-2"> --}}
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo" >
            </li>
            {{-- <li class="fs-5 text-white">Muhammad Fajar</li> --}}
        </ul>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            @if(request()->is('home'))
            <li class="fs-3">Voucher</li>
            @else
            <li class="fs-3">History</li>
            @endif
        </ul>

        <div class="text-end">
            @if(request()->is('home'))
                <a href="/history"><button type="button" class="btn btn-outline-light me-2">History</button></a>
            @else
                <a href="/home"><button type="button" class="btn btn-outline-light me-2">Home</button></a>
            @endif
        </div>
      </div>
    </div>
</nav>
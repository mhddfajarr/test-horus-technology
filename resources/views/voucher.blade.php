@extends('component.main')

@section('content')
<div class="full-screen-container">
    <div class="sidebar-card">
        <h2 class="text-center">Kategori</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Kategori 1</a>
                <a class="nav-link active" aria-current="page" href="#">Kategori 1</a>
                <a class="nav-link active" aria-current="page" href="#">Kategori 1</a>
            </li>
        </ul>
        <div class="button-container mt-3">
            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-primary" style="width: 100%;" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <main class="content">
        <h3>Voucher</h3>
        <div class="grid-container">
            @foreach ($data['data'] as $voucher)
                <div class="card">
                    <img class="img-card" src="{{ asset($voucher['foto']) }}" alt="Voucher Image">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title" style="text-align: left;">{{ $voucher['nama'] }}</h5>
                                <p class="card-text" style="text-align: left;">With supporting </p>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="btn btn-success float-end">Claim</a>
                            </div>
                        </div>
                    </div>
                </div>   
            @endforeach  
    </main>    
</div>
@endsection
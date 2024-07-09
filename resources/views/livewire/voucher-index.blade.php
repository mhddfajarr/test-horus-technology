<div class="full-screen-container">
    <div class="sidebar-card">
        <h2 class="text-center">Kategori</h2>
        <ul class="nav flex-column">
            <li class="nav-item mt-3">
                <button class="link-kategori " wire:click="selectCategory(null)">All</button>
                <button class="link-kategori " wire:click="selectCategory('food')">Food</button>
                <button class="link-kategori" wire:click="selectCategory('hotel')">Hotel</button>
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
                                <p class="card-text" style="text-align: left;">{{ $voucher['kategori'] }} </p>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success float-end" wire:click="claim({{ $voucher['id'] }})">Claim</button>
                            </div>
                        </div>
                    </div>
                </div>   
            @endforeach  
    </main>    
</div>
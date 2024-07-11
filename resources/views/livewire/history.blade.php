<div class="full-screen-container ">
    <main class="content">
        <p class="fs-2 font-weight-bold">History</p>
        <div class="container-history">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col" style="width: 70%;" class="fs-5 px-3">Nama</th>
                    <th class="text-center align-middle" scope="col" style="width: 30%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if (empty($data))
                    <tr>
                        <td colspan="3" class="text-center align-middle">No data available</td>
                    </tr>
                    @else
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row">
                                    <div style="display: flex; align-items: center;">
                                        <img class="image-history" src="{{ $item['voucher']['foto'] }}" alt="">
                                        <div style="display: flex; flex-direction: column; margin-left: 10px;">
                                            <p class="fs-6 pt-3 mb-0">{{ $item['voucher']['nama'] }}</p>
                                            <p style="font-weight: normal; margin-top: 0; padding-top:0px">Kategori : {{ $item['voucher']['kategori'] }}</p>
                                        </div>
                                    </div>
                                </th>
                                <td class="text-center align-middle">
                                    <button class="btn btn-danger" wire:click="delete({{ $item['id'] }})">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    
                </tbody>
              </table>
        </div>
    </main>    

    <div class="sidebar-card">
        <h2 class="text-center">Kategori</h2>
        <ul class="nav flex-column">
            <li class="nav-item mt-3 d-flex align-items-center">
                <button class="link-kategori" wire:click="selectCategory(null)">All</button>
                <span class="count-span">2</span>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <button class="link-kategori " wire:click="selectCategory('food')">Food</button>
                <span class="count-span">2</span>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <button class="link-kategori" wire:click="selectCategory('hotel')">Hotel</button>
                <span class="count-span">2</span>
            </li>
        </ul>
        <div class="button-container mt-3">
            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-primary" style="width: 100%;" type="submit">Logout</button>
            </form>
        </div>
    </div>

    
</div>

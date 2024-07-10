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
                                        <p class="fs-6 mt-3">{{ $item['voucher']['nama'] }}</p>
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
        <h2>Kategori</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
        </ul>
        <div class="button-container">
            <button class="btn btn-primary">Button 1</button>
        </div>
    </div>

    
</div>

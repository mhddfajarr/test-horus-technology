@extends('component.main')

@section('content')
<div class="full-screen-container">
    <main class="content">
        <h3>Voucher</h3>
        <div class="container-history">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col" style="width: 70%;">Nama</th>
                    <th scope="col" style="width: 30%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                  </tr>
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
@endsection
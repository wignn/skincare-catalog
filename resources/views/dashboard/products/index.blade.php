@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Daftar Produk</h2>
  <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $p)
      <tr>
        <td>{{ $p->name }}</td>
        <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
        <td>{{ $p->stock }}</td>
        <td>
          @if($p->image)
            <img src="{{ asset('storage/' . $p->image) }}" width="60">
          @endif
        </td>
        <td>
          <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

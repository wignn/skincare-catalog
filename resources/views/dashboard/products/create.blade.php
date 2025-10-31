@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-semibold mb-6 p-4">Add Product</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 p-4">
    @csrf   
    <div>
        <label>Product Name</label>
        <input type="text" name="name" class="border w-full p-2" required>
    </div>

    <div>
        <label>Description</label>
        <textarea name="description" class="border w-full p-2"></textarea>
    </div>

    <div>
        <label>Price</label>
        <input type="number" name="price" step="0.01" class="border w-full p-2" required> 
    </div>

    <div>
        <label>Stock</label>
        <input type="number" name="stock" class="border w-full p-2" required>
    </div>

    <div>
        <label>Product Image</label>
        <input type="file" name="image" class="border w-full p-2" accept="image" required>
    </div>

    <button type="submit" class="border px-4 py-2 hover:bg-gray-100">Save</button>
</form>
@endsection
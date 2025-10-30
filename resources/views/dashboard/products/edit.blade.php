@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Edit Product</h1>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Price</label>
            <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                class="w-full border rounded px-3 py-2" min="0" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Image</label>
            <input type="file" name="image" class="w-full hover:bg-gray-100">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-32 mt-2 rounded">
            @endif
        </div>

        <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Update</button>
    </form>
@endsection

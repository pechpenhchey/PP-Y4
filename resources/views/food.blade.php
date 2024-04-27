{{-- Debugging --}}

<x-app-layout>
    <h1>Products</h1>
    @foreach ($products as $product)
        <div>
            <h2>{{ $product->title }}</h2>
            <p>Category: {{ $product->category->name }}</p>
            <p>Price: ${{ $product->price }}</p>
            <p>Description: {{ $product->description }}</p>
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}">
        </div>
        <hr>
    @endforeach
</x-app-layout>

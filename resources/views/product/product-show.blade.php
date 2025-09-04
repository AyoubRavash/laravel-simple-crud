@extends('layouts.layout')

@section('content')
  <div class="container">
    <h2>Product Details</h2>
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">{{ $product->name }}</h5>
      </div>
      <div class="card-body d-flex justify-content-between">
        <div class="col">
          <p class="card-text"><strong>Description</strong>: {{ $product->description }}</p>
          <p class="card-text"><strong>Price</strong>: {{ number_format($product->price, 2) }}</p>
          <p class="card-text"><strong>Quantity</strong>: {{ $product->quantity }}</p>
          <p class="card-text"><strong>Category</strong>: {{ $product->category->name }}</p>
          <p class="card-text"><strong>Status</strong>: <span
              class="badge {{ $product->status == 'active' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($product->status) }}</span>
          </p>

          <a href="{{ route('product.edit', parameters: $product->id) }}" class="btn btn-primary">Edit</a>
          <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="col text-end">
          @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="200" height="200"
              class="float-end">
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
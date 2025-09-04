@extends('layouts.layout')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">Edit Product</div>
      <div class="card-body">
        <form action="{{ route('product.update', parameters: $product->id) }}" method="post"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          @include('product.form')
          <button type="submit" class="btn btn-success">Save</button>
          <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection
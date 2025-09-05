@extends('layouts.layout')

@section('content')
  <div class="container">
    <h2>Category Details</h2>
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">{{ $category->name }}</h5>
      </div>
      <div class="card-body">
        <div class="col">
          <p class="card-text"><strong>Status</strong>: <span
              class="badge {{ $category->status == 'active' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($category->status) }}</span>
          </p>

          <a href="{{ route('category.edit', parameters: $category->id) }}" class="btn btn-primary">Edit</a>
          <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
        </div>
      </div>
    </div>
  </div>
@endsection
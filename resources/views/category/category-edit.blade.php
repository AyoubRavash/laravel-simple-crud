@extends('layouts.layout')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">Edit Category</div>
      <div class="card-body">
        <form action="{{ route('category.update', parameters: $category->id) }}" method="post"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          @include('category.form')
          <button type="submit" class="btn btn-success">Save</button>
          <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection
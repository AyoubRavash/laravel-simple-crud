@extends('layouts.layout')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col">
            <h2>Deleted Product List</h2>
          </div>
          <div class="col">
            <div class="row">
              <div class="col-md-6">
                <form class="d-flex" role="search" action="{{ route('product.show-deleted') }}" method="get">
                  @csrf
                  <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" />
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
              <div class="col-md-6">
                <a href="{{ route('product.index') }}" class="btn btn-warning float-end">Show All</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @if (Session::has('success'))
        <span class="alert alert-success">{{ Session::get('success') }}</span>
      @endif
      @if (Session::has('error'))
        <span class="alert alert-danger">{{ Session::get('error') }}</span>
      @endif
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product Name</th>
              <th scope="col">Category</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Status</th>
              <th scope="col">Description</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if (count($products) > 0)
              @foreach ($products as $p)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $p->name }}</td>
                  <td>{{ $p->category->name }}</td>
                  <td>{{ $p->quantity }}</td>
                  <td>{{ $p->price }}</td>
                  <td>{{ $p->status }}</td>
                  <td>{{ $p->description }}</td>
                  <td>
                    <div class="btn-group gap-1" role="group">
                      <a href="{{ route('product.show', $p->id) }}" class="btn btn-warning btn-sm">Show</a>
                      <a href="{{ route('product.restore', $p->id) }}" class="btn btn-success btn-sm">Restore</a>
                      <form action="{{ route('product.delete', $p->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                          onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="8" class="text-center">No data found</td>
              </tr>
            @endif
          </tbody>
        </table>
        {{ $products->links() }}
      </div>
    </div>
  </div>
@endsection
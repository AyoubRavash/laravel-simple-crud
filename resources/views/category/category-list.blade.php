@extends('layouts.layout')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col">
            <h2>Category List</h2>
          </div>
          <div class="col">
            <div class="row">
              <div class="col-md-6">
                <form class="d-flex" role="search" action="{{ route('category.index') }}" method="get">
                  @csrf
                  <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" />
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
              <div class="col-md-6">
                <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('category.show-deleted') }}" class="btn btn-warning">Show Deleted</a>
                  <a href="/create-category" class="btn btn-primary">Create</a>
                </div>
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
              <th scope="col">Category Name</th>
              <th scope="col">Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if (count($categories) > 0)
              @foreach ($categories as $c)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $c->name }}</td>
                  <td>{{ $c->status }}</td>
                  <td>
                    <div class="btn-group gap-1" role="group">
                      <a href="{{ route('category.show', $c->id) }}" class="btn btn-warning btn-sm">Show</a>
                      <a href="{{ route('category.edit', $c->id) }}" class="btn btn-primary btn-sm">Edit</a>
                      <form action="{{ route('category.destroy', $c->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                          onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="4" class="text-center">No data found</td>
              </tr>
            @endif
          </tbody>
        </table>
        {{ $categories->links() }}
      </div>
    </div>
  </div>
@endsection
<div class="mb-3">
  <label for="product-name" class="form-label">Product Name *</label>
  <input type="text" name="name" id="product-name" class="form-control" value="{{ old('name', $product->name ?? '')}}"
    required>
  @error('name')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
<div class="mb-3">
  <label for="product-description" class="form-label">Product Description</label>
  <textarea name="description" id="product-description" class="form-control"
    value="{{ old('description', $product->description ?? '') }}">{{ old('description', $product->description ?? '') }}</textarea>
  @error('description')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
<div class="mb-3">
  <label for="product-quantity" class="form-label">Quantity *</label>
  <input type="number" step="1" name="quantity" id="product-quantity" class="form-control"
    value="{{ old('quantity', $product->quantity ?? 0)}}" required>
  @error('quantity')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
<div class="mb-3">
  <label for="product-price" class="form-label">Price *</label>
  <input type="number" step="0.01" name="price" id="product-price" class="form-control"
    value="{{ old('price', $product->price ?? 0)}}" required>
  @error('price')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
<div class="mb-3">
  <label for="product-image" class="form-label">Image</label>
  <input type="file" name="image" id="product-image" class="form-control">
  @if (!empty($product->image))
    <img src="{{ asset('storage/' . $product->image) }}" alt="product image">
  @endif
  @error('image')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
<div class="mb-3">
  <label for="product-status" class="form-label">Status *</label>
  <select name="status" id="product-status" class="form-select">
    <option value="active" {{ old('status', $product->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
    <option value="de-active" {{ old('status', $product->status ?? '') == 'de-active' ? 'selected' : '' }}>De-Active
    </option>
  </select>
  @error('status')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>

<div class="mb-3">
  <label for="product-category" class="form-label">Category *</label>
  <select name="category_id" id="product-category" class="form-select">
    @foreach ($categories as $category)
      <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
        {{ $category->name }}
      </option>
    @endforeach
  </select>
  @error('category_id')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
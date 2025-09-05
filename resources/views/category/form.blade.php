<div class="mb-3">
  <label for="category-name" class="form-label">Category Name *</label>
  <input type="text" name="name" id="category-name" class="form-control" value="{{ old('name', $category->name ?? '')}}"
    required>
  @error('name')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
<div class="mb-3">
  <label for="category-status" class="form-label">Status *</label>
  <select name="status" id="category-status" class="form-select">
    <option value="active" {{ old('status', $category->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
    <option value="de-active" {{ old('status', $category->status ?? '') == 'de-active' ? 'selected' : '' }}>De-Active
    </option>
  </select>
  @error('status')
    <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
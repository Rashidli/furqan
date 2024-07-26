@include('admin.includes.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Əlavə et</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Kateqoriya</label>
                                    <select class="form-control" name="parent_category_id" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div id="child-category-container"></div>


                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title') }}">
                                    @error('az_title')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title') }}">
                                    @error('en_title')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title') }}">
                                    @error('ru_title')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Qiymət</label>
                                    <input class="form-control" type="text" name="price" value="{{ old('price') }}">
                                    @error('price')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Endirimli qiymət</label>
                                    <input class="form-control" type="text" name="discounted_price" value="{{ old('discounted_price') }}">
                                    @error('discounted_price')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Endirim faizi</label>
                                    <input class="form-control" type="text" name="discount_percent" value="{{ old('discount_percent') }}">
                                    @error('discount_percent')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Stock</label>
                                    <input  type="checkbox" name="is_stock">
                                    @if($errors->first('is_stock')) <small class="form-text text-danger">{{$errors->first('is_stock')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Mətn az</label>
                                    <textarea id="editor_az" class="form-control" type="text" name="az_description">{{ old('az_description') }}</textarea>
                                    @error('az_description')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Mətn en</label>
                                    <textarea id="editor_en" class="form-control" type="text" name="en_description">{{ old('en_description') }}</textarea>
                                    @error('en_description')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Mətn ru</label>
                                    <textarea id="editor_ru" class="form-control" type="text" name="ru_description">{{ old('ru_description') }}</textarea>
                                    @error('ru_description')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Əsas şəkil</label>
                                    <input class="form-control" type="file" name="image">
                                    @error('image')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Slayder</label>
                                    <input class="form-control" type="file" multiple name="product_images[]">
                                    @error('product_images')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.includes.footer')
<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/categories/' + categoryId + '/children',
                    type: 'GET',
                    success: function(response) {
                        console.log(response)
                        if (response.length > 0) {
                            var childSelect = '<div class="mb-3"><label class="col-form-label">Sub-Kateqoriya</label>';
                            childSelect += '<select class="form-control" name="category_id" id="subcategory_id">';
                            childSelect += '<option value="">Select Sub-Category</option>';
                            $.each(response, function(index, childCategory) {
                                childSelect += '<option value="' + childCategory.id + '">' + childCategory.title + '</option>';
                            });
                            childSelect += '</select></div>';
                            $('#child-category-container').html(childSelect);
                        } else {
                            $('#child-category-container').html('<small class="form-text text-muted">No sub-categories available.</small>');
                        }
                    }
                });
            } else {
                $('#child-category-container').html('');
            }
        });
    });
</script>

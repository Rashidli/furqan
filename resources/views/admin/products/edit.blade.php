@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Məhsul siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->translate('en')?->title }}</li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title"
                                           value="{{ old('az_title', $product->translate('az')->title) }}">
                                    @if($errors->first('az_title'))
                                        <small class="form-text text-danger">{{ $errors->first('az_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title"
                                           value="{{ old('en_title', $product->translate('en')->title) }}">
                                    @if($errors->first('en_title'))
                                        <small class="form-text text-danger">{{ $errors->first('en_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title"
                                           value="{{ old('ru_title', $product->translate('ru')->title) }}">
                                    @if($errors->first('ru_title'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_title') }}</small>
                                    @endif
                                </div>

                                @foreach($filters as $filter)
                                    <div class="mb-3">
                                        <label class="col-form-label">{{ $filter->title }}</label>
                                        <select class="form-control" name="option_ids[]">
                                            <option value="">Select {{ $filter->title }}</option>
                                            @foreach($filter->options as $option)
                                                <option value="{{ $option->id }}" {{ $product->options->contains($option->id) ? 'selected' : '' }}>
                                                    {{ $option->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach

                                <div class="mb-3">
                                    <label class="col-form-label">Mətn az</label>
                                    <textarea id="editor_az" class="form-control"
                                              name="az_description">{{ old('az_description', $product->translate('az')->description) }}</textarea>
                                    @if($errors->first('az_description'))
                                        <small
                                            class="form-text text-danger">{{ $errors->first('az_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Mətn en</label>
                                    <textarea id="editor_en" class="form-control"
                                              name="en_description">{{ old('en_description', $product->translate('en')->description) }}</textarea>
                                    @if($errors->first('en_description'))
                                        <small
                                            class="form-text text-danger">{{ $errors->first('en_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Mətn ru</label>
                                    <textarea id="editor_ru" class="form-control"
                                              name="ru_description">{{ old('ru_description', $product->translate('ru')->description) }}</textarea>
                                    @if($errors->first('ru_description'))
                                        <small
                                            class="form-text text-danger">{{ $errors->first('ru_description') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Kateqoriya</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Qiymət</label>
                                    <input class="form-control" type="text" name="price"
                                           value="{{ old('price', $product->price) }}">
                                    @if($errors->first('price'))
                                        <small class="form-text text-danger">{{ $errors->first('price') }}</small>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Endirimli qiymət</label>
                                    <input class="form-control" type="text" name="discounted_price"
                                           value="{{ old('discounted_price', $product->discounted_price) }}">
                                    @if($errors->first('discounted_price'))
                                        <small class="form-text text-danger">{{ $errors->first('discounted_price') }}</small>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Endirim faizi</label>
                                    <input class="form-control" type="text" name="discount_percent"
                                           value="{{ old('discount_percent', $product->discount_percent) }}">
                                    @if($errors->first('discount_percent'))
                                        <small class="form-text text-danger">{{ $errors->first('discount_percent') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Stockda var?</label>
                                    <input  type="checkbox" name="is_stock" {{$product->is_stock ? 'checked' : ''}}>
                                    @if($errors->first('is_stock')) <small class="form-text text-danger">{{$errors->first('is_stock')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Populyar?</label>
                                    <input  type="checkbox" name="is_popular" {{$product->is_popular ? 'checked' : ''}}>
                                    @if($errors->first('is_popular')) <small class="form-text text-danger">{{$errors->first('is_popular')}}</small> @endif
                                </div>

                                <!-- Image Inputs -->
                                <div class="mb-3">
                                    <label class="col-form-label">Əsas şəkil</label>
                                    <input class="form-control" type="file" name="image">
                                    <br>
                                    @if($errors->first('image'))
                                        <small class="form-text text-danger">{{ $errors->first('image') }}</small>
                                    @endif
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                             style="max-width: 100px; max-height: 100px;">
                                    @endif
                                </div>

                                <div class="mb-3">

                                    <div class="form-group">
                                        <label>Slider</label>
                                        <input type="file" name="product_images[]" multiple class="form-control">
                                    </div>
                                    <br>
                                    @if($errors->first('image')) <small class="form-text text-danger">{{$errors->first('image')}}</small> @endif
                                    @foreach($product->product_images as $slider)
                                        <div class="image-container" data-slider-id="{{ $slider->id }}">
                                            <img style="width: 100px; height: 100px;" src="{{ asset('storage/' . $slider->image) }}" class="uploaded_image" alt="{{ $slider->image }}">
                                            <a class="btn btn-danger btn-sm" href="{{ route('delete-slider-image', ['id' => $slider->id]) }}">Delete</a>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>
                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button class="btn btn-primary">Save</button>
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
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('#category_id').change(function() {--}}
{{--            var categoryId = $(this).val();--}}
{{--            if (categoryId) {--}}
{{--                $.ajax({--}}
{{--                    url: '/categories/' + categoryId + '/children',--}}
{{--                    type: 'GET',--}}
{{--                    success: function(response) {--}}
{{--                        console.log(response); // Log the response for debugging--}}

{{--                        if (Array.isArray(response) && response.length > 0) {--}}
{{--                            var childSelect = '<div class="mb-3"><label class="col-form-label">Sub-Kateqoriya</label>';--}}
{{--                            childSelect += '<select class="form-control" name="category_id" id="subcategory_id">';--}}
{{--                            childSelect += '<option value="">Select Sub-Category</option>';--}}
{{--                            $.each(response, function(index, childCategory) {--}}
{{--                                childSelect += '<option value="' + childCategory.id + '">' + childCategory.title + '</option>';--}}
{{--                            });--}}
{{--                            childSelect += '</select></div>';--}}
{{--                            $('#child-category-container').html(childSelect);--}}
{{--                        } else {--}}
{{--                            $('#child-category-container').html('<small class="form-text text-muted">No sub-categories available.</small>');--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function(xhr, status, error) {--}}
{{--                        console.error('Error:', status, error); // Log error for debugging--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                $('#child-category-container').html('');--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

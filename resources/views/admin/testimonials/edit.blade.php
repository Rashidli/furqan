@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form action="{{ route('testimonials.update', $testimonial->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">

                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('testimonials.index') }}">Testimonial siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $testimonial->translate('en')?->title }}</li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title', $testimonial->translate('az')?->title) }}">
                                    @if($errors->first('az_title'))
                                        <small class="form-text text-danger">{{ $errors->first('az_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title', $testimonial->translate('en')?->title) }}">
                                    @if($errors->first('en_title'))
                                        <small class="form-text text-danger">{{ $errors->first('en_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title', $testimonial->translate('ru')?->title) }}">
                                    @if($errors->first('ru_title'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Vəzifə az</label>
                                    <input class="form-control" type="text" name="az_position" value="{{ old('az_position', $testimonial->translate('az')?->position) }}">
                                    @if($errors->first('az_position'))
                                        <small class="form-text text-danger">{{ $errors->first('az_position') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Vəzifə en</label>
                                    <input class="form-control" type="text" name="en_position" value="{{ old('en_position', $testimonial->translate('en')?->position) }}">
                                    @if($errors->first('en_osition'))
                                        <small class="form-text text-danger">{{ $errors->first('en_osition') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Vəzifə ru</label>
                                    <input class="form-control" type="text" name="ru_position" value="{{ old('ru_osition', $testimonial->translate('ru')?->position) }}">
                                    @if($errors->first('ru_position'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_position') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" class="uploaded_image mb-3" alt="{{ $testimonial->image }}" style="width: 100px; height: 100px;">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    @if($errors->first('image'))
                                        <small class="form-text text-danger">{{ $errors->first('image') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $testimonial->bg_image) }}" class="uploaded_bg_image mb-3" alt="{{ $testimonial->bg_image }}" style="width: 100px; height: 100px;">
                                    <div class="form-group">
                                        <label>Arxa şəkil</label>
                                        <input type="file" name="bg_image" class="form-control">
                                    </div>
                                    @if($errors->first('bg_image'))
                                        <small class="form-text text-danger">{{ $errors->first('bg_image') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', $testimonial->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $testimonial->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Text az</label>
                                    <textarea id="editor_az" class="form-control" name="az_description">{{ old('az_description', $testimonial->translate('az')?->description) }}</textarea>
                                    @if($errors->first('az_description'))
                                        <small class="form-text text-danger">{{ $errors->first('az_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Text en</label>
                                    <textarea id="editor_en" class="form-control" name="en_description">{{ old('en_description', $testimonial->translate('en')?->description) }}</textarea>
                                    @if($errors->first('en_description'))
                                        <small class="form-text text-danger">{{ $errors->first('en_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Text ru</label>
                                    <textarea id="editor_ru" class="form-control" name="ru_description">{{ old('ru_description', $testimonial->translate('ru')?->description) }}</textarea>
                                    @if($errors->first('ru_description'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_description') }}</small>
                                    @endif
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

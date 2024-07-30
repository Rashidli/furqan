@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ route('main_abouts.update', $main_about->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('main_abouts.index') }}">Siyahı</a></li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Text az</label>
                                    <textarea  class="form-control" type="text" name="az_description">{{ old('az_description', $main_about->translate('az')->description) }}</textarea>
                                    @if($errors->first('az_description')) <small class="form-text text-danger">{{ $errors->first('az_description') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Text en</label>
                                    <textarea  class="form-control" type="text" name="en_description">{{ old('en_description', $main_about->translate('en')->description) }}</textarea>
                                    @if($errors->first('en_description')) <small class="form-text text-danger">{{ $errors->first('en_description') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Text ru</label>
                                    <textarea  class="form-control" type="text" name="ru_description">{{ old('ru_description', $main_about->translate('ru')->description) }}</textarea>
                                    @if($errors->first('ru_description')) <small class="form-text text-danger">{{ $errors->first('ru_description') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <img style="width: 100px; height: 100px;" src="{{ asset('storage/' . $main_about->image) }}" class="uploaded_image" alt="{{ $main_about->image }}">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    @if($errors->first('image')) <small class="form-text text-danger">{{ $errors->first('image') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" id="" class="form-control">
                                        <option value="1" {{ old('is_active', $main_about->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $main_about->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
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

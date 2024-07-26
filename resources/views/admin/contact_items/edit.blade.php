@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ route('contact_items.update', $contact_item->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('contact_items.index') }}">Siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $contact_item->translate('az')?->title }}</li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title', $contact_item->translate('az')->title) }}">
                                    @if($errors->first('az_title')) <small class="form-text text-danger">{{ $errors->first('az_title') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title', $contact_item->translate('en')->title) }}">
                                    @if($errors->first('en_title')) <small class="form-text text-danger">{{ $errors->first('en_title') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title', $contact_item->translate('ru')->title) }}">
                                    @if($errors->first('ru_title')) <small class="form-text text-danger">{{ $errors->first('ru_title') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <img style="width: 100px; height: 100px;" src="{{ asset('storage/' . $contact_item->image) }}" class="uploaded_image" alt="{{ $contact_item->image }}">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    @if($errors->first('image')) <small class="form-text text-danger">{{ $errors->first('image') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" id="" class="form-control">
                                        <option value="1" {{ old('is_active', $contact_item->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $contact_item->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Value az</label>
                                    <input class="form-control" type="text" name="az_value" value="{{ old('az_value', $contact_item->translate('az')->value) }}">
                                    @if($errors->first('az_value')) <small class="form-text text-danger">{{ $errors->first('az_value') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Value en</label>
                                    <input class="form-control" type="text" name="en_value" value="{{ old('en_value', $contact_item->translate('en')->value) }}">
                                    @if($errors->first('en_value')) <small class="form-text text-danger">{{ $errors->first('en_value') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Value ru</label>
                                    <input class="form-control" type="text" name="ru_value" value="{{ old('ru_value', $contact_item->translate('ru')->value) }}">
                                    @if($errors->first('ru_value')) <small class="form-text text-danger">{{ $errors->first('ru_value') }}</small> @endif
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

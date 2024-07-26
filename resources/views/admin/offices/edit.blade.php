@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ route('offices.update', $office->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('offices.index') }}">Siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $office->translate('az')?->title }}</li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Filial adı az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title', $office->translate('az')->title) }}">
                                    @if($errors->first('az_title')) <small class="form-text text-danger">{{ $errors->first('az_title') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Filial adı en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title', $office->translate('en')->title) }}">
                                    @if($errors->first('en_title')) <small class="form-text text-danger">{{ $errors->first('en_title') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Filial adı ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title', $office->translate('ru')->title) }}">
                                    @if($errors->first('ru_title')) <small class="form-text text-danger">{{ $errors->first('ru_title') }}</small> @endif
                                </div>
                                {!! $office->map !!}
                                <div class="mb-3">
                                    <label class="col-form-label">Xəritə</label>
                                    <input class="form-control" type="text" name="map" value="{{ old('map', $office->map) }}">
                                    @if($errors->first('map')) <small class="form-text text-danger">{{ $errors->first('map') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" id="" class="form-control">
                                        <option value="1" {{ old('is_active', $office->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $office->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Address az</label>
                                    <input class="form-control" type="text" name="az_value" value="{{ old('az_value', $office->translate('az')->value) }}">
                                    @if($errors->first('az_value')) <small class="form-text text-danger">{{ $errors->first('az_value') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Address en</label>
                                    <input class="form-control" type="text" name="en_value" value="{{ old('en_value', $office->translate('en')->value) }}">
                                    @if($errors->first('en_value')) <small class="form-text text-danger">{{ $errors->first('en_value') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Address ru</label>
                                    <input class="form-control" type="text" name="ru_value" value="{{ old('ru_value', $office->translate('ru')->value) }}">
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

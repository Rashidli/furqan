@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form action="{{ route('products.modules.update', [$product->id, $module->id]) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">

                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.modules.index', [$product->id]) }}">Modullar siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $module->translate('az')?->title }}</li>
                            </ol>
                        </nav>

                        <h4 class="card-title">{{ $module->translate('az')?->title }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title', $module->translate('az')?->title) }}">
                                    @if($errors->first('az_title'))
                                        <small class="form-text text-danger">{{ $errors->first('az_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title', $module->translate('en')?->title) }}">
                                    @if($errors->first('en_title'))
                                        <small class="form-text text-danger">{{ $errors->first('en_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title', $module->translate('ru')?->title) }}">
                                    @if($errors->first('ru_title'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label"></label>
                                    <input class="form-control" type="number" name="price" value="{{ old('price', $module->price) }}">
                                    @if($errors->first('price'))
                                        <small class="form-text text-danger">{{ $errors->first('price') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', $module->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $module->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
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
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form action="{{ route('vacancies.update', $vacancy->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">

                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('vacancies.index') }}">Vakansiya siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $vacancy->translate('az')?->title }}</li>
                            </ol>
                        </nav>

                        <h4 class="card-title">{{ $vacancy->translate('az')?->title }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title', $vacancy->translate('az')?->title) }}">
                                    @if($errors->first('az_title'))
                                        <small class="form-text text-danger">{{ $errors->first('az_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title', $vacancy->translate('en')?->title) }}">
                                    @if($errors->first('en_title'))
                                        <small class="form-text text-danger">{{ $errors->first('en_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title', $vacancy->translate('ru')?->title) }}">
                                    @if($errors->first('ru_title'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Filial az</label>
                                    <input class="form-control" type="text" name="az_branch" value="{{ old('az_branch', $vacancy->translate('az')?->branch) }}">
                                    @if($errors->first('az_branch'))
                                        <small class="form-text text-danger">{{ $errors->first('az_branch') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Filial en</label>
                                    <input class="form-control" type="text" name="en_branch" value="{{ old('en_branch', $vacancy->translate('en')?->branch) }}">
                                    @if($errors->first('en_branch'))
                                        <small class="form-text text-danger">{{ $errors->first('en_branch') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Filial ru</label>
                                    <input class="form-control" type="text" name="ru_branch" value="{{ old('ru_branch', $vacancy->translate('ru')?->branch) }}">
                                    @if($errors->first('ru_branch'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_branch') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', $vacancy->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $vacancy->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Məzmun az</label>
                                    <textarea id="editor_az" class="form-control" name="az_description">{{ old('az_description', $vacancy->translate('az')?->description) }}</textarea>
                                    @if($errors->first('az_description'))
                                        <small class="form-text text-danger">{{ $errors->first('az_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Məzmun en</label>
                                    <textarea id="editor_en" class="form-control" name="en_description">{{ old('en_description', $vacancy->translate('en')?->description) }}</textarea>
                                    @if($errors->first('en_description'))
                                        <small class="form-text text-danger">{{ $errors->first('en_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Məzmun ru</label>
                                    <textarea id="editor_ru" class="form-control" name="ru_description">{{ old('ru_description', $vacancy->translate('ru')?->description) }}</textarea>
                                    @if($errors->first('ru_description'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Tələblər az</label>
                                    <textarea id="editor1_az" class="form-control" name="az_requirement">{{ old('az_requirement', $vacancy->translate('az')?->requirement) }}</textarea>
                                    @if($errors->first('az_requirement'))
                                        <small class="form-text text-danger">{{ $errors->first('az_requirement') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Tələblər en</label>
                                    <textarea id="editor1_en" class="form-control" name="en_requirement">{{ old('en_requirement', $vacancy->translate('en')?->requirement) }}</textarea>
                                    @if($errors->first('en_requirement'))
                                        <small class="form-text text-danger">{{ $errors->first('en_requirement') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Tələblər ru</label>
                                    <textarea id="editor1_ru" class="form-control" name="ru_requirement">{{ old('ru_requirement', $vacancy->translate('ru')?->requirement) }}</textarea>
                                    @if($errors->first('ru_requirement'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_requirement') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Telefon</label>
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone', $vacancy->phone) }}">
                                    @if($errors->first('phone'))
                                        <small class="form-text text-danger">{{ $errors->first('phone') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ old('email', $vacancy->email) }}">
                                    @if($errors->first('email'))
                                        <small class="form-text text-danger">{{ $errors->first('email') }}</small>
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

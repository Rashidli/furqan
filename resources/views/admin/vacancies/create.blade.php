@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{ route('vacancies.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Əlavə et</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title') }}">
                                    @if($errors->first('az_title'))
                                        <small class="form-text text-danger">{{ $errors->first('az_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title') }}">
                                    @if($errors->first('en_title'))
                                        <small class="form-text text-danger">{{ $errors->first('en_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title') }}">
                                    @if($errors->first('ru_title'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_title') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Filial az</label>
                                    <input class="form-control" type="text" name="az_branch" value="{{ old('az_branch') }}">
                                    @if($errors->first('az_branch'))
                                        <small class="form-text text-danger">{{ $errors->first('az_branch') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Filial en</label>
                                    <input class="form-control" type="text" name="en_branch" value="{{ old('en_branch') }}">
                                    @if($errors->first('en_branch'))
                                        <small class="form-text text-danger">{{ $errors->first('en_branch') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Filial ru</label>
                                    <input class="form-control" type="text" name="ru_branch" value="{{ old('ru_branch') }}">
                                    @if($errors->first('ru_branch'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_branch') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Tələblər az</label>
                                    <textarea id="editor1_az" class="form-control" name="az_requirement">{{ old('az_requirement') }}</textarea>
                                    @if($errors->first('az_requirement'))
                                        <small class="form-text text-danger">{{ $errors->first('az_requirement') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Tələblər en</label>
                                    <textarea id="editor1_en" class="form-control" name="en_requirement">{{ old('en_requirement') }}</textarea>
                                    @if($errors->first('en_requirement'))
                                        <small class="form-text text-danger">{{ $errors->first('en_requirement') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Tələblər ru</label>
                                    <textarea id="editor1_ru" class="form-control" name="ru_requirement">{{ old('ru_requirement') }}</textarea>
                                    @if($errors->first('ru_requirement'))
                                        <small class="form-text text-danger">{{ $errors->first('ru_requirement') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Telefon</label>
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                                    @if($errors->first('phone'))
                                        <small class="form-text text-danger">{{ $errors->first('phone') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">E-poçt</label>
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                                    @if($errors->first('email'))
                                        <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Məzmun az</label>
                                    <textarea id="editor_az" class="form-control" name="az_description">{{ old('az_description') }}</textarea>
                                    @if($errors->first('az_description'))
                                        <small class="form-text text-danger">{{ $errors->first('az_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Məzmun en</label>
                                    <textarea id="editor_en" class="form-control" name="en_description">{{ old('en_description') }}</textarea>
                                    @if($errors->first('en_description'))
                                        <small class="form-text text-danger">{{ $errors->first('en_description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Məzmun ru</label>
                                    <textarea id="editor_ru" class="form-control" name="ru_description">{{ old('ru_description') }}</textarea>
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


@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{route('main_abouts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Əlavə et</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Text az</label>
                                    <textarea id="editor_az" class="form-control" type="text" name="az_description">{{ old('az_description') }}</textarea>
                                    @if($errors->first('az_description')) <small class="form-text text-danger">{{$errors->first('az_description')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Text en</label>
                                    <textarea id="editor_en" class="form-control" type="text" name="en_description">{{ old('en_description') }}</textarea>
                                    @if($errors->first('en_description')) <small class="form-text text-danger">{{$errors->first('en_description')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Text ru</label>
                                    <textarea id="editor_ru" class="form-control" type="text" name="ru_description">{{ old('ru_description') }}</textarea>
                                    @if($errors->first('ru_description')) <small class="form-text text-danger">{{$errors->first('ru_description')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Şəkli</label>
                                    <input class="form-control" type="file" name="image">
                                    @if($errors->first('image')) <small class="form-text text-danger">{{$errors->first('image')}}</small> @endif
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
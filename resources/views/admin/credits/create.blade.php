@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{route('credits.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Əlavə et</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title') }}">
                                    @if($errors->first('az_title')) <small class="form-text text-danger">{{$errors->first('az_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title') }}">
                                    @if($errors->first('en_title')) <small class="form-text text-danger">{{$errors->first('en_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title') }}">
                                    @if($errors->first('ru_title')) <small class="form-text text-danger">{{$errors->first('ru_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Value az</label>
                                    <input class="form-control" type="text" name="az_value" value="{{ old('az_value') }}">
                                    @if($errors->first('az_value')) <small class="form-text text-danger">{{$errors->first('az_value')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Value en</label>
                                    <input class="form-control" type="text" name="en_value" value="{{ old('en_value') }}">
                                    @if($errors->first('en_value')) <small class="form-text text-danger">{{$errors->first('en_value')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Value ru</label>
                                    <input class="form-control" type="text" name="ru_value" value="{{ old('ru_value') }}">
                                    @if($errors->first('ru_value')) <small class="form-text text-danger">{{$errors->first('ru_value')}}</small> @endif
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

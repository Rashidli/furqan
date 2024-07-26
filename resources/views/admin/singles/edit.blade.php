@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('singles.update', $single->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$single->translate('en')->title}}</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Type</label>
                                    <input readonly class="form-control" type="text" name="type" value="{{$single->type}}">
                                    @if($errors->first('type')) <small class="form-text text-danger">{{$errors->first('type')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{$single->translate('az')->title}}">
                                    @if($errors->first('az_title')) <small class="form-text text-danger">{{$errors->first('az_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{$single->translate('en')->title}}">
                                    @if($errors->first('en_title')) <small class="form-text text-danger">{{$errors->first('en_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{$single->translate('ru')->title}}">
                                    @if($errors->first('ru_title')) <small class="form-text text-danger">{{$errors->first('ru_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Meta title az</label>
                                    <input class="form-control" type="text" name="az_seo_title" value="{{$single->translate('az')->seo_title}}">
                                    @if($errors->first('az_seo_title')) <small class="form-text text-danger">{{$errors->first('az_seo_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Meta title en</label>
                                    <input class="form-control" type="text" name="en_seo_title" value="{{$single->translate('en')->seo_title}}">
                                    @if($errors->first('en_seo_title')) <small class="form-text text-danger">{{$errors->first('en_seo_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Meta title ru</label>
                                    <input class="form-control" type="text" name="ru_seo_title" value="{{$single->translate('ru')->seo_title}}">
                                    @if($errors->first('ru_seo_title')) <small class="form-text text-danger">{{$errors->first('ru_seo_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Meta description az</label>
                                    <textarea id="editor_az"  class="form-control" type="text" name="az_seo_description">{{$single->translate('az')->seo_description}}</textarea>
                                    @if($errors->first('az_seo_description')) <small class="form-text text-danger">{{$errors->first('az_seo_description')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Meta description en</label>
                                    <textarea id="editor_en" class="form-control" type="text" name="en_seo_description">{{$single->translate('en')->seo_description}}</textarea>
                                    @if($errors->first('en_seo_description')) <small class="form-text text-danger">{{$errors->first('en_seo_description')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Meta description ru</label>
                                    <textarea id="editor_ru" class="form-control" type="text" name="ru_seo_description">{{$single->translate('ru')->seo_description}}</textarea>
                                    @if($errors->first('ru_seo_description')) <small class="form-text text-danger">{{$errors->first('ru_seo_description')}}</small> @endif
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

{{--<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>--}}
{{--<script>--}}
{{--    ClassicEditor--}}
{{--        .create( document.querySelector( '#editor_az' ) )--}}
{{--        .catch( error => {--}}
{{--            console.error( error );--}}
{{--        } );--}}

{{--    ClassicEditor--}}
{{--        .create( document.querySelector( '#editor_en' ) )--}}
{{--        .catch( error => {--}}
{{--            console.error( error );--}}
{{--        } );--}}

{{--    ClassicEditor--}}
{{--        .create( document.querySelector( '#editor_ru' ) )--}}
{{--        .catch( error => {--}}
{{--            console.error( error );--}}
{{--        } );--}}

{{--</script>--}}

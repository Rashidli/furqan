@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('words.update', $word->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$word->title}}</h4>
                        <div class="row">
                            <div class="col-6">


                                <div class="mb-3">
                                    <label class="col-form-label">Söz az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{$word->translate('az')->title}}">
                                    @if($errors->first('az_title')) <small class="form-text text-danger">{{$errors->first('az_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Söz en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{$word->translate('en')->title}}">
                                    @if($errors->first('en_title')) <small class="form-text text-danger">{{$errors->first('en_title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Söz ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{$word->translate('ru')->title}}">
                                    @if($errors->first('ru_title')) <small class="form-text text-danger">{{$errors->first('ru_title')}}</small> @endif
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


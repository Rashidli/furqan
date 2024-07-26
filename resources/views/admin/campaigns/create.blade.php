@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{route('campaigns.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Əlavə et</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Məhsulu seç</label>
                                    <select name="product_id" id="" class="form-control">
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}" >{{$product->title}} - {{$product->price}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Kampanya qiyməti</label>
                                    <input class="form-control" type="text" name="campaign_price" value="{{ old('campaign_price') }}">
                                    @if($errors->first('campaign_price'))
                                        <small class="form-text text-danger">{{ $errors->first('campaign_price') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Kampanya bitmə tarixi</label>
                                    <input class="form-control" type="datetime-local" name="campaign_end_time" value="{{ old('campaign_end_time')}}">
                                    @if($errors->first('campaign_end_time'))
                                        <small class="form-text text-danger">{{ $errors->first('campaign_end_time') }}</small>
                                    @endif
                                </div>

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
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@include('admin.includes.footer')

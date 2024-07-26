@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ route('campaigns.update', $campaign->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Kampanya siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $campaign->translate('en')?->title }}</li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Məhsulu seç</label>
                                    <select name="product_id" class="form-control">
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}" {{$product->id == $campaign->product_id ? 'selected' : ''}}>{{$product->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Kampanya qiyməti</label>
                                    <input class="form-control" type="text" name="campaign_price" value="{{ old('campaign_price', $campaign->campaign_price) }}">
                                    @if($errors->first('campaign_price'))
                                        <small class="form-text text-danger">{{ $errors->first('campaign_price') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Kampanya bitmə tarixi</label>
                                    <input class="form-control" type="datetime-local" name="campaign_end_time" value="{{ old('campaign_end_time', $campaign->campaign_end_time ) }}">
                                    @if($errors->first('campaign_end_time'))
                                        <small class="form-text text-danger">{{ $errors->first('campaign_end_time') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Kampanya Başlığı az</label>
                                    <input class="form-control" type="text" name="az_title" value="{{ old('az_title', $campaign->translate('az')->title) }}">
                                    @if($errors->first('az_title')) <small class="form-text text-danger">{{ $errors->first('az_title') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Kampanya Başlığı en</label>
                                    <input class="form-control" type="text" name="en_title" value="{{ old('en_title', $campaign->translate('en')->title) }}">
                                    @if($errors->first('en_title')) <small class="form-text text-danger">{{ $errors->first('en_title') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Kampanya Başlığı ru</label>
                                    <input class="form-control" type="text" name="ru_title" value="{{ old('ru_title', $campaign->translate('ru')->title) }}">
                                    @if($errors->first('ru_title')) <small class="form-text text-danger">{{ $errors->first('ru_title') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" id="" class="form-control">
                                        <option value="1" {{ old('is_active', $campaign->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $campaign->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
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

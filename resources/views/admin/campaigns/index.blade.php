@include('admin.includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if(session('message'))
                                    <div class="alert alert-success">{{session('message')}}</div>
                                @endif
                                <h4 class="card-title">Kampaniyalar</h4>
                                    <a href="{{route('campaigns.create')}}" class="btn btn-primary">+</a>
                                <br>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th>№</th>
                                                <th>Başlıq</th>
                                                <th>Məhsul</th>
                                                <th>Bitmə vaxtı</th>
                                                <th>Active</th>
                                                <th>Əməliyyat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($campaigns as $campaign)
                                            <tr class="{{ $campaign->campaign_end_time < now() ? 'table-danger' : '' }}">
                                                <th scope="row">{{$campaign->id}}</th>
                                                <th scope="row">{{$campaign->title}}</th>
                                                <th scope="row">{{$campaign->product?->title}}</th>
                                                <th scope="row">{{$campaign->campaign_end_time}}</th>
                                                <td>
                                                    @if($campaign->is_active)
                                                        <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                                    @else
                                                        Deactive
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('campaigns.edit',$campaign->id)}}" class="btn btn-primary" style="margin-right: 15px">Edit</a>
                                                    <form action="{{route('campaigns.destroy', $campaign->id)}}" method="post" style="display: inline-block">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                        <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <br>
                                    {{ $campaigns->links('admin.vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('admin.includes.footer')

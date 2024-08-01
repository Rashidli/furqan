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
                                <h4 class="card-title">Haqqımızda</h4>
{{--                                    <a href="{{route('main_abouts.create')}}" class="btn btn-primary">+</a>--}}
                                <br>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                        <thead class="table-light">
                                        <tr>
                                            <th>№</th>
                                            <th>Başlıq</th>
                                            <th>Status</th>
                                            <th>Əməliyyat</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($main_abouts as $main_about)

                                            <tr>
                                                <th scope="row">{{$main_about->id}}</th>
                                                <th scope="row">Haqqımızda</th>
                                                {{--                                                <td><img src="{{asset('storage/'.$main_about->image)}}" style="width: 100px; height: 50px" alt=""></td>--}}
                                                <td>
                                                    @if($main_about->is_active)
                                                        <i
                                                            class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                                    @else
                                                        Deactive
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('main_abouts.edit',$main_about->id)}}" class="btn btn-primary"
                                                       style="margin-right: 15px">Edit</a>
{{--                                                    <form action="{{route('main_abouts.destroy', $main_about->id)}}" method="post"--}}
{{--                                                          style="display: inline-block">--}}
{{--                                                        {{ method_field('DELETE') }}--}}
{{--                                                        @csrf--}}
{{--                                                        <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')"--}}
{{--                                                                type="submit" class="btn btn-danger">Delete--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                    {{ $main_abouts->links('admin.vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('admin.includes.footer')

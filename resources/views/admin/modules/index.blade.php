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
                            <h4 class="card-title">{{$product->title }} modulları </h4>
                            <a href="{{route('products.modules.create', $product->id)}}" class="btn btn-primary">+</a>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Adı</th>
                                        <th>Qiyməti</th>
                                        <th>Status</th>
                                        <th>Əməliyat</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($modules as $key => $module)

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$module->title}}</td>
                                            <td>{{$module->price}}</td>
                                            <td>
                                                @if($module->is_active)
                                                    <i
                                                        class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                                @else
                                                    Deactive
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('products.modules.edit', [$product->id, $module->id])}}" class="btn btn-warning" style="margin-right: 15px" >Edit</a>
                                                <form action="{{route('products.modules.destroy', [$product->id, $module->id])}}" method="post" style="display: inline-block">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button onclick="confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                                <br>
                                {{ $modules->links('admin.vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@include('admin.includes.footer')

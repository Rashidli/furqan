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
                                <h4 class="card-title">Məhsullar</h4>
                                        <a href="{{route('products.create')}}" class="btn btn-primary">+</a>
                                <br>
                                    <form action="{{route('products.index')}}" method="get">
                                        <div class="row">

                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class=" col-form-label" for="order_status">Limit</label>
                                                    <select class="form-control"  name="limit">
                                                        <option selected value="">---</option>
                                                        <option value="10" {{ request()->limit == '10' ? 'selected' : '' }}>10</option>
                                                        <option value="50" {{ request()->limit == '50' ? 'selected' : '' }}>50</option>
                                                        <option value="100" {{ request()->limit == '100' ? 'selected' : '' }}>100</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class=" col-form-label" for="order_status">Kateqoriya</label>
                                                    <select class="form-control"  name="category_id">
                                                        <option selected value="">---</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{$category->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class="col-form-label"> Məhsul adı </label>
                                                    <input type="text" name="name" value="{{request()->name}}"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class="col-form-label"> Axtar </label>
                                                    <input type="submit"  class="form-control btn btn-primary">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class="col-form-label"> Sıfırla </label><br>
                                                    <a href="{{route('products.index')}}" class="btn btn-primary">Sıfırla</a>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Adı</th>
                                                <th>Üst kateqoriyası</th>
                                                <th>Kateqoriyası</th>
                                                <th>Modullar</th>
                                                <th>Status</th>
                                                <th>Əməliyat</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($products as $key => $product)

                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$product->title}}</td>
                                                <td>{{$product->category?->parent?->title}}</td>
                                                <td>{{$product->category?->title}}</td>
                                                <td><a href="{{ route('products.modules.index', [$product->id]) }}" class="btn btn-info">Modullar {{$product->modules_count}}</a></td>
{{--                                                <td><img src="{{asset('storage/'.$product->image)}}" style="width: 100px; height: 50px" alt=""></td>--}}
                                                <td>
                                                    @if($product->is_active)
                                                        <i
                                                            class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                                    @else
                                                        Deactive
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning" style="margin-right: 15px" >Edit</a>
                                                    <form action="{{route('products.destroy', $product->id)}}" method="post" style="display: inline-block">
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
                                    {{ $products->links('admin.vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('admin.includes.footer')

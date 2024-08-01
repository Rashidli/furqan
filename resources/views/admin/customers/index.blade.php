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
                                <h4 class="card-title">Userlər</h4>
{{--                                    <a href="{{route('customers.create')}}" class="btn btn-primary">+</a>--}}
                                <br>
                                <br>

                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Ad</th>
                                                <th>Soyad</th>
                                                <th>Telefon</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customers as $key => $customer)
                                                <tr>
                                                    <th scope="row">{{$key+1}}</th>
                                                    <th scope="row">{{$customer->name}}</th>
                                                    <th scope="row">{{$customer->surname}}</th>
                                                    <th scope="row">{{$customer->phone}}</th>
                                                    <th scope="row">{{$customer->email}}</th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                    {{ $customers->links('admin.vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('admin.includes.footer')

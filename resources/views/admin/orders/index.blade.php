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
                                <h4 class="card-title">Sifarişlər</h4>
{{--                                    <a href="{{route('orders.create')}}" class="btn btn-primary">+</a>--}}
                                <br>
                                <br>

                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Sifarişçi</th>
                                                <th>Telefonu</th>
                                                <th>Tarix</th>
                                                <th>Status</th>
                                                <th>Ümumi</th>
                                                <th>Detallı</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $key => $order)
                                                <tr>
                                                    <th scope="row">{{$order->id}}</th>
                                                    <th scope="row">{{$order->customer?->name}}</th>
                                                    <th scope="row">{{$order->customer?->phone}}</th>
                                                    <th scope="row">{{$order->created_at->format('d.m.Y')}}</th>
                                                    <th scope="row">{{ \App\Enums\OrderStatus::fromValue($order->status)->label() }}</th>
                                                    <th scope="row">{{$order->total_price}} ({{$order->items_count}} məhsul)</th>
                                                    <th><a href="{{route('orders.edit', $order->id)}}" class="btn btn-info">Bax</a></th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                    {{ $orders->links('admin.vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('admin.includes.footer')

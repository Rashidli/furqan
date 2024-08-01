@include('admin.includes.header')
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ route('orders.update', $order->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $order->id }}</li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1" {{ $order->status == \App\Enums\OrderStatus::ACCEPTED->value ? 'selected' : '' }}>Yeni sfariş</option>
                                        <option value="2" {{ $order->status == \App\Enums\OrderStatus::PREPARED->value ? 'selected' : '' }}>Hazırlanır</option>
                                        <option value="3" {{ $order->status == \App\Enums\OrderStatus::SENT->value ? 'selected' : '' }}>Göndərildi</option>
                                        <option value="4" {{ $order->status == \App\Enums\OrderStatus::DELIVERED->value ? 'selected' : '' }}>Təhvil verildi</option>
                                        <option value="5" {{ $order->status == \App\Enums\OrderStatus::REJECTED->value ? 'selected' : '' }}>Ləğv edildi</option>
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
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Məhsullar</h4>
                        <br>
                        <br>
                        <table>
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Sifarişçi</th>
                                <th>Telefonu</th>
                                <th>Tarix</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->customer?->name}}</td>
                                <td>{{$order->customer?->phone}}</td>
                                <td>{{$order->created_at->format('d.m.Y')}}</td>
                                <td>{{ \App\Enums\OrderStatus::fromValue($order->status)->label() }}</td>
                                <td>{{$order->total_price}} ({{$order->items_count}} məhsul)</td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <h4>Order Items</h4>
                        <table>
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Məhsul</th>
                                <th>Sayı</th>
                                <th>Qiyməti</th>
                                <th>Ümumi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->items as $key => $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->price * $item->quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" align="right"><strong>Total</strong></td>
                                <td>{{$order->total_price}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
@include('admin.includes.footer')

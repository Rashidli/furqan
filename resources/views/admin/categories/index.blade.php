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
                                <h4 class="card-title">Kateqoriya</h4>
                                    <a href="{{route('categories.create')}}" class="btn btn-primary">+</a>
                                <br>
                                <br>
                                <div class="table-responsive">
                                    <table  class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead class="table-light">
                                            <tr>
                                                <th>№</th>
                                                <th>Başlıq</th>
                                                <th>Üst kateqoriya</th>
                                                <th>Əməliyyat</th>
                                            </tr>
                                        </thead>
                                        <livewire:livewire-sort-table />
                                    </table>
                                    <br>
                                    {{ $categories->links('admin.vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@include('admin.includes.footer')

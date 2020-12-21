<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file_export" class="table table-striped table-bordered display responsive nowrap" width="100%">
                        <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 10%;">Nome</th>
                            <th style="width: 20%;">Marca</th>
                            <th style="width: 25%;">Preço</th>
                            <th style="width: 20%;">QTD</th>
                            <th style="width: 10%;">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>
                                    <a href="{{ route("panel.product.edit", ["product_id"=>$item->id]) }}" class="btn btn-theme"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route("$routeAmbient.$routeCrud.delete", ["product_id"=>$item->id]) }}" class="btn btn-dark click-action"><i class="fa fa-trash text-white"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 10%;">Iniciais</th>
                            <th style="width: 20%;">Nome</th>
                            <th style="width: 25%;">Descrição</th>
                            <th style="width: 20%;">ID Sismat</th>
                            <th style="width: 10%;">Ação</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

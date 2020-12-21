<div class="row">
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Criação de Produtos
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <form method="POST" action="{{ route("panel.product.update") }}" onsubmit="formSubmit(this);">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="card-body">
                            <div class="">
                                <div class="sl-item">
                                    <div class="sl-right">
                                        <div>
                                            <span class="sl-date"> | Nome</span>
                                            <input type="text" class="form-control m-t-10" name="name" id="name" placeholder="Nome" value="{{ $item->name ?? old("name") ?? "" }}"/>
                                            <label for="name"></label>
                                            <small class="form-control-feedback"> </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-right">
                                        <div>
                                            <span class="sl-date"> | Marca</span>
                                            <input type="text" class="form-control m-t-10" name="brand" id="brand" placeholder="Marca do Produto" value="{{ $item->brand ?? old("brand") ?? "" }}"/>
                                            <label for="brand"></label>
                                            <small class="form-control-feedback"> </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-right">
                                        <div>
                                            <span class="sl-date"> | Preço </span>
                                            <input class="form-control m-t-10" name="price" id="price" placeholder="Preço do Produto" value="{{ $item->price ?? old("price") ?? "" }}">
                                            <label for="price"></label>
                                            <small class="form-control-feedback"> </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-right">
                                        <div>
                                            <span class="sl-date"> | Estoque</span>
                                            <input type="number" class="form-control m-t-10" name="stock" id="stock" placeholder="QTD" value="{{ $item->stock ?? old("stock") ?? "" }}"/>
                                            <label for="stock"></label>
                                            <small class="form-control-feedback"> </small>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <div class="like-comm">
                                        <a href="{{ route("panel.product.index") }}" class="btn btn-danger btn-theme-danger m-r-10">
                                            <i class="fa fa-arrow-left"></i>
                                            Lista
                                        </a>
                                        <button type="submit" class="btn btn-success m-r-10 btn-theme">
                                            <i class="fa fa-check"></i>
                                            Atualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

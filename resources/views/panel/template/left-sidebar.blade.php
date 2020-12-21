<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
            <div class="user-pro-body">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Olá {{ auth()->user()->first_name }} <span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <a  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            href="{{ route('logout') }}" class="dropdown-item">
                            <i class="fa fa-power-off"></i> Encerrar
                        </a>
                        <form method="POST" action="{{ route("logout") }}" style="display: none;" id="logout-form">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{ route("panel.main.index") }}" aria-expanded="false">
                        <i class="fa fa-home"></i><span class="hide-menu">Home</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route("apiDocumentation.main.index") }}" aria-expanded="false" target="_blank">
                        <i class="fa fa-code"></i><span class="hide-menu">API Doc</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route("panel.product.index") }}">
                        <i class="fa fa-boxes"></i><span class="hide-menu">Produtos</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

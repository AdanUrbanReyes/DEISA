<nav class="navbar navbar-expand-lg navbar-light bg-faded" style="background-color: #FCFFF5;">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-uppercase" href="{{ url('/') }}">DEISA</a>
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul style="margin: 0 auto;" class="navbar-nav mr-auto">
      <li class="nav-item" ><a class="nav-link text-uppercase" href="#">Quienes somos</a></li>
      <li class="nav-item" ><a class="nav-link text-uppercase" href="#">Servicios</a></li>
      <li class="nav-item" ><a class="nav-link text-uppercase" href="#">Acreditaciones</a></li>
      <li class="nav-item" ><a class="nav-link text-uppercase" href="#">Reconocimientos</a></li>
      <li class="nav-item dropdown" >
        <a href="#" class="dropdown-toggle nav-link text-uppercase" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gaceta<span class="caret"></span></a>
        <div class="dropdown-menu">
          <a href="#" class="dropdown-item">Normas generales</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">Articulos de interes</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">Comunicados oficiales</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">Ultimas publicaciones de normas</a>
        </div>
      </li>
      <li class="nav-item dropdown" >
        <a href="#" class="dropdown-toggle nav-link text-uppercase" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contacto<span class="caret"></span></a>
        <div class="dropdown-menu">
          <a href="#" class="dropdown-item">Cotizaciones</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">Aviso de privacidad</a>
        </div>
      </li>
      @if (Route::has('login'))
        @auth
          <li class="nav-item" >
            <a class="nav-link text-uppercase" href="{{ url('/home') }}">Inicio</a>
          </li>
          <li class="nav-item dropdown">
              <a href="#" class="dropdown-toggle nav-link text-uppercase" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  {{ Auth::user()->name }} {{Auth::user()->primer_apellido}} {{Auth::user()->segundo_apellido}} <span class="caret"></span>
              </a>
              <div class="dropdown-menu">
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
          </li>          
        @else
          <li class="nav-item" >
            <a class="nav-link text-uppercase" href="{{route('login')}}">Iniciar Sesion</a>
          </li>
        @endauth
      @endif
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <div class="input-group">
        <input class="form-control " type="text" placeholder="Buscar">
        <span class="input-group-btn">
            <button class="btn btn-success" type="submit">
                <img src="{{asset('imagenes/buscar.png')}}" class="img-fluid" style="height: 20px;">
            </button>
        </span>
      </div>
    </form>
  </div>
</nav>
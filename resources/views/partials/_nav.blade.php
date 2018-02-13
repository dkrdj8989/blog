  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 30px">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <h2>JUNHO's blog</h2>
        </li>
        <li class="nav-item @yield('home')">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item @yield('about')">
          <a class="nav-link" href="/about">about</a>
        </li>
        <li class="nav-item @yield('contact')">
          <a class="nav-link" href="/contact">contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/post">전체 글 보기</a>
        </li>
      </ul>
      @if(Auth::check())
        <ul class="nav navrbar-nav navbar-right">
          <li class="nav-item dropdown">
            환영합니다.
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{Auth::user()->name }} 님
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('tag.index')}}">태그</a>
              <a class="dropdown-item" href="{{ route('category.index')}}">카테고리</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              로그아웃
              </a>
            </div>
          </li>
        </ul>        
      @else
        <a href={{route('login')}} class="btn btn-default">로그인</a>
        <a href="{{route('register')}}" class="btn btn-default">회원가입</a>
      @endif
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
      </form>
    </div>
  </nav> <!-- end of nav-->
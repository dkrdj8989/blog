<!doctype html>
<html lang="en">
<head>

  @include('partials._header')

  <body>

    @include('partials._nav')
    
    <div class="container">
      @include('partials.notification')
      {{-- @if (Auth::guest())
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
      @else
            {{ Auth::user()->name }} <span class="caret"></span>

              <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
              </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          @endif --}}
      @yield('content')
    </div> <!--end of container -->

    @include('partials._footer')
    @include('partials._scripts')

    @yield('scripts')

  </body>
</head>
</html>

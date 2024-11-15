<!-- header -->
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">미니보드</a>
            @auth
                {{-- 로그인을 했을때만 보임 --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        게시판
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($myGlobalBoardsCategoryInfo as $item)
                                <li><a class="dropdown-item" href="{{ route('boards.index', ['bc_type' => $item->bc_type]) }}">{{ $item->bc_name }}</a></li>   
                            @endforeach
                        </ul>
                    </li>
                    </ul>
                    <a href="{{ route('logout') }}" class="navbar-nav nav-link text-light" role="button">로그아웃</a>
                </div>
            @endauth
            @guest
                {{-- 로그인을 안했을때 보임 --}}
                <a href="{{ route('get.registration') }}" class="navbar-nav nav-link text-light" role="button">회원가입</a>
            @endguest
        </div>
    </nav>
</header>
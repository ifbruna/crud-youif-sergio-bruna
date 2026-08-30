<div class="d-flex flex-row align-items-center mx-5 mt-2">
    
    <div class="container-fluid d-flex flex-row align-items-center">
        <a href="{{ route('home_page') }}" class="d-flex">
            <img 
                src="{{ asset('assets/images/youif_logo.png') }}"
                class="img-fluid"
                width="80px"
                height="80px"
            >

            <div class="d-flex flex-row h4 align-items-center">

                <span class="text-danger">A You</span>
                <span class="text-success">IF&nbsp;</span>
                <span class="text-danger">project!</span>

            </div>
        </a>
    </div>
    
    @if (session()->get('user.permission') === 'admin')

        <a href="{{ route('new_media') }}">
            
            <button
            class="btn btn-secondary px-4 mx-2 justify-content-center"
            type="button"
            aria-expanded="false"
            >

            Postar uma mídia <i class="fa-solid fa-circle-plus"></i>
            
        </button>

        </a>
    @endif
    
    <div class="dropdown">

        <button
            class="btn btn-secondary dropdown-toggle px-5"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
        Menu
        </button>

        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    Logout&nbsp;
                    <i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="{{route('history')}}">
                    Histórico&nbsp;
                    <i class="fa-solid fa-clock-rotate-left ms-2"></i>
                </a>
            </li>

            @if (session()->get('user.permission') === 'admin')
                <li>
                    <a class="dropdown-item" href="{{ route('admin_dashboard') }}">
                        Admin&nbsp;
                        <i class="fa-solid fa-user-lock"></i>
                    </a>
                </li>
            @endif
            
        </ul>
    </div>

</div>

<hr>
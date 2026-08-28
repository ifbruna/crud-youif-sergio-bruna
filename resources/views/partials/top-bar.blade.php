<div class="d-flex flex-row align-items-center mx-5 mt-2">
    
    <div>

        <a href="{{ route('home_page') }}">
            <img 
                src="{{ asset('assets/images/youif_logo.png') }}"
                class="img-fluid"
                width="80px"
                height="80px"
            >
        </a>

    </div>

    
    <div class="col text-center">

        <span class="text-danger">A simple </span>
        <span class="text-success">Laravel</span>
        <span class="text-danger">project!</span>

    </div>

    
    <div class="dropdown">

        <button
            class="btn btn-secondary dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
        Menu
        </button>

        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    Logout
                    <i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="#">
                    Histórico
                    <i class="fa-solid fa-clock-rotate-left ms-2"></i>
                </a>
            </li>
        </ul>
    </div>

</div>

<hr>
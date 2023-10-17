<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand">Task Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a wire:navigate class="active" aria-current="page" href="/tasks">Tasks</a>
          </li>
        </ul>
      </div>
      <div id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @auth
            <li class="nav-item">
                <a class="nav-link">
                    {{ Auth::user()->name }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" wire:click="logout">Logout</a>
            </li>
            @endauth
            
            @guest
            <li class="nav-item">
                <a wire:navigate class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a wire:navigate class="nav-link" href="/register">Register</a>
            </li>
            @endguest
         
        </ul>
        
      </div>
    </div>
</nav>
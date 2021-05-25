<div class="pl-3">
    Welcome {{ session('user.name') }}!
</div>
<ul class="nav">   
    <li class="nav-item active">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
    </a>
    </li>
    <li class="nav-item ">
    <a class="nav-link" href="{{ route('profile') }}">
        <i class="material-icons">person</i>
        <p>User Profile</p>
    </a>
    </li>
    <li class="nav-item ">
    @if(Auth::user()->hasRole('administrator'))
    <a class="nav-link" href="{{ route('adminArea') }}">
        <i class="material-icons">supervisor_account</i>
        <p>Admin Area</p>
    </a>
    @endif()
    </li>
</ul>

<nav class="bg-gray-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-xl font-bold">Laporan App</div>
        <ul class="flex space-x-4">
            @auth('user')
                <li><a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'underline' : '' }}">Dashboard</a></li>
                <li><a href="/user/report/create" class="{{ request()->routeIs('user.reports') ? 'underline' : '' }}">Report</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-300">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @endauth
            {{-- @auth('admins')
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'underline' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.report') }}" class="{{ request()->routeIs('admin.report') ? 'underline' : '' }}">Report</a></li>
                <li><a href="{{ route('admin.response') }}" class="{{ request()->routeIs('admin.response') ? 'underline' : '' }}">Response</a></li>
                <li><a href="{{ route('admin.show') }}" class="{{ request()->routeIs('admin.show') ? 'underline' : '' }}">Show</a></li>
                <li><a href="{{ route('admin.tambah_staff') }}" class="{{ request()->routeIs('admin.tambah_staff') ? 'underline' : '' }}">Tambah Staff</a></li>
                <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-300">Logout</a></li>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">@csrf</form>
            @endauth
            @auth('admins', 'staff')
                <li><a href="{{ route('staff.dashboard') }}" class="{{ request()->routeIs('staff.dashboard') ? 'underline' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('staff.report') }}" class="{{ request()->routeIs('staff.report') ? 'underline' : '' }}">Report</a></li>
                <li><a href="{{ route('staff.response') }}" class="{{ request()->routeIs('staff.response') ? 'underline' : '' }}">Response</a></li>
                <li><a href="{{ route('staff.show') }}" class="{{ request()->routeIs('staff.show') ? 'underline' : '' }}">Show</a></li>
                <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-300">Logout</a></li>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">@csrf</form>
            @endauth --}}
            @guest('user', 'admins')
                <li><a href="{{ route('login') }}">Login</a></li>
            @endguest
        </ul>
    </div>
</nav>
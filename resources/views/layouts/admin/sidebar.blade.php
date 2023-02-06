<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ config('app.url') . '/storage/' . getSysInfo()->logo }}" alt="{{ getSysInfo()->nama }} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ getSysInfo()->nama }} Administration</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" id="nav-tree" data-widget="treeview" role="menu" data-accordion="false">
                @foreach (getAdmMenuHeaders() as $header)
                    @if (auth()->user()->can('' . $header->permission . ''))
                        <li class="nav-header">{{ strtoupper($header->menu_title) }}</li>
                        @if (count($header->childs))
                            @foreach ($header->childs as $parent)
                                @if (auth()->user()->can('' . $parent->permission . ''))
                                    <li class="nav-item {{ request()->segment(2) == explode('/', $parent->slug)[1] ? 'menu-open' : '' }}">
                                        <a href="{{ config('app.url') . '/' . $parent->slug }}" class="nav-link {{ request()->segment(2) == explode('/', $parent->slug)[1] ? 'active' : '' }}">
                                            <i class="nav-icon fas {{ $parent->icon }}"></i>
                                            <p>
                                                {{ $parent->menu_title }}
                                                @if (count($parent->childs))
                                                    <i class="right fas fa-angle-left"></i>
                                                @endif
                                            </p>
                                        </a>
                                        @if (count($parent->childs))
                                            <ul class="nav nav-treeview">
                                                @foreach ($parent->childs as $child)
                                                    @if (auth()->user()->can('' . $child->permission . ''))
                                                        <li class="nav-item {{ request()->segment(3) == $child->slug ? 'menu-open' : '' }}">
                                                            <a href="{{ config('app.url') . '/' . $parent->slug . '/' . $child->slug }}" class="nav-link {{ request()->segment(3) == $child->slug ? 'active' : '' }}">
                                                                <i class="fas {{ $child->icon }} nav-icon"></i>
                                                                <p>
                                                                    {{ $child->menu_title }}
                                                                    @if (count($child->childs))
                                                                        <i class="right fas fa-angle-left"></i>
                                                                    @endif
                                                                </p>
                                                            </a>
                                                            @if (count($child->childs))
                                                                <ul class="nav nav-treeview">
                                                                    @foreach ($child->childs as $item)
                                                                        @if (auth()->user()->can('' . $item->permission . ''))
                                                                            <li class="nav-item">
                                                                                <a href="{{ config('app.url') . '/' . $parent->slug . '/' . $child->slug . '/' . $item->slug }}" class="nav-link {{ request()->segment(4) == $item->slug ? 'active' : '' }}">
                                                                                    <i class="far {{ $item->icon }} nav-icon"></i>
                                                                                    <p>
                                                                                        {{ $item->menu_title }}
                                                                                    </p>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

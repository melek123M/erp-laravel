<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Menu latéral -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach (config('adminlte.menu') as $menuItem)
                    @if (isset($menuItem['type']) && $menuItem['type'] === 'sidebar-menu-search')
                        <li class="nav-item">
                            <form class="form-inline">
                                <div class="input-group">
                                    <input class="form-control form-control-sidebar" type="search"
                                        placeholder="{{ $menuItem['text'] }}" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-sidebar">
                                            <i class="fas fa-search fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    @elseif (isset($menuItem['header']))
                        <li class="nav-header">{{ $menuItem['header'] }}</li>
                    @elseif (isset($menuItem['text']))
                        <li class="nav-item">
                            <a href="{{ $menuItem['url'] ?? '#' }}" class="nav-link">
                                <i class="nav-icon {{ $menuItem['icon'] ?? 'far fa-circle' }}"></i>
                                <p>{{ $menuItem['text'] }}</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>

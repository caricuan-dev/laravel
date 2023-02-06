<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('user.dashboard') }}">
            <span class="align-middle mr-3">
                <img src="{{ config('app.url') . '/storage/' . getSysInfo()->logo }}" alt="{{ getSysInfo()->nama }} Logo" style="opacity: .8" height="40" width="40">
            </span>
        </a>

        <ul class="sidebar-nav">
            @foreach (getUserMenuHeaders() as $header)
                <li class="sidebar-header">
                    {{ strtoupper($header->menu_title) }}
                </li>
                @if (count($header->childs))
                    @foreach ($header->childs as $parent)
                        <li class="sidebar-item">
                            <a href="@if (count($parent->childs)) {{ '#menu_' . $parent->id . '_id'}} @else {{ config('app.url') . '/' . $parent->slug }} @endif" @if (count($parent->childs)) data-toggle="collapse" @endif class="sidebar-link">
                                <i class="align-middle" data-feather="share-2"></i> <span class="align-middle">{{ $parent->menu_title }}</span>
                            </a>
                            @if (count($parent->childs))
                                <ul id="{{ 'menu_' . $parent->id . '_id' }}" class="sidebar-dropdown list-unstyled collapse">
                                    @foreach ($parent->childs as $child)
                                        <li class="sidebar-item">
                                            <a href="@if (count($child->childs)) {{ '#menu_' . $child->id . '_id'}} @else {{ config('app.url') . '/' . $child->slug }} @endif" @if (count($child->childs)) data-toggle="collapse" @endif class="sidebar-link">
                                                {{ $child->menu_title }}
                                            </a>
                                            @if (count($child->childs))
                                                <ul id="{{ 'menu_' . $child->id . '_id' }}" class="sidebar-dropdown list-unstyled collapse">
                                                    @foreach ($child->childs as $item)
                                                        <li class="sidebar-item">
                                                            <a href="@if (count($item->childs)) {{ '#menu_' . $item->id . '_id'}} @else {{ config('app.url') . '/' . $item->slug }} @endif" @if (count($item->childs)) data-toggle="collapse" @endif class="sidebar-link">
                                                                {{ $item->menu_title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ul>
    </div>
</nav>

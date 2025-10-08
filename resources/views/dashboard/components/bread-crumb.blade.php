@php
    use Illuminate\Support\Str;

    $routeName = Route::currentRouteName();
    $pageParts = explode('.', $routeName);

    $section = $pageParts[1] ?? 'home';
    $action = $pageParts[2] ?? 'index';

    $sectionTitleMap = [
        'home' => 'Dashboard',
        'products' => 'Products',
        'sales' => 'Sales',
    ];

    $actionTitleMap = [
        'index' => $sectionTitleMap[$section] ?? 'Dashboard',
        'create' => 'Add ' . ($sectionTitleMap[$section] ?? ''),
        'edit' => 'Edit ' . ($sectionTitleMap[$section] ?? ''),
    ];

    $pageTitle = $actionTitleMap[$action] ?? ucfirst($section);
@endphp

<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">{{ $pageTitle }}</h1>

        <div class="breadcrumb">
            <a href="{{ route('dashboard.home') }}">Dashboard</a>

            @if ($section !== 'home')
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('dashboard.' . $section) }}">{{ $sectionTitleMap[$section] ?? ucfirst($section) }}</a>

                @if ($action !== 'index')
                    <i class="fas fa-chevron-right"></i>
                    <span>{{ ucfirst($action) }}</span>
                @endif
            @endif
        </div>
    </div>

    <div class="header-actions">
        @if ($action !== 'index')
            <a href="{{ route('dashboard.' . $section) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to {{ $sectionTitleMap[$section] ?? ucfirst($section) }}
            </a>
        @endif
    </div>
</div>
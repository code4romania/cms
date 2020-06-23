@php
    $view = sprintf('%s.%s', config('twill.block_editor.block_views_path'), 'counterItem');

    switch ($block->input('background')) {
        case 'primary':
            $containerBackground = 'bg-primary-700 text-white';
            $badgeBackground = 'text-white';
            $badgeText = 'text-primary-700';
            break;

        case 'warning':
            $containerBackground = 'bg-warning-400 text-black';
            $badgeBackground = 'text-black';
            $badgeText = 'text-warning-400';
            break;

        case 'danger':
            $containerBackground = 'bg-danger-700 text-white';
            $badgeBackground = 'text-white';
            $badgeText = 'text-danger-700';
            break;

        case 'success':
            $containerBackground = 'bg-success-700 text-white';
            $badgeBackground = 'text-white';
            $badgeText = 'text-success-700';
            break;

        case 'black':
            $containerBackground = 'bg-black text-white';
            $badgeBackground = 'text-white';
            $badgeText = 'text-gray-900';
            break;

        case 'gray':
            $containerBackground = 'bg-gray-800 text-white';
            $badgeBackground = 'text-white';
            $badgeText = 'text-gray-800';
            break;

        default:
            $containerBackground = null;
            $badgeBackground = null;
            $badgeText = 'text-white';
            break;
    }

    switch ($block->input('columns')) {
        case 1:
            $containerColumns = 'grid-cols-1';
            break;

        case 2:
            $containerColumns = 'grid-cols-2';
            break;

        case 3:
            $containerColumns = 'grid-cols-2 lg:grid-cols-3';
            break;

        default:
            break;
    }
@endphp

<section class="py-12 {{ $containerBackground }}">
    <div class="container">
        <h1 class="mb-8 text-center h2">{{ $block->translatedInput('title') }}</h1>

        <div class="grid gap-8 {{ $containerColumns }}">
            @foreach ($block->children as $index => $child)
                @include($view, [
                    'index'           => $index,
                    'block'           => $child,
                    'badgeBackground' => $badgeBackground,
                    'badgeText'       => $badgeText,
                ])
            @endforeach
        </div>
    </div>
</section>

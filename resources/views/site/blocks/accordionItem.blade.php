<b-collapse
    :open="isBlockPreview"
    class="card block">

    <header
        slot="trigger"
        slot-scope="props"
        role="button"
        class="card-header">

        <p class="card-header-title is-size-5-tablet">
            {{ $block->translatedinput('header') }}
        </p>
        <a class="card-header-icon">
            <b-icon :icon="props.open ? 'menu-down' : 'menu-up'"></b-icon>
        </a>
    </header>

    <div class="card-content content">
        {!! $block->translatedinput('description') !!}
    </div>
</b-collapse>

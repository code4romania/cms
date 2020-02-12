<div class="section block block-subscribe">
    <div class="container">
        <div class="section is-slim is-down">
            <div class="columns is-multiline is-vcentered">
                <div class="column is-12-tablet is-7-desktop is-8-widescreen">
                    <h1 class="title">{{ $block->translatedinput('title') }}</h1>
                    <div class="content">
                        {!! $block->translatedinput('description') !!}
                    </div>
                </div>

                <div class="column">
                    <form action="{{ route('newsletter.subscribe') }}" method="post">
                        @csrf
                        <b-field>
                            <b-input name="email" icon="email" placeholder="Email" type="email" required></b-input>
                        </b-field>
                        <b-button native-type="submit" type="is-success" size="is-medium is-fullwidth">
                            {{ __('content.submit') }}
                        </b-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

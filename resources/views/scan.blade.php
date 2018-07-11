@extends('layouts.app')

@section('content')
    <ais-index app-id="{{ config('scout.algolia.id') }}" api-key="{{ config('scout.algolia.key') }}" index-name="threads">
        <ais-search-box></ais-search-box>

        <ais-refinement-list attribute-name="channel.name"></ais-refinement-list>

        <ais-results>
            <template scope="{ result }">
                <div class="container">
                    <h2>
                        <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                    </h2>
                </div>
            </template>
        </ais-results>
    </ais-index>
@endsection

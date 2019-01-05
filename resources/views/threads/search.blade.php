@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(isset($searched))
                <img src="{{ asset('images/algolia.png') }}" alt="algolia">
            @endif

            <ais-index
                app-id="{{ config('scout.algolia.id') }}"
                api-key="{{ config('scout.algolia.key') }}"
                index-name="threads"
                query="{{ request('q') }}"
            >
                <div class="d-flex py-4 flex-row">
                    <div>
                        <div class="bg-white border p-4">
                            <h4>Search</h4>

                            <ais-search-box>
                                <ais-input placeholder="Find a thread..." :autofocus="true" class="form-control"></ais-input>
                            </ais-search-box>
                        </div>

                        <div class="bg-white border p-4">
                            <h4>
                                Filter By Channel
                            </h4>

                            <div class="panel-body">
                                <ais-refinement-list attribute-name="channel.name"></ais-refinement-list>
                            </div>
                        </div>
                    </div>

                    <div class="flex-grow-1 ml-4 bg-white p-3">
                        <ais-results>
                            <template slot-scope="{ result }">
                                <li class="list-reset pb-3 border-bottom mt-3 search-result">
                                    <a :href="result.path" class="search-title">
                                        <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                                    </a>
                                    <p class="pt-2">
                                        <span class="category-label" v-text="result.channel.name" :style="{backgroundColor: result.channel.color}"></span>
                                        <span>|</span>
                                        <a :href="`/profiles/${result.creator.name}`">
                                            <span v-text="result.creator.name"></span>
                                        </a>
                                    </p>
                                </li>
                            </template>
                        </ais-results>
                    </div>
                </div>

            </ais-index>
        </div>
    </div>
@endsection

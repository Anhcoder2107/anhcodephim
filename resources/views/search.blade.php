@extends('layout.master')
@section('title')
    Search Results for "{{ $search }}"
@endsection
@section('container')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Search Results</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Search Results Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title">
                                        <h4>Search Results for "{{ $search }}"</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($movies as $movie)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ $movie->thumb_url }}">
                                            <div class="ep">{{ $movie->episode_current }} / {{ $movie->episode_total }}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{ $movie->view_total }}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>{{ $movie->status }}</li>
                                                <li>{{ $movie->type }}</li>
                                            </ul>
                                            <h5><a href="{{ route('movies.show', $movie->slug) }}">{{ $movie->name }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="product__pagination">
                        @for ($i = 1; $i <= $movies->lastPage(); $i++)
                            <a href="{{ "search?search=".$search."&page=".$i }}" class="{{ $movies->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                        @endfor
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Top Views</h5>
                            </div>
                            <ul class="filter__controls">
                                <li class="active" data-filter="*">Day</li>
                                <li data-filter=".week">Week</li>
                                <li data-filter=".month">Month</li>
                                <li data-filter=".years">Years</li>
                            </ul>
                            <div class="filter__gallery">
                            </div>
                        </div>
                        <div class="product__sidebar__comment">
                            <div class="section-title">
                                <h5>New Comment</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Results Section End -->
@endsection

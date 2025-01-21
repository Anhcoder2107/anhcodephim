@extends('layout.master')
@section('title', 'AnhcodePhim')
@section('container')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                @foreach ($sliderMovies as $sliderMovie)
                    <div class="hero__items set-bg" data-setbg="{{ $sliderMovie->poster_url }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero__text">
                                    <div class="label">
                                        @foreach ($sliderMovie->categories as $category)
                                            <span>{{ $category->name }} - </span>
                                        @endforeach
                                    </div>
                                    <h2>{{ $sliderMovie->name }}</h2>
                                    <p>
                                        {!! Str::substr($sliderMovie->content, 0, 50) !!}...
                                    </p>
                                    <a href="{{ route('movies.show', $sliderMovie->slug) }}"><span>Watch Now</span> <i
                                            class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Phim hot</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($trendMovies as $trendMovie)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ route('movies.show', $trendMovie->slug) }}">
                                            <div class="product__item__pic set-bg lazy"
                                                data-setbg="{{ $trendMovie->thumb_url }}">
                                                <div class="ep">{{ $trendMovie->episode_current }} /
                                                    {{ $trendMovie->episode_total }}</div>
                                                <div class="view"><i class="fa fa-eye"></i>
                                                    {{ $trendMovie->view_total }}
                                                </div>
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>Active</li>
                                                <li>Movie</li>
                                            </ul>
                                            <h5><a
                                                    href="{{ route('movies.show', $trendMovie->slug) }}">{{ $trendMovie->name }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="recent__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Phim Bộ</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($seriesMovies as $seriesMovie)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg lazy" data-setbg="{{ $seriesMovie->thumb_url }}">
                                            <div class="ep">
                                                {{ $seriesMovie->episode_current }}/ {{ $seriesMovie->episode_total }}
                                            </div>
                                            <div class="comment"><i class="fa fa-comments"></i> 0</div>
                                            <div class="view"><i class="fa fa-eye"></i>
                                                {{ $seriesMovie->view_total }}
                                            </div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>Active</li>
                                                <li>Movie</li>
                                            </ul>
                                            <h5><a
                                                    href="{{ route('movies.show', $seriesMovie->slug) }}">{{ $seriesMovie->name }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="live__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Phim Lẻ</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($singleMovies as $singleMovie)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg lazy" data-setbg="{{ $singleMovie->thumb_url }}">
                                            <div class="ep">{{ $singleMovie->episode_current }} /
                                                {{ $singleMovie->episode_total }}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> 0</div>
                                            <div class="view"><i class="fa fa-eye"></i>
                                                {{ $singleMovie->view_total }}
                                            </div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>Active</li>
                                                <li>Movie</li>
                                            </ul>
                                            <h5><a
                                                    href="{{ route('movies.show', $singleMovie->slug) }}">{{ $singleMovie->name }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                                @foreach ($topViewMovies as $topViewMovie)
                                    <div class="product__sidebar__view__item set-bg lazy mix day"
                                        data-setbg="{{ $topViewMovie->thumb_url }}">
                                        <div class="ep">{{ $topViewMovie->episode_current }} /
                                            {{ $topViewMovie->episode_total }}</div>
                                        <div class="view"><i class="fa fa-eye"></i> {{ $topViewMovie->view_total }}
                                        </div>
                                        <h5><a
                                                href="{{ route('movies.show', $topViewMovie->slug) }}">{{ $topViewMovie->name }}</a>
                                        </h5>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        {{-- <div class="product__sidebar__comment">
                            <div class="section-title">
                                <h5>New Comment</h5>
                            </div>
                            <div class="product__sidebar__comment__item">
                                <div class="product__sidebar__comment__item__pic">
                                    <img src="img/sidebar/comment-1.jpg" alt="">
                                </div>
                                <div class="product__sidebar__comment__item__text">
                                    <ul>
                                        <li>Active</li>
                                        <li>Movie</li>
                                    </ul>
                                    <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                                    <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                </div>
                            </div>
                            <div class="product__sidebar__comment__item">
                                <div class="product__sidebar__comment__item__pic">
                                    <img src="img/sidebar/comment-2.jpg" alt="">
                                </div>
                                <div class="product__sidebar__comment__item__text">
                                    <ul>
                                        <li>Active</li>
                                        <li>Movie</li>
                                    </ul>
                                    <h5><a href="#">Shirogane Tamashii hen Kouhan sen</a></h5>
                                    <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                </div>
                            </div>
                            <div class="product__sidebar__comment__item">
                                <div class="product__sidebar__comment__item__pic">
                                    <img src="img/sidebar/comment-3.jpg" alt="">
                                </div>
                                <div class="product__sidebar__comment__item__text">
                                    <ul>
                                        <li>Active</li>
                                        <li>Movie</li>
                                    </ul>
                                    <h5><a href="#">Kizumonogatari III: Reiket su-hen</a></h5>
                                    <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                </div>
                            </div>
                            <div class="product__sidebar__comment__item">
                                <div class="product__sidebar__comment__item__pic">
                                    <img src="img/sidebar/comment-4.jpg" alt="">
                                </div>
                                <div class="product__sidebar__comment__item__text">
                                    <ul>
                                        <li>Active</li>
                                        <li>Movie</li>
                                    </ul>
                                    <h5><a href="#">Monogatari Series: Second Season</a></h5>
                                    <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection

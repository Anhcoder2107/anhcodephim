@extends('layout.master')
@section('title')
Xem Phim | {{$movie->name}}
@endsection
@section('container')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="{{ route('movies.category') }}">Thể loại</a>
                        <span>{{ $movie->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__video__player">
                  <iframe width="100%" height="600" src="{{ $episode_first->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    </div>
                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>List Name</h5>
                        </div>
                        @foreach ($episodes as $ep)
                            <a href="{{ route('movies.watch.espiode', [$movie->slug, $ep->slug]) }}">Tập {{ $ep->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Anime Section End -->
@endsection

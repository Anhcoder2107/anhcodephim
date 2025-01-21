@extends('admin.layout.maste-admin')
@section('title')
    AnhcodePhim Admin
@endsection
@section('container')

    @php
        $allPermissions = Auth::user()->permissions;
        // $permissions = ['Browse movie', 'Browse episode', 'Browse actor', 'Browse director', 'Browse category', 'Browse region'];
        $hasPermission = true;
        foreach ($allPermissions as $permission) {
            if (!Auth::user()->can($permission)) {
                $hasPermission = false;
                break;
            }
        }
    @endphp

    @if (!$hasPermission)
        <div class="alert alert-warning">
            You do not have any permissions to view this content.
        </div>
    @endif


    <div class="content-row">
        <div class="row">
            @can('Browse movie', Auth::user())
            <div class="col-md-2">
                <div class="color-swatches">
                    <div class="swatches">
                        <div class="clearfix">
                            <div style="background-color:#4FC1E9" class="pull-left light"></div>
                            <div style="background-color:#3BAFDA" class="pull-right dark"></div>
                        </div>
                        <div class="infos">
                            <h4>Movies</h4>
                            <p>{{ $movieCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            @can('Browse episode', Auth::user())
            <div class="col-md-2">
                <div class="color-swatches">
                    <div class="swatches">
                        <div class="clearfix">
                            <div style="background-color:#A0D468" class="pull-left light"></div>
                            <div style="background-color:#8CC152" class="pull-right dark"></div>
                        </div>
                        <div class="infos">
                            <h4>Episodes</h4>
                            <p>{{ $episodeCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            @can('Browse actor', Auth::user())
            <div class="col-md-2">
                <div class="color-swatches">
                    <div class="swatches">
                        <div class="clearfix">
                            <div style="background-color:#FFCE54" class="pull-left light"></div>
                            <div style="background-color:#F6BB42" class="pull-right dark"></div>
                        </div>
                        <div class="infos">
                            <h4>Actors</h4>
                            <p>{{ $actorCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            @can('Browse director', Auth::user())
            <div class="col-md-2">
                <div class="color-swatches">
                    <div class="swatches">
                        <div class="clearfix">
                            <div style="background-color:#ED5565" class="pull-left light"></div>
                            <div style="background-color:#DA4453" class="pull-right dark"></div>
                        </div>
                        <div class="infos">
                            <h4>Directors</h4>
                            <p>{{ $directorCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>

    @can('Browse movie', Auth::user())
        <div class="content-row">
            <h2 class="content-row-title"> Movies</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actor</th>
                            <th>Director</th>
                            <th>Release Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td>{{ $movie->id }}</td>
                                <td>{{ $movie->name }}</td>
                                <td>
                                    @foreach ($movie->actors as $actor)
                                        {{ $actor->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($movie->directors as $director)
                                        {{ $director->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $movie->release_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endcan

    <div class="content-row">
        <div class="row">
            @can('Browse category', Auth::user())
                <div class="col-md-6">
                    <div class="table-responsive">
                        <h3>Categories</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan

            @can('Browse episode', Auth::user())
                <div class="col-md-6">
                    <div class="table-responsive">
                        <h3>Episodes</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Movie name</th>
                                    <th>Episode name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($episodes as $episode)
                                    <tr>
                                        <td>{{ $episode->id }}</td>
                                        <td>{{ $episode->movie->name }}</td>
                                        <td>{{ $episode->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan
        </div>
        <div class="row">
            @can('Browse actor', Auth::user())
                <div class="col-md-6">
                    <div class="table-responsive">
                        <h3>Actors</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actors as $actor)
                                    <tr>
                                        <td>{{ $actor->id }}</td>
                                        <td>{{ $actor->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan
            @can('Browse director', Auth::user())
                <div class="col-md-6">
                    <div class="table-responsive">
                        <h3>Directors</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($directors as $director)
                                    <tr>
                                        <td>{{ $director->id }}</td>
                                        <td>{{ $director->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan
        </div>
        @can('Browse region', Auth::user())
            <div class="table-responsive">
                <h3>Regions</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($regions as $region)
                            <tr>
                                <td>{{ $region->id }}</td>
                                <td>{{ $region->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endcan
    </div>
@endsection

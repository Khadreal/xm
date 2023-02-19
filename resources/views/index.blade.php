@extends('layout.main')

@section('content')
    <div class="container-sm">
        <div class="col-md-10 offset-md-1">
            <div class="card text-bg-light mb-3">
                <div class="card-header">Get historical data</div>
                <div class="card-body">
                    <div class="error-bag"></div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="row g-3" method="POST" action="{{ route('search') }}" id="search">
                        {{ csrf_field() }}
                        <div class="col-md-3">
                            <label for="symbol" class="form-label">
                                Company symbol
                            </label>
                            <input placeholder="Symbol e.g: GOOGL" class="form-control" autocomplete="off"
                                   value="{{ old('symbol') }}" name="symbol" required type="text" id="symbol">
                        </div>
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">
                                Start date
                            </label>
                            <input placeholder="Start date" name="start_date" class="form-control" autocomplete="off"
                                   value="{{ old('start_date') }}" required type="text" id="start_date">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">
                                End date
                            </label>
                            <input placeholder="End date" name="end_date" class="form-control" autocomplete="off"
                                   value="{{ old('end_date') }}" required type="text" id="end_date">
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label">
                                Email
                            </label>
                            <input placeholder="Email" name="email" class="form-control" autocomplete="off"
                                   value="{{ old('email') }}" required type="email" id="email">
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary mb-3 btn-search">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <canvas id="myChart"></canvas>
            <div id="js-result-view">
            </div>
        </div>
    </div>
@endsection


@extends('layouts.app', ['current_page' => 'create_auction'])

@section('content')
    <script defer src={{ asset("js/create_auction.js") }}></script>

    <div class="container-fluid">
        <div class="flex-shrink-0">
            <section class="row m-4">
                <h1>Create Auction</h1>

                @include("partials.breadcrumbs", [ "pages" => [
                    ["title" => "Home", "href" => "/"],
                    ["title" => "Auctions", "href" => "/auction/search_results"],
                    ["title" => "Create Auction", "href" => "/create_auction"]
                ]])
            </section>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="createAuctionForm" action="{{route('store_auction')}}" class="form-auction" enctype="multipart/form-data" method="post">

            <!-- Cross-Site Request Forgery verification -->
            @csrf

            <div class="row g-3 align-items-center">
                <!-- Gallery column -->
                <section class="col-lg-5">
                    <div id="uploadPreview" class="carousel carousel-dark slide col-sm-6  m-auto mt-3"
                         data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- images are inserted here through js -->
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#uploadPreview"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon handle-background" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#uploadPreview"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon handle-background" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <div class="col-12 text-center">
                        <div id="imageUpload" enctype="multipart/form-data" method="post" action="#">
                            <div class="form-group w-100 w-md-50 m-auto">
                                <label class="form-label text-secondary" for="imageFile">Choose the images you wish to
                                    upload</label>
                                <input type="file" class="form-control" id="imageFile" name="image[]" accept=".png, .jpg, .jpeg" multiple="multiple"/>
                            </div>
                        </div>
                    </div>

                    <div class="image-area mt-4">
                        <img id="imageResult" src="#" alt=""
                             class="img-fluid rounded shadow-sm mx-auto d-block">
                    </div>
                </section>

                <!-- Form column -->
                <section class="col-lg-5 pt-3 text-black-50 fs-5">
                        <div class="row">
                            {{-- Auction name--}}
                            <div class="form-group col-md-12 mt-3">
                                <label for="inputName" class="sr-only">Auction Name</label>
                                <input type="text" id="inputName" name="title" class="form-control" required value="{{ old('title') }}">
                            </div>

                            {{-- Auction description --}}
                            <div class="form-group col-md-12 mt-3">
                                <label for="inputDescription" class="sr-only">Auction Description</label>
                                <textarea class="form-control" rows="4" id="inputDescription" name="description">{{{ old('description') }}}</textarea>
                            </div>


                            {{-- Starting on --}}
                            <div class="form-group col-sm-6 mt-3">
                                <label for="inputStartDate" class="sr-only ">Starting on</label>
                                <div class="input-group">
                                    <input type="date" name="start_date" id="inputStartDate" class="form-control" value="{{ old('start_date') }}" required>
                                    <input type="time" name="start_time" id="inputStartTime" class="form-control" value="{{ old('start_time') }}" required>
                                </div>
                            </div>

                            {{-- Ending on --}}
                            <div class="form-group col-sm-6 mt-3">
                                <label for="inputEndDate" class="sr-only">Ending on</label>
                                <div class="input-group">
                                    <input type="date" name="end_date" id="inputEndDate" class="form-control" value="{{ old('end_date') }}" required>
                                    <input type="time" name="end_time" id="inputEndTime" class="form-control" value="{{ old('end_time') }}" required>
                                </div>
                            </div>

                            {{-- Starting bid --}}
                            <div class="form-group col-sm-4 mt-3">
                                <label for="inputStartBid" class="sr-only">Starting Bid</label>
                                <div class="input-group">
                                    <input type="number" name="starting_bid" id="inputStartBid" class="form-control hide-appearence" placeholder="1.00" min="0.01" step="0.01"
                                           aria-label="credit amount (with dot and two decimal places)" value="{{ old('starting_bid') }}" required>
                                    <span class="input-group-text">φ</span>
                                </div>
                            </div>

                            {{-- Increment --}}
                            <div class="form-group col-sm-4 mt-3">
                                <label for="inputIncr" class="sr-only">Increment</label>
                                <div class="input-group">
                                    <input type="number" name="increment_val" id="inputIncr" class="form-control hide-appearence"
                                           placeholder="0.20" min="0.01" step="0.01"
                                           aria-label="credit amount (with dot and two decimal places)" value="{{ old('increment_val') }}" required>
                                    <input type="checkbox" name="percent_check" class="d-none" id="incrPercent">
                                    <span id="incrSpan" class="input-group-text">φ</a>
                                </div>
                            </div>


                            {{-- Category --}}
                            <div class="col-sm-4 mt-3">
                                <label for="inputCategory">Category</label>
                                <div class="input-group mb-3 col-sm-6">
                                    <select class="form-select" name="category" id="inputCategory" value="{{ old('category') }}" required>
                                        <option {{ old('category') ? "" : "selected" }}>Choose...</option>
                                        <option value="Games" {{ old('category') == 'Games' ? "selected" : "" }}>Games</option>
                                        <option value="Software" {{ old('category') == 'Software' ? "selected" : "" }}>Software</option>
                                        <option value="eBook" {{ old('category') == 'eBook' ? "selected" : "" }}>eBook</option>
                                        <option value="Music" {{ old('category') == 'Music' ? "selected" : "" }}>Music</option>
                                        <option value="Skins" {{ old('category') == 'Skins' ? "selected" : "" }}>Skins</option>
                                        <option value="Other" {{ old('category') == 'Other' ? "selected" : "" }}>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row  justify-content-end  mt-3  mb-3">
                            {{-- NSFW --}}
                            <div class="mt-2 me-3 col-sm-3 form-check form-switch">
                                <input class="form-check-input" name="nsfw" type="checkbox" id="switch-nsfw" value=true>
                                <label class="form-check-label" for="switch-nsfw">NSFW</label>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-end" type="submit">
                                Create Auction
                            </button>
                        </div>
                </section>
            </div>
        </form>
        </div>
    </div>
@endsection

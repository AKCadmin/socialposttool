@extends('layouts/contentNavbarLayout')

@section('title', ' Configuration - Add')

@section('content')
<h5 class="py-3 mb-4" style="text-transform: capitalize;">
    <span class="text-muted fw-light">
        @isset($data['module_name'])
        {{ $data['module_name'].'/' }}
        @endisset
    </span>
    @isset($data['page_title'])
    {{ $data['page_title'] }}
    @endisset
</h5>
@isset($data['error'])
@if ($data['error']==true)
<div class="alert alert-danger" role="alert">
    <strong>Error:</strong> {{ $data['message'] }}
</div>
@else
<div class="alert alert-success" role="alert">
    <strong>Success:</strong> {{ $data['message'] }}
</div>
@endif
@endisset
<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="text-transform: capitalize;">
                    @isset($data['form_name'])
                    {{ $data['form_name'] }}
                    @endisset
                </h5>
            </div>
            <div class="card-body">
                <form id="social_form" method="POST" action="{{ route('do-social-post-action') }}">
                    @csrf
                    <input type="hidden" name="aws_paapi_submit" id="aws_paapi_submit" value="Save/Update">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-email">Market Place *</label>
                        <select class="form-control" name="organization_id" id="organization_id" required>
                            <option value="" selected disabled>Select Market Place</option>
                            @isset($data['organization_drop_down_data'])
                            @foreach ($data['organization_drop_down_data'] as $organization)
                            <option value="{{$organization->organization_id}}">
                                {{$organization->organization_name}}
                            </option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Amazon Locale *</label>
                        <select class="form-control" name="locale" id="locale" required>
                            <option value="" selected disabled>Select Locale</option>
                            <option value=".ca">Canada</option>
                            <option value=".fr">France</option>
                            <option value=".in">India</option>
                            <option value=".sa">Saudi Arabia</option>
                            <option value=".co.uk">United Kingdom</option>
                            <option value=".com">USA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Amazon Affiliate ID *</label>
                        <input type="text" name="affiliate_id" class="form-control" id="affiliate_id" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-email">Search Index *</label>
                        <select class="form-control" name="search_index" id="search_index" required>
                            <option value="" selected disabled>Select Search Index</option>
                            <option value="All">All</option>
                            <option value="ArtsAndCrafts">ArtsAndCrafts</option>
                            <option value="Automotive">Automotive</option>
                            <option value="Baby">Baby</option>
                            <option value="Beauty">Beauty</option>
                            <option value="Books">Books</option>
                            <option value="Computers">Computers</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Fashion">Fashion</option>
                            <option value="GardenAndOutdoor">GardenAndOutdoor</option>
                            <option value="GiftCards">GiftCards</option>
                            <option value="GroceryAndGourmetFood">GroceryAndGourmetFood</option>
                            <option value="HealthPersonalCare">HealthPersonalCare</option>
                            <option value="HomeAndKitchen">HomeAndKitchen</option>
                            <option value="HomeAndKitchen">HomeAndKitchen</option>
                            <option value="KindleStore">KindleStore</option>
                            <option value="Miscellaneous">Miscellaneous</option>
                            <option value="MoviesAndTV">MoviesAndTV</option>
                            <option value="Music">Music</option>
                            <option value="MusicalInstruments">MusicalInstruments</option>
                            <option value="OfficeProducts">OfficeProducts</option>
                            <option value="PetSupplies">PetSupplies</option>
                            <option value="Software">Software</option>
                            <option value="SportsAndOutdoors">SportsAndOutdoors</option>
                            <option value="ToolsAndHomeImprovement">ToolsAndHomeImprovement</option>
                            <option value="ToysAndGames">ToysAndGames</option>
                            <option value="VideoGames">VideoGames</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Keyword *</label>
                        <input type="text" name="keyword" class="form-control" id="keyword" required />
                    </div>
                    <button type="submit" class="btn btn-primary" id="social_form_submit_btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

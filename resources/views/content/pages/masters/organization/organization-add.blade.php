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
                <form id="organization_form" method="POST" action="{{ route('organization-create-or-edit') }}">
                    @csrf
                    <input type="hidden" name="organization_id" id="organization_id"
                        value="{{ isset($data['data']) ? $data['data']->organization_id : '' }}">
                    <div class="mb-3">
                        <label class="form-label" for="organization_name">Name *</label>
                        <input type="text" name="organization_name" class="form-control" id="organization_name"
                            placeholder="Amazon Market Place" required
                            value="{{ isset($data['data']) ? $data['data']->organization_name : '' }}" />
                    </div>
                    @isset($data['data'])
                    <div class="mb-3">
                        <label class="form-label" for="organization_name">Code</label>
                        <input type="text" name="organization_code" class="form-control" id="organization_code"
                            placeholder="Amazon Market Place" disabled
                            value="{{ isset($data['data']) ? $data['data']->organization_code : '' }}" />
                    </div>
                    @endisset
                    <div class="mb-3">
                        <input type="radio" name="organization_type" id="is_social_media" value="is_social_media"
                            {{ isset($data['data']) && $data['data']->is_social_media == 1 ? 'checked' : '' }} />
                        <label class=" form-label" for="is_social_media">Social Media Organization</label>
                        <input type="radio" name="organization_type" id="is_market_place" style="margin-left: 5%;"
                            value="is_market_place"
                            {{ isset($data['data']) && $data['data']->is_market_place == 1 ? 'checked' : '' }}" />
                        <label class="form-label" for="is_market_place">Market Place Organization</label>
                    </div>
                    <button type="submit" class="btn btn-primary" id="organization_form_submit_btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
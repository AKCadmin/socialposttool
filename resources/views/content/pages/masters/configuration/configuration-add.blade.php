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
                <form id="configuration_form" method="POST" action="{{ route('configuration-create-or-edit') }}">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ isset($data['data']) ? $data['data']->id : '' }}">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Settings Key *</label>
                        <input type="text" name="key" class="form-control" id="key" placeholder="Access Key" required
                            value="{{ isset($data['data']) ? $data['data']->key : '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Settings Value *</label>
                        <input type="text" name="value" class="form-control" id="value" placeholder="AKH481NBUITY451"
                            required value="{{ isset($data['data']) ? $data['data']->value : '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-email">Settings For *</label>
                        <select class="form-control" name="organization_id" id="organization_id" required
                            value="{{isset($data['data'])?$data['data']->organization_id:''}}">
                            <option value="" selected disabled>Select Organization</option>
                            @isset($data['organization_drop_down_data'])
                            @foreach ($data['organization_drop_down_data'] as $organization)
                            <option value="{{$organization->organization_id}}"
                                {{isset($data['data']) && $data['data']->organization_id == $organization->organization_id ? 'selected disabled':''}}>
                                {{$organization->organization_name}}
                            </option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="configuration_form_submit_btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts/contentNavbarLayout')

@section('title', 'Organization List')

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

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Is Social Media</th>
                    <th>Is Market Place</th>
                    <th>Action</th>
                </tr>
            </thead>
            @isset($data['data'])
            <tbody>
                @foreach ($data['data'] as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->organization_code }}</td>
                    <td>{{ $data->organization_name }}</td>
                    <td>{{ $data->is_social_media==1 ? 'Yes' : '' }}</td>
                    <td>{{ $data->is_market_place==1 ? 'Yes' : '' }}</td>
                    <td class="action-column">
                        <a href="{{ route('organization-edit', ['organization_id' => $data->encrypted_organization_id]) }}"
                            class="action-button edit-button"><i class='bx bxs-edit'
                                value="{{ $data->organization_id }}"></i></a>
                        <a href="{{ route('organization-edit', ['organization_id' => $data->encrypted_organization_id]) }}"
                            class="action-button delete-button" value="{{ $data->organization_id }}"><i
                                class='bx bxs-trash-alt'></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endisset
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection
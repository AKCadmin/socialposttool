@extends('layouts/contentNavbarLayout')

@section('title', 'Configuration List')

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
                    <th>ID</th>
                    <th>Organization</th>
                    <th>Settings Key</th>
                    <th>Settings Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            @isset($data['data'])
            <tbody>
                @foreach ($data['data'] as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->configuration_id }}</td>
                    <td>{{ $data->organization_name }}</td>
                    <td>{{ $data->key }}</td>
                    <td>{{ $data->value }}</td>
                    <td class="action-column">
                        <a href="{{ route('configuration-edit', ['configuration_id' => $data->encrypted_id]) }}"
                            class="action-button edit-button"><i class='bx bxs-edit'
                                value="{{ $data->encrypted_id }}"></i></a>
                        <a href="{{ route('configuration-edit', ['configuration_id' => $data->encrypted_id]) }}"
                            class="action-button delete-button" value="{{ $data->encrypted_id }}"><i
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
@extends('layouts/contentNavbarLayout')

@section('title', 'Posts List')

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
                    <th>Post ID</th>
                    <th>Market Place URL</th>
                    <th>Short URL</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            @isset($data['data'])
            <tbody>
                @foreach ($data['data'] as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->post_id }}</td>
                    <td>{{ $data->destination_url }}</td>
                    <td>{{ $data->default_short_url }}</td>
                    <td>{{ $data->post_content_text }}</td>
                    <td class="action-column">
                        <a href="{{ $data->post_url }}" class="action-button view-button"><i class='bx bx-link'
                                value="{{ $data->encrypted_id }}" title="View Post"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endisset
        </table>
    </div>
</div>


<!--/ Basic
 Bootstrap
Table -->






@endsection
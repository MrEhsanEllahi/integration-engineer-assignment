@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h4 class="card-title text-white m-0">
                        Connect Your MailerLite Account
                    </h4>
                </div>
                <div class="card-body">
                    @if($apiKey)
                        <p><b>Status: </b><span class="badge badge-success">Connected</span></p>
                        <p><b>API-KEY: </b>{{ $apiKey }}</p>
                    @else
                        <form id="storeApiKey" method="POST"
                            action="{{ route('settings.validate.api-key') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-8">
                                    <label>API KEY*</label>
                                    <input type="text" name="api_key" class="form-control" id="api_key"
                                        value="{{ $apiKey ?? old('api_key') }}"
                                        placeholder="Enter API KEY" required>
                                </div>
                                <div class="form-group col-2">
                                    <button type="submit" form="storeApiKey" class="btn btn-primary">Validate</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

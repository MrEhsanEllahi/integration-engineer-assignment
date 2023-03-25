@extends('layouts.app')

@section('title', 'Integrations')

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
                    @if($apiToken)
                        <p><b>Status: </b><span class="badge badge-success">Connected</span></p>
                    @else
                        <form id="validateIntegration" method="POST"
                            action="{{ route('integrations.validate') }}">
                            @csrf
                            <div class="form-group">
                                <label>API TOKEN*</label>
                                <textarea name="api_token" class="form-control" id="api_token" required>{{ old('api_token') }}</textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" form="validateIntegration" class="btn btn-primary">Validate</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

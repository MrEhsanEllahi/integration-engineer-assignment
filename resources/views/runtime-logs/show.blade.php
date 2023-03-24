@extends('layouts.app')

@section('title', 'Runtime Logs')

@section('content')
<div class="container-fluid">
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0">
                Runtime Log
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <strong>Title:</strong>
                        {{ $runtimeLog->title }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Reference:</strong>
                        {{ $runtimeLog->reference }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Level:</strong>
                        <span class="badge badge-log-{{ $runtimeLog->level }}">{{ $runtimeLog->level }}</span>
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Created At:</strong>
                        {{ $runtimeLog->created_at }}
                    </p>
                </div>
                @if ($runtimeLog->trace)
                    <div class="jumbotron p-3 col-md-12">
                        <h3>Trace:</h3>
                        <p class="mt-3">{{ $runtimeLog->trace }}</p>
                    </div>
                @endif
                @if ($runtimeLog->payload)
                    <div class="jumbotron p-3 col-md-12">
                        <h3>Payload:</h3>
                        <p class="mt-3">{{ $runtimeLog->payload }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

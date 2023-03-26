@extends('layouts.app')

@section('title', 'Edit Subscriber')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h4 class="card-title text-white m-0">
                        Edit Subscriber
                    </h4>
                </div>
                <div class="card-body">
                    <form id="updateSubscriber" method="POST" action="{{ route('subscribers.update') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="subscriber_id" value="{{ $subscriber->id }}">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Name*</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $subscriber->name }}" required />
                            </div>
                            <div class="form-group col-6">
                                <label>Country*</label>
                                <select id="country" class="form-control selectpicker" data-live-search="true"
                                    title="Select Country" name="country" required>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->name }}" {{ $subscriber->country === $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" form="updateSubscriber" class="btn btn-primary">Update Subscriber</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

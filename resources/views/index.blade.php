@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h4 class="card-title text-white m-0">
                        Subscriber to our newsletter
                    </h4>
                </div>
                <div class="card-body">
                    <form id="addSubscriber" method="POST" action="{{ route('subscribers.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Name*</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}" required />
                            </div>
                            <div class="form-group col-6">
                                <label>Email*</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ old('email') }}" required />
                            </div>
                            <div class="form-group col-12">
                                <label>Country*</label>
                                <select id="country" class="form-control selectpicker" data-live-search="true"
                                    title="Select Country" name="country" required>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->name }}" {{ old('country') === $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" form="addSubscriber" class="btn btn-primary">Add Subscriber</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

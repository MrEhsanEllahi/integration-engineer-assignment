@extends('layouts.app')

@section('title', 'Subscribers List')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">Subscribers</h3>
                </div>
                <div class="card-body">
                    <div id="loader" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
                        <i class="fas fa-spinner fa-spin fa-3x"></i>
                    </div>
                    <div class="table-responsive">
                        <table id="subscribers" class="table table-bordered table-striped table-hover w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Subscribe Date</th>
                                    <th>Subscribe Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-filters d-flex justify-content-between">
                        <div class="pagination">
                            <button id="prevPage" class="btn btn-secondary mr-2"><i class="fas fa-caret-left"></i> Previous</button>
                            <button id="nextPage" class="btn btn-primary">Next <i class="fas fa-caret-right"></i></button>
                        </div>
                        <select id="limit">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    @include('subscribers.script');
@endpush

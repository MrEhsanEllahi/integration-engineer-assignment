@extends('layouts.app')

@section('title', 'Runtime Logs')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">Runtime Logs</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="runtimeLogs" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Level</th>
                                    <th>Reference</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($runtimeLogs as $log)
                                    <tr>
                                        <td>{{ $log->title }}
                                        </td>
                                        <td><span class="badge badge-log-{{ $log->level }}">{{ $log->level }}</span>
                                        </td>
                                        <td>{{ $log->reference }}
                                        </td>
                                        <td>{{ $log->created_at }}
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <a
                                                    href="{{ route('runtime-logs.show', $log->id) }}"><i
                                                        class="fas fa-eye mr-2 text-primary"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $runtimeLogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

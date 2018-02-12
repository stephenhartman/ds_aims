@extends('layouts.app')

@section('title', 'Alumni Database')

@push('styles')
@endpush

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.6/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.6/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush

@section('content')
    <div class="container table-responsive">
        <h2>Alumni Database</h2>
        <hr>
        {{ $dataTable->table() }}
    </div>
@endsection

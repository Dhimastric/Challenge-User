@extends('layouts.main')

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <label>DASBOARD</label>
                <hr>
                Selamat Datang {{ Auth::user()->name }}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Staff Details</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ route('staff.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <br><br>
            <div class="staff-title">
                <strong>Title: </strong> {{ $staff->title }}
            </div>
            <br>
            <div class="staff-description">
                <strong>Description: </strong> {{ $staff->description }}
            </div>
            <br>
            <div class="staff-description">
                <strong>Status: </strong> {{ $staff->status }}
            </div>
        </div>
    </div>
</div>
@endsection

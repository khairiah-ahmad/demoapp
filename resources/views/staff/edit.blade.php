@extends('layouts.app')
@section('content')
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('staff.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p></p>
                <h2>Edit Staff</h2>
            </div>
        </div>
        
        <br>
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('staff.update', ['staff' => $staff->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $staff->name }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="email" class="col-md-2 col-form-label">Email</label>
                    <div class="col-md-8">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $staff->email }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="gender" class="col-md-2 col-form-label">Gender</label>
                    <div class="col-md-8">
                    <select class="form-control" id="gender" name="gender">
                        <option value="M" @if ($staff->gender == 'M') selected @endif>Male</option>
                        <option value="F" @if ($staff->gender == 'F') selected @endif>Female</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="staff_no" class="col-md-2 col-form-label">Staff No.</label>
                    <div class="col-md-8">
                        <input id="staff_no" type="text" class="form-control @error('staff_no') is-invalid @enderror" name="staff_no" value="{{ $staff->staff_no }}" required>
                        <!--
                        @if($errors->has('staff_no'))
                        <div class="error">{{ $errors->first('staff_no') }}</div>
                        @endif
                        --> 
                        @error('staff_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="job_title" class="col-md-2 col-form-label">Designation</label>
                    <div class="col-md-8">
                        <input id="job_title" type="text" class="form-control" name="job_title" value="{{ $staff->job_title }}" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="mobile_no" class="col-md-2 col-form-label">Mobile/Office No.</label>
                    <div class="col-md-4">
                        <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" placeholder="Mobile Phone No. (eg. 0123456789)" value="{{ $staff->mobile_no }}" >
                        <!--
                        @if($errors->has('mobile_no'))
                        <div class="error">{{ $errors->first('mobile_no') }}</div>
                        @endif
                        -->
                        @error('mobile_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" placeholder="Office Phone No. (eg. 0378900000)" value="{{ $staff->tel }}" >
                        <!--
                        @if($errors->has('tel'))
                        <div class="error">{{ $errors->first('tel') }}</div>
                        @endif
                        -->
                        @error('tel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="office_addr" class="col-md-2 col-form-label">Office Address</label>
                    <div class="col-md-8">
                        <textarea name="office_addr" class="form-control" id="office_addr" rows="5">{{ $staff->office_addr }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

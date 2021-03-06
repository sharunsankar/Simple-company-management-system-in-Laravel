@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        @include('layouts.sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Employee</div>
                <div class="card-body">
                    
                    <span id="response_message"></span>
                   
                    <form id="formEditEmployee" name="formEditEmployee" method="POST" action="{{ route('employees.update',$employee->id) }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{$employee->first_name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{$employee->last_name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label text-md-right">Company</label>
                            <div class="col-md-6">
                                <select name="company_id" class="form-control">
                                    @foreach ($companies as $company)
                                    <option value="{{$company->id}}" {{ (!empty($employee->company_id) && $employee->company_id == $company->id)?'selected':'' }}>{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$employee->email}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$employee->phone}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">Designation</label>
                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control" name="designation" value="{{$employee->designation}}">
                            </div>
                        </div>

                        <input type="hidden" name="status" value="1">

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<script type="text/javascript" src="{{ url('js/employee.js') }}" defer></script>

@endsection
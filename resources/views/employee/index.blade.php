@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('layouts.sidebar')

        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Employees</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif    

                <form action="{{route('file.import')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row mt-2">
                        <div class="col-md-4">
                            <input type="file" class="form-control" name="fileInput">
                        </div>
                        <input type="hidden" name="file_type" value="employee">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                Bulk Upload
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ url( '/'  .'employees.csv' )}}" class="btn btn-info" download>Download Template</a>
                        </div>
                    </div>
                </form>

                <div class="card-body">

                @if(!empty($employees))

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>FIrst Name</th>
                                    <th>Last Name</th>
                                    <th>Company</th>
                                    <th>Phone</th>                                    
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                @foreach($employees as $employee)
                                <tr>
                                    <td> {{$employee->first_name}} </td>
                                    <td> {{$employee->last_name}} </td>
                                    <td> {{$employee->company->name}} </td>
                                    <td> {{$employee->phone}} </td>                                    
                                    <td> {{$employee->status == 1? 'Active': 'Inactive'}}</td>
                                    <td>
                                    <div class="dropdown show">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{route('employees.edit', ['employee' => $employee->id])}}">Edit </a>

                                        <form action="{{ route('employees.destroy', ['employee' => $employee->id])}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete this data');">Delete</button>
                                        </form>

                                        </div>
                                        </div>
                                        
                                    </td>
                                </tr>
                                @endforeach                               
                               
                            </tbody>
                        </table>
                        {{ $employees->links() }}
                    </div>
                    @else
                        <h2>Employee List is empty!</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
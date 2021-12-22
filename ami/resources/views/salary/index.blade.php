@extends('layouts.app')
@section('salary')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Salary</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}"> Dashboard </a></li>
                <li class="active"> Salary List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#con-close-modal">Add Salary</a>
                    <h3 class="panel-title">Salary list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Salary</th>
                                        <th>Advance</th>
                                        <th>Advance date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($salarys as $key=>$salary)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$salary->employee->name}}</td>
                                        <td>{{$salary->employee->job->salary}}</td>
                                        <td>{{$salary->advance_pay}}</td>
                                        <td>{{$salary->pay_date}}</td>
                                        <td class="text-right">

                                          <a href="javascript:;" data-id="{{$salary->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('salary.destroy', $salary->id)}}" id="delete{{$salary->id}}" method="POST">
                                              @csrf
                                              @method('DELETE')                    
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> <!-- End Row -->

        <!-- Modal content  --->

    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                </div>
                <form action="{{route ('salary.store')}}" method="POST">
                @csrf
                <input type="hidden" name="month" value="{{date('m.Y')}}">
                <input type="hidden" name="check" value="{{date('d.m.Y')}}">
                <div class="modal-body"> 
                    <div class="row"> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Payment-Type</label> 
                                <select class="form-control" name="employee_id">
                                    <option label="Select Employee name"></option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->fname}} {{$employee->lname}}</option>
                                    @endforeach
                                </select>
                                    @if ($errors->has('employee_id'))
                                    <span class="text-danger">{{$errors->first('employee_id')}}</span>
                                    @endif
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-2" class="control-label">Advance Amount</label>
                                <input type="number" name="advance_pay" class="form-control">
                                    @if ($errors->has('advance_pay'))
                                    <span class="text-danger">{{$errors->first('advance_pay')}}</span>
                                    @endif 
                            </div> 
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-2" class="control-label">Advance Date</label>
                                <input type="date" name="pay_date" class="form-control">
                                    @if ($errors->has('pay_date'))
                                    <span class="text-danger">{{$errors->first('pay_date')}}</span>
                                    @endif 
                            </div> 
                        </div>
                    </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-info waves-effect waves-light">Salary Add</button> 
                </div>
                </form> 
            </div> 
        </div>
    </div><!-- /.modal -->

@endsection

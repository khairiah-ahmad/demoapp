@extends('layouts.app')
@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Tasks List</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ url('/home') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Dashboard</a>
                <a href="{{ route('task.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new task</a>
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
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th width="5%">#</th>
            <th>Task Name</th>
            <th width="10%"><center>Task Status</center></th>
            <th width="14%"><center>Action</center></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($tasks as $task)
              <tr>
              <!--<th>{{ $task->id }}</th>-->
              <th scope="row">{{ $loop->index + 1 }}</th>
              <td>{{ $task->title }}</td>
              <td><center>{{ $task->status }}</center></td>
              <td>
              <div>
                  <form action="{{ route('task.destroy', $task->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                    <div class="input-group justify-content-center">
                      <div>
                        <a href="{{ route('task.edit', $task->id)}}" class="btn btn-warning">Edit</a>
                      </div>
                      <span class="tab">&nbsp;</span>
                      <div class="input-group-append">
                      <button class="btn btn-danger" type="submit">Delete</button>
                      </div>
                    </div>
                  </form>
                </div> 
                <!--<div class="action_btn">
                  <div class="action_btn">
                    <a href="{{ route('task.edit', $task->id)}}" class="btn btn-warning">Edit</a>
                  </div>
                  <div class="action_btn margin-left-10">
                    <form action="{{ route('task.destroy', $task->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                  </div>
                </div>-->
              </td>
            </tr>
          @empty
              <tr>
              <td colspan="4"><center>No data found</center></td>
            </tr>
          @endforelse
        </tbody>
      </table>
        </div>
    </div>
</div>
@endsection

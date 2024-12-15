@extends('layouts.app')
@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
      <div class="row">
        <div class="col-md-6">
          
          <a href="{{ url('/home') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Dashboard</a>
          <a href="{{ route('staff.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new staff</a>
          <!--
          <a href="{{ url('/home') }}" type="button"> Dashboard</a>
          <a href="{{ route('staff.create') }}" type="button"> Add new staff</a>
          -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
            <p>
            <h2>Staff List</h2>
        </div>
      </div>

        <br>
        
        <div class="form-group row mb-3">
          <form action="{{ route('staff.search') }}" method="GET">
            <div class="input-group mb-3 w-50">
              <input type="text" class="form-control" name="search" placeholder="Search Staff by name, email or staff no.">
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
              </div>
              <span class="tab">&nbsp;</span>
              <div>
                <a href="{{ route('staff.index') }}" class="btn btn-primary">Search All</a>
              </div>
            </div>
          </form>
        </div>

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
            <th>#</th>
            <th>Staff Name</th>
            <th><center>Staff No.</center></th>
            <th><center>Email</center></th>
            <th><center>Action</center></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($staffs as $staff)
              <tr>
              <!--<th>{{ $loop->iteration }}</th>-->
              <th scope="row">{{ $staffs->firstItem() + $loop->index }}</th>
              <td>{{ $staff->name }}</td>
              <td><center>{{ $staff->staff_no }}</center></td>
              <td><center>{{ $staff->email }}</center></td>
              <td><center>
                <div>
                  <form action="{{ route('staff.destroy', $staff->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                    <div class="input-group justify-content-center">
                      <div>
                        <a href="{{ route('staff.edit', $staff->id)}}" class="btn btn-warning">Edit</a>
                      </div>
                      <span class="tab">&nbsp;</span>
                      <div class="input-group-append">
                      <button class="btn btn-danger" type="submit">Delete</button>
                      </div>
                    </div>
                  </form>
                </div>    
                
                <!-- unremark to test
                <div>
                  <button class="btn btn-link" 
                        x-on:click="staffid='{{ $staff->id}}'" 
                        data-bs-toggle="modal" data-bs-target="#deleteStaff">
                        <i class="fa-solid fa-ban"></i> Delete Confirmation</button>
                </div>

                        <a data-toggle="modal" id="smallButton" data-target="#smallModal" href="{{ route('staff.delete', $staff->id) }}" title="Delete Project">
                            <i class="fas fa-trash text-danger  fa-lg"></i>Delete Staff
                        </a>
-->
                </div>
                </center>
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
    <div class="w-1/2">
        {{ $staffs->links() }}
    </div>
    
</div>

<!-- small modal -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href
            , beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            }
            , complete: function() {
                $('#loader').hide();
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            }
            , timeout: 8000
        })
    });

</script>

<div id="deleteStaff" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('staff.destroy', $staff->id) }}" method="PUT">
            <input type="hidden" name="delstaffid" x-model="staffid" >
            <div class="modal-header">						
                    <h4 class="modal-title">Delete Staff Record</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">					
                    <p>Are you sure you want to delete this staff record?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
          </form>
        </div>
    </div>
</div>


@endsection

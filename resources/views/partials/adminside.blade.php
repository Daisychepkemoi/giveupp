@extends('layouts.master')
@section('content')
<div class="contents">
  <div class="containers">
    
    <div class="panel-group">
      <div class="panel panel-default">
        @if($user->is_admin==1)
        <div class="panel-body">
         <div class="notify">

          <div class="panel-heading">Admin Dashboard 
          </div>
          
          
          <div class="panel-body" id="contentse">
             <h6><a href="/userproposal">All Proposals</a></h6>
           <hr>

           <h6><a href="/newproposals">New Proposals</a></h6>
           <hr>
           <h6><a href="/stageone">Stage-1</a></h6>
           <hr>
           
           <h6><a href="/stagetwo">Stage-2</a><hr></h6>
           <hr>
           <h6><a href="/accepted">Accepted</a><hr></h6>
           
           <h6><a href="/rejected">Rejected</a> <hr></h6>
          </div>

       </div>

       
       <div class="notifycontent">
         @if (session()->has('success'))
         <div class="alert alert-info">
          {{ session('success') }}
        </div>
        @endif
        
        <div class="panel-heading">Proposals</div>
        
        <div class="panel-body" id="contentss">


          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col"></th>
                <th scope="col">Title</th>
                <th scope="col">Organisation_Name</th>
                <th scope="col">Submitted_by</th>
                
                <th scope="col">Created </th>
                <th scope="col">stage</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

              @foreach ($proposalsadminside as $propose)

              @include('admin.admin')
              @endforeach
            </tbody>
          </table>

          <div class="text-center">
            {{$proposalsadminside->links()}}
          </div>

        </div>
      </div>
    </div>
    @else
    <div class="panel-body">
     <div class="notify">
       
     </div>

     <div class="notifycontent">
      <div class="panel-body" id="contentss">

       
       <div class="navsbar">
         <h2></h2>
         <h2>
          Access Denied.
          
        </h2>
        
      </div>

    </div>
  </div>
</div>
@endif

</div>
</div>

@endsection
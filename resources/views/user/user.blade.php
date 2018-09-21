@extends('layouts.master')
@section('content')
@if($user->is_admin==1)
@include('partials.adminside')
@else
<div class="contents">

 @if($user->verified==true)

 <div class="containers">
   
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-body">
       <div class="notify">
        <div class="panel-heading">
          Panel
        </div>
        
        
        <div class="panel-body" id="contentse">
         <hr>
         <h6><a href="/sentproposals">Sent Proposals</a></h6>
         <hr>
         <h6><a href="/userdrafts">Drafts</a></h6>
         <hr>
         <h6><a href="/stageoneuser">Stage-1</a></h6>
         <hr>
         <h6><a href="/stagetwouser">Stage-2</a></h6>
         <hr>
         
         <h6><a href="/rejecteduser">Rejected</a> </h6>
         <hr>
         <h6><a href="/accepteduser">Accepted</a> </h6>
         <hr>
         
       </div>
     </div>

     
     <div class="notifycontent">
      
       <div class="panel-heading">Proposals</div>
       <div class="panel-heading">
        <button class="btn btn-success " id="bton" >
          <a href="/proposal" id="buton" >
            Create Proposal
          </a>
        </button>
      </div>

      
      <div class="panel-body" id="contentss">


        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col"></th>
              <th scope="col">Title</th>
              <th scope="col">Organisation_Name</th>
              <th scope="col">Submitted_by</th>
              <th scope="col">Last Updated</th>
              <th scope="col">Status</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($proposals as $propose)
            <tr>
              <th scope="row"></th>
              
              <td> <a href="/userproposal/{{$propose->id}}">{{$propose->title}}</a> </td>
              <td>{{$propose->organization}}</td>
              <td>{{$propose->submitted_by}}</td>
              
              <td>{{$propose->updated_at->diffForHumans()}}</td>
              @if($propose->draft==1)
              <td><button class="btn btn-primary">Pending </button></td>
              @else
              <td><button class="btn btn-primary">Submitted </button></td>
              @endif
              <td><button class="btn btn-primary"><a href="/userproposal/{{$propose->id}}" id="buton" >view</a> </button></td>

              
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="text-center">
            {{$proposals->links()}}
        </div>


      </div>
    </div>
  </div>

</div>
</div>

</div>
@else
<hr>
<div class="mainboddy"> 
 <div class="navsbarr">

  

   <h3> Welcome to One Love website {{$user->name}}.<br>Your account isn't activated.</h3>
   
   <h3>Please check your email to <strong>Activate</strong> your account.</h3>
   
   
 </div>
 
</div>
@endif
</div>

@endif

@endsection
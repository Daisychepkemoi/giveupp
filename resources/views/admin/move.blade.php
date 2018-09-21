@extends('layouts.master')
@section('content')

<div class="contents">
  <div class="containers">
    <hr>
    @if($user->is_admin==1)
    <div class="panel-group">

      <div class="panel-body">
       <div class="notify">

        <div class="panel-heading">
          Dashboard 
        </div>

        <div class="panel-body" id="contentse">
         <h6><a href="/newproposals">New Proposals</a></h6>
         <hr>
         <h6><a href="/stageone">Stage-1</a></h6>
         <hr>
         
         <h6><a href="/stagetwo">Stage-2</a><hr></h6>
         <hr>
         <h6><a href="/rejected">Rejected</a> <hr></h6>
         <h6><a href="/accepted">Accepted</a> <hr></h6>
       </div>
     </div>

     <div class="notifycontent">
      @foreach ($proposalsadminside as $propose)
      @if($propose->stage == 'stageone')

      <div class="panel-heading"><h2 id="titl">Stage-1  Proposal</h2> </div>
      @elseif($propose->stage == 'stagetwo')
      <div class="panel-heading"> <h2 id="titl">Stage-2  Proposal</h2></div>
      @elseif($propose->stage == 'Accepted')
      <div class="panel-heading"> <h2 id="titl">Accepted  Proposal</h2></div>
      @elseif($propose->stage == '')
      <div class="panel-heading"><h2 id="titl">Unreviewed  Proposal</h2></div>
      @else($propose->stage == 'reject')
      <div class="panel-heading"><h2 id="titl">Rejected  Proposal</h2></div>
      @endif

      <div class="panel-body" id="contentss">

       <div class="prope">
        <div class="prop">
          <h2 id="bodyy">{{$propose->title}} Proposal</h2>
          <h3>Introduction</h3>
          <p>It's written by  {{$propose->submitted_by}} for {{$propose->organization}}  organization located in {{$propose->address}} whose contact address is : {{$propose->phone}} </p>
          <h3>Summary</h3>
          <p>  {{$propose->summary}}</p>
          <h3>Background Information</h3>.
          <p> {{$propose->background}}</p>
          <h3>Activities</h3>
          <p>  {{$propose->activities}}</p>
          <h3>Estimated Budget</h3>
          <p>Ksh :  {{$propose->budget}}</p>

        </div>
      </div>

      <hr>
      <div>
         @if(empty($propose->stage) )
          <button class="btn btn-primary" id="move" ><a href="/admin/{{$propose->id}}/stage1" id="buton">Move To Stage-1</a></btn> 
          <button class="btn btn-primary " id="moveright"> <a href="/admin/{{$propose->id}}/reject" id="buton">Reject</a></button>
          @elseif ($propose->stage == 'stageone')
          <button class="btn btn-primary" id="move"><a href="/admin/{{$propose->id}}/stage2" id="buton">Move To Stage-2</a></btn> 
          <button class="btn btn-primary " id="moveright"> <a href="/admin/{{$propose->id}}/reject" id="buton">Reject</a></button>
          @elseif ($propose->stage == 'stagetwo')
          <button class="btn btn-primary" id="move"><a href="/admin/{{$propose->id}}/accepted" id="buton">Accept</a></btn> 
          <button class="btn btn-primary" id="moveright"><a href="/admin/{{$propose->id}}/reject" id="buton">Reject</a></btn> 
          @elseif($propose->stage == 'rejected')
          <button class="btn btn-primary"> <a href="/back" id="buton">Back</a></button>
          @else
          <button class="btn btn-primary"> <a href="/back" id="buton">Back</a></button>
          @endif
      </div>
    </div>
    @endforeach
   </div>
  </div>

@else
  <div class="panel-body">
     <div class="notify">
     </div>
     <div class="notifycontent">
        <div class="panel-body" id="contentss">
          <div class="navsbar">
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
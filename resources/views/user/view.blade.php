@extends('layouts.master')
@section('content')
<div class="contents">


   @if($user->verified==true)
  
      @if($user->email==$proposal->submitted_by)
            <div class="containers">
      
        <div class="panel-group">
 
              <div class="panel-body">
              	<div class="notify">
              		<div class="panel-heading">
                      Panel
                  </div>
      		
			    {{-- @foreach($proposal as $proposal) --}}
			          <div class="panel-body" id="contentse">
              					<h6><a href="/newproposals">New Proposals</a></h6>
              					<hr>
                        <h6><a href="/userdrafts">Drafts</a></h6>
                        <hr>

              					<h6><a href="/stageoneuser">Stage-1</a></h6>
              					<hr>
              					
                        <h6><a href="/stagetwouser">Stage-2</a><hr></h6>
              					<h6><a href="/accepteduser">Accepted</a><hr></h6>
              					<hr>
              					<h6><a href="/rejecteduser">Rejected</a> <hr></h6>
      				
      		      </div>
      	       </div>

      
                <div class="notifycontent">
          		 
                  @if($proposal->stage == 'stageone')

                        <div class="panel-heading"><h2 id="titl">Stage-1  Proposal</h2> </div>
                  @elseif($proposal->stage == 'stagetwo')
                        <div class="panel-heading"> <h2 id="titl">Stage-2  Proposal</h2></div>
                  @elseif($proposal->stage == 'Accepted')
                        <div class="panel-heading"> <h2 id="titl">Accepted  Proposal</h2></div>
                  @elseif($proposal->stage == '')
                        <div class="panel-heading"><h2 id="titl">Unreviewed  Proposal</h2></div>
                  @else($proposal->stage == 'reject')
                          <div class="panel-heading"><h2 id="titl">Rejected  Proposal</h2></div>
                  @endif



      			             <div class="panel-body" id="contentss">
                                @if($proposal->draft==1)
                               <div class="col-sm-8">
                                   <form method="POST" action="/submitchange/{{$proposal->id}}">
                                    {{ csrf_field() }}
                                        <div class="form-group">
                                          <label for="title">Title : <strong>*</strong></label>
                                          <input type="text" class="form-control" id="title" placeholder="title"  name="title" value="{{$proposal->title}} " required="">
                                          
                                        </div>
                                        <div class="form-group">
                                          <label for="organization">Organization Name : <strong>*</strong></label>
                                          <input type="text" class="form-control" id="organization" placeholder="Organization Name"  name="organization" value="{{$proposal->organization}}" required="">
                                          
                                        </div>

                                  
                                          <div class="form-group">
                                            <label for="address">Address: <strong>*</strong></label>
                                            <input type="text" class="form-control" id="address" placeholder="Address"  name="address" value="{{$proposal->address}}" required="">
                                            
                                          </div>
                                          <div class="form-group">
                                            <label for="phone">Phone: <strong>*</strong></label>
                                            <input type="number" class="form-control" placeholder="Phone" id="phone"  name="phone" value="{{$proposal->phone}}"  required="">
                                            
                                          </div>
                                           
                                          
                                          <div class="form-group">
                                            <label for="email">Email : <strong>*</strong></label>
                                            <input type="email" class="form-control" placeholder="Organization's Email" id="email" value="{{$proposal->email}}"  name="email" required="">
                                            
                                          </div>
                                         <div class="form-group">
                                            <label for="summary">summary : <strong>*</strong></label>
                                            <textarea type="text" class="form-control" id="summary" placeholder="summary"  name="summary"  required="">
                                              {{$proposal->summary}}
                                            </textarea> 
                                          </div>
                                         <div class="form-group">
                                            <label for="background">Background : <strong>*</strong></label>
                                            <textarea type="text" class="form-control" id="background" placeholder="background"  name="background"  required="">
                                              {{$proposal->background}}
                                            </textarea>
                                          </div>
                                          <div class="form-group">
                                            <label for="activities">Activities: <strong>*</strong></label>
                                            <TEXTAREA type="activities" class="form-control" id="activities" placeholder="Activities"  name="activities" required="" >{{$proposal->activities}}</TEXTAREA>
                                            
                                          </div>
                                          <div class="form-group">
                                            <label form="budget">Budget : <strong>*</strong></label>
                                            <input type="number" class="form-control" id="budget"  placeholder="budget" name="budget" value="{{$proposal->budget}}"  required="">
                                          </div>
                                          
                                         
                                          
                                          <div class="form-group">
                                          
                                            <input type="hidden" class="form-control" id="submitted_by" placeholder="" value="{{$proposal->submitted_by}}" name="submitted_by" readonly>
                                           </div>

                                          
                                          <button type="submit" name="save" value="savedraft" class="btn btn-primary"><a href=""></a>Submit</button> 
                                      
                                          <button type="submit" name="save" value="editdraft" class="btn btn-primary">save changes as Draft</button> 
                                          <button type="submit" name="save" value="deletedraft" class="btn btn-danger">delete</button> 
                          
                                          @include('layouts.errors')
                                    </form>
                              </div>
                              @else
                                <div class="prope">
                                  <div class="prop">
                                      <h2 id="bodyy">{{$proposal->title}} Proposal</h2>
                                      <h3>Introduction</h3>
                                      <p>It's written by  {{$proposal->submitted_by}} for {{$proposal->organization}}  organization located in {{$proposal->address}} whose contact address is : {{$proposal->phone}} </p>
                                      <h3>summary</h3>
                                      <p>  {{$proposal->summary}}</p>
                                      <h3>background Information</h3>.
                                      <p> {{$proposal->background}}</p>
                                      <h3>Activities</h3>
                                      <p>  {{$proposal->activities}}</p>
                                      <h3>Estimated Budget</h3>
                                      <p>Ksh :  {{$proposal->budget}}</p>
                                        
                              
                                  </div>
                                  <button class="btn btn-primary"> <a href="/userback" id="buton">Back</a></button>
                              </div>
                              @endif
                       <hr>
                              </div>

                        </div>
               
      	       </div>
            </div>

    
        </div>
         {{-- @endforeach --}}
       @else
          <hr>
        <div class="mainboddy"> 
             <div class="navsbarr">


                <h2>Access denied</h2>
               <h3> You are not listed as a collaborator in this proposal</h3>
                
               
                
               
              </div>
             
        </div>
        @endif

        

      @else

     <hr>
        <div class="mainboddy"> 
             <div class="navsbarr">



               <h3> Welcome to One Love website <i>{{$user->name}}.</i><br>Your account isn't activated.</h3>
                
               <h3>Please check your email to <strong>Activate</strong> your account.</h3>
                
               
              </div>
             
        </div>
        @endif
        
</div>




@endsection
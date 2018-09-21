<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Notifications\AcceptOrReject;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Notifications\Notification;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(Proposal $proposal)
    {
        $user = auth()->user();
        $proposalsadminside = Proposal::where('id',request('id'))->get();
        return  view('admin.move', compact('proposalsadminside', 'user'));
    }

    public function rejected(Proposal $proposal)
    {
        $user = auth()->user();
        $proposalsadminside = Proposal::where('stage', 'rejected')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposalsadminside', 'user'));
    }
    public function stageone(Proposal $proposal)
    {
        $user=auth()->user();
        $proposalsadminside = Proposal::where('stage', 'stageone')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposalsadminside', 'user'));
    }
    public function stagetwo(Proposal $proposal)
    {
        $user=auth()->user();
        $proposalsadminside = Proposal::where('stage', 'stagetwo')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposalsadminside', 'user'));
    }
    public function newProposals(Proposal $proposal)
    {
        $user = auth()->user();
        $proposalsadminside = Proposal::whereNull('stage')->orderBy('updated_at', 'desc')->paginate(5); 
        return view('user.user', compact('proposalsadminside', 'user'));
    }
    
    public function accepted(Proposal $proposal)
    {
        $user = auth()->user();
        $proposalsadminside = Proposal::where('stage', 'Accepted')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposalsadminside', 'user'));
    }
    public function stage1(Request $request, proposal $proposal, $id)
    {
        $user = auth()->user();
        DB::table('proposals')->where('id', $request->id)->update(['stage' => 'stageone']);
        return redirect('/newproposals')->with('success', 'Proposal moved to stage one successfully');
    }
    public function goback()
    {
        return redirect('/userproposal');
    }
    public function reject(request $request, $id, Proposal $proposal)
    {

        $submitted_by = DB::table('proposals')->where('id', $request->id)->pluck('submitted_by');
        $user = User::where('email', $submitted_by)->first();
        DB::table('proposals')->where('id', $request->id)->update(['stage' => 'rejected']);
        $user->notify(new AcceptOrReject($proposal));
        return redirect('/userproposal')->with('success', 'Proposal rejected successfully');
    }
    public function stage2(request $request, $id, Proposal $proposal)
    {
        $user = auth()->user();
        DB::table('proposals')->where('id', $request->id)->update(['stage' => 'stagetwo']);
        return redirect('/stageone')->with('success', 'Proposal moved to stage two successfully');
    }
    public function accept(request $request, $id, Proposal $proposal)
    {
        $submitted_by = DB::table('proposals')->where('id', $request->id)->pluck('submitted_by');
        $user = User::where('email', $submitted_by)->first();
        DB::table('proposals')->where('id', $request->id)->update(['stage' => 'Accepted']);
        $user->notify(new AcceptOrReject($proposal));
        return redirect('/stagetwo')->with('success', 'Proposal accepted successfully');
    }
}

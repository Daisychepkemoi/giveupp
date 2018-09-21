<?php

namespace App\Http\Controllers;

use App\Proposal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\NewProposalAdmin;
use App\Http\Controllers\Notification;
use Illuminate\Pagination\Paginator;

class ProposalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','activate','activatepage']);
    }

    public function index()
    {
        return view('proposal.index');
    }
    public function create()
    {
        $user = auth()->user();
        return view('proposal.proposal', compact('user'));
    }

    public function store(request $request)
    {
        $this->validate(
         request(),
         [
            'title'=>'required',
            'organization'=>'required',
            'summary'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'submitted_by'=>'required',
            'background'=>'required',
            'activities'=>'required',
            'budget'=>'required',

        ]
    );
        $proposal = Proposal::create([
            'title'=>request('title'),
            'organization'=>request('organization'),
            'summary'=>request('summary'),
            'address'=>request('address'),
            'phone'=>request('phone'),
            'email'=>request('email'),
            'submitted_by'=>auth()->user()->email,
            'background'=>request('background'),
            'activities'=>request('activities'),
            'budget'=>request('budget')

        ]);
        $id = $proposal->id;
        switch ($request->input('publish')) {
            case 'save':
                    $user = User::where('is_admin',1)->first();
                    $proposal = DB::table('proposals')->where('id', $id)->first();
                    \Mail::to($user->email)->send(new NewProposalAdmin($user));
                    return redirect()->to('/submitproposal/'.$id)->with('success', 'Proposal Submitted Successfully');
                    break;

            case 'draft':
                    return redirect()->to('/draft/'.$id);
                    break;


        }
    }
    public function view(proposal $proposal)
    {
        $user = auth()->user();
        $proposals = Proposal::latest()->where('submitted_by', $user->email)->OrderBy('updated_at', 'desc')->paginate(5);
        $proposalsadminside = Proposal::where('draft', $proposal->draft=false)->orderBy('updated_at', 'desc')->paginate(5);

        if ($proposal->count() > 0) {
            return view('user.user', compact('proposals', 'user', 'proposalsadminside'));
        } else {
            return view('user.empty', compact('user', 'proposaladminside'));
        }

    }

    public function open($id)
    {
        $user = auth()->user();
        $proposal = Proposal::where('id', request('id'))->first();
        return view('user.view', compact('proposal', 'user'));
    }

    public function finalsubmit(request $request, $id)
    {
        DB::table('proposals')->where('id', $request->id)->update(['draft' => false]);
        return redirect('/userproposal');
    }

    public function savedraft(request $request, $id)
    {
        DB::table('proposals')->where('id', $request->id)->update(['draft' => true]);
        return redirect('/userproposal')->with('success', 'Draft saved successfully');
    }
    public function destroy(request $request, $id)
    {
        DB::table('proposals')->where('id', $request->id)->delete();
        return redirect('/userproposal')->with('success', 'Draft deleted successfully');
    }

    public function update(request $request)
    {
        $proposal = Proposal::where('id', $request->id)->first();
        $proposal->title=$request->get('title');
        $proposal->organization=$request->get('organization');
        $proposal->address=$request->get('address');
        $proposal->phone=$request->get('phone');
        $proposal->email=$request->get('email');
        $proposal->submitted_by=$request->get('submitted_by');
        $proposal->background=$request->get('background');
        $proposal->activities=$request->get('activities');
        $proposal->summary=$request->get('summary');
        $proposal->budget=$request->get('budget');
        $proposal->save();
        $id=$proposal->id;
        switch ($request->input('save')) {
            case 'savedraft':
                $user = User::where('is_admin',1)->first();
                $proposal = DB::table('proposals')->where('id', $id)->first();
                \Mail::to($user->email)->send(new NewProposalAdmin($user));
                return redirect()->to('/submitproposal/'.$id)->with('success', 'Proposal Submitted Successfully');
                break;

            case 'editdraft':
                return redirect()->to('/draft/'.$id)->with('success', 'saved as draft Successfully');
                break;
            case 'deletedraft':
                return redirect('/deletedraft/'.$id)->with('success', 'Draft deleted Successfully');
                break;
        }
    }
    public function activatepage(request $request)
    {
        $user = auth()->user();
        return view('email.welcome', compact('user'));
    }
    public function activate(request $request)
    {
        DB::table('users')->where('id', $request->id)->update(['verified' => true]);
        return redirect()->route('login')->with('message', 'Account successfully activated!');
    }
    public function rejected(Proposal $proposal)
    {
        $user = auth()->user();
        $useremail = $user->email;
        $proposals = Proposal::where('submitted_by', $useremail)->where('stage', 'rejected')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposals', 'user'));
    }
    public function stageoneuser(Proposal $proposal)
    {
        $user = auth()->user();
        $useremail = $user->email;
        $proposals = Proposal::where('submitted_by', $useremail)->where('stage', 'stageone')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposals', 'user'));
    }
    public function userdrafts(Proposal $proposal)
    {
        $user = auth()->user();
        $useremail = $user->email;
        $proposals = Proposal::where('submitted_by', $useremail)->where('draft', 1)->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposals', 'user'));
    }
    public function stagetwouser(Proposal $proposal)
    {
        $user = auth()->user();
        $useremail = $user->email;
        $proposals = Proposal::where('submitted_by', $useremail)->where('stage', 'stagetwo')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposals', 'user'));
    }
    public function newProposals(Proposal $proposal)
    {
        $user = auth()->user();
        $useremail = $user->email;
        $proposals = Proposal::where('submitted_by', $useremail)->whereNull('stage')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposals', 'user'));
    }
    public function accepteduser(Proposal $proposal)
    {
        $user = auth()->user();
        $useremail = $user->email;
        $proposals = Proposal::where('submitted_by', $useremail)->where('stage', 'Accepted')->orderBy('updated_at', 'desc')->paginate(5);
        return view('user.user', compact('proposals', 'user'));
    }
    public function userback()
    {
        return redirect('/userproposal');
    }
}

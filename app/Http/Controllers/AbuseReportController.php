<?php namespace App\Http\Controllers;

// use App\Http\Requests;
use DB;
use Auth;
use App\User;
use App\Plainte;
use Illuminate\Http\Request;
use App\Events\ReportAbuseWasPosted;
use App\Events\RestoreAccountMsgeWasSent;
use Illuminate\Support\Facades\Input as Input;


class AbuseReportController extends Controller
{
    // public function index(){
    //   return '';
    // }

  public function restoreAccountForm(){
    
    return view();
  }


  private function getRquestUsr(Request $request){
      return $request->user();
  }


  ///  TODO : creer un user robot@menahose

    public function plaintesUser(Request $request){

      $plaignant = $this->getRquestUsr($request);

    //  dd($plaignant);


    //  ['plaignant', 'auteur_faits', 'faits_reproches']
      $data = Input::only(['causes','auteurPlaintes', 'message']);

      //$auteur_plaintes = User::findOrFail($data['auteur_plaintes']);
      // $auteur_plaintes = DB::table('users')->where('id', $data['auteur_plaintes'])->first();
      //return redirect()->back();

      if($plaignant->id !== $data['auteurPlaintes']){
        //   $this->setUserStatut($data['auteur_plaintes']);
          // $newplainte = Plainte::create($data);

          $donnees = [
            'cause' => Input::get('causes'),
            'faits_reproches' => Input::get('message'),
            'plaignant' => $plaignant->id
          ];

          $user = User::find($data['auteurPlaintes']);
          event(new ReportAbuseWasPosted($user, $donnees));

// return redirect()->back();

        //  account_activated,
      }
       return redirect('/mailbox/inbox');
    }

    private function setUserStatut($auteur_faits){
       /// $user = User::find()->
    }

    public function complaintForm($id){

        $user = Auth::user();
        $flag ="compose";
        $typeform = 'abuse';

        $auteurPlaintes = User::find($id);

       // dd($auteurPlaintes );

        if (null == $auteurPlaintes){
            return redirect('mailbox/inbox');
        }
      
        return view('messenger.complaints', compact('user', 'typeform', 'auteurPlaintes', 'flag'));
    }


    public function restoreAccount(){
        $user = Auth::user();
        $typeform = 'restore';

        $flag ="compose";
        return view('messenger.complaints', compact('user', 'typeform', 'flag'));
    }


    public function restore(Request $request){

        $user = $request->user();
        event(new RestoreAccountMsgeWasSent($user, Input::get('message')));

        return redirect('mailbox/inbox');
    }


}

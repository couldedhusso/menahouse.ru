<?php
      use App\Images;
      use App\Profiles;
      use Illuminate\Database\Eloquent\ModelNotFoundException;

      $profilexit = false ;

      try {
           $userprofile = Profiles::whereuser_id(Auth::user()->id )->firstOrfail();
           $profilexit = true ;
      } catch (ModelNotFoundException $e) { }
?>

@if($profilexit != true or $userprofile->hasprofile == 0  )
    <img src="{{ asset('img/default_avatar.png')}}" width="25" height="25" alt="">
@else
  <img src="{{ asset('storage/profil').'/'.$userprofile->images->path }}"  width="25" height="25" alt="">
  {{-- <img src="https://s3.eu-central-1.amazonaws.com/menahousecs3/dev/profileimg/{!! $userprofile->images->path !!}" class="img-circle demo-avatar"> --}}
@endif

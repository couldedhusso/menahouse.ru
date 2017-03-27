
@if(Auth::check())
    <?php
      $count = Auth::user()->newMessagesCount();
      // $cssClass = $count == 0 ? 'hidden' : '';
    ?>

    @if($count == 0 )
        <span>0</span>
    @else
       <span>{!!$count!!}</span>
    @endif
@endif

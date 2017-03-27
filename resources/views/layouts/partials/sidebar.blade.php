<aside>
  <?php
    // ===>  gesttion de la class active du sidebar
    switch ($flag) {
      case 'bookmarked':
              $bookmarked = "active";
              $default = "";
              $advertisements = "";
              $settings = "";
              break;
      case 'advertisements':
              $bookmarked = "";
              $default = "";
              $advertisements = "active";
              $settings = "";
              break;
      case 'favoris':
              $bookmarked = "";
              $default = "";
              $advertisements = "active";
              $settings = "";
              break;
      default:
              $bookmarked = "";
              $default = "";
              $advertisements = "";
              $settings = "active";
              break;
    }
  ?>

    <ul class="sidebar-navigation">
        <li class="{{$settings}}"><a href="{{url('dashboard/settings/'.Auth::user()->id)}}"><i class="fa fa-user"></i><span>Настройки</span></a></li>
        <li><a href="{{url('dashboard/advertisement/add')}}"><i class="fa fa-add"></i><span>Разместить объявление</span></a></li>
        <li class="{{$advertisements}}"><a href="{{url('dashboard/advertisements')}}"><i class="fa fa-home"></i><span>Мои объявления</span></a></li>
        <li class="{{$bookmarked}}"><a href="{{url('dashboard/bookmarked')}}"><i class="fa fa-heart"></i><span>Избранное</span></a></li>
        <li><a href="#"><i class="fa fa-heart"></i><span>Избранное список</span></a></li>
    </ul>
</aside>

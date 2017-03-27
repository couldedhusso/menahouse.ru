<div class="secondary-navigation">
           <div class="container">
               <div class="contact">
                   <figure><strong>Тел.:</strong>+7 999-123-4567</figure>
                   <figure><strong>Email:</strong>mena@yandex.ru</figure>
               </div>
               <div class="user-area">
                   <div class="actions">
                       {{-- <a href="create-account.html" class="promoted"><strong>Регистрация</strong></a>
                       <a href="sign-in.html">Войти</a> --}}
                       @if(Auth::check())
                           <a  class="promoted cls-avatar" href=""> <strong>{{ Auth::user()->familia ." ". Auth::user()->imia }}</strong>  <span class="sr-only">(current) </span></a>
                           <a href="{{ url('/auth/logout') }}">Выйти</a>
                       @else
                         <a href="{{ url('/sign-up') }}" class="promoted"><strong>Регистрация</strong></a>
                         <a href="{{ url('/sign-in') }}">Войти</a>
                       @endif

                   </div>
               </div>
           </div>
       </div>
<div class="container">
           <header class="navbar" id="top" role="banner">
               <div class="navbar-header">
                   <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                       <span class="sr-only">Toggle navigation</span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                   </button>
                   <div class="navbar-brand nav" id="brand">
                       <a href="#"> <img src="assets/img/logo.png" alt="Менахаус" title="Менахаус"></a>
                   </div>
               </div>
               <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">


                 <!-- Search Box -->
                   <div class="search-box-wrapper">
                       <div class="search-box-inner">
                           <div class="container">
                               <div class="search-box map">
                                   <div class="tab-content">

                                   <form role="form" id="form-map-sale" class="form-map form-search clearfix" method="post" action="house/catalogue">
                                       <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                       <div class="row">
                                           <div class="col-md-2 col-sm-4">
                                               <div class="form-group">
                                                   <select name="form-sale-city">
                                                       <option value="Москва">Москва</option>
                                                   </select>
                                               </div><!-- /.form-group -->
                                           </div>
                                           <div class="col-md-2 col-sm-4">
                                               <div class="form-group">
                                                   <select name="form-sale-district">
                                                       <option value="">Район</option>
                                                       <option value="ЦАО">ЦАО</option>
                                                       <option value="ЗАО">ЗАО</option>
                                                       <option value="ЮАО">ЮАО</option>
                                                       <option value="ВАО">ВАО</option>
                                                       <option value="САО">САО</option>
                                                   </select>
                                               </div><!-- /.form-group -->
                                           </div>
                                           <div class="col-md-2 col-sm-4">
                                               <div class="form-group">
                                                   <select name="form-sale-property-type">

                                                       <option value="">Тип жилья</option>
                                                       <option value="Квартира">Квартира</option>
                                                       <option value="Частный дом">Частный дом</option>
                                                       <option value="Коттедж">Коттедж</option>
                                                       <option value="Дача">Дача</option>
                                                   </select>
                                               </div><!-- /.form-group -->
                                           </div>
                                           <div class="col-md-2 col-sm-4">
                                               <div class="form-group">
                                                   <select name="form-sale-number-room">
                                                       <option value="">Кол-во комнат</option>
                                                       <option value="1">1</option>
                                                       <option value="2">2</option>
                                                       <option value="3">3</option>
                                                       <option value="4">4</option>
                                                       <option value="5">5+</option>
                                                   </select>
                                               </div><!-- /.form-group -->
                                           </div>
                                           <div class="col-md-2 col-sm-4">
                                               <div class="form-group">
                                                   {{-- <select name="form-sale-price"> --}}
                                                   <select name="form-sale-surface">
                                                       <option value="">Площадь</option>
                                                       <option value="1">30-70 +</option>
                                                       <option value="2">70-90 +</option>
                                                       <option value="3">90-110 +</option>
                                                       <option value="4">110 +</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-2 col-sm-4">
                                               <div class="form-group">
                                                   <button type="submit" class="btn btn-default">Искать</button>
                                               </div><!-- /.form-group -->
                                           </div>

                                       </div>


                                      </form><!-- /#form-map -->
                                  </div>
                               </div><!-- /.search-box -->
                           </div><!-- /.container -->
                       </div><!-- /.search-box-inner -->
                   <br><br><br>
                   </div>
                   <!-- end Search Box -->

               </nav><!-- /.navbar collapse-->
               <div class="add-your-property">
                   <a href="{{url('/dashboard/nedvizhimosts/add')}}" class="btn btn-green"><i class="fa fa-plus"></i><span class="text">Разместить объявление</span></a>
               </div>
           </header><!-- /.navbar -->
</div><!-- /.container -->

@extends('templates.TemplatePropertiesListing')

@section('search-results')
  <section id="results">
               <header><h1>Предложения по вашему запросу</h1></header>
               <section id="search-filter">
                   <figure><h3><i class="fa fa-search"></i>Результатов поиска:</h3>
                       <span class="search-count">{{ $foundelemts }}</span>
                       @if($foundelemts != 0)
                         <div class="sorting">
                             <div class="form-group">
                               <form  id="formdata" method="post"  action="/sorted/properties">
                                 <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                   @foreach($paramSearch as $key => $value )
                                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                                   @endforeach
                                  <select name="sorting" id="sorting">
                                      <option value="">Сортировать</option>
                                      <option value="1">По цене убывания</option>
                                      <option value="2">По метражу</option>
                                      <option value="3">По дате добавления</option>
                                  </select>
                              </form>

                             </div><!-- /.form-group -->
                         </div>
                       @endif
                   </figure>
               </section>
               <?php $count_ads  = 0 ; ?>

               <section id="properties" class="display-lines">

                   @if(Auth::check())


                   @else

                     <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">

                              <?php $itemid = 0; ?>

                              <!-- Carousel items -->
                               <div class="carousel-inner" role="listbox">


                               @foreach(array_chunk($houses, 2) as $items)
                                    <?php $itemid = $itemid + 1; ?>

                                          @if($itemid == 1)
                                               <div class="active item">

                                               @foreach($items as $house )
                                                 <?php
                                                      $home = new App\Obivlenie ;
                                                      $typehousenumberrooms =  $home->typeHouse($house->kolitchestvo_komnat, $house->type_nedvizhimosti) ;
                                                 ?>

                                                  <div class="property">

                                                  <!--  <div class="property"> -->
                                                   {{-- <figure class="tag status">Спецпредложение</figure> --}}
                                                   {{-- @if($house->type_nedvizhimosti == 'Квартира' or $house->type_nedvizhimosti =='Комната')
                                                     <figure class="type" title="Apartment"><img src="{{ asset('static/assets/img/property-types/apartment.png')}}" alt=""></figure>
                                                   @elseif($house->type_nedvizhimosti == 'Частный дом')
                                                     <figure class="type" title="Apartment"><img src="{{ asset('static/assets/img/property-types/single-family.png')}}" alt=""></figure>
                                                   @elseif($house->type_nedvizhimosti == 'Коттедж')
                                                     <figure class="type" title="Apartment"><img src="{{ asset('static/assets/img/property-types/cottage.png')}}" alt=""></figure>
                                                   @else
                                                     <figure class="type" title="Apartment"><img src="{{ asset('static/assets/img/property-types/empty.png')}}" alt=""></figure>
                                                   @endif --}}
                                                   <span class="actions pull-right">
                                                        <?php // TODO: tester l envoie de la requete ?>
                                                        <a id="bookmarkItem" href="#" class="bookmark" data-bookmark-state="empty"><span class="title-add">В избранное</span><span class="title-added">Добавлено</span></a>
                                                    </span>

                                                   <div class="property-image">
                                                       {{-- <figure class="ribbon">{{$categerise}}</figure> --}}
                                                       <figure class="ribbon">
                                                         @if($house->status != "Обмен")
                                                           Обмен-продаж
                                                         @else
                                                           {{$house->status}}
                                                         @endif
                                                     </figure>
                                                       <a href="{{ url('property/'.$house->id ) }}">
                                                           <img alt="" src="{{asset('storage/thumbnail/'.$house->id.'.jpeg')}}">
                                                       </a>
                                                   </div>

                                                   <div class="info">
                                                       <header>
                                                           <a href="{{ url('property/'.$house->id ) }}"><h3>{{$typehousenumberrooms }}</h3></a>
                                                           <figure>м.{{ $house->metro }}; {{ $house->ulitsa }}</figure>
                                                       </header>
                                                       <div class="tag price"><?php echo number_format($house->price, 2, ',', ' ')." "; ?>&#x20bd</div>
                                                       <aside>
                                                           <p>
                                                             {{ $house->tekct_obivlenia }}
                                                           </p>
                                                           <dl>
                                                               <dt>Этаж:</dt>
                                                                   <dd>{{ $house->etazh }} / {{ $house->etajnost_doma }}</dd>
                                                               <dt>Площадь:</dt>
                                                                   <dd>{{ $house->obshaya_ploshad }} м<sup>2</sup></dd>
                                                               <dt>Жилая:</dt>
                                                                   <dd>{{ $house->zhilaya_ploshad }} м<sup>2</sup></dd>
                                                               <dt>Кухня:</dt>
                                                                   <dd>{{ $house->ploshad_kurhni }} м<sup>2</sup></dd>
                                                           </dl>
                                                       </aside>

                                                       <a href="{{url('/mailbox/message/compose/'.$house->id)}}" class="btn btn-white-grey-3 btn-m-3" title="Открыть объявление, узнать полную информацию и написать владельцу">
                                                         <figure class="fa fa-envelope"></figure>
                                                         <span>&nbsp; Написать &nbsp;</span>
                                                         <span class="arrow fa fa-angle-right"></span>
                                                       </a><!-- /.write-button -->
                                                   </div>  {{-- {!! $houses->render() !!} --}}

                                                   </div>
                                                   <!-- </div>  /.property -->


                                                   @endforeach
                                               </div>    <!-- </div>  /.active item -->



                                           @else
                                               <div class="item">
                                                  @foreach($items as $house )

                                                   <?php
                                                        $home = new App\Obivlenie ;
                                                        $typehousenumberrooms =  $home->typeHouse($house->kolitchestvo_komnat, $house->type_nedvizhimosti) ;
                                                   ?>

                                                    <div class="property">

                                                          <!--  <div class="property"> -->
                                                           {{-- <figure class="tag status">Спецпредложение</figure> --}}
                                                           {{-- @if($house->type_nedvizhimosti == 'Квартира' or $house->type_nedvizhimosti =='Комната')
                                                             <figure class="type" title="Apartment"><img src="{{ asset('static/assets/img/property-types/apartment.png')}}" alt=""></figure>
                                                           @elseif($house->type_nedvizhimosti == 'Частный дом')
                                                             <figure class="type" title="Apartment"><img src="{{ asset('static/assets/img/property-types/single-family.png')}}" alt=""></figure>
                                                           @elseif($house->type_nedvizhimosti == 'Коттедж')
                                                             <figure class="type" title="Apartment"><img src="{{ asset('static/assets/img/property-types/cottage.png')}}" alt=""></figure>
                                                           @else
                                                             <figure class="type" title="Apartment"><img src="{{ asset('static/assets/img/property-types/empty.png')}}" alt=""></figure>
                                                           @endif --}}
                                                           <span class="actions pull-right">
                                                                <?php // TODO: tester l envoie de la requete ?>
                                                                <a id="bookmarkItem" href="#" class="bookmark" data-bookmark-state="empty"><span class="title-add">В избранное</span><span class="title-added">Добавлено</span></a>
                                                            </span>

                                                           <div class="property-image">
                                                               {{-- <figure class="ribbon">{{$categerise}}</figure> --}}
                                                               <figure class="ribbon">
                                                                 @if($house->status != "Обмен")
                                                                   Обмен-продаж
                                                                 @else
                                                                   {{$house->status}}
                                                                 @endif
                                                             </figure>
                                                               <a href="{{ url('property/'.$house->id ) }}">
                                                                   <img alt="" src="{{asset('storage/thumbnail/'.$house->id.'.jpeg')}}">
                                                               </a>
                                                           </div>

                                                           <div class="info">
                                                               <header>
                                                                   <a href="{{ url('property/'.$house->id ) }}"><h3>{{$typehousenumberrooms }}</h3></a>
                                                                   <figure>м.{{ $house->metro }}; {{ $house->ulitsa }}</figure>
                                                               </header>
                                                               <div class="tag price"><?php echo number_format($house->price, 2, ',', ' ')." "; ?>&#x20bd</div>
                                                               <aside>
                                                                   <p>
                                                                     {{ $house->tekct_obivlenia }}
                                                                   </p>
                                                                   <dl>
                                                                       <dt>Этаж:</dt>
                                                                           <dd>{{ $house->etazh }} / {{ $house->etajnost_doma }}</dd>
                                                                       <dt>Площадь:</dt>
                                                                           <dd>{{ $house->obshaya_ploshad }} м<sup>2</sup></dd>
                                                                       <dt>Жилая:</dt>
                                                                           <dd>{{ $house->zhilaya_ploshad }} м<sup>2</sup></dd>
                                                                       <dt>Кухня:</dt>
                                                                           <dd>{{ $house->ploshad_kurhni }} м<sup>2</sup></dd>
                                                                   </dl>
                                                               </aside>

                                                               <a href="{{url('/mailbox/message/compose/'.$house->id)}}" class="btn btn-white-grey-3 btn-m-3" title="Открыть объявление, узнать полную информацию и написать владельцу">
                                                                 <figure class="fa fa-envelope"></figure>
                                                                 <span>&nbsp; Написать &nbsp;</span>
                                                                 <span class="arrow fa fa-angle-right"></span>
                                                               </a><!-- /.write-button -->
                                                           </div>  {{-- {!! $houses->render() !!} --}}

                                                   </div>
                                                   <!-- </div>  /.property -->


                                                   @endforeach
                                               </div> <!-- </div>  /.item -->
                                           @endif

                                @endforeach
                              </div>


                      </div><!-- carousel-->


                   @endif



                    <!-- Pagination ($foundelemts / 2 )-->
                    <div class="center">
                        <ul class="pagination">
                            @for($i=0; $i < ($foundelemts / 2); $i++)
                                @if( $i== 0)
                                    <li  data-target="#myCarousel" data-slide-to="{!!$i!!}" class="active"><a href="">{{$i+1}}</a></li>
                                @else
                                    <li data-target="#myCarousel" data-slide-to="{!!$i!!}"><a href="">{{$i+1}}</a></li>
                                @endif
                              @endfor
                         </ul><!-- /.pagination-->

                              </div><!-- /.center-->
                </section><!-- /#properties-->

  </section><!-- /#results -->

@endsection

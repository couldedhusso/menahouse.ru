@extends('layouts.LayoutArenda')


@section('content')

<div class="container">
   <div class="grid">

            <div class="row cells12">

              <div class="cell colspan12">
                  <ul class="breadcrumbs">
                    <li><a href="#"><span class="icon mif-home"></span> На главную </a></li>
                    <li><a href="#">Аренда</a></li>
                  </ul>
              </div>

            </div>

            <div class="row cells12">
                 <div class="cell colspan12">
                   <h3 class="text-light fg-gray">Недвижимости на аренду
                     <button class="image-button place-right" onclick="showDialog('#dialog')">
                       быстрый поиск
                       <span class="icon mif-filter fg-white"></span>
                     </button></h3>
                   <hr class="bg-grayr">
                 </div>



                 <div data-role="dialog" id="dialog" style="left: 0px; right: 0px; width: auto; height: auto; visibility: hidden;"
                      class="padding20 dialog" data-close-button="true" data-windows-style="true">
                     <div class="container">
                         <h3 class="text-light fg-gray">Быстрый поиск</h3>
                        <div class="grid">


                          {!! Form::open(array('route' => 'search_path', 'method' => 'post')) !!}
                          <div class="row cells12 fg-gray">

                            <div class="cell colspan4">
                                <h5>Тип недвижимости</h5>
                              <div class="full-size input-control select">
                                <select name="type_nedvizhimosti">
                                     <option value="">- Не выбрано -</option>
                                     <option value="Квартира">Квартира</option>
                                     <option value="Комната">Комната</option>
                                     <option value="Коттедж">Коттедж</option>
                                     <option value="Дом/Дача">Дом/Дача</option>
                                     <option value="Часть дома">Часть дома</option>
                                     <option value="Офис">Офис</option>
                                     <option value="Здание">Здание</option>
                                     <option value="Торговое помещение">Торговое помещение</option>
                                     <option value="Склад">Склад</option>
                                </select>
                              </div>
                            </div>

                            <div class="cell colspan3">
                              <h5>Город</h5>
                              <div class="full-size input-control select">
                                <select name="gorod">
                                     <option value="" >- Не выбрано -</option>
                                     <option value="Москва">Москва</option>
                                     <option value="Московская область">Московская область</option>
                                     <option value="Санкт-Петербург">Санкт-Петербург</option>
                                </select>
                              </div>
                            </div>

                            <div class="cell colspan3">
                              <h5>Районы</h5>
                              <div class="input-control full-size text">
                                <input type="text" name="rayon" placeholder="Например : ЦАО">
                              </div>

                                <input type="submit"  value="Найти" class="button primary">
                            </div>


                              {{-- <div class="cell colspan2">
                                  <input type="submit" id="submit-all" value="Найти" class="button primary">
                              </div> --}}

                          </div>
                          {!! Form::close() !!}

                          <div class="row cells12">

                            <div class="cell colspan12">
                                  <h5></h5>
                                <a ><span class="icon mif-equalizer"></span> Расшерение поиска</a>
                            </div>

                          </div>

                        </div>
                     </div>
                    <span class="dialog-close-button"></span>

                </div>

           </div>

          {{-- <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-3x fa-spin"></span></p> --}}



           @foreach($result as $item)
                <div class="row cells12">
                  {{-- <a href="#"> --}}
                    <div class="cell colspan12">
                      <h4 class="text-light fg-gray"> {{ $item->type_nedvizhimosti }}
                          <span class="place-right">
                            {{ $item->price }} <i class="fa fa-rub"> </i> в месяц
                          </span>
                      </h4>

                    </div>
                  </div>

                  <div class="row cells12">
                      <div class="cell colspan5 cls-border">
                          {{-- @foreach($autors as $auteur)
                              {{ $auteur->imia }}
                          @endforeach --}}
                      </div>

                      <div class="cell colspan7 img-grid">
                          <ul class="bxslider">
                              @foreach($item->images as $img )

                                  <li><img src="{{ asset('storage').'/'.$img->path }}"></li>

                                  {{-- <div class="grid-item grid-item--width2 grid-item--height2">
                                     <img src="{{ asset('storage').'/'.$img->path }}">
                                  </div> --}}
                              @endforeach
                          </ul>
                      </div>
                  </div>


               {{-- </a> --}}

           @endforeach


   </div>
</div>


@endsection

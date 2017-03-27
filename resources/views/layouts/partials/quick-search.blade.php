<section id="sidebar">
     <aside id="edit-search">

      <header id="poisk"><h3>Поиск</h3></header>

            <form role="form" id="form-sidebar" class="form-search" method="post" 
                                                        action="/menahouse/recherches">
               <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
              <div class="form-group">
                    <select name="status">
                        <option value="1" selected="1">Обмен</option>
                        <option value="2">Обмен + продажа</option>
                    </select>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <select name="gorod">
                        <option value="">Город</option>
                        <option value="1">Все города</option>
                        <option value="2">Москва</option>
                        <option value="3">Московская область</option>
                        <option value="4">Новая Москва</option>
                    </select>
                </div><!-- /.form-group -->
                
                <div class="form-group">
                <select name="rayon">
                    <option value="">Округ</option>
                    <option value="0" data-city="2">Все округа</option>
                    <option value="1" data-city="2">Центральный</option>
                    <option value="2" data-city="2">Северный</option>
                    <option value="3" data-city="2">Северо-Восточный</option>
                    <option value="4" data-city="2">Восточный</option>
                    <option value="5" data-city="2">Юго-Восточный</option>
                    <option value="6" data-city="2">Южный</option>
                    <option value="7" data-city="2">Юго-Западный</option>
                    <option value="8" data-city="2">Западный</option>
                    <option value="9" data-city="2">Северо-Западный</option>
                    <option value="10" data-city="2">Зеленоградский</option>

                    <option value="" data-city="3 4">Все районы</option>
                    <option value="12" data-city="4">Троицкий</option>
                </select>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <select name="type_nedvizhimosti">
                        <option value="">Тип жилья</option>
                        <option value="1">Квартира</option>
                        <option value="2">Комната</option>
                        <option value="3">Частный дом</option>
                        <option value="4">Новостройки</option>
                    </select>
                </div><!-- /.form-group -->
                
                <div class="form-group">
                            <select name="kolitchestvo_komnat">
                                <option value="">Кол-во комнат</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4+</option>
                                <option value="5">Студия</option>
                            </select>
                    </div><!-- /.form-group -->
                <div>

                <div class="slider" style="margin-top: 8px; border: 1px solid #d2d2d2">
                    <span style="font-weight:bold; margin-left: 8px;" >Площадь</span>
                    <div range-slider min="1" attach-handle-values="true" max="200" model-min="range.min" model-max="range.max"></div>
                    <div style="margin:1em; display:table;">
                        <div class="slider-control">
                            <span>От:</span>
                            <input style="height:25px" type="number" class="" name="rangeMin" ng-model="range.min">
                            <label>м2</label>
                        </div>
                        <div class="slider-control">
                            <span>До:</span>
                            <input type="number" class="" name="rangeMax" ng-model="range.max">
                            <label>м2</label>
                        </div>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="btn-group bootstrap-select">
                        <button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="Площадь" aria-expanded="true">
                            <span class="filter-option pull-left">Площадь</span>&nbsp;<span class="caret"></span>
                        </button>

                    </div>
                </div>-->
                <!--<div class="form-group">
                    <select name="area">
                        <option value="">Площадь</option>
                        <option value="1">30-70 +</option>
                        <option value="2">70-90 +</option>
                        <option value="3">90-110 +</option>
                        <option value="4">110 +</option>
                    </select>
                </div>--><!-- /.form-group -->
            </div>
                <hr>
                        <p>Критерии обмена</P>
                <div class="form-group">
                    <select name="tseli_obmena">
                        <option value="">Обмен на</option>
                        <option value="1">На увеличение</option>
                        <option value="2">На уменьшение</option>
                    </select>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <select name="mestopolozhenie_obmena">
                        <option value="">Район обмена</option>
                        <option value="1">В другом районе</option>
                        <option value="2">В своём районе</option>
                    </select>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <button type="submit"  class="btn btn-default">Искать</button>
                </div><!-- /.form-group -->
               </form><!-- /#form-map -->
      </aside><!-- /#edit-search -->

    {{-- <aside id="featured-properties">
        <header><h3>Спецпредложения</h3></header>
        <div class="property small">
            <a href="#">
                <div class="property-image">
                    <img alt="" src="{{asset('static/assets/img/properties/property-06.jpg')}}">
                </div>
            </a>
            <div class="info">
                <a href=="#"><h4>2х комн.</h4></a>  <!-- CZ индивидуальная ссылка объявления -->
                <figure>м.Маяковская </figure>
                <div class="tag price">7 000 000</div>
            </div>
        </div><!-- /.property -->
        <div class="property small">
            <a href="#">
                <div class="property-image">
                    <img alt="" src="{{asset('static/assets/img/properties/property-09.jpg')}}">
                </div>
            </a>
            <div class="info">
                <a href="property-detail.html"><h4>3х комн.</h4></a>
                <figure>м.Шоссе Энтузиастов</figure>
                <div class="tag price">6 540 000</div>
            </div>
        </div><!-- /.property -->
        <div class="property small">
            <a href="property-detail.html">
                <div class="property-image">
                    <img alt="" src="{{asset('static/assets/img/properties/property-03.jpg')}}">
                </div>
            </a>
            <div class="info">
                <a href="property-detail.html"><h4>1 комн.</h4></a>
                <figure>м.Пушкинская</figure>
                <div class="tag price">9 000 000</div>
            </div>
        </div><!-- /.property -->
    </aside><!-- /#featured-properties --> --}}

    <aside id="our-guides">
        <header><h3>Почему мы?</h3></header>
        <a href="#" class="universal-button">
            <figure class="fa fa-home"></figure>
            <span>Честный обмен</span>
            <span class="arrow fa fa-angle-right"></span>
        </a><!-- /.universal-button -->
        <a href="#" class="universal-button">
            <figure class="fa fa-umbrella"></figure>
            <span>Юридическая информация</span>
            <span class="arrow fa fa-angle-right"></span>
        </a><!-- /.universal-button -->
    </aside><!-- /#our-guide -->

</section><!-- /#sidebar -->

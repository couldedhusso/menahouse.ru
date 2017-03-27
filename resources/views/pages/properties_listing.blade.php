@extends('templates.TemplatePropertiesListing')

@section('search-results')
<section id="results" class="ng-cloak">
    <header><h1>Предложения по вашему запросу</h1></header>
    <section id="search-filter">
                             <figure><h3><i class="fa fa-search"></i>Результатов поиска:</h3>
                                 <span class="search-count">{>houses.length<}</span>
                                 <div class="sorting">
                                     <div class="form-group">
                                         <select name="sorting" ng-model ="criteria_sort">
                                             <option value="">Сортировать</option>
                                             <option value="-price">По цене убывания</option>
                                             <option value="-obshaya_ploshad">По метражу</option>
                                             <option value="-created_at">По дате добавления</option>
                                         </select>
                                     </div><!-- /.form-group -->
                                 </div>
                             </figure>
    </section>
    <section id="properties" class="display-lines" ng-repeat = "house in houses.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage))| orderBy:criteria_sort">
    {{-- <section id="properties" class="display-lines" ng-repeat = "house in houses | startFrom:(currentPage-1)*itemsPerPage"> --}}

          <div class="property">
            <span class="actions pull-right">
                 <?php // TODO: tester l envoie de la requete ?>
                 {{-- <a id="{>house.id<}"  ng-href="dashboard/bookmarked/{>house.id<}" class="bookmark" data-bookmark-state="empty"><span class="title-add">В избранное</span><span class="title-added">Добавлено</span></a> --}}
             </span>

            <div class="property-image">
                  <figure class="ribbon">
                    {> getstatus(house.house) <}
                  </figure>
                  <a ng-href="property/{>house.id<}"> <img alt="" ng-src="{>getimgpath(house.id)<}"></a>
             </div>
              <div class="info">
                  <header>
                      <a ng-href="property/{>house.id<}"><h3> {> gettypehouse(house.kolitchestvo_komnat, house.type_nedvizhimosti) <}</h3></a>
                      <figure>м.{> house.metro <}; {> house.ulitsa <}</figure>
                  </header>
                   <div class="tag price"> {> house.price <} &#x20bd</div>
                   <aside>
                      <p>
                        {> house.tekct_obivlenia <}
                      </p>
                      <dl>
                          <dt>Этаж:</dt>
                              <dd>{> house.etazh <} / {> house.etajnost_doma <}</dd>
                          <dt>Площадь:</dt>
                              <dd> {> house.obshaya_ploshad <}  м<sup>2</sup></dd>
                          <dt>Жилая:</dt>
                              <dd> {> house.zhilaya_ploshad <} м<sup>2</sup></dd>
                          <dt>Кухня:</dt>
                              <dd> {> house.ploshad_kurhni <} м<sup>2</sup></dd>
                      </dl>
                  </aside>

                  <a ng-href="/mailbox/message/compose/{>house.id<}" class="btn btn-white-grey-3 btn-m-3" title="Открыть объявление, узнать полную информацию и написать владельцу">
                    <figure class="fa fa-envelope"></figure>
                    <span>&nbsp; Написать &nbsp;</span>
                    <span class="arrow fa fa-angle-right"></span>
                  </a><!-- /.write-button -->
              </div>
            </div>
    </section>
    {{-- <ul total-items="$scope.totalItems" ng-model="$scope.currentPage" class="pagination-sm"></ul> --}}


    <!-- Pagination -->
        <div class="center">
               {{-- <ul total-items="$scope.totalItems" ng-model="$scope.currentPage" class="pagination pagination-sm"></ul> --}}
              {{-- <pagination total-items="houses.length" ng-model="currentPage"  class="pagination" items-per-page="itemsPerPage"></pagination> --}}
              <pagination total-items="totalItems" ng-model="currentPage"  class="pagination" items-per-page="itemsPerPage"></pagination>
       </div><!-- /.center-->



    {{-- <pagination total-items = "houses.length" ng-model="currentPage" items-per-page="pageSize"></pagination> --}}
</section>
@endsection

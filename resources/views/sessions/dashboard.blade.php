
@extends('templates.TemplateDashboard')

@section('Title')
  Mena | My Properties
@endsection

@section('active_breadcrumb')
  <li><a href="#">Аккаунт</a></li>
  <li class="active">Мои объявления</li>
@endsection

@section('sidebar')
  @include('layouts.partials.sidebar-properties')
@endsection

@section('content')
  <!-- My Properties -->


{{-- 
<div ng-controller="HouseController as vm" ng-cloak>


</div> --}}


<section id="my-properties">
    <header><h1>Список моих объявлений</h1></header>
          <div class="my-properties">
              <div class="table-responsive">
                <table class="table">
                     <thead>
                        <tr>
                                       <th>Объявление</th>
                                       <th></th>
                                       <th>Дата добавления</th>
                                       <th>Просмотры</th>
                                       <th>Действие</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   {{-- @foreach($obivlenie as $house) --}}
                                   <tr>

                                   @if(null !== $house)
                                    

                                    @if(Auth::user()->status == 'banned')

                                        <td class="image">
                                            <a href="#"><img alt="" src="{{'http://d3ngeoscgpa8s9.cloudfront.net/'.$house->thumb->source}}"></a>
                                            </td>
                                            <td><div class="inner">
                                                <a href="#"><h2>{{ $house->type_appart.', м.'.$house->metro }}</h2></a>
                                                <figure>{{ $house->ulitsa }}</figure>
                                                <div class="tag price">{{ $house->price }}</div>
                                            </div>
                                            </td>
                                            <td>{{ $house->data_pub }}</td>
                                            <td>
                                                @if($house->nbr_vue  == null)
                                                    0
                                                    @else
                                                    {{ $house->nbr_vue }}
                                                @endif

                                            </td>

                                            <td class="actions">
                                                <a href="#" class="edit"><i class="fa fa-ban" title="Редактировать объявление"></i>Редактировать</a>
                                                <a href="#"><i class="delete fa fa-trash-o" title="Удалить объявлени"></i></a>
                                            </td>
                                        
                                    @else

                                        <td class="image">
                                            <a href="{{url('/'.$house->link)}}"><img alt="" src="{{'http://d3ngeoscgpa8s9.cloudfront.net/'.$house->thumb->source}}"></a>
                                            </td>
                                            <td><div class="inner">
                                                <a href="{{url('/'.$house->link)}}"><h2>{{ $house->type_appart.', м.'.$house->metro }}</h2></a>
                                                <figure>{{ $house->ulitsa }}</figure>
                                                <div class="tag price">{{ $house->price }}</div>
                                            </div>
                                            </td>
                                            <td>{{ $house->data_pub }}</td>
                                            <td>
                                                @if($house->nbr_vue  == null)
                                                    0
                                                    @else
                                                    {{ $house->nbr_vue }}
                                                @endif

                                            </td>

                                            <td class="actions">
                                                <a href="{{url('dashboard/advertisement/edit/'.$house->id)}}" class="edit"><i class="fa fa-pencil" title="Редактировать объявление"></i>Редактировать</a>
                                                <a href="{{url('dashboard/advertisement/delete/'.$house->id)}}"><i class="delete fa fa-trash-o" title="Удалить объявлени"></i></a>
                                            </td>
                                        
                                    @endif

                                @endif

                                 </tr>
                                      
                                       
                                    {{-- @endforeach --}}
                                   </tbody>
                               </table>
                           </div><!-- /.table-responsive -->
                       </div><!-- /.my-properties -->
                   </section><!-- /#my-properties -->
               <!-- end My Properties -->
@endsection


{{-- for messaging system
https://laracasts.com/discuss/channels/requests/laravel-4-messaging-system-using-2-tables --}}

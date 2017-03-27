@extends('templates.TemplateMailbox')

@section('Title')
  Mena | Mailbox
@endsection

@section('active_breadcrumb')
  <li><a href="#">Сообщения</a></li>
  <li class="active">Входящие</li>
@endsection

@section('sidebar')
  @include('layouts.partials.sidebar-mailbox')
@endsection

@section('content')
  <!-- My Properties -->
             <div class="col-lg-9 col-sm-3">
             <div class="mail-box-header">

                 <h2>
                     Входящие (@include('messenger.unread-count'))
                 </h2>

                 @if('banned' == Auth::user()->status)
                   <h3><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; Вы заблокированы по причине жалоб 
                   <a href="{{url('me/restore-account')}}"> <span class="float-right" style="font-size:14px;
                   border:1px solid; margin : 12px; padding : 10px">восстановить</span></a></h3>
                @endif

                 <div class="mail-tools">
                     <div class="btn-group pull-right">
                         {{-- <button id="arrow-left" class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                         <button id="arrow-right" class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button> 
                         <pager total-items="totalItems" ng-model="currentPage" items-per-page="mailPerPage"></pager> --}}

                         {{-- <ul class="pager ng-isolate-scope ng-not-empty ng-valid ng-dirty ng-valid-parse" total-items="totalItems" ng-model="currentPage" items-per-page="mailPerPage">
                          <li ng-class="{disabled: noPrevious(), fa-arrow-left: align}" class="fa fa-arrow-right disabled"><a href="" ng-click="selectPage(page - 1)" class="ng-binding">Previous</a></li>
                          <li ng-class="{disabled: noNext(), fa-arrow-right: align}" class="fa fa-arrow-right disabled"><a href="" ng-click="selectPage(page + 1)" class="ng-binding">Next</a></li>
                        </ul> --}}
                     </div>
                 </div>
             </div>
                 <div class="mail-box">
                 <table class="table table-hover table-mail">

                  @foreach($usermessages as $umsge)
                  
                      @if($umsge->readed)

                           <tr class="read">
                               <td class="check-mail">
                                   <input type="checkbox" class="i-checks">
                               </td>

                               <td class="mail-contact"><a href="{{url('mailbox/message/'.$umsge->id)}}">{{$umsge->subject}}</a></td>
                                <td class="mail-subject">
                                 <a href="{{url('mailbox/message/'.$umsge->id)}}"> {{ substr($umsge->body, 0, ceil(strlen($umsge->body) - strlen($umsge->body)*70)/100 ) }}...
                                 </a>
                               </td>
                               <td class="text-right mail-date">{{ $umsge->created_at->diffForHumans()}}</td>
                         </tr>


                      @else

                           <tr class="unread">
                               <td class="check-mail">
                                   <input type="checkbox" class="i-checks">
                               </td>

                               <td class="mail-contact"><a href="{{url('mailbox/message/'.$umsge->id)}}">{{$umsge->subject}}</a></td>
                                <td class="mail-subject">
                                 <a href="{{url('mailbox/message/'.$umsge->id)}}"> {{ substr($umsge->body, 0, ceil(strlen($umsge->body) - strlen($umsge->body)*40)/100 ) }}...
                                 </a>
                               </td>
                               <td class="text-right mail-date">{{ $umsge->created_at->diffForHumans()}}</td>
                           </tr>
                          
                      @endif

                             
                  @endforeach
{{-- 

                   <tbody ng-repeat="umsge in usermessages.slice(((currentPage-1)*mailPerPage), ((currentPage)*mailPerPage))">
                         <tr class="unread">
                             <td class="check-mail">
                                 <input type="checkbox" class="i-checks">
                             </td>

                             <td class="mail-contact"><a ng-href="/mailbox/inbox/{>umsge.id<}">{>umsge.familia<} {>umsge.imia<}</a></td>
                             <td class="mail-subject">
                               <a ng-href="/mailbox/inbox/{>umsge.id<}"> {> umsge.body.slice(0, -sliceTexte(umsge.body.length)) <} ...
                             </a>
                           </td>
                             <td class="text-right mail-date">{> umsge.created_at.slice(0, -9)<}</td>

                         </tr>
                   </tbody> --}}
                 </table>

                 <!-- Pagination -->
                   <div class="center">

                      <?php echo $usermessages->render(); ?>
                     {{-- <pagination total-items="totalMails" ng-model="currentPage"  class="pagination" items-per-page="mailPerPage"></pagination> --}}
                   </div><!-- /.center-->
                   <!-- End Pagination -->

                 </div>
             </div>
             <!-- end My Properties -->
@endsection

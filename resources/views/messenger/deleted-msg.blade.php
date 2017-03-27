@extends('templates.TemplateMailbox')

@section('Title')
  Mena | Mailbox
@endsection

@section('active_breadcrumb')
  <li><a href="#">Сообщения</a></li>
  <li class="active">Удалёные</li>
@endsection

@section('sidebar')
  @include('layouts.partials.sidebar-mailbox')
@endsection

@section('content')
  <!-- My Properties -->
             <div class="col-lg-9 col-sm-3" >
                 
                 <div class="mail-box-header">
                     <h2>
                         Удалёные сообщения
                     </h2>
                     {{-- <div class="mail-tools">
                         <div class="btn-group pull-right">
                             <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                             <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>
                         </div>
                     </div> --}}
                 </div>
                 <div class="mail-box">
                 <table class="table table-hover table-mail">

                  
                   <tbody>
                         @foreach($usermessages as $umsge)

                            <tr class="unread">
                               <td class="check-mail">
                                   <input type="checkbox" class="i-checks">
                               </td>

                               <td class="mail-contact"><a href="{{url('mailbox/message/'.$umsge->id)}}">{{$umsge->imia." ".$umsge->otchestvo}}</a></td>
                               <td class="mail-subject">
                                 <a href="{{url('mailbox/message/'.$umsge->id)}}"> {{ substr($umsge->body, 0, -strlen($umsge->body)) }} ...
                               </a>
                             </td>
                               <td class="text-right mail-date">{{ (new DateTime($umsge->created_at ))->format('Y-m-d')  }}</td>
                           </tr>
                              
                          @endforeach

{{--                           
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

                         </tr> --}}
                   </tbody>
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

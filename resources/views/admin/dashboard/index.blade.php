@extends('admin', ['no_boxes' => true])

@section('content')
   <section class="content" ng-controller="Dashboard">
       <script type='text/javascript' src="{{ asset('frontend/controllers/admin/Dashboard.js') }}"></script>
       <style>
           piechart{
               display:none;
               width:100%;
               height:250px;
           }​,
           barchart{
               width:100%;
               height:450px;
           }
           #hqbarchart div.xAxis div.tickLabel
           {
               transform: rotate(-90deg);
               -ms-transform:rotate(-90deg); /* IE 9 */
               -moz-transform:rotate(-90deg); /* Firefox */
               -webkit-transform:rotate(-90deg); /* Safari and Chrome */
               -o-transform:rotate(-90deg); /* Opera */
               /*rotation-point:50% 50%;*/ /* CSS3 */
               /*rotation:270deg;*/ /* CSS3 */
               text-align: left;
           }
       </style>
       <div class="row">
           <div class="col-md-2">
               <div class="block block-drop-shadow">
                   <div class="user bg-default bg-light-rtl">
                       <div class="info">
                           <a href="#" class="informer informer-three text-left">
                               <span>Administrator</span>
                           </a>
                           <a href="#" class="informer informer-four">
                                admin@fintechmonitor.com
                           </a>
                           <img src="themes/taurus/img/user.jpg" class="img-circle img-thumbnail">
                       </div>
                   </div>
                   <div class="content list-group list-group-icons">
                       <a href="#" class="list-group-item"><span class="icon-bar-chart"></span>Statistic<i class="icon-angle-right pull-right"></i></a>
                       <a href="#" class="list-group-item"><span class="icon-cogs"></span>Settings<i class="icon-angle-right pull-right"></i></a>
                       <a href="#" class="list-group-item"><span class="icon-off"></span>Logout<i class="icon-angle-right pull-right"></i></a>
                   </div>
               </div>
               <div class="block block-drop-shadow">
                   <div class="head bg-default bg-light-ltr">
                       <h2>Calendar</h2>
                       <div class="side pull-right">
                           <ul class="buttons">
                               <li><a href="#"><span class="icon-cogs"></span></a></li>
                           </ul>
                       </div>
                   </div>
                   <div style="overflow:hidden;" class="content">
                       <div class="form-group">
                           <div id="datetimepicker12"></div>
                       </div>
                       <script type="text/javascript">
                       $(document).ready(function() {
                           $(function () {
                               $('#datetimepicker12').datetimepicker({
                                   inline: true,
                                   sideBySide: true,
                                   format: 'DD-MMM-YYYY'
                               });
                           });
                       });
                       </script>
                   </div>

               </div>
           </div>
           <div class="col-md-7">
               <div class="row">
                   <div class="col-md-5">
                       <div class="block block-drop-shadow">
                           <div class="head bg-default bg-light-ltr">
                               <h2>Companies</h2>
                           </div>
                           <div class="content">
                               <div class="knob left-twenty right-twenty center">
                                   <input type="text" data-fgColor="#3F97FE" data-min="1" data-max="<%data.statistic.month.companies[1]%>" data-width="100" data-height="100" value="<%data.statistic.month.companies[0]%>" data-readOnly="true"/>
                               </div>
                               <div class="pull-right">
                                   <div><strong>Total: </strong> <%data.statistic.month.companies[1]%></div>
                                   <div><strong>Added by last month: </strong> <%data.statistic.month.companies[0]%></div>
                               </div>
                           </div>

                       </div>
                       <div class="block block-drop-shadow">
                           <div class="head bg-default bg-light-ltr">
                               <h2>News</h2>
                           </div>
                           <div class="content">
                               <div class="knob left-twenty right-twenty center">
                                   <input type="text" data-fgColor="#3F97FE" data-min="1" data-max="<%data.statistic.month.news[1]%>" data-width="100" data-height="100" value="<%data.statistic.month.news[0]%>" data-readOnly="true"/>
                               </div>
                               <div class="pull-right">
                                   <div><strong>Total: </strong> <%data.statistic.month.news[1]%></div>
                                   <div><strong>Added by last month: </strong> <%data.statistic.month.news[0]%></div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-5">
                       <div class="block block-drop-shadow">
                           <div class="head bg-default bg-light-ltr">
                               <h2>Products</h2>
                           </div>
                           <div class="content">
                               <div class="knob left-twenty right-twenty center">
                                   <input type="text" data-fgColor="#3F97FE" data-min="1" data-max="<%data.statistic.month.products[0]%>" data-width="100" data-height="100" value="<%data.statistic.month.products[0]%>" data-readOnly="true"/>
                               </div>
                               <div class="pull-right">
                                   <div><strong>Total: </strong> <%data.statistic.month.products[1]%></div>
                                   <div><strong>Added by last month: </strong> <%data.statistic.month.products[0]%></div>
                               </div>
                           </div>
                       </div>
                       <div class="block block-drop-shadow">
                           <div class="head bg-default bg-light-ltr">
                               <h2>People</h2>
                           </div>
                           <div class="content">
                               <div class="knob left-twenty right-twenty center">
                                   <input type="text" data-fgColor="#3F97FE" data-min="1" data-max="<%data.statistic.month.people[1]%>" data-width="100" data-height="100" value="<%data.statistic.month.people[0]%>" data-readOnly="true"/>
                               </div>
                               <div class="pull-right">
                                   <div><strong>Total: </strong> <%data.statistic.month.people[1]%></div>
                                   <div><strong>Added by last month: </strong> <%data.statistic.month.people[0]%></div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>


               <div class="block block-drop-shadow">
                   <div class="head bg-default bg-light-ltr">
                       <h2>Companies by employee quantity</h2>
                   </div>
                   <div class="content controls">
                       <div class="form-row">
                           <div class="col-md-6">
                               <piechart class="block"> </piechart>
                               {{--<div id="chart_pie_1" style="width: 100%; height: 250px;"></div>--}}
                               <div id="legendPlaceholder"></div>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="block block-drop-shadow">
                   <div class="head bg-default bg-light-ltr">
                       <h2>Headquarters for each companies</h2>
                   </div>
                   <div class="content">
                       <barchart class="block" id="hqbarchart"> </barchart>
                       {{--<div id="chart_bar_1" style="width: 100%; height: 250px;"></div>--}}
                   </div>
               </div>
           </div>
           <div class="col-md-3">

           </div>
       </div>
    </section>
@endsection
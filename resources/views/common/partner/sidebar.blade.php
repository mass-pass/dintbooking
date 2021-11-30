<section>
        <div class="content-wrapper">
           <div class="manage-wrapper">
               <div class="side-bar-wrapper">
                <div class="card main-manage-item">
                    <div class="card-header" >
                     <div class="main-manage">
                        <span><i class="fa fa-cog"></i>&nbsp; Manage </span>
                        </div>
                    </div> 
                  </div>
                   <div class="side-bar" id="accordion">                       
                        <div class="sidebar-item">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                  <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                   <span><i class="fa fa-building"></i>&nbsp; Property</span> <i class="fa fa-chevron-right"></i>
                                  </a>
                                </div>                            
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                  <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="{{ route('layout', ['property' => $currentPropertyId ?? '']) }}">Layout</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ route('facilities') }}">Facilities</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ route('amenities') }}">Amenities</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ route('photos') }}">Photos</a>
                                        </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                        </div>
                       
                        <div class="sidebar-item">
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                  <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span><i class="fa fa-users"></i>&nbsp; User management</span> <i class="fa fa-chevron-right"></i>
                                  </a>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                  <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="#">User</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="#">Roles</a>
                                        </li>
                            
                                    </ul>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="sidebar-item">
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                  <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span><i class="fa fa-users"></i>&nbsp; Channel distrubution</span> <i class="fa fa-chevron-right"></i>
                                  </a>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                  <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="#">Channels</a>
                                        </li>
                                
                                    </ul>
                                  </div>
                                </div>
                              </div>
                        </div>
                    
               <div class="manage-content-wrapper">
                    <div class="manage-content">
                    </div>
               </div>
           </div>
        </div>
    </section>
<div class="container">
    <ul class="nav nav-tabs nav-append-content jobs_menu">
        <li ><a href="#tab1">Browse Jobs</a></li>
        <li class="active"><a href="#tab2">My Jobs</a></li>
    </ul> <!-- /tabs -->

    <div class="tab-content">
        <div class="tab-pane " id="tab1">
            <section id="no-more-tables">
                <table class="qlabs_grid_container tablesorter jobs_table">		
                    <thead>
                        <tr class="header_row">
                            <td colspan="7" class="header_cell">
                                <div class="row-fluid">
                                    <div class="span7">
                                        <i class="icon-calendar"></i><h3 class="page-title"> Months</h3> <!-- header label -->
                                        JUN 2013
                                    </div>

                                    <div class="span2">
                                        <select name="small" class="select-block select-role">
                                            <option value="0">Today</option>
                                            <option value="1">Tommorow</option>
                                            <option value="2">This Week</option>
                                            <option value="3">This Month</option>
                                        </select>
                                    </div>
                                    <div class="span3">
                                        <div class="control-group small ctrl-grp">
                                            <div class="input-append">
                                                <input class="span2" id="appendedInputButton-04" type="text" placeholder="Search">
                                                <button class="btn btn-small" type="button"><span class="fui-search"></span></button>
                                            </div>
                                        </div>
                                    </div>

                            </td>
                        </tr>
                        <tr class="subheader_row">
                            <th class="subheader_cell awm_exchange_service_tlt service_tlt headerSortDown">Logo</th>
                            <th class="subheader_cell awm_exchange_service_demand headerSortDown">Session Date</th>
                            <th class="subheader_cell awm_exchange_service_supply headerSortDown">Duration</th>
                            <th class="subheader_cell awm_exchange_service_discount headerSortDown">Wages</th>
                            <th class="subheader_cell awm_exchange_services_action">Progress</th>
                            <th class="subheader_cell awm_exchange_services_arrow">Action</th>
                        </tr>
                    </thead>
                    <tbody class="data_container">
                        <tr class="data_even">
                            <!-- table 1-->
                            <td colspan="7">
                                <table class="ins_table">

                                    <tr class="data_even ">

                                        <td data-title="Services" class="data_cell awm_service_title" >
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/walmart-logo.png"/>
                                        </td>
                                        <td data-title="Demand" class="data_cell awm_service_demand">
                                            <span class="service-total-demand" data-count="0">30</span>
                                            <div>
                                                May<b  class="service-client-demand" data-count="0">2013</b>
                                            </div>
                                            <div class="demand"> Monday</div>
                                        </td>
                                        <td data-title="Supply" class="data_cell awm_service_supply">
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <span data-count="0" class="total-exchange-count">11:00</span>
                                                    <div>
                                                        pm
                                                    </div>
                                                </div>
                                                <div class="span2">
                                                    <b class="time-bold">to</b>
                                                </div>
                                                <div class="span5">
                                                    <span data-count="0" class="total-exchange-count">2:00</span>
                                                    <div>
                                                        pm
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Price"  class="data_cell awm_service_discount">
                                            <ins><span class="amount">$1000</span></ins>
                                        </td>
                                        <td data-title="Action "  class="data_cell awm_service_action">

                                            <span class="label label-small label-success">Available</span>
                                        </td>
                                        <td class="data_cell awm_service_arrow">
                                            <a href="#collapse52" class="nav-toggle">
                                                <div class="arrow-down">
                                                </div>
                                            </a>
                                        </td>

                                    </tr>

                                    <tr class="expanded">
                                        <td colspan="7">
                                            <input id="row_1" name="#" type="checkbox"/>
                                            <div id="collapse52" style="display:none" class="expand">
                                                <div class="column_100">
                                                    <table class="qlabs_grid_container awm_single_services ins_table service_tlt " width="100%">
                                                        <thead>
                                                            <tr class="header_row">
                                                                <td class="header_cell">
                                                                    <h4 >Walmart</h4>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="data_container">
                                                            <tr class="odd">
                                                                <td class="data_cell awm_single_service_name">
                                                                    <div class="row-fluid">
                                                                        <div class="span9">
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Requested by :</b></div><div class="span9"> <a href="#" class="request_link">  Anna Pollard</a>  </div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Location :</b></div><div class="span9">  Paccar Hall, 1st Floor NE Stevens Way, Seattle </div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Details :</b></div><div class="span9">  We will need 3 workers to set up chairs and tables and help direct traffic for our event. Please wear business casual and a red tie </div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Tags :</b></div><div class="span9">  <span class="label">Event</span><span class="label">Labour</span> </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="span3">
                                                                            <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.png"/>
                                                                            <a href="#fakelink" class="btn btn-large btn-block btn-success btn-apply">Apply Job</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="data_even">
                            <!-- table 1-->
                            <td colspan="7">
                                <table class="ins_table">
                                    <tr class="data_even">
                                        <td data-title="Services" class="data_cell awm_service_title" >
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/livefyre-logo.png"/>
                                        </td>
                                        <td data-title="Demand" class="data_cell awm_service_demand">
                                            <span class="service-total-demand" data-count="1">10</span>
                                            <div>
                                                June<b  class="service-client-demand" data-count="1">2013</b>
                                            </div>
                                            <div class="demand"> Thusrday</div>
                                        </td>
                                        <td data-title="Supply" class="data_cell awm_service_supply">
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <span data-count="0" class="total-exchange-count">8:00</span>
                                                    <div>
                                                        am
                                                    </div>
                                                </div>
                                                <div class="span2">
                                                    <b class="time-bold">to</b>
                                                </div>
                                                <div class="span5">
                                                    <span data-count="0" class="total-exchange-count">12:00</span>
                                                    <div>
                                                        pm
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Price"  class="data_cell awm_service_discount">
                                            <ins><span class="amount">$28</span></ins>
                                        </td>
                                        <td data-title="Action "  class="data_cell awm_service_action">
                                            <span class="label label-small label-success">Available</span>
                                        </td>
                                        <td class="data_cell awm_service_arrow">
                                            <a href="#collapse53" class="nav-toggle">
                                                <div class="arrow-down">
                                                </div>
                                            </a>

                                        </td>
                                    </tr>
                                    <tr class="expanded">
                                        <td colspan="7">
                                            <input id="row_1" name="#" type="checkbox"/>
                                            <div id="collapse53" style="display:none" class="expand">
                                                <div class="column_100">
                                                    <table class="qlabs_grid_container awm_single_services ins_table service_tlt " width="100%">
                                                        <thead>
                                                            <tr class="header_row">
                                                                <td class="header_cell">
                                                                    <h4 >Lifefyre</h4>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="data_container">
                                                            <tr class="odd">
                                                                <td class="data_cell awm_single_service_name">
                                                                    <div class="row-fluid">
                                                                        <div class="span9">
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Requested by :</b></div><div class="span9"><a href="#" class="request_link">  Anna Pollard</a>  </div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Location :</b></div><div class="span9">  Paccar Hall, 1st Floor NE Stevens Way, Seattle </div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Details :</b></div><div class="span9">  We will need 3 workers to set up chairs and tables and help direct traffic for our event. Please wear business casual and a red tie </div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Tags :</b></div><div class="span9">  <span class="label">Event</span><span class="label">Labour</span> </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="span3">
                                                                            <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.png"/>
                                                                            <a href="#fakelink" class="btn btn-large btn-block btn-success btn-apply">Apply Job</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="data_even">
                            <!-- table 1-->
                            <td colspan="7">
                                <table class="ins_table">
                                    <tr class="data_even">
                                        <td data-title="Services" class="data_cell awm_service_title" >
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/UbuntuLogo.png"/>
                                        </td>
                                        <td data-title="Demand" class="data_cell awm_service_demand">
                                            <span class="service-total-demand" data-count="1">05</span>
                                            <div>
                                                May<b  class="service-client-demand" data-count="1">2013</b>
                                            </div>
                                            <div class="demand"> Sunday</div>
                                        </td>
                                        <td data-title="Supply" class="data_cell awm_service_supply">
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <span data-count="0" class="total-exchange-count">10:00</span>
                                                    <div>
                                                        am
                                                    </div>
                                                </div>
                                                <div class="span2">
                                                    <b class="time-bold">to</b>
                                                </div>
                                                <div class="span5">
                                                    <span data-count="0" class="total-exchange-count">12:00</span>
                                                    <div>
                                                        pm
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Price"  class="data_cell awm_service_discount">
                                            <ins><span class="amount">$400</span></ins>
                                        </td>
                                        <td data-title="Action "  class="data_cell awm_service_action">
                                            <span class="label label-small label-important">No Available</span>
                                        </td>
                                        <td class="data_cell awm_service_arrow">
                                            <a href="#collapse54" class="nav-toggle">
                                                <div class="arrow-down">
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="expanded">
                                        <td colspan="7">
                                            <input id="row_1" name="#" type="checkbox"/>
                                            <div id="collapse54" style="display:none" class="expand">
                                                <div class="column_100">
                                                    <table class="qlabs_grid_container awm_single_services ins_table service_tlt " width="100%">
                                                        <thead>
                                                            <tr class="header_row">
                                                                <td class="header_cell">
                                                                    <h4 >Ubunto</h4>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="data_container">
                                                            <tr class="odd">
                                                                <td class="data_cell awm_single_service_name">
                                                                    <div class="row-fluid">
                                                                        <div class="span9">
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Requested by :</b></div><div class="span9"><a href="#" class="request_link"> <a href="#" class="request_link">  Anna Pollard</a>  </a></div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Location :</b></div><div class="span9">  Paccar Hall, 1st Floor NE Stevens Way, Seattle </div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Details :</b></div><div class="span9">  We will need 3 workers to set up chairs and tables and help direct traffic for our event. Please wear business casual and a red tie </div>
                                                                            </div>
                                                                            <div class="row-fluid minywans_list">
                                                                                <div class="span3 "><b>Tags :</b></div><div class="span9">  <span class="label">Event</span><span class="label">Labour</span> </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="span3">
                                                                            <img src="<?php echo get_template_directory_uri() ?>/images/arrow-left.png"/>
                                                                            <a href="#fakelink" class="btn btn-large btn-block btn-success btn-apply">Apply Job</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <td colspan="7">
                        <table class="ins_table">
                            <tr class="data_even">
                                <td data-title="Services" class="data_cell awm_service_title" >
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/CIRC-logo_300dpi_PNG.png"/>
                                </td>
                                <td data-title="Demand" class="data_cell awm_service_demand">
                                    <span class="service-total-demand" data-count="0">12</span>
                                    <div>
                                        May<b  class="service-client-demand" data-count="0">2013</b>
                                    </div>
                                    <div class="demand"> Friday</div>
                                </td>
                                <td data-title="Supply" class="data_cell awm_service_supply">
                                    <div class="row-fluid">
                                        <div class="span5">
                                            <span data-count="0" class="total-exchange-count">8:00</span>
                                            <div>
                                                am
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <b class="time-bold">to</b>
                                        </div>
                                        <div class="span5">
                                            <span data-count="0" class="total-exchange-count">12:00</span>
                                            <div>
                                                pm
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td data-title="Price"  class="data_cell awm_service_discount">
                                    <ins><span class="amount">$25</span></ins>
                                </td>
                                <td data-title="Action "  class="data_cell awm_service_action">
                                    <span class="label label-small label-success">Available</span>
                                </td>
                                <td class="data_cell awm_service_arrow">
                                    <a href="#collapse55" class="nav-toggle">
                                        <div class="arrow-down">
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr class="expanded">
                                <td colspan="7">
                                    <input id="row_1" name="#" type="checkbox"/>
                                    <div id="collapse55" style="display:none" class="expand">
                                        <div class="column_100">
                                            <table class="qlabs_grid_container awm_single_services ins_table service_tlt " width="100%">
                                                <thead>
                                                    <tr class="header_row">
                                                        <td class="header_cell">
                                                            <h4 >CIRC</h4>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody class="data_container">
                                                    <tr class="odd">
                                                        <td class="data_cell awm_single_service_name">
                                                            <div class="row-fluid">
                                                                <div class="span9">
                                                                    <div class="row-fluid minywans_list">
                                                                        <div class="span3 "><b>Requested by :</b></div><div class="span9"> <a href="#" class="request_link">  Anna Pollard</a> </div>
                                                                    </div>
                                                                    <div class="row-fluid minywans_list">
                                                                        <div class="span3 "><b>Location :</b></div><div class="span9">  Paccar Hall, 1st Floor NE Stevens Way, Seattle </div>
                                                                    </div>
                                                                    <div class="row-fluid minywans_list">
                                                                        <div class="span3 "><b>Details :</b></div><div class="span9">  We will need 3 workers to set up chairs and tables and help direct traffic for our event. Please wear business casual and a red tie </div>
                                                                    </div>
                                                                    <div class="row-fluid minywans_list">
                                                                        <div class="span3 "><b>Tags :</b></div><div class="span9">  <span class="label">Event</span><span class="label">Labour</span> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="span3">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.png"/>
                                                                    <a href="#fakelink" class="btn btn-large btn-block btn-success btn-apply">Apply Job</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    </tr>
                    <tr class="data_even">
                        <!-- table 1-->
                        <td colspan="7">
                            <table class="ins_table">
                                <tr class="data_even">
                                    <td data-title="Services" class="data_cell awm_service_title" >
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/livefyre-logo.png"/>
                                    </td>
                                    <td data-title="Demand" class="data_cell awm_service_demand">
                                        <span class="service-total-demand" data-count="1">10</span>
                                        <div>
                                            June<b  class="service-client-demand" data-count="1">2013</b>
                                        </div>
                                        <div class="demand"> Sunday</div>
                                    </td>
                                    <td data-title="Supply" class="data_cell awm_service_supply">
                                        <div class="row-fluid">
                                            <div class="span5">
                                                <span data-count="0" class="total-exchange-count">8:00</span>
                                                <div>
                                                    am
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <b class="time-bold">to</b>
                                            </div>
                                            <div class="span5">
                                                <span data-count="0" class="total-exchange-count">12:00</span>
                                                <div>
                                                    pm
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="Price"  class="data_cell awm_service_discount">
                                        <ins><span class="amount">$28</span></ins>
                                    </td>
                                    <td data-title="Action "  class="data_cell awm_service_action">
                                        <span class="label label-small label-success">Available</span>
                                    </td>
                                    <td class="data_cell awm_service_arrow">
                                        <a href="#collapse57" class="nav-toggle">
                                            <div class="arrow-down">
                                            </div>
                                        </a>

                                    </td>
                                </tr>
                                <tr class="expanded">
                                    <td colspan="7">
                                        <input id="row_1" name="#" type="checkbox"/>
                                        <div id="collapse57" style="display:none" class="expand">
                                            <div class="column_100">
                                                <table class="qlabs_grid_container awm_single_services ins_table service_tlt " width="100%">
                                                    <thead>
                                                        <tr class="header_row">
                                                            <td class="header_cell">
                                                                <h4 >Lifefyre</h4>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="data_container">
                                                        <tr class="odd">
                                                            <td class="data_cell awm_single_service_name">
                                                                <div class="row-fluid">
                                                                    <div class="span9">
                                                                        <div class="row-fluid minywans_list">
                                                                            <div class="span3 "><b>Requested by :</b></div><div class="span9"> <a href="#" class="request_link">  Anna Pollard</a> </div>
                                                                        </div>
                                                                        <div class="row-fluid minywans_list">
                                                                            <div class="span3 "><b>Location :</b></div><div class="span9">  Paccar Hall, 1st Floor NE Stevens Way, Seattle </div>
                                                                        </div>
                                                                        <div class="row-fluid minywans_list">
                                                                            <div class="span3 "><b>Details :</b></div><div class="span9">  We will need 3 workers to set up chairs and tables and help direct traffic for our event. Please wear business casual and a red tie </div>
                                                                        </div>
                                                                        <div class="row-fluid minywans_list">
                                                                            <div class="span3 "><b>Tags :</b></div><div class="span9">  <span class="label">Event</span><span class="label">Labour</span> </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span3">
                                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.png"/>
                                                                        <a href="#fakelink" class="btn btn-large btn-block btn-success btn-apply">Apply Job</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="data_even">
                        <!-- table 1-->
                        <td colspan="7">
                            <table class="ins_table">
                                <tr class="data_even">
                                    <td data-title="Services" class="data_cell awm_service_title" >
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/bitly_logo.png"/>
                                    </td>
                                    <td data-title="Demand" class="data_cell awm_service_demand">
                                        <span class="service-total-demand" data-count="1">05</span>
                                        <div>
                                            May<b  class="service-client-demand" data-count="1">2013</b>
                                        </div>
                                        <div class="demand"> Wednesday</div>
                                    </td>
                                    <td data-title="Supply" class="data_cell awm_service_supply">
                                        <div class="row-fluid">
                                            <div class="span5">
                                                <span data-count="0" class="total-exchange-count">8:00</span>
                                                <div>
                                                    am
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <b class="time-bold">to</b>
                                            </div>
                                            <div class="span5">
                                                <span data-count="0" class="total-exchange-count">12:00</span>
                                                <div>
                                                    pm
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="Price"  class="data_cell awm_service_discount">
                                        <ins><span class="amount">$400</span></ins>
                                    </td>
                                    <td data-title="Action "  class="data_cell awm_service_action">
                                        <span class="label label-small label-important">No Available</span>
                                    </td>
                                    <td class="data_cell awm_service_arrow">
                                        <a href="#collapse58" class="nav-toggle">
                                            <div class="arrow-down">
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="expanded">
                                    <td colspan="7">
                                        <input id="row_1" name="#" type="checkbox"/>
                                        <div id="collapse58" style="display:none" class="expand">
                                            <div class="column_100">
                                                <table class="qlabs_grid_container awm_single_services ins_table service_tlt " width="100%">
                                                    <thead>
                                                        <tr class="header_row">
                                                            <td class="header_cell">
                                                                <h4 >Bitly</h4>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="data_container">
                                                        <tr class="odd">
                                                            <td class="data_cell awm_single_service_name">
                                                                <div class="row-fluid">
                                                                    <div class="span9">
                                                                        <div class="row-fluid minywans_list">
                                                                            <div class="span3 "><b>Requested by :</b></div><div class="span9"> <a href="#" class="request_link">  Anna Pollard</a>  </div>
                                                                        </div>
                                                                        <div class="row-fluid minywans_list">
                                                                            <div class="span3 "><b>Location :</b></div><div class="span9">  Paccar Hall, 1st Floor NE Stevens Way, Seattle </div>
                                                                        </div>
                                                                        <div class="row-fluid minywans_list">
                                                                            <div class="span3 "><b>Details :</b></div><div class="span9">  We will need 3 workers to set up chairs and tables and help direct traffic for our event. Please wear business casual and a red tie </div>
                                                                        </div>
                                                                        <div class="row-fluid minywans_list">
                                                                            <div class="span3 "><b>Tags :</b></div><div class="span9">  <span class="label">Event</span><span class="label">Labour</span> </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span3">
                                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.png"/>
                                                                        <a href="#fakelink" class="btn btn-large btn-block btn-success btn-apply">Apply Job</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>		</tbody>
                </table>
                <div class="pagination" style=" margin-left: 263px; ">
                    <ul>
                        <li class="previous"><a href="#fakelink" class="fui-arrow-left"></a></li>
                        <li class="active"><a href="#fakelink">1</a></li>
                        <li><a href="#fakelink">2</a></li>
                        <li><a href="#fakelink">3</a></li>
                        <li><a href="#fakelink">4</a></li>
                        <li><a href="#fakelink">5</a></li>
                        <li><a href="#fakelink">6</a></li>
                        <li><a href="#fakelink">7</a></li>
                        <li><a href="#fakelink">8</a></li>
                        <li><a href="#fakelink">9</a></li>
                        <li><a href="#fakelink">10</a></li>
                        <li class="pagination-dropdown dropup">
                            <i class="dropdown-arrow"></i>
                            <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fui-triangle-up"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#fakelink">10&ndash;20</a></li>
                                <li><a href="#fakelink">20&ndash;30</a></li>
                                <li><a href="#fakelink">40&ndash;50</a></li>
                            </ul>
                        </li>
                        <li class="next"><a href="#fakelink" class="fui-arrow-right"></a></li>
                    </ul>
                </div> <!-- /pagination -->
            </section>
        </div>

        <!-- /tabs -->
        <div class="tab-pane active" id="tab2">
            <div class="breadcrumb-text">
                <p>
                    <a href="myjobs.html">My Jobs</a>
                    Job List
                </p>
            </div>
            <div id="jobs-list">
                <div class="tab-pane" id="tab2">
                    <div class="dialog dialog-success">
                        Add a Job Listing 
                        <a href="#"> <button class="btn btn-primary btn-wide mll">
                                <i class="fui-mail"></i>
                                Add Jobs
                            </button><a/>
                    </div>
                    <div id="add-job-form" style="display:blobk;">
                    <form class="form-horizontal frm_job">
                        <div class="control-group small">
                            <label class="control-label" for="inputtask">Tasks</label>
                            <div class="controls ">
                                <input type="text" id="tasks"value="" placeholder="" class="span3">
                            </div>
                        </div>
                        <div class="control-group small">
                            <label class="control-label" for="inputtask">Start</label>
                            <div class="controls">
                                <div class="input-prepend input-datepicker">
                                    <button type="button" class="btn"><span class="fui-calendar"></span></button>
                                    <input type="text" id="start-date" class="span1" value="14 March, 2013" id="datepicker-01">
                                </div>
                                <input class="span2 timepicker" id="start-time" type="text" > &nbsp;PDT
                            </div>
                        </div>
                        <div class="control-group small">
                            <label class="control-label" for="inputtask">End</label>
                            <div class="controls">
                                <div class="input-prepend input-datepicker">
                                    <button type="button" class="btn"><span class="fui-calendar"></span></button>
                                    <input type="text" id="end-date" class="span1" value="14 March, 2013">
                                </div>
                                <input class="span2 timepicker" id="end-time" type="text" > &nbsp;PDT
                            </div>
                        </div>
                        <div class="control-group small">
                            <label class="control-label" for="inputtask">Required</label>
                            <div class="controls ">
                                <input type="text" id="required" placeholder="" value="0" class="spinner">
                            </div>
                        </div>
                        <div class="control-group small">
                            <label class="control-label" for="inputtask">Wages</label>
                            <div class="controls ">
                                <input type="text" id="wages" placeholder=""  class="spinner">
                            </div>
                        </div>
                        <div class="control-group small">
                            <label class="control-label" for="inputtask">Location</label>
                            <div class="controls ">
                                <input type="text" id="location" value="" placeholder="" class="span3">
                            </div>
                        </div>
                        <div class="control-group small">
                            <label class="control-label" for="inputtask">Details</label>
                            <div class="controls ">
                                <textarea class="span6" rows="10" id="details" cols="4" placeholder="Add comment..." style="height:70px;"></textarea>
                            </div>
                        </div>
                        <hr>
                        <a href="#sendform" class="btn btn-large btn-block btn-inverse span2" >Submit</a>
                        <div class="clear"></div>
                    </form>
                </div>

                </div>
                <div class="row-fluid list-jobs"  style="background: #C7C9C5;">
                    <div class="span12 jobs-details">
                        <div class="span2 img-logo"> <img src="<?php echo get_template_directory_uri(); ?>/images/livefyre-logo.png"/> </div>
                        <div class="span3 minyawns-select"><span>4</span>
                            <div>Minyawns Have Applied</div> 
                        </div>
                        <div class="span3 jobs-date"> 
                            <div class="posteddate"> Posted Date : <span>10 April 2013</span></div>
                            <div class="jobsdate"> Jobs Date : <span>20 June 2013</span></div>
                        </div>
                        <div class="span3 job-duration">
                            <div class="row-fluid">
                                <div class="span5">
                                    <span data-count="0" class="total-exchange-count">11:00</span>
                                    <div>
                                        pm
                                    </div>
                                </div>
                                <div class="span2">
                                    <b class="time-bold">to</b>
                                </div>
                                <div class="span5">
                                    <span data-count="0" class="total-exchange-count">2:00</span>
                                    <div>
                                        pm
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span1 wages">
                            $100
                        </div>
                    </div>
                    <div class="span12 expand">
                        <div class="span8 details"> 
                            <div class="row-fluid">
                                <div class="span4"> <img src="<?php echo get_template_directory_uri(); ?>/images/livefyre-logo.png"/></div>
                                <div class="span8">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </br>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </div>
                            </div><br>
                            <div class="row-fluid minyawansgrid">
                                <div class="span6"><img src="<?php echo get_template_directory_uri(); ?>/images/iconsult1.png"/><b> Simon Srewell</b>
                                    <a href="#fakelink" >
                                        <i class="icon-thumbs-up"></i> 100
                                    </a> 
                                    <a href="#fakelink"  class="icon-thumbs">
                                        <i class="icon-thumbs-down"></i> 200
                                    </a> 
                                </div>
                                <div class="span6"> <img src="<?php echo get_template_directory_uri(); ?>/images/iconsult2.png"/><b> Riya mactheel</b>
                                    <a href="#fakelink" >
                                        <i class="icon-thumbs-up"></i> 50
                                    </a> 
                                    <a href="#fakelink"  class="icon-thumbs">
                                        <i class="icon-thumbs-down"></i> 50
                                    </a>

                                </div>
                                <div class="span6"><img src="<?php echo get_template_directory_uri(); ?>/images/iconsult3.png"/><b> Richard Andrews</b>
                                    <a href="#fakelink" >
                                        <i class="icon-thumbs-up"></i> 10
                                    </a> 
                                    <a href="#fakelink"  class="icon-thumbs">
                                        <i class="icon-thumbs-down"></i> 20
                                    </a>

                                </div>
                                <div class="span6"><img src="<?php echo get_template_directory_uri(); ?>/images/iconsult4.png"/> <b> Albert Srewell</b>
                                    <a href="#fakelink" >
                                        <i class="icon-thumbs-up"></i> 50
                                    </a> 
                                    <a href="#fakelink"  class="icon-thumbs">
                                        <i class="icon-thumbs-down"></i> 100
                                    </a>

                                </div>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/left-arrow.png" class="arrow-left"/>
                            </div>

                        </div>

                        <div class="span4"><a href="#fakelink" class="btn btn-large btn-block btn-success btn-apply ">Apply</a> </br>
                            <a href="#fakelink" class="btn btn-large btn-block btn-danger btn-unapply">Un Apply</a></div></div>
                </div>

                <div class="row-fluid list-jobs" style="background: #C7C9C5;">
                    <div class="span12 jobs-details">
                        <div class="span2 img-logo"> <img src="<?php echo get_template_directory_uri(); ?>/images/walmart-logo.png"/> </div>
                        <div class="span3 minyawns-select"><span>4</span>
                            <div>Minyawns Have Applied</div> 
                        </div>
                        <div class="span3 jobs-date"> 
                            <div class="posteddate"> Posted Date : <span>8 July 2013</span></div>
                            <div class="jobsdate"> Jobs Date : <span>10 July 2013</span></div>
                        </div>
                        <div class="span3 job-duration">
                            <div class="row-fluid">
                                <div class="span5">
                                    <span data-count="0" class="total-exchange-count">08:00</span>
                                    <div>
                                        pm
                                    </div>
                                </div>
                                <div class="span2">
                                    <b class="time-bold">to</b>
                                </div>
                                <div class="span5">
                                    <span data-count="0" class="total-exchange-count">12:00</span>
                                    <div>
                                        pm
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span1 wages">
                            $50
                        </div>
                    </div>
                    <div class="span12 expand">
                        <div class="span8 details"> 
                            <div class="row-fluid">
                                <div class="span4"> <img src="<?php echo get_template_directory_uri(); ?>/images/walmart-logo.png"/></div>
                                <div class="span8">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </br>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </div>
                            </div><br>
                            <div class="row-fluid minyawansgrid">
                                <div class="span6"><img src="<?php echo get_template_directory_uri(); ?>/images/iconsult1.png"/><b> Simon Srewell</b>
                                    <a href="#fakelink" >
                                        <i class="icon-thumbs-up"></i> 100
                                    </a> 
                                    <a href="#fakelink"  class="icon-thumbs">
                                        <i class="icon-thumbs-down"></i> 200
                                    </a> 
                                </div>
                                <div class="span6"> <img src="<?php echo get_template_directory_uri(); ?>/images/iconsult2.png"/><b> Riya mactheel</b>
                                    <a href="#fakelink" >
                                        <i class="icon-thumbs-up"></i> 50
                                    </a> 
                                    <a href="#fakelink"  class="icon-thumbs">
                                        <i class="icon-thumbs-down"></i> 50
                                    </a>

                                </div>
                                <div class="span6"><img src="<?php echo get_template_directory_uri(); ?>/images/iconsult3.png"/><b> Richard Andrews</b>
                                    <a href="#fakelink" >
                                        <i class="icon-thumbs-up"></i> 10
                                    </a> 
                                    <a href="#fakelink"  class="icon-thumbs">
                                        <i class="icon-thumbs-down"></i> 20
                                    </a>

                                </div>
                                <div class="span6"><img src="<?php echo get_template_directory_uri(); ?>/images/iconsult4.png"/> <b> Albert Srewell</b>
                                    <a href="#fakelink" >
                                        <i class="icon-thumbs-up"></i> 50
                                    </a> 
                                    <a href="#fakelink"  class="icon-thumbs">
                                        <i class="icon-thumbs-down"></i> 100
                                    </a>

                                </div>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/left-arrow.png" class="arrow-left"/>
                            </div>

                        </div>

                        <div class="span4">
                            <a href="#fakelink" class="btn btn-large btn-block btn-success btn-apply ">Apply</a> </br>
                            <a href="#fakelink" class="btn btn-large btn-block btn-danger btn-unapply">Un Apply</a></div>
                    </div>
                </div>

                <div class="row-fluid list-jobs">
                    <div class="span12 jobs-details">
                        <div class="span2 img-logo"> <img src="<?php echo get_template_directory_uri(); ?>/images/UbuntuLogo.png"/> </div>
                        <div class="span3 minyawns-select"><span>4</span>
                            <div>Minyawns Have Applied</div> 
                        </div>
                        <div class="span3 jobs-date"> 
                            <div class="job-complete"> Job Completed</div>
                        </div>
                        <div class="span3 job-duration">
                            <div class="row-fluid">
                                <div class="span5">
                                    <span data-count="0" class="total-exchange-count">11:00</span>
                                    <div>
                                        pm
                                    </div>
                                </div>
                                <div class="span2">
                                    <b class="time-bold">to</b>
                                </div>
                                <div class="span5">
                                    <span data-count="0" class="total-exchange-count">2:00</span>
                                    <div>
                                        pm
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span1 wages">
                            $100
                        </div>
                    </div>
                    <div class="span12 expand">
                        <div class="span8 details"> 
                            <div class="row-fluid">
                                <div class="span4"> <img src="<?php echo get_template_directory_uri(); ?>/images/UbuntuLogo.png"/></div>
                                <div class="span8">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </br>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </div>
                            </div><br>
                            <div class="row-fluid minyawansgrid">

                                <img src="<?php echo get_template_directory_uri(); ?>/images/left-arrow.png" class="arrow-left"/>
                            </div>

                        </div>

                        <div class="span4">
                            <div class="like_btn">
                                <b>Your Job Ratings</b>

                                <a href="#fakelink">
                                    <i class="icon-thumbs-up"></i> 10
                                </a> 
                                <a href="#fakelink" class="icon-thumbs">
                                    <i class="icon-thumbs-down"></i> 20
                                </a> 
                            </div> 

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
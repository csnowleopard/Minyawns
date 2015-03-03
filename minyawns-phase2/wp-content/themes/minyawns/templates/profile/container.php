<div class="container">
    <div  id="main-content" class="main-content bg-white" >
        <div class="breadcrumb-text">
            <p id="bread-crumbs-id">
                <a href="<?php echo site_url()."/jobs" ?>">View All Jobs</a>

            </p>
        </div>
<div id="loader1" class="modal_ajax" ></div>

        <div id="profile-view" class="row-fluid min_profile">

        </div>

        <hr>
        <div id="my-history" class="row-fluid">
            <div class="span12">
                <section id="no-more-tables">
                    <table class="qlabs_grid_container tablesorter jobs_table">		
                        <thead>
                            <tr class="header_row">
                                <td colspan="7" class="header_cell">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <h3 class="page-title"> My History</h3> <!-- header label -->
                                            Applied, pending and completed job history
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="subheader_row profile-header">
                                <th class="subheader_cell awm_exchange_service_tlt service_tlt headerSortDown profile-logo">Logo</th>
                                <th class="subheader_cell awm_exchange_service_demand headerSortDown profile-date">Session Date</th>
                                <th class="subheader_cell awm_exchange_service_supply headerSortDown profile-time">Duration</th>
                                <th class="subheader_cell awm_exchange_service_discount headerSortDown profile-wages">Wages</th>
                                <th class="subheader_cell awm_exchange_services_action profile-rating">Ratings</th>
                            </tr>
                        </thead>
                        <tbody class="data_container">
                            <tr class="data_even">
                                <!-- table 1-->
                                <td colspan="7">
                                    <table class="ins_table">
                                        <div id="loader2" class="modal_ajax_large_dashboard" ><!-- Place at bottom of page --></div>

                                    </table>
                                </td>
                            </tr>

                        </tbody>
                    </table>




                </section>
                <br>
            </div>
        </div>
    </div>
</div>

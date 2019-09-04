<div id="village" class="tab-pane fade">
    <div class="page-header">
        <h1>
            <small>
                Setup Region Type
            </small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Setup Village
        </h1>
    </div>

    <div class="nav-search" id="nav-search">

            <span class="input-icon">
                <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                <i class="ace-icon fa fa-search nav-search-icon"></i>
                <a href="#" data-toggle="modal" data-target="#AddVillageModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Village</a>
            </span>

    </div>
    <div class="row" style="margin-top: 34px;">&nbsp;</div>
    <div class="row">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Province Name</th>
                <th>District Name</th>
                <th>Sub District Name</th>
                <th>Village Name</th>
                <th width="17%">BPS Code</th>
                <th width="17%">Status</th>
                <th width="13%">Actions</th>
            </tr>
            </thead>

            <tbody>
            </tbody>
        </table>
    </div>
</div>
@include('datamaster.region.village.form') 
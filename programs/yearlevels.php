<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Manage Year Levels</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col text-center">
                        <label for="progidylvls">Program</label>
                        <select id="progidylvls" name="progidylvls" class="form-control form-control-sm text-center form-select upssecesec reqsingle req" required>

                        </select>
                    </div>
                    <div class="col text-center">
                        <label for="progtype">Program type</label>
                        <select id="progtype" name="progtype" class="form-control form-control-sm text-center form-select upssecesec reqsingle req" required>

                        </select>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-auto">
                        <label for="entriessec">Entries</label>
                        <br>
                        <select id="entriesylvls" name="entriesylvls" class="form-select-sm entries  ">
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-auto text-center">
                        <label for="pageylvls">Pages</label>
                        <div class="input-group input-group-sm text-end">
                            <button name="prevnxtbtnylvls" class="btn btn-sm btn-secondary prev me-1">
                                <i class="bi bi-caret-left"></i></button>
                            <select name="pageylvls" id="pageylvls" class="form-control  page ">
                                <option value="0"></option>
                            </select>
                            <button name="prevnxtbtnylvls" class="btn btn-sm btn-secondary next ms-1 ">
                                <i class="bi bi-caret-right"></i></button>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-2 text-start">
                        <label for="search">Search</label>
                        <input type="text" class="form-control search " name="searchylvls" id="searchylvls" placeholder="Search...">
                    </div>

                </div>
                <div class="row p-2 table-responsive">
                    <table id="ylvlstb" class="table table-sm table-striped table-hover text-center table-bordered">
                        <tbody>
                            <tr>
                                <td colspan="3"> <button onclick="setupaddylvl(this);" class="btn btn-sm btn-primary">Add Year lvl</button></td>
                            </tr>
                            <tr>
                                <td colspan="3">Select Program</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="closemodalbtn" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script src="../funcs.js"></script>
<script src="yearlevels.js"></script>
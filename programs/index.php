<?php
include_once '../Menu/Header.php';
include 'yearlevels.php';

addlogs('Visit Page: Manage Programs');

?>
<?php if (!(valid4() || valid2())) {
    echo '<script>window.location="../Dashboard";</script>';
} ?>
<main id="main" class="main">
    <div class="float-end">
        <button class="btn btn-sm btn-primary" onclick="manual(this);">Manual</button>
    </div>
    <div class="pagetitle">
        <h1>School Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../Dashboard/">Home</a></li>
                <li class="breadcrumb-item">Programs</li>
                <!-- <li class="breadcrumb-item"></li> -->
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row  mt-3">
                            <div class="col text-start">
                                <label for="ae">Entries</label>
                                <select id="entries" name="entries" class="form-select-sm entries resettb">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                </select>

                            </div>
                            <div class="col-2 text-center">
                                <button onclick="manageylvls(this);" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Manage Year Levels</button>
                            </div>
                            <div class="col-3 text-end">
                                <input type="text" class="form-control search resettb" name="search" id="search" placeholder="Search...">
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col table-responsive">
                                <table class="table table-bordered table-striped text-center" id="programstb">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Code</th>
                                            <th>Desc.</th>
                                            <th>Duration</th>
                                            <th>Availability</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6">
                                                <button class="btn  btn-primary" onclick="setaddprogram(this);"> <span>Add Program </span><i class="bi bi-journal-plus"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <!-- inputs -->
                                            <td colspan="2">
                                                <label for="progcode" class="fw-bold">Program Code</label>
                                                <input type="text" class="form-control " onkeyup="this.value = this.value.toUpperCase();" in="Program Code" title="must be 3 characters or more" name="progcode" id="progcode" minlength="3" maxlength="10" required>
                                            </td>
                                            <td>
                                                <label for="progdesc" class="fw-bold">Program Description</label>
                                                <input type="text" class="form-control" name="progdesc" in="Program Description" title="must be 5 characters or more" id="progdesc" minlength="5" maxlength="200" required>
                                            </td>
                                            <td>
                                                <label for="progduration" class="fw-bold">Program Duration</label>
                                                <select name="progduration" id="progduration" in="Select Program Duration" title="" class="form-control" minlength="1" required>
                                                    <option value="">Select Duration</option>
                                                    <option value="2">2 Years</option>
                                                    <option value="4">4 Years</option>
                                                    <option value="5">5 Years</option>
                                                </select>
                                            </td>
                                            <td>
                                                <label for="progavailability" class="fw-bold">Availability</label>
                                                <select name="progavailability" id="progavailability" in="Select Program Duration" title="" class="form-control" value="4" minlength="1" required>
                                                    <option value="Available">Available</option>
                                                    <option value="Unavailable">Unavailable</option>
                                                </select>
                                            </td>
                                            <td class="align-middle">
                                                <button type="submit" class="btn btn-sm btn-success" onclick="addprogram(this);"><span>Save </span><i class="bi bi-check-circle"></i></button>

                                                <button class="btn btn-sm btn-danger" onclick="cancelbtn(this);"><span>Cancel </span><i class="bi bi-x-circle"></i></button>
                                            </td>
                                            <!-- inputs -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row  mt-2">
                            <div class="col"></div>
                            <div class="col-auto text-center">
                                <div class="input-group input-group-sm text-end">
                                    <button name="nextbtn" class="btn btn-sm btn-secondary prev me-1">
                                        <i class="bi bi-caret-left"></i></button>
                                    <select name="page" id="page" class="form-control resettb page">
                                    </select>
                                    <button name="prevbtn" class="btn btn-sm btn-secondary next ms-1 ">
                                        <i class="bi bi-caret-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="programs.js"></script>
<?php
include_once '../Menu/Footer.php';
?>
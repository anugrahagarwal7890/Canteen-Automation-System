<section class="content">
    <div class="box box-primary add_student_form" style="<?= ($result) ? "" : 'display:none' ?>">
        <div class="box-header with-border">
            <h3 class="box-title">Add Student</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?= ANUGRAH_URL . "users/index" ?>">
            <?= (isset($result['users']['id'])) ? "<input hidden name='id' value='" . $result['users']['id'] . "'>" : "" ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>University Roll No.</label>
                            <input type="number" class="form-control" required="" placeholder="Enter University Roll"
                                   name="university_roll"
                                   value="<?= ($result) ? $result['users']["universityrollno"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Name" name="name"
                                   value="<?= ($result) ? $result['users']["name"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email Id</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Name" name="email"
                                   value="<?= ($result) ? $result['users']["email"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" required="" placeholder="Mobile Number"
                                   name="mobile" value="<?= ($result) ? $result['users']["mobile"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" <?= (!$result) ? "required" : "" ?>
                                   placeholder="Enter Password" name="password">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Year</label>
                            <div class="clearfix"></div>
                            <select class="form-control" name="year_id">
                                <option value="" selected>Select</option>
                                <?php
                                if (isset($year) && $year) {
                                    foreach ($year as $co)
                                    {
                                        ?>
                                        <option <?= (isset($result['users']) && $result['users']['year_id']==$co["id"]) ? "SELECTED" : "" ?> value="<?= ($co)?$co["id"]:""?>"><?= $co['name'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit"
                                    class="btn btn-primary"><?= ($result) ? "Update" : "Submit" ?></button>
                            <button type="button" class="btn btn-danger" onclick="$('.add_student_form').hide('slow')">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </form>
    </div>

    <section class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Student List</h3>
            <button class="btn btn-primary pull-right btn-xs add_student">Add Student</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="adv-table">
                <table class="table table-striped table-responsive" style="overflow-x: scroll" id="student_table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>University Roll</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <!--                            <th><input></th>-->
                        <th></th>
                        <th><input class="form-control input-sm search-input-text" data-column="1"></th>
                        <th><input class="form-control input-sm search-input-text" data-column="2"></th>
                        <th><input class="form-control input-sm search-input-text" data-column="3"></th>
                        <th><input class="form-control input-sm search-input-text" data-column="4"></th>
                        <th><input class="form-control input-sm search-input-text" data-column="5"></th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</section>
<script>
    $(document).ready(function () {
        var table = "student_table";
        var dataTable = $("#" + table).DataTable({
            processing: true,
            pageLength: 10,
            serverSide: true,
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [0, -1] /* 1st one, start by the right */
            }],
            order: [[0, "desc"]],
            ajax: {
                url: "<?= ANUGRAH_URL ?>users/ajax_student_list", // json datasource
                type: "post", // method  , by default get
                error: function () {  // error handling
                    $("." + table + "-error").html("");
                    $("#" + table + "_processing").css("display", "none");
                }
            }
        });
        $("#" + table + "_filter").css("display", "none");
        $('.search-input-text').on('keyup', function () {   // for text boxes
            var i = $(this).attr('data-column');  // getting column index
            var v = $(this).val();  // getting search input value
            dataTable.columns(i).search(v).draw();
        });
        $('.search-input-select').on('change', function () {   // for select box
            var i = $(this).attr('data-column');
            var v = $(this).val();
            dataTable.columns(i).search(v).draw();
        });
    });

    $(".add_student").click(function () {
        $(".add_student_form input").val();
        $(".add_student_form").show("slow");
    });
</script>

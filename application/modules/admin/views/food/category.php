<section class="content">
    <div class="box box-primary add_category_form" style="<?= ($result) ? "" : 'display: none' ?>">
        <div class="box-header with-border">
            <h3 class="box-title">Add Category</h3>
        </div>
        <form role="form" method="post" action="<?=ANUGRAH_URL."food/category"?>">
            <div class="box-body">
                <div class="row">
                    <?= ($result) ? "<input hidden name='id' value='" . $result['id'] . "'>" : "" ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" required="" placeholder="Enter name" name="name" value="<?= ($result) ? $result['name'] : "" ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?= ($result) ? "Update" : "Submit" ?></button>
                            <button type="button" class="btn btn-danger" onclick="$('.add_category_form').hide('slow')">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </form>
    </div>

    <section class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Category List</h3><button class="btn btn-primary pull-right btn-xs add_category">Add Category</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="adv-table">
                <table class="table table-striped table-responsive" style="overflow-x: scroll" id="category_table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <th><input></th>
                        <th><input></th>
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
        $('#category_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                'url': "<?= ANUGRAH_URL ?>food/ajax_category_list",
                'method': 'post'
            }
        });
    });

    $(".add_category").click(function () {
        $(".add_category_form").show("slow");
    });
</script>

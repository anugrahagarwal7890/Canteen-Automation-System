<section>
    <div class="box-body">
        <div class="adv-table">
            <table class="table table-striped table-responsive" style="overflow-x: scroll" id="feedback_table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Feedback</th>
                    <!--                    <th>Material</th>-->
                    <!--                    <th>Total</th>-->
                </tr>
                </thead>
                <thead>
                <tr>
                    <!--                            <th><input></th>-->
                    <!--                        <th><input></th>-->
                    <th><input></th>
                    <th><input></th>
                    <!--                            <th><input></th>
                                                <th><input></th>
                                                <th><input></th>
                                                <th><input></th>
                                                <th><input></th>
                                                <th><input></th>-->


                </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#feedback_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                'url': "<?= ANUGRAH_URL ?>feedback/ajax_feedback_list",
                'method': 'post'
            }
        });
    });

</script>

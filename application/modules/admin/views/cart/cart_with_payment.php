<section>
    <div class="box-body">
        <div class="adv-table">
            <table class="table table-striped table-responsive" style="overflow-x: scroll" id="company_table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Customer Name</th>
                    <th>Food</th>
                    <th>Quantity</th>
                    <th>Total</th>
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
                    <th><input></th>
                    <th><input></th>
                    <th><input></th>
                    <!--                    <th><input></th>-->
                    <!--                    <th><input></th>-->
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#company_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                'url': "<?= ANUGRAH_URL ?>cart/ajax_cart_with_payment",
                'method': 'post'
            }
        });
    });

</script>

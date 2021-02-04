
<style>
    
input.btn.btn-primary {
    display: none;
}
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Add Sales</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Add Sales</li>
            </ol>
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Add Sales
                    </div>
                    <div class="container mt-1">
                        <form action="sell.php" method="post">

                            <table class="add">
                                <tbody>
                                    <tr>
                                        <th> <label for="amount">sales</label></th>
                                        <td><input type="number" class="form-control" id="amount" name="amount" placeholder="Rs" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="hidden" class="form-control" id="type" name="type" value="sell"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Add" class="btn btn-primary"></td>
                                    </tr>



                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="panel panel-primary" style="border-color: #b52727;">
                    <div class="panel-heading" style="background-color: #b52727;">
                        Add Payment
                    </div>
                    <div class="container mt-1">
                        <form action="sell.php" method="post">

                            <table class="add">
                                <tbody>
                                    <tr>
                                        <th> <label for="amount">Payment</label></th>
                                        <td><input type="number" class="form-control" id="amount" name="amount" placeholder="Rs" required></td>
                                    </tr>
                                    <tr>
                                        <th> <label for="description">Description</label></th>
                                        <td><input type="text" class="form-control" id="description" name="description" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="hidden" class="form-control" id="payment" name="type" value="payment"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Add" class="btn btn-primary" style="background-color: #b52727;"></td>
                                    </tr>



                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="panel panel-primary" style="border-color: #28a745;">
                    <div class="panel-heading" style="background-color: #28a745;">
                        Add Expense
                    </div>
                    <div class="container mt-1">
                        <form action="sell.php" method="post">

                            <table class="add">
                                <tbody>
                                    <tr>
                                        <th> <label for="amount">Expense</label></th>
                                        <td><input type="number" class="form-control" id="amount" name="amount" placeholder="Rs" required></td>
                                    </tr>
                                    <tr>
                                        <th> <label for="exp_description">Description</label></th>
                                        <td><input type="text" class="form-control" id="exp_description" name="exp_description" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="hidden" class="form-control" id="type" name="type" value="expense"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Add" class="btn btn-primary" style="background-color: #28a745;"></td>
                                    </tr>



                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered" id="item_table">
                    <thead>
                        <tr>
                            <th>Opening Balanace</th>
                            <th>Today Sales</th>
                            <th>Payments</th>
                            <th>Expense</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currect_date = date('Y-m-d');
                        $sql = "SELECT * FROM sell Where `date`LIKE  '%$currect_date%'";
                        $today_sell = 0;
                        $payments = 0;
                        $today_expense = 0;
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['type'] == "sell") {
                                $today_sell += $row['amount'];
                            } 
                            else if($row['type'] == "payment"){
                                $payments += $row['amount'];

                            }
                            else {
                                $today_expense += $row['amount'];
                            }
                        }

                        $pre_date = date('Y-m-d', strtotime('-1 day'));
                        $sql = "SELECT * FROM sell Where `date`LIKE  '%$pre_date%'";
                        $opening = 0;
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['type'] == "sell") {
                                $opening += $row['amount'];
                            } else {
                                $opening -= $row['amount'];
                            }
                        }
                        ?>
                        <tr>
                            <td id="opening"><?php echo $opening ?></td>
                            <td id="today_sell"><?php echo $today_sell ?></td>
                            <td id="payment_mnt"><?php echo $payments ?></td>
                            <td id="today_expense"><?php echo $today_expense ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total</th>
                            <th id="total"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </main>


    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy;M. Emmad Sadiq</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>

</div>
</div>
<script>
    var total = parseInt($('#today_sell').html()) - parseInt($('#payment_mnt').html()) - parseInt($('#today_expense').html()) + parseInt($('#opening').html())
    $('#total').html(total)
</script>
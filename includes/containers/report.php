<style>
    @import url('https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Cabin:wght@700&family=Texturina:ital,wght@1,100&display=swap');

    .party_details {
        margin: auto;
    }

    .item {
        display: flex;
    }

    .item h5 {
        font-family: cursive;
        width: 28%;
        background-color: #94c744;
        /* text-align: center; */
        font-size: 19px;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-bottom: 1px;
    }

    .item p {
        font-size: 18px;
        font-family: emoji;
        background-color: #38715e;
        border-left: 2px solid white;
        color: white;
        width: 72%;
        padding: 4px;
        text-transform: capitalize;
        margin-bottom: 1px;
    }

    h3.heading {
        text-align: center;
        font-size: 38px;
        font-family: 'Cabin', sans-serif;
        text-decoration: underline;
        text-transform: uppercase;
    }

    .period {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .period .to {
        margin-left: 18px;
    }

    .period p {
        font-size: 24px;
        font-weight: 700;
    }

    .period .from p span {
        color: #198a19;
        font-family: 'Texturina', serif;
    }

    .period .to p span {
        color: #ff1b1b;
        font-family: 'Texturina', serif;
    }

    .required {
        padding: 10px;
    }

    .add {
        margin: auto;
        width: 75%;

    }


    .add th {
        width: 6rem;
        padding: 7px 0px;
    }

    .add textarea {
        margin-top: 3px;
    }

    .add .btn.btn-primary {
        width: 100%;
        margin-top: 11px;
    }

    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        color: #fff;
        background-color: #428bca;
        border-color: #428bca;
        border-top-right-radius: 3px;
    }

    .panel-body {
        padding: 15px;
    }

    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .panel-primary {
        border-color: #428bca;
        /* margin-left: 14%; */
        width: 100%;
        padding-bottom: 13px;
    }

    #to,
    #from {
        width: 200px;
    }

    .add #name option {
        text-transform: capitalize;
    }

    @media print {
        .item h5 {
            background-color: white;
        }

        .item p {
            background-color: white;
            color: black;
        }

        footer {
            display: none;
        }

        .hidden-print {
            display: none;
        }
    }

    .table td {
        padding: 0px 0.25rem !important;
    }
</style>

<div id="layoutSidenav_content">
    <main>

        <?php if (isset($_POST['to'])) {
        ?>
            <div class="toolbar hidden-print mt-4">
                <div class="text-center">
                    <button id="printInvoice" class="btn btn-info" onclick=window.print()><i class="fa fa-print"></i> Print</button>
                </div>
                <hr>
            </div>


            <div class="heading text-center">
                <h2>DEMO STORE</h2>
                <h4>DAILY SALES REPORT</h4>
            </div>
            <div class="period">
                <div class="from">
                    <p>FROM : <span><?php echo $from ?></span></p>
                </div>
                <div class="to">
                    <p>TO : <span><?php echo $to ?></span></p>
                </div>
            </div>

            <div class="container">
                <table class="table table-bordered" id="item_table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>

                    </thead>
                    <?php
                    $opening = 0;
                    $sell = 0;
                    $expense = 0;
                    $payment = 0;
                    // $pre_date = date('Y-m-d', strtotime('-1 day', strtotime($to))) 
                    $sql = "SELECT * FROM sell Where `date` < '$from' ORDER BY `date` ";
                    $result = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['type'] == "sell") {
                            $opening += $row['amount'];
                        }
                        if ($row['type'] == "payment") {
                            $opening -= $row['amount'];
                        }
                        if ($row['type'] == "expense") {
                            $opening -= $row['amount'];
                        }
                    }
                    ?>

                    <tr>
                        <td><?php echo date('Y-m-d', strtotime('-1 day', strtotime($from))) ?></td>
                        <td>opening Balance</td>
                        <td><?php echo $opening ?>.00</td>
                    </tr>
                    <!-- ------------------------- -->
                    <?php
                    $nextday = date('Y-m-d', strtotime('+1 day', strtotime($to)));
                    $sql = "SELECT * FROM sell Where `type`='sell' AND `date` >= '$from' AND `date` <='$nextday' ORDER BY `date` ";
                    $result = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sell += $row['amount'];
                    ?>

                        <tr>
                            <td><?php echo $row['date'] ?></td>
                            <td><?php echo $row['type'] ?></td>
                            <td><?php echo $row['amount'] ?>.00</td>
                        </tr>
                    <?php
                    }

                    ?>
                    <tr>
                        <th colspan="2" class="text-center">Total Sales</th>
                        <th><?php echo $sell + $opening ?>.00</th>
                    </tr>

                    <?php

                    $sql = "SELECT * FROM sell Where `type`='payment' AND `date` >= '$from' AND `date` <='$nextday' ORDER BY `date` ";
                    $result = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $payment += $row['amount'];
                    ?>
                        <tr>
                            <td><?php echo $row['date'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['amount'] ?>.00</td>
                        </tr>
                    <?php

                    }
                    ?>
                    <tr>
                        <th colspan="2" class="text-center">TOTAL Payment</th>
                        <th class="total_debit"><?php echo $payment ?>.00</th>
                    </tr>

                    <?php

                    $sql = "SELECT * FROM sell Where `type`='expense' AND `date` >= '$from' AND `date` <='$nextday' ORDER BY `date` ";
                    $result = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $expense += $row['amount'];
                    ?>
                        <tr>
                            <td><?php echo $row['date'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['amount'] ?>.00</td>
                        </tr>
                    <?php

                    }
                    ?>
                    <tr>
                        <th colspan="2" class="text-center">TOTAL Expense</th>
                        <th class="total_debit"><?php echo $expense ?>.00</th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">Today Closing</th>
                        <th class="total_debit"><?php echo $sell - $expense - $payment + $opening ?>.00</th>
                    </tr>
                </table>
            </div>


        <?php
        } else {
        ?>
            <div class="container-fluid">
                <h1 class="mt-4">Report</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">report</li>
                </ol>
                <div class="row">
                    <div class="panel panel-primary " style="border-color: #333c44;">
                        <div class="panel-heading" style="background-color: #333c44;">
                            Report
                        </div>
                        <div class="container mt-1">
                            <form action="report.php" method="post">

                                <table class="add">
                                    <tbody>
                                        <tr>
                                            <th> <label for="from">From</label></th>
                                            <td><input type="date" class="form-control" id="from" name="from" placeholder="dd/mm/yy" required></td>
                                        </tr>
                                        <tr>
                                            <th> <label for="to">To</label></th>
                                            <td><input type="date" class="form-control" id="to" name="to" required></td>

                                        </tr>
                                        <tr>
                                            <td colspan="2"><input type="submit" value="Add" class="btn btn-primary"></td>
                                        </tr>



                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php

        }
        ?>
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
    var total = parseInt($('#today_sell').html()) - parseInt($('#today_expense').html()) + parseInt($('#opening').html())
    $('#total').html(total)
</script>
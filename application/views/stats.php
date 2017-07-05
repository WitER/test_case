<div class="row">
    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Register today
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="list-unstyled">
                <?php foreach ($todayRegister[date('Y-m')] as $city => $count) : ?>
                <li><?php echo $city; ?>: <?php echo $count; ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                Views today
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <?php foreach (array_keys($weekViews) as $day) : ?>
                        <th><?php echo $day; ?></th>
                        <?php endforeach; ?>
                        </thead>
                        <tbody>
                        <tr>
                            <?php foreach ($weekViews as $view) : ?>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><b>Users: </b><?php echo $view->users_count; ?></li>
                                        <li><b>Views: </b><?php echo $view->views_count; ?></li>
                                    </ul>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
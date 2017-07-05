<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Register</th>
                            <th>Last visit</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->first_name; ?></td>
                                <td><?php echo $user->last_name; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->country->name; ?> \ <?php echo $user->city->name; ?></td>
                                <td><?php echo long2ip($user->register_ip); ?> \ <?php echo $user->register_date; ?></td>
                                <td><?php echo $user->last_visit; ?></td>
                                <td>...</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
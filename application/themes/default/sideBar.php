<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <?php if ($this->user_model->isAdmin()) : ?>
            <li>
                <a href="<?php echo base_url('users'); ?>">Users</a>
            </li>
            <li>
                <a href="<?php echo base_url('stats'); ?>">Stats</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
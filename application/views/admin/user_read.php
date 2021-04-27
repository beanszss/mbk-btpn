 <section class="content">
        <h2 style="margin-top: 0px">User Details</h2>
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <tr>
                        <td>User id</td>
                        <td><?php echo $id;?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $first_name;?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?php echo $username;?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $email?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?php echo $phone?></td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td><?php if ($active == "1"){ echo "Aktif"; }else{ echo "Tidak Aktif"; } ?></td>
                    </tr>
                    <tr>
                        <td>Last Login</td>
                        <td><?php echo $last_login?></td>
                    </tr>
                </table>
                <a href="<?php echo base_url('admin/user') ?>" class="btn btn-default pull-right">Cancel</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <h2 style="margin-top: 0px">Users</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px" id="message">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Users</h3>
            </div>
            <form class="form-horizontal" id="formUsers" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9">
                    <input type="hidden" name="id_users" required/>
                    <input type="text" class="form-control" name="username" placeholder="Username" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" placeholder="Email" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">First Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Last Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required/>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Access</label>
                    <div class="col-sm-9">
                        <select name="access" class="form-control" required/>
                            <option value="1">Administrator</option>
                            <option value="2">Member</option>
                            <option value="3">Moderator</option>
                            <option value="4">Helpdesk</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" class="form-control" required/>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
                  </div> 
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Re Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="re_password" placeholder="Re Password" required/>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="button" id="btnUsers" onclick="saveUsers()" class="btn btn-info pull-right">Add Users</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-7">
            <div class="box">
                <div class="box-body">
                    <table class="table table-hover table-bordered dt-responsive order-column" id="tableUsers" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="80px">No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Access</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

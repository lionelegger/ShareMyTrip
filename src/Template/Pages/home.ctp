<!-- ADD USER modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register a new user</h4>
            </div>
            <form method="post" accept-charset="utf-8" _lpchecked="1">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" ng-model="newUserToAdd.email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" ng-model="newUserToAdd.password">
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input name="name" type="text" class="form-control" id="first_name" placeholder="First name" ng-model="newUserToAdd.first_name">
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input name="name" type="text" class="form-control" id="last_name" placeholder="Last name" ng-model="newUserToAdd.last_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addUser" ng-click="addNewUser()" data-dismiss="modal">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<h1>HOMEPAGE</h1>


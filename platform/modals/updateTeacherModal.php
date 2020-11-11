<div class="modal fade" id="updateDetailsModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class ="form-horizontal" action="modals/updateTeacherHandler.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4>Update Details</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <input type="hidden" name="id" value="<?=$user['id']?>">
                    </div>
                    <div class="form-group">

                        <label for ="username" class="col-lg-2 control-label">
                            Username:
                        </label>
                        <div class="col-lg-10">

                            <input type="text" class="form-control" placeholder="Username" name="username" value="<?= $user['username']; ?>">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for ="password" class="col-lg-2 control-label">
                            Password:
                        </label>
                        <div class="col-lg-10">

                            <input type="text" class="form-control" placeholder="Password" name="pwd" value="<?= $user['password']; ?>">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for ="profileImage" class="col-lg-4 control-label">
                            Profile Image:
                        </label>
                        <div class="col-lg-8">

                            <input type="file" name="profileImage" /></br>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss ="modal">Close</a>
                    <button class="btn btn-primary" type="submit" name="update" value="Submit">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>


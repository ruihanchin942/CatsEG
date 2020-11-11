<div class="modal fade" id="resetStudentPasswordModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class ="form-horizontal" action="modals/updateStudentHandler.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4>Reset Password</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <input type="hidden" name="id" value="<?=$studentInfo['id'];?>">
                        <input type="hidden" name="statustype" value="<?=$status;?>">
                        <input type="hidden" name="pwd" value="<?=randomPassword();?>">
                    </div>
                    <div class="form-group">

                        <label for ="name" class="col-lg-12 control-label">
                            Are you sure you want to reset the password?
                        </label>

                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss ="modal">Close</a>
                    <button class="btn btn-danger" type="submit" name="update" value="Submit">Reset</button>
                </div>
            </form>

        </div>
    </div>
</div>


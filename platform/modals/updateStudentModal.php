<div class="modal fade" id="updateDetailsModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content"  style="background-color: #effffd">
            <form class ="form-horizontal" action="modals/updateStudentHandler.php" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background-color: #48BEB5; color: white">
                    <h4>Update Details</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <input type="hidden" style="background-color: #BCE8E3" name="id" value="<?=$studentInfo['id'];?>">
                        <input type="hidden" style="background-color: #BCE8E3" name="statustype" value="<?=$status?>">
                    </div>
                    <div class="form-group">

                        <label for ="name" class="col-lg-2 control-label">
                            Nickname:
                        </label>
                        <div class="col-lg-10">

                            <input type="text" class="form-control" style="background-color: #BCE8E3" placeholder="nick name" name="nickname" value="<?= $studentInfo['nickname']; ?>">

                        </div>

                    </div>
                    <div class="form-group">

                        <label for ="name" class="col-lg-2 control-label">
                            Password:
                        </label>
                        <div class="col-lg-10">

                            <input type="text" class="form-control" style="background-color: #BCE8E3" placeholder="password" name="pwd" value="<?= $studentInfo['password']; ?>">

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
                    <a class="btn-all" data-dismiss ="modal">Close</a>
                    <button class="btn-all" type="submit" name="update" value="Submit">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>


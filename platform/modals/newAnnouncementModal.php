<div class="modal fade" id="newAnnouncementModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #effffd">
            <form id="addAnnouncementForm" class ="form-horizontal" action="modals/addAnnouncementHandler.php" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background-color: #48BEB5; color: white">
                    <h4>Add Announcement</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <input type="hidden" style="background-color: #BCE8E3"  name="teacherId" value="<?=$user['id'];?>">
                        <input type="hidden" style="background-color: #BCE8E3" name="status" value="0">
                    </div>
                    <div class="form-group">

                        <label for ="title" class="col-lg-2 control-label">
                            Title:
                        </label>
                        <div class="col-lg-10">

                            <input type="text" style="background-color: #BCE8E3" class="form-control" placeholder="Title" name="title" value="">

                        </div>

                    </div>
                    <div class="form-group">

                        <label for ="message" class="col-lg-2 control-label">
                            Message:
                        </label>
                        <div class="col-lg-10">

                            <textarea style="background-color: #BCE8E3" form="addAnnouncementForm" type="text" class="form-control" placeholder="Message" name="message" value=""></textarea>

                        </div>
                    </div>
                    <div class="form-group">

                        <label for ="announcementType" class="col-lg-2 control-label">
                            Send To:
                        </label>
                        <div class="col-lg-10">
                            <select name="announcementType" class="custom-select" id="inputGroupSelect01">
                                <option selected value = "0">All</option>
                                <?php
                                foreach ($classArr as $class => $values){
                                    ?>
                                    <option value="<?=$values['grade']?><?=$values['class']?>"><?=$values['grade']?><?=$values['class']?></option>
                                <?php
                                }
                                ?>

                            </select>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn-all" data-dismiss ="modal">Close</a>
                    <button class="btn-all" type="submit" name="submit" value="Submit">Enter</button>
                </div>
            </form>

        </div>
    </div>
</div>


	 <!-- Modal -->
            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="addEvent.php">

                            <div class="modal-header">
                               
                                <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Activity:</label>
                                    <div class="col-sm-13">
                                        <!-- <input type="text" name="title" class="form-control" id="title" placeholder="Activity" autocomplete="off" style="height: 80px;" required=""> -->
                                        <textarea rows="4" cols="10" id="title" class="form-control" name="title" maxlength="300" value="" required></textarea>
                                    </div>
                                </div>
                        <div class="form-group">
                            <label for="start" class="col-sm-5 control-label">Starting Date - Hrs/Mins/Sec</label>
                            <div class="col-sm-13">
                                <input type="text" name="start" class="form-control" id="start" >
								
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-sm-5 control-label">End Date - Hrs/Mins/Sec</label>
                            <div class="col-sm-13">
                                <input type="text" name="end" class="form-control" id="end">
                            </div>
                        </div>

                    </div>
					<center><a target="_blank" href="https://www.bytebloc.com/Help/Content/24_Hour_Time_Format.htm">Please refer to this link for the 24hrs format</a></center>
                    <div class="modal-footer"> 
						
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="editEventTitle.php">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Schedule</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Activity</label>
                            <div class="col-sm-13">
                                <!-- <input type="text" name="title" class="form-control" id="title" placeholder="Title"> -->
                                <textarea rows="4" cols="10" id="title" class="form-control" name="title" maxlength="300" value="" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start" class="col-sm-5 control-label">Starting Date - Hrs/Mins/Sec</label>
                            <div class="col-sm-13">
                                <input type="text" name="start" class="form-control" id="start" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-sm-5 control-label">End Date - Hrs/Mins/Sec</label>
                            <div class="col-sm-13">
                                <input type="text" name="end" class="form-control" id="end">
                            </div>
                        </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" class="form-control" id="id">


                        </div>
						<center><a target="_blank" href="https://www.bytebloc.com/Help/Content/24_Hour_Time_Format.htm">Please refer to this link for the 24hrs format</a></center>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success 	">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!-- END Modal -->
	
	
     
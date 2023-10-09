<form action="#" id="my-great-dropzone" enctype="multipart/form-data">
    <div class="container mt-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="taskDetailsTab" data-bs-toggle="tab" href="#taskDetails">
                    <i class="fa-regular fa-square-check"></i> Task Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="filesTab" data-bs-toggle="tab" href="#files">
                    <i class="fa-solid fa-paperclip"></i> Files
                </a>
            </li>
            <!-- Add the other tabs similarly -->
        </ul>

        <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="taskDetails">
                <!-- Task Details Tab -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="doer">Who Should do this?</label>
                            <select class="form-select" name="doer" id="doer">
                                <option value="1">Mubashir Rehman</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="st_date">Start Date</label>
                            <input type="date" class="form-control" name="st_date" id="st_date"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" name="due_date" id="due_date"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notes">Provide a detailed description for this task (optional)</label>
                    <textarea class="form-control" name="notes" id="notes" cols="" rows="5" placeholder="Add a description"></textarea>
                </div>
            </div>

            <div class="tab-pane fade" id="files">
                <!-- Files Tab -->
                <div class="form-group">
                    <label for="files">Would you like to attach files to this task?</label>
                    <div class="attach_files_cont">
                        <div id="attached_files_con">
                            Drop or paste files here
                        </div>
                        <div class="mt-2">
                            <label class="custom-file-button">
                                <input type="file" id="attch_file" class="hidden-input" multiple/>
                                <span>+ Add Files</span>
                            </label>
                            <button type="button" class="existing_files custom-file-button">
                                Select from Existing Files
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Add your script tags for Summernote and Dropzone here -->

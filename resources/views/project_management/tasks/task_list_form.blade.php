<!-- include libraries(jQuery, bootstrap) -->
<link
href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
rel="stylesheet"
/>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link
href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css"
rel="stylesheet"
/>
<!-- <link rel="stylesheet" href="../../../../public/css/summernote.css"> -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- dropzone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<link
href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css"
rel="stylesheet"
type="text/css"
/>


<div class="modal" id="add_project">
    <div class="modal-content" style="width: 40% !important;">
        <!-- Top Section: Title and Steps -->
        <div class="top-section">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <h2>Add Task List</h2>

        </div>

        <!-- Middle Section: Form Inputs -->
        <form id="form">
            <div class="middle-section">
                <div>
                    <div class="input">
                        <label for="list_name">Give the list a name</label>
                        <input type="text" name="list_name" id="list_name" placeholder="e.g. New feature research" style="width: 100%;">
                    </div>

                    <div class="input">
                        <label for="use_teamplate">Would you Like to use a template?</label>
                        <select name="use_teamplate" id="use_template" disabled="disabled" style="max-width: 300px; ">
                            <option value="">Select Template</option>
                        </select>
                    </div>
                </div>

                <div class="other_info">
                    <div class="tab_nav">
                        <div class="tab active">Notes</div>
                        <div class="tab">Privacy</div>
                        <div class="tab">Milestone</div>
                        <div class="tab">Defaults</div>
                    </div>

                    <div class="tab_content">
                        <div class="tab_c active"  data-step="1" >
                            <div class="textarea" style="width: 100%">
                                <label for="description">Do you have any notes for list? Enter them here. <span class="light">(optional)</span></label>
                                <textarea name="notes" id="notes" cols="" rows="5" placeholder="Add a description" style="width: 100%" ></textarea>
                            </div>
                        </div>

                        <div class="tab_c">
                            <div class="input">
                                <label for="task_view">Who can view the task list?</label>
                                <select name="users" id="users" style="max-width: 300px;">
                                    <option value="1">Mubashir</option>
                                </select>
                            </div>

                        </div>

                        <div class="tab_c">
                            <div class="input">
                                <label for="task_view">Does this list relate to a milestone?</label>
                                <select name="users" id="users" style="max-width: 300px;">
                                    <option value="1">Mubashir</option>
                                </select>
                            </div>
                            <button class="text_btn">+ Create a milestone</button>
                        </div>

                        <div class="tab_c">
                            <div style="width: 100%; text-align: left;">
                                <label style="width: 100%;">
                                    <input style="width: fit-content; margin-right: 7px;" type="checkbox" name="pin_task_list" id="pin_task_list"> Pin this task List <span title="A pinned task list will never close."><i class="fa-solid fa-circle-info"></i></span>
                                </label>
                            </div>


                            <div class="input" style="margin-top: 20px;">
                                <label for="time">Time <span title="Choose the default setting for time logged in this task list. This can be overridden when logging time."><i class="fa-solid fa-circle-info"></i></span></label>
                                <label>
                                    <input style="width: fit-content; margin-right: 7px;" type="radio" name="time" id="time" checked> Use project setting: Billable
                                </label>
                                <label>
                                    <input style="width: fit-content; margin-right: 7px;" type="radio" name="time" id="time"> Set task list setting
                                </label>
                            </div>

                            <div class="default_table_con">
                                <label for="defaults" style="margin-bottom: 0; font-size: 13px;">Defaults for new tasks</label><br>
                                <small style="font-size: 12px; font-weight: 300;">Task created on this list will use the following default values:</small>

                                <div class="default_con">
                                    <button class="text_btn edit_btn" ><i class="fa-solid fa-pen"></i> Edit</button>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td>Assigned To</td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td>Following changes</td>
                                            <td colspan="3">Nobody</td>
                                        </tr>
                                        <tr>
                                            <td>Following Comments</td>
                                            <td colspan="3">Nobody</td>
                                        </tr>
                                        <tr>
                                            <td>Private</td>
                                            <td>No</td>
                                            <td>Estimated Time</td>
                                            <td>0 mins</td>
                                        </tr>
                                        <tr>
                                            <td>Priority</td>
                                            <td>None</td>
                                            <td>Due Date</td>
                                            <td>No Date</td>
                                        </tr>
                                        <tr>
                                            <td>Tags</td>
                                            <td colspan="3">None</td>
                                        </tr>
                                        <tr>
                                            <td>Board Column</td>
                                            <td colspan="3">None</td>
                                        </tr>
                                        <tr>
                                            <td>Custom Fields</td>
                                            <td colspan="3">None</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Section: Buttons -->
            <div class="footer-section">

                <button type="button" class="cancel-btn" id="closeModalBtn">
                    Cancel
                </button>
                <button type="submit">
                    Add Task List
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .tab_c{
        display: none;
    }

    .tab_c.active{
        display: block;
    }

    .input{
        margin-bottom: 10px;
        gap: 0;
    }

    input, select, option{
        padding: 5px 10px;
        font-weight: 300;
    }

    label{
        font-weight: 300;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .other_info{
        margin-top: 20px;
    }

    .default_table_con{
        margin-top: 16px;
    }

    .default_con{
        margin-top: 10px;
        border: 1px solid #f5f7fa;
        padding: 5px 10px;
        width: 100%;
        border-radius: 5px;
        position: relative;
    }

    table {
        border-collapse:separate;
        border-spacing: 0 10px;
        font-size: 12px;
    }

    tr td:nth-child(odd){
        color: #999;
        width: 170px;
    }

    tr td:nth-child(even){
        color: #555;
    }

    .edit_btn{
        position: absolute;
        border: 1px solid #f5f7fa;
        right: 10px;
        top: 10px;
        font-weight: normal;
        padding: 7px 10px;
    }
</style>


<script>
    $("#notes").summernote({
        placeholder: "Add Your Description here...",
        tabsize: 2,
        height: 100,
        // airMode: true,
        toolbar: [
                // ['style', ['style']],
                [
                    "font",
                    [
                        "bold",
                        "italic",
                        "strikethrough",
                    ],
                ],
                ["para", ["ul", "ol"]],
                ["insert", ["link", "picture", "video"]],
                ["view", [ "undo", "redo"]], // ['fullscreen', 'codeview', 'help']
            ],
        });


</script>

{{-- <div>
    <h3>Task</h3>
    <div class="top">
        <label>
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="search_task" id="search_task" placeholder="Assignee or task name">
        </label>
        {{-- <a href="#"><i class="fa-solid fa-plus text-blue trigger-link" data-task-list="{{ $taskList->id }}"></i></a>
   
        <button class="add_a_task" data-toggle="task_form" data-target="my-great-dropzone"
            data-task-list-id ="{{ $taskList->id }}">+ Add Task</button>
    </div>
</div> --}}
<div class="tasks-main">
    <div class="top mt-0">
        <div class="top_heading">
            @if (!empty($taskName))
                Task named {{ $taskName }} is completed
            @endif
            <h3>Tasks</h3>
        </div>

        <div class="actions">
            <label>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="search_task" id="search_task" placeholder="Assignee or task name">
            </label>
            <button class="add_a_task">+ Add Task List</button>
        </div>
    </div>
@if (!empty($taskList))
    <div class="listItem">
        <div class="listItemContent">
            <a href="#">
                <i class="fa-solid fa-angle-right text-blue trigger-arrow" data-task-list-id ="{{ $taskList->id }}"></i>
            </a>
            {{ $taskList->task_list_name }}
            <div class="dropdown">
                <button onclick="myFunction(this)" class="text_btn ellipsisBtn" type="button">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <div class="dropdown-content">
                    <!-- Dropdown content -->
                    <ul>
                        <li id="edit-tasklist" class="edit-task-list-option" data-task-id="{{ $taskList->id }}">
                            <i class="fa-solid fa-pencil option_list_icon edit-task"></i>
                            <span class="option_list_text">Edit Task</span>
                        </li>



                        <li class="disabled"><i class="fa-regular fa-copy option_list_icon "></i> <span
                                class="option_list_text">Move or Copy</span></li>
                        <li class="disabled"><i class="fa-solid fa-sort option_list_icon"></i> <span
                                class="option_list_text">Reorder Tasks By...</span></li>
                        <li class="disabled"><i class="fa-solid fa-file option_list_icon"></i> <span
                                class="option_list_text">Reports</span></li>

                        <li class="delete-list-btn" data-task-id="{{ $taskList->id }}">

                            <i class="fa-solid fa-trash option_list_icon"></i>Delete Task
                        </li>

                    </ul>
                </div>
            </div>
            <a href="#"><i class="fa-solid fa-plus text-blue trigger-link"
                    data-task-list="{{ $taskList->id }}"></i></a>
        </div>
    </div>
@else
    No task list for this project
@endif
{{-- @endforeach --}}
{{-- @endif --}}
<script>
    var addTaskForm = `
<form action="#" class="task_form"  id="my-great-dropzone" data-task-list-id="" enctype="multipart/form-data">

@csrf
@method('post')

            <div class="add_task">
            <div class="">
                @if (!empty($tl->projects_id))
                <input type="hidden" name="pro_id" value="{{ $tl->projects_id }}">
@endif
    <input type="text" name="subject" placeholder="what needs to be done?">
             </div>

                <div class="task_bar">
                    <ul>
                        <li class="active">
                            <i class="fa-regular fa-square-check"></i> Task
                            Details
                        </li>
                        <li><i class="fa-solid fa-paperclip"></i> Files</li>
                        <li><i class="fa-regular fa-flag"></i> Priority</li>
                        <li>
                            <i class="fa-regular fa-clock"></i> Progress & Time
                        </li>
                        <li><i class="fa-regular fa-eye"></i> Followers</li>
                        <li><i class="fa-solid fa-tag"></i> Tags</li>
                        <li><i class="fa-solid fa-plus"></i> More</li>
                    </ul>
                </div>

                <div class="task_content">
                    <div class="task_tab active">
                        <div class="input_group">
                            <div class="input">
                                <label for="doer">Who Should do this?</label>
                                <select name="doer" id="doer">
                                    <option value="1">Mubashir Rehman</option>
                                </select>
                            </div>

                            <div class="input">
                                <label for="st_date">Start Date</label>
                                <input
                                    type="date"
                                    name="st_date"
                                    id="st_date"
                                />
                            </div>

                            <div class="input">
                                <label for="due_date">Due Date</label>
                                <input
                                    type="date"
                                    name="due_date"
                                    id="due_date"
                                />
                            </div>
                        </div>

                        <div class="textarea" style="width: 100%">
                            <label for="description"
                                >Provide a detailed description for this task
                                (optional)</label
                            >
                            <textarea
                                name="notes"
                                id="notes"
                                cols=""
                                rows="5"
                                placeholder="Add a description"
                                style="width: 100%"
                            ></textarea>
                        </div>
                    </div>

                    <div class="task_tab">
                        <div class="input">
                            <label for="files" style="margin-bottom: 10px"
                                >Would you like to attach files to this
                                task?</label
                            >
                            <div class="attach_files_cont">
                                <div id="attached_files_con">
                                    Drop or paste files here
                                </div>
                                <div class="dz-message">
                Drag and Drop Single/Multiple Files Here<br>
            </div>
                                <div>
                                    <label class="custom-file-button">
                                        <input
                                            type="file"
                                            id="attch_file" name="file"
                                            class="hidden-input"
                                            multiple
                                        />
                                        <span>+ Add Files</span>
                                    </label>
                                    <button
                                        type="button"
                                        class="existing_files custom-file-button"
                                    >
                                        Select from Existing Files
                                    </button>
                                    <div id="dropped_files"></div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="task_tab">
                        <div class="input">
                            <label for="priority"
                                >Chose the priority of this task</label
                            >
                            <div class="radio">
                                <input
                                    type="radio"
                                    name="priority"
                                    value="None"
                                    id="priority"
                                    label="None "
                                    checked="true"
                                />
                                <input
                                    type="radio"
                                    name="priority"
                                    value="Low"
                                    id="priority"
                                    label="Low"
                                />
                                <input
                                    type="radio"
                                    name="priority"
                                    value="Medium"
                                    id="priority"
                                    label="Medium"
                                />
                                <input
                                    type="radio"
                                    name="priority"
                                    value="High"
                                    id="priority"
                                    label="High"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="task_tab">
                        <div class="input_group" style="max-width: 550px">
                            <div class="input">
                                <label for="progress"
                                    >Progress so for (0%)</label
                                >
                                <input
                                    type="range"
                                    name="progress"
                                    id="progress"
                                />
                            </div>

                            <div class="input">
                                <label for="est_time"
                                    >Esitmated time to complete</label
                                >
                                <div
                                    style="
                                        display: flex;
                                        max-width: 165px;
                                        gap: 10px;
                                    "
                                >
                                    <label>
                                        <input
                                            type="number"
                                            name="hours"
                                            id="hours"
                                            style="padding: 5px"
                                        />
                                        h
                                    </label>
                                    <label>
                                        <input
                                            type="number"
                                            name="minutes"
                                            id="minutes"
                                            style="padding: 5px"
                                        />
                                        m
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                </div>
            </div>
            <input  class="submit-btn" type="submit" value="create">
            OR
            <button class="cancel" id="form-cancel">cancel</button>
        </form>`;


    $("body").on("click", ".add_a_task", function() {

        $('.trigger-link').click();
    
});

    //     $(document.body).append(addTaskForm); // Append it to the body
    //     $('.task_form').show(); // Show the modal

    //     var taskId = $(this).data('task-list-id'); // Get the task ID from the clicked element

    //     console.log(taskId);
    //     // Toggle the modal


    //     // Set the task ID as the data-task-id of the form
    //     $('#my-great-dropzone').attr('data-task-list-id', taskId);

    // });


    // edit task list form submission
    $(document).ready(function() {
        $('body').on('click', '.update-btn', function(e) {
            e.preventDefault();
            // if ($('#list_name').val() === '') {
            //     alert("list name field is required" );

            // }
            var formData = new FormData($('#edt_tsk_list')[0]); // Get form data
            var taskId = $('#edt_tsk_list').data('task-id'); // Get the data-task-list-id from the form
            var url = "{{ route('update.tasklist', ['taskId' => ':taskId']) }}";
            url = url.replace(':taskId', taskId);
            console.log("helo");
            // Append the URL to the formData object
            formData.append('_method', 'PUT'); // Add the PUT method override

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert('success');
                    $("body .modal").remove()

                },
                error: function(error) {
                    console.error('Error updating data:', error);
                }
            });
        });
    });
</script>
<style>
    /* .top {
        float: right;
    }

    .top button {
        border-radius: 20px;
        height: 40%;
    } */

    /* .task_form {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    } */

    li {
        text-decoration: none;
    }

    .slactions {
        float: right;
    }

    .slactions label {
        border: 1px solid #f1f1f1;
        border-radius: 20px;
        padding: 0 10px;
        height: 30px;
    }

    .slactions input#search_task {
        border: 0;
        background-color: transparent;
        font-size: 12px;
        padding: 5px 10px 5px 3px;
        font-weight: 400;
        color: #0B0E1F;
        width: 90%;
    }

    .slactions .trigger-link {
        border-radius: 20px;
        padding: 5px 10px;
        color: #fff;
        font-weight: 400;
        letter-spacing: normal;
    }

    .dropzone {
        background: #e3e6ff;
        border-radius: 13px;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
        border: 2px dotted #1833FF;
        margin-top: 50px;
    }

    .task {
        text-decoration: none;
    }

    .task:hover {
        text-decoration: none;
    }

    .tasks {
        text-decoration: none;
    }

    .tasks:hover {
        text-decoration: none;
    }

    .listItem {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .listItemContent {
        font: medium;
        display: inline-block;
        margin-right: 10px;
        /* Adjust as needed */
    }

    .btn_con ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .btn_con li {
        padding: 8px 16px;
        cursor: pointer;
    }

    .btn_con {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: none;
        /* Initially hide the menu */
        min-width: 150px;
    }

    .ellipsisBtn {
        background: none;
        border: none;
        cursor: pointer;
    }

    .listItem:hover .btn_con {
        display: block;
    }


    /* Dropdown Button */
    .dropbtn {
        background-color: #3498DB;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* Dropdown button on hover & focus */
    .dropbtn:hover,
    .dropbtn:focus {
        background-color: #2980B9;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
        text-align: left;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f0e6e6;
        text-align: left;
        min-width: 160px;
        border-radius: 5px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left !important;
        /* Added !important */
    }

    .dropdown-content ul li {
        float: left;
        list-style: none;
        /* Remove default list style */
        text-align: left;
        /* Align text to the left */
        padding: 5px 0;
        /* Add some space between items */
    }

    /* Add padding to icons */
    .dropdown-content ul li i {
        margin-right: 10px;
        /* Add space between icon and text */
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #ddd;
    }

    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
    .show {
        display: block;
    }


    /* styling for add task form  */

    .task_bar ul {
        display: flex;
        gap: 5px;
        margin-bottom: 0;
    }

    .task_bar ul li {
        list-style: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .task_bar ul li.active {
        background-color: #f2f4fc;
    }

    .task_content {
        background-color: #f2f4fc;
        margin-top: 0;
        padding: 10px;
    }

    .task_content .dropzone {
        border: none;
    }

    .task_tab {
        display: none;
    }

    .task_tab.active {
        display: block;
    }

    .dz-default {
        display: none;
    }

    label {
        font-size: 12px;
        font-weight: 400;
    }

    .attach_files_cont {
        background-color: #fff;
        padding: 10px 25px;
    }

    .radio {
        display: flex;
        gap: 5px;
        background-color: #fff;
        width: 100%;
        padding: 10px 15px;
    }

    input#priority {
        padding: 5px 10px;
        margin-left: 0 !important;
        width: fit-content;
    }

    a:hover {
        text-decoration: none;
    }

    .custom-file-button {
        display: inline-block;
        padding: 8px 16px;
        border: 1px solid #0056b3;
        color: #0056b3;
        border-radius: 4px;
        cursor: pointer !important;
        transition: background-color 0.3s ease;
        font-weight: 400;
        background-color: transparent;
    }

    .custom-file-button:hover {
        background-color: #f2f4fc;
    }

    .custom-file-button span {
        cursor: pointer !important;
    }

    .hidden-input {
        display: none !important;
    }

    .dragover {
        border: dashed 2.5px #dadada;
    }

    .deleteFile {
        color: #c20000;
        background-color: transparent;
        border-radius: 50%;
        padding: 5px 8px;
        border: 1px solid #f2f4fc;
    }

    .deleteFile:hover {
        border: 1px solid #0056b3;
        color: #0056b3;
    }

    .dz-preview {
        display: none;
    }

    .attachedFilePrev {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        border: none;
    }

    span.file_name {
        padding: 0 7px;
    }

    span.progress_prct {
        border-right: 1px solid #dadada;
        padding: 0 5px;
    }

    .submit-btn {
        background-color: blue;
        width: 20%;
        color: blue;
    }

    .listItemContent {
        font-size: large;
        font: bold;
    }

    .trigger-arrow {
        transition: transform 0.3s ease-in-out;
    }

    .trigger-arrow.rotate {
        transform: rotate(90deg);
    }

    .main-content {
        display: flex;
    }

    .tasks a {
        text-decoration: none;
    }

    .tasks a {

        text-decoration: none;
    }

    .listItem li {
        text-decoration: none;
    }
</style>

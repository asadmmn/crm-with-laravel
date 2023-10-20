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
            <button class="add_task_list">+ Add Task List</button>
        </div>
    </div>

    <div class="tasks">
        <div class="task_con">
            <div class="task_binding">
                <div class="actions">
                    @if (isset($task_lists) && !empty($task_lists))
                        @foreach ($task_lists as $tl)
                            @if (!empty($tl))
                                <div class="listItem">
                                    <div class="listItemContent">
                                        <li></li> <a href="#">
                                            <i class="fa-solid fa-angle-right text-blue trigger-arrow"
                                                data-task-list-id="{{ $tl->id }}"></i>
                                        </a></li>
                                        {{ $tl->task_list_name }}
                                        <div class="dropdown">
                                            <button onclick="myFunction(this)" class="text_btn ellipsisBtn"
                                                type="button">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </button>
                                            <div class="dropdown-content">
                                                <!-- Dropdown content -->
                                                <ul>
                                                    <li id="edit-tasklist" class="edit-task-list-option"
                                                        data-toggle="modal"
                                                        data-target="edit_task_list"data-task-id="{{ $tl->id }}">
                                                        <i class="fa-solid fa-pencil option_list_icon edit-task"></i>
                                                        <span class="option_list_text">Edit Task list</span>
                                                    </li>


                                                    <li class="disabled"><i
                                                            class="fa-regular fa-copy option_list_icon "></i> <span
                                                            class="option_list_text">Move or Copy</span></li>
                                                    <li class="disabled"><i
                                                            class="fa-solid fa-sort option_list_icon"></i> <span
                                                            class="option_list_text">Reorder Tasks By...</span></li>
                                                    <li class="disabled"><i
                                                            class="fa-solid fa-file option_list_icon"></i> <span
                                                            class="option_list_text">Reports</span></li>

                                                    <li class="delete-task-list-btn"
                                                        id="dlt-tsk-lst"data-task-id="{{ $tl->id }}">

                                                        <i class="fa-solid fa-trash option_list_icon"></i>Delete Task
                                                        list
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <a href="#"><i class="fa-solid fa-plus text-blue trigger-link"
                                                data-task-list="{{ $tl->id }}"></i></a>
                                    </div>
                                </div>
                            @else
                                No task list for this project
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div id="taskform_container">

</div>
<div id="calendar" class="hidden">
    <!-- Calendar content -->
</div>


<script src="{{ URL::asset('js/modal.js') }}"></script>
<script src="{{ URL::asset('js/project.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>

<!-- JavaScript (bundle includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dueDateInput').focus(function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd',
            });
        });
        $('#startDateInput').datepicker({
            format: 'yyyy-mm-dd',
        });

        function calculateRemainingTime() {
            var startDate = $('#startDateInput').datepicker('getDate');
            var dueDate = $('#dueDateInput').datepicker('getDate');
            if (startDate && dueDate) {
                var timeDiff = dueDate - startDate;
                var daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                return daysDiff + ' days remaining';
            }
            return '';
        }
        $('.hoverable').hover(
            function() {
                $(this).datepicker('show');
            },
            function() {
                $(this).datepicker('hide');
            }
        );
        $('#startDateInput, #dueDateInput').on('changeDate', function() {
            var remainingTime = calculateRemainingTime();
            $('.datepicker-days .datepicker-switch').text(remainingTime);
        });
    });

    function myFunction(button) {
        button.nextElementSibling.classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.ellipsisBtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    // task form
    const myGreatDropzoneForm = `

    <form action="#" class="task_form"  id="my-great-dropzone" data-task-list-id="" enctype="multipart/form-data">

@csrf
@method('post')

            <div class="add_task">
            <div class="">
                @if (!empty($tl->projects_id))
                <input type="hidden" name="pro_id" value="{{ $tl->projects_id }}">
@endif
    <input type="text" class="sjt" name="subject" placeholder="what needs to be done?" rows="5">
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
          
            &nbsp <a href="#" class="btn btn-primary btn-lg active submit-btn m-s-auto" type="submit" role="button" aria-pressed="true">Add</a>
OR
<a href="#" id="form-cancel" class="btn btn-secondary btn-lg active cancel" role="button" aria-pressed="true">cancel</a>

      
        </form>

`;

    //drop file uploads
    // task form call
    $("body").on("click", '.trigger-link', function() {
        var taskListId = $(this).data('task-list');
        console.log($(this).parent().next().next());

        var taskform = $(this).closest('#taskform_container');

        // Check if the edit form already exists
        if (taskform.length === 0) {
            taskform = $('<div id="taskform_container"></div>');
            $(this).closest('.listItem').after(taskform);
        }

        $("body .task_form").remove();

        var combinedHTML = myGreatDropzoneForm;
        //taskform.toggle();
        taskform.html(combinedHTML);
        $("#my-great-dropzone").attr("data-task-list-id", taskListId);
    });

    // task form call
    $("body").on("click", '.cancel', function() {

        $("body .task_form").remove()


    });

    document.body.addEventListener('click', function(event) {
        var element = event.target;
        if (element.classList.contains('task_form')) {
            element.classList.remove('task_form');
        }
    });

    $("body").on("click", '.trigger-arrow', function() {
        $(this).toggleClass('rotate');

        var taskListId = $(this).data('task-list-id');
        console.log("Task List ID:", taskListId);


        var clickedElement = $(this);
        //clickedElement.toggle();
        $.ajax({
            url: '/tasklist/' + taskListId + '/tasks',
            type: 'GET',
            success: function(data) {
                //console.log("Tasks Data:", data); // Check if tasks data is received
                $("body .task").remove()
                clickedElement.parent().next().next().html(data);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });


    $(document).ready(function() {
        $('body').on('click', '.submit-btn', function(e) {
            e.preventDefault();

            var formData = new FormData($('.task_form')[0]); // Get form data
            var id = $('#my-great-dropzone').data(
                'task-list-id'); // Get the data-task-list-id from the form

            console.log("Task List ID:", id);
            var actionRoute = '/taskstore/' + id; // Assuming this is the correct route

            // Additional data for the request body
            var requestBody = {
                key1: 'value1',
                key2: 'value2'
            };

            formData.append('json_body', JSON.stringify(
                requestBody)); // Append JSON string to form data

            $.ajax({
                url: actionRoute,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("body .task_form").remove()
                    // Handle the response data (if any)
                    //console.log(data);

                    // Optionally, redirect or display a success message
                    alert('added successfully!');
                },
                error: function(error) {
                    console.error('Error:', error);
                    // Handle errors
                }
            });
        });
    });


    var editListForm = `
<div class="modal" id="edit_task_list">
    <div class="modal-content" style="width: 40% !important;">
        <!-- Top Section: Title and Steps -->
        <div class="top-section">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <h2>Edit Task List</h2>
        </div>

        <!-- Middle Section: Form Inputs -->
        <form action="#" class="edit_task_list_form" id="edt_tsk_list" data-task-id="#" enctype="multipart/form-data">

            @method('put')
            @csrf
            <input type="hidden" name="project_id" value="{{ $gettask }}">
            <div class="middle-section">
                <div>
                    <div class="input">
                        <label for="list_name">Give the list a name</label>
                        <input type="text" name="list_name" required="required" id="list_name" placeholder="e.g. New feature research" style="width: 100%;">
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
                        <div class="tab_c active" data-step="1">
                            <div class="textarea" style="width: 100%">
                                <label for="description">Do you have any notes for list? Enter them here. <span class="light">(optional)</span></label>
                                <textarea name="notes" id="notes" cols="" rows="5" placeholder="Add a description" style="width: 100%" ></textarea>
                            </div>
                        </div>

                        <div class="tab_c">
                            <div class="input">
                                <label for="task_view">Who can view the task list?</label>
                                <select name="user" id="user" style="max-width: 300px;">
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
                <input  class="update-btn" type="submit" value="update">
            OR
            <button class="cancel" id="form-cancel">cancel</button>
            </div>
        </form>
    </div>
</div>`;


    $("body").on("click", ".edit-task-list-option", function() {
        $(document.body).append(editListForm); // Append it to the body
        $('#edit_task_list').show(); // Show the modal

        var taskId = $(this).data('task-id'); // Get the task ID from the clicked element

        console.log(taskId);
        // Toggle the modal


        // Set the task ID as the data-task-id of the form
        $('#edt_tsk_list').attr('data-task-id', taskId);

    });


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



    $(document).ready(function() {
        $('body').on('click', '.delete-task-list-btn', function(e) {
            e.preventDefault();
            var taskId = $(this).data('task-id');

            $.ajax({
                type: 'DELETE',
                url: '/deletelist/' + taskId,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    // Handle success
                    alert('Task list deleted successfully');
                },
                error: function(error) {
                    // Handle error
                    console.error('Error deleting task:', error);
                }
            });
        });
    });



    // task form call
    $("body").on("click", '.cancel', function() {

        $("body .task_form").remove()


    });
    // <!-- add task form js  
    $(document).ready(function() {
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
                ["view", ["undo", "redo"]], // ['fullscreen', 'codeview', 'help']
            ],
            // toolbar: [
            //     // ['style', ['style']],
            //     [
            //         "font",
            //         [
            //             "bold",
            //             "underline",
            //             "clear",
            //             "fontname",
            //             "fontsize",
            //             "forecolor",
            //             "backcolor",
            //             "italic",
            //             "strikethrough",
            //             "superscript",
            //             "subscript",
            //         ],
            //     ],
            //     ["color", ["color"]],
            //     ["para", ["ul", "ol", "paragraph", "style", "height"]],
            //     ["table", ["table"]],
            //     ["insert", ["link", "picture", "video"]],
            //     ["view", ["codeview", "help", "undo", "redo"]], // ['fullscreen', 'codeview', 'help']
            // ],

        });

        // Switch Tabs
        $("body").on("click", ".task_bar ul li", function() {
            var tabs = $(this).index();
            $(this).parent().find(".active").removeClass("active");
            $(this).addClass("active");

            // if($(this).parents().eq(1).next().hasClass('task_content')){
            //     var tab = $(this).parent().next()
            // } else {
            var tab = $(this).parents().eq(1).next();
            // }

            tab.find(".task_tab").each(function(index) {
                if (index == tabs) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });


        $('body').on('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        $('body').on('dragleave drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        $('body').on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var files = e.originalEvent.dataTransfer.files;
            $('#attch_file')[0].files = files;
            $(this).removeClass('dragover');
            displayDroppedFiles(files);
        });

        function displayDroppedFiles(files) {
    var droppedFilesContainer = $('#dropped_files');

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var fileName = file.name;
        var fileType = file.type;
        var fileIcon = '';

        if (fileType.includes('image')) {
            fileIcon = '<img src="image_icon_url" alt="' + fileName + '" style="width: 50px;">';
        } else if (fileType.includes('pdf')) {
            fileIcon = '<img src="pdf_icon_url" alt="' + fileName + '" style="width: 50px;">';
        } else {
            fileIcon = '<img src="generic_icon_url" alt="' + fileName + '" style="width: 50px;">';
        }

        droppedFilesContainer.append(fileIcon + '</span><br>');
    }
}

    });
</script>
<style>
    #taskform_container{
        text-decoration: none;
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

    .sjt{
        width:100%;
    }
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

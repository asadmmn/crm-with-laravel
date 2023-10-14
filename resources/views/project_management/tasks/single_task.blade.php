
<div class="top mt-0">
    <div class="top_heading">
        @if(!empty($taskName))
            Task named {{$taskName}} is completed
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
                    @if(!empty($tl))
                        <div class="listItem">
                            <div class="listItemContent">
                              <li></li>  <a href="#">
                                    <i class="fa-solid fa-angle-right text-blue trigger-arrow" data-task-list-id="{{ $tl->id }}"></i>
                                </a></li>
                                {{ $tl->task_list_name }}
                                <div class="dropdown">
                                    <button onclick="myFunction(this)" class="text_btn ellipsisBtn" type="button">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <!-- Dropdown content -->
                                        <ul>
                                            <li id="edit-tasklist" class="edit-task-list-option"  data-task-id="{{ $tl->id }}">
                                                <i class="fa-solid fa-pencil option_list_icon edit-task"></i>
                                                <span class="option_list_text">Edit Task</span>
                                            </li>
                                            
                                       
                        
                                            <li class="disabled"><i class="fa-regular fa-copy option_list_icon "></i> <span
                                                    class="option_list_text">Move or Copy</span></li>
                                            <li class="disabled"><i class="fa-solid fa-sort option_list_icon"></i> <span
                                                    class="option_list_text">Reorder Tasks By...</span></li>
                                            <li class="disabled"><i class="fa-solid fa-file option_list_icon"></i> <span
                                                    class="option_list_text">Reports</span></li>
                        {{-- 
                                                    <li id="delete-task" class="delete-task-option"   data-task-id="{{ $task->id }}>
                                                        <i class="fa-solid fa-trash option_list_icon"></i>
                                                        <span class="option_list_text">Delete Task</span>
                                                    </li> --}}
                                                    <li class="delete-list-btn" data-task-id="{{ $tl->id }}">
                                                        
                                                        <i class="fa-solid fa-trash option_list_icon"></i>Delete Task</li>
                        
                                        </ul>
                                    </div>
                                </div>
                                <a href="#"><i class="fa-solid fa-plus text-blue trigger-link" data-task-list="{{ $tl->id }}"></i></a>
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
<br>
<div class="taskform_container">

</div>
<div id="calendar" class="hidden">
    <!-- Calendar content -->
</div>


<script src="{{ URL::asset('js/modal.js') }}"></script>
    <script src="{{ URL::asset('js/project.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
                @if(!empty($tl->projects_id))
                <input type="hidden" name="pro_id" value="{{ $tl->projects_id}}">
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
        </form>

`;


// task form call
$("body").on("click", '.trigger-link', function() {
    var taskListId = $(this).data('task-list');
    console.log($(this).parent().next().next());

    var taskform = $(this).closest('.taskform_container');

    // Check if the edit form already exists
    if (taskform.length === 0) {
        taskform = $('<div class="taskform_container"></div>');
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
        var id = $('#my-great-dropzone').data('task-list-id'); // Get the data-task-list-id from the form

        console.log("Task List ID:", id);
        var actionRoute = '/taskstore/' + id; // Assuming this is the correct route

        // Additional data for the request body
        var requestBody = {
            key1: 'value1',
            key2: 'value2'
        };

        formData.append('json_body', JSON.stringify(requestBody)); // Append JSON string to form data

        $.ajax({
            url: actionRoute,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                // Handle the response data (if any)
                //console.log(data);

                // Optionally, redirect or display a success message
                alert('Form submitted successfully!');
            },
            error: function(error) {
                console.error('Error:', error);
                // Handle errors
            }
        });
    });
});

//edit task list 

// $("body").on("click", ".edit-tasklist-option", function() {
//     // Get the container element for the form
   

//     $(document).ready(function(){
//             $('#edit-listform-container').html(myGreatDropzoneForm);
//         });
//     // Get the task list ID from the clicked element's data attribute
//     var taskListId = $(this).data("task-list-id");
//     // Set the form's data attribute "data-task-list-id" to the retrieved task list ID
//     $("#my-great-dropzone").attr("data-task-list-id", taskListId);
// });


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

        Dropzone.autoDiscover = false;
        // Assuming 'myDropzone' is your existing Dropzone instance
        var myDropzone = new Dropzone("#my-great-dropzone", {
            url: "your_upload_url_here", // Set your server upload URL
            autoProcessQueue: true, // Prevent automatic upload on file drop
            previewTemplate: document.querySelector("#custom-preview-template").innerHTML,
        });

        // Add a class to the form when a file is dragged over it
        myDropzone.on("dragenter", function() {
            $("#my-great-dropzone").addClass("dragover");
        });

        // Remove the class when the file is dragged away
        myDropzone.on("dragleave", function() {
            $("#my-great-dropzone").removeClass("dragover");
        });

        // Handle the file when it's added to Dropzone
        myDropzone.on("addedfile", function(file) {
            var filetype = file.type;
            var fileName = file.name;
            $(".task_tab").hide();
            $(".task_tab")[1].style = "display: block;";
            $(".task_bar ul").find(".active").removeClass("active");
            $(".task_bar ul li")[1].classList = "active";

            var imgSrc = "";
            if (filetype.includes("image")) {
                imgSrc = "/public/images/image.png";
            } else if (filetype.includes("video")) {
                imgSrc = "/public/images/Video File.svg";
            } else if (filetype.includes("pdf")) {
                imgSrc = "/public/images/pdf file.svg";
            } else if (filetype.includes("x-zip-compressed")) {
                imgSrc = "/public/images/Archive Folder.svg";
            } else if (
                filetype.includes("sheet") ||
                filetype.includes("csv")
            ) {
                imgSrc = "/public/images/Google Sheets.svg";
            } else if (
                filetype.includes("document") ||
                filetype.includes("plain")
            ) {
                imgSrc = "/public/images/Microsoft Word 2019.svg";
            } else {
                imgSrc = "/public/images/File.svg";
            }

            // // Create an image element for the uploaded file
            var mainDiv = document.createElement("div");
            mainDiv.classList = "attachedFilePrev";

            var imageElement = document.createElement("img");
            imageElement.src = imgSrc;
            imageElement.alt = fileName;
            imageElement.style = "width: 40px; height: 40px; margin-right: 10px;";

            var fileinfoDiv = document.createElement("div");
            fileinfoDiv.style = "display: flex; align-items: center;";
            var fileinfo = document.createElement("div");
            fileinfo.style = "border: 1px solid #dadada; padding: 0px 0px;";
            var progress_prctSpan = document.createElement("span")
            progress_prctSpan.classList = "progress_prct";
            var fileNameSpan = document.createElement("span");
            fileNameSpan.classList = "file_name";
            fileNameSpan.textContent = fileName;
            fileinfo.append(progress_prctSpan);
            fileinfo.appendChild(fileNameSpan);
            fileinfoDiv.appendChild(imageElement);

            fileinfoDiv.append(fileinfo);

            var deleteButton = document.createElement("button");
            deleteButton.innerHTML = '<i class="fa-regular fa-trash-can"></i>';
            deleteButton.classList = "deleteFile";
            var deletediv = document.createElement("div");
            deletediv.appendChild(deleteButton);

            mainDiv.appendChild(fileinfoDiv);
            mainDiv.appendChild(deletediv);
            deleteButton.addEventListener("click", function() {
                // Remove the file from Dropzone
                myDropzone.removeFile(file);
                // Remove the file preview element
                mainDiv.remove();
            });

            // Append the image element to the target div
            if ($("body #attached_files_con").find(".attachedFilePrev").length > 0) {
                $("#attached_files_con").append(mainDiv);
            } else {
                $("#attached_files_con").html(mainDiv);
            }

            // Customize the appearance and show progress during processing
            myDropzone.on("processing", function(file) {
                // Add a custom CSS class to the file's preview element during processing
                file.previewElement.classList.add("custom-processing-file");

                // You can define your custom CSS rules for .custom-processing-file in your stylesheets
            });

            // Update the progress while uploading
            myDropzone.on("uploadprogress", function(file, progress) {
                // Update the progress in your custom file element (e.g., a progress bar)
                // Example: file.previewElement.querySelector(".custom-progress").style.width = progress + "%";
                progress_prctSpan.textContent = progress + "%"
            });
        });



        // Handle the file upload manually
        myDropzone.on("success", function(file, response) {
            // Assuming the server returns the uploaded file's URL in the response
            var imageUrl = response.imageUrl;

            // Insert the image URL into Summernote
            $("#notes").summernote("editor.insertImage", imageUrl);
        });

        // Listen for changes in the file input
        $("#attch_file").on("change", function(event) {
            var files = event.target.files;

            // Loop through the selected files
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                // Add the file to Dropzone
                myDropzone.addFile(file);

                // Display the file in the Dropzone list
                // myDropzone.emit("addedfile", file);

                // Process the file as needed (e.g., display a preview)
                // myDropzone.createThumbnailFromUrl(file, myDropzone.options.thumbnailWidth, myDropzone.options.thumbnailHeight, myDropzone.options.thumbnailMethod, true, function(thumbnail) {
                //     myDropzone.emit("thumbnail", file, thumbnail);
                // });
            }
        });
    });
</script>
<style>
    /* .main-content{
        display:flex;
    }
    
    .details{
        position: absolute;
    right: 0;
    
    width: 50%;
    } */
    .task{
        text-decoration: none;
    }
    .task:hover{
        text-decoration: none;
    }
    .tasks{
        text-decoration: none;
    }
    .tasks:hover{
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
.dropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
    text-align:left;
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
    text-align: left !important; /* Added !important */
}

.dropdown-content ul li {
    float:left;
    list-style: none; /* Remove default list style */
    text-align: left; /* Align text to the left */
    padding: 5px 0; /* Add some space between items */
}

/* Add padding to icons */
.dropdown-content ul li i {
    margin-right: 10px; /* Add space between icon and text */
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
    a:hover{
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
    .listItemContent{
font-size: large;
        font:bold;
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
.tasks a{
    text-decoration: none;
}
.tasks a{

    text-decoration: none;
}
.listItem li{
    text-decoration: none;
}

</style>

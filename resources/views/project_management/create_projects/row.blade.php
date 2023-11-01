@php
    if (!function_exists('generateRandomColor')) {
        function generateRandomColor($letter)
        {
            // Generate a hash value from the letter
            $hash = crc32($letter);

            // Use the hash value to generate RGB values
            $red = ($hash & 0xff0000) >> 16;
            $green = ($hash & 0x00ff00) >> 8;
            $blue = $hash & 0x0000ff;

            // Create a CSS color string
            $color = sprintf('#%02X%02X%02X', $red, $green, $blue);

            return $color;
        }
    }
@endphp

{{-- archived --}}
<!-- Blade Template -->
<table class="archived" style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif; display:none;">
    <thead>
        <tr>
            <th style="border:1px solid #ccc; padding:12px; background-color:#f2f2f2; text-align:center;">Project Name</th>
            <th style="border:1px solid #ccc; padding:12px; background-color:#f2f2f2; text-align:center;">Company</th>
            <th style="border:1px solid #ccc; padding:12px; background-color:#f2f2f2; text-align:center;">Status</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($archiveData))
            @foreach ($archiveData as $aitem)
                <tr class="@if ($aitem->project_status == 'archive') @endif" data-prjct_id="{{ $aitem->id }}">
                    <td style="border:1px solid #ccc; padding:10px;">
                        <div style="display:flex; align-items:center;">
                            @php
                                $star = $aitem->fvrt == 1 ? 'color:#FFD700;' : '';
                            @endphp
                            <i class="fa-solid fa-star {{ $star }}" style="margin-right:5px;"></i>
                            <a href="#" class="project-link" style="text-decoration:none; color:#333; font-weight:bold; font-size:16px;">{{ $aitem->project_name }}</a>
                        </div>
                    </td>
                    <td style="border:1px solid #ccc; padding:10px; font-style:italic; color:#555; font-size:14px;">{{ $aitem->company }}</td>
                    <td style="border:1px solid #ccc; padding:10px; font-style:italic; color:#555; font-size:14px; text-align:center;">archived</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<!-- JavaScript to toggle visibility -->
<script>

document.getElementById('myselect').addEventListener('change', function() {
  var selectedValue = this.value; // Get the selected value

  if (selectedValue === 'archived') {
    $(document.body).append('.archived'); // Append it to the body
       $('.archived').show();
       $('.activepro').remove();
    
   
  } else {
   
  location.reload();
  }
});



</script>




@foreach ($data as $item)
    <div class="project activepro" data-prjct_id="{{ $item->id }}">
        <div class="top">
            <div class="prjct_breif">
                @php
                    $star = $item->fvrt == 1 ? 'stared' : '';
                @endphp
                <div class="fvrt {{ $star }}"><i class="fa-solid fa-star"></i></div>
                <div class="prjct_name">

                    <a href="#" class="prjct_btn"
                        data-prjct_id="{{ $item->id }}" style="text-decoration: none;">{{ $item->project_name }}</a><br>
                    <span class="light_font">{{ $item->company }}</span>
                </div>
                <div class="ppl" style="gap: 15px; margin-left: 0; flex: 1;">
                    <div class="prjct_more_options">
                        <i class="fa-solid fa-ellipsis" id="" style="color: #dadada; cursor: pointer;"></i>
                    </div>
                    <div class="owner">
                        @php
                            $owner = '<i class="fa-regular fa-circle-user"></i>';
                            $color = '#dadada';
                            if ($item->owner > 0) {
                                $owner = $item->owner;
                            }
                            // $color = generateRandomColor($item->owner[0])
                        @endphp

                        @if ($item->owner == 0)
                            <div class="p" style="background-color: transparent; color: #dadada;font-size: 25px;">
                                <i class="fa-regular fa-circle-user"></i>
                            </div>
                        @else
                            <div class="p"
                                style="background-color: {{ generateRandomColor($item->ownerName->name[0]) }};">
                                {{ $item->ownerName->name[0] }}</div>
                        @endif



                        <div class="options">
                            <ul data-prjct_id="{{ $item->id }}">
                                <li class="ass_owner">
                                    @if ($item->owner == 0)
                                        <div class="p" style="background-color: transparent;"><i
                                                class="fa-regular fa-circle-user"></i></div>No Project Owner
                                    @else
                                        <div class="p"
                                            style="background-color: {{ generateRandomColor($item->ownerName->name[0]) }};
                                            font-size: 11px;">
                                            {{ $item->ownerName->name[0] }}</div>{{ $item->ownerName->name }}
                                    @endif

                                </li>
                                @if ($item->owner == 0)
                                    <li class="update_owner"><i class="fa-solid fa-user"></i> Choose Project Owner</li>
                                @else
                                    <li class="update_owner"><i class="fa-solid fa-user"></i> Update Project Owner</li>
                                @endif

                            </ul>
                        </div>
                    </div>

                </div>

                <div class="more_options">
                    <div class="tab_nav">
                        <div class="tab active">
                            Manage Project
                        </div>
                        <div class="tab">
                            Quick Add
                        </div>
                    </div>

                    <div class="tab_content">
                        <div class="tab_c" data-step="1">
                            <ul data-prjct_id="{{ $item->id }}">
                                <li class="edit_prjct"><i class="fa-solid fa-pen"></i> Edit project Details</li>
                                <li class="disabled"><i class="fa-regular fa-copy"></i> Copy</li>
                                <li class="disabled"><i class="fa-solid fa-briefcase"></i> Save as Template</li>
                                <li class="archive_prjct"><i class="fa-solid fa-box-archive"></i> Archive</li>
                                <li class="disabled"><i class="fa-solid fa-plus"></i> More options</li>
                                <li class="delete"><i class="fa-solid fa-trash"></i> Delete</li>
                            </ul>

                        </div>

                        <div class="tab_C" style="display: none;">
                            <ul data-prjct_id="{{ $item->id }}">
                                <li class="quick-add-task"><i class="fa-regular fa-square-check "></i> Add task</li>
                                <li class="disabled"><i class="fa-solid fa-chart-line"></i> Add budget</li>
                                <li class="add_users"><i class="fa-regular fa-user"></i> Add user</li>
                                <li class="disabled"><i class="fa-solid fa-envelope"></i> Add message</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab_nav">
                <div class="tab active">
                    About
                </div>
                <div class="tab">
                    Insights
                </div>
            </div>
        </div>

        <div class="tab_content">
            <div class="tab_c" data-step="1">
                {{-- <div class="top tags">
                    <p><span class="tag">test</span></p>
                    <button class="tag">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/price-tag--v1.png"
                            alt="price-tag--v1" />
                    </button>
                </div> --}}
                <div class="content">
                    <div class="updates">
                        <p>This Project has no recent updates</p>
                    </div>
                    <p><sup><i class="fa-solid fa-circle-info"></i></sup>{{ $item->notes }}</p>
                </div>

                <div class="ppl" style="margin-left: 15px;">
                    @foreach ($item->users as $u)
                        <div class="p" style="background-color: {{ generateRandomColor($u->name[0]) }};">
                            {{ $u->name[0] }}</div>
                    @endforeach
                </div>
            </div>

            <div class="tab_C" style="display: none;">

            </div>
        </div>
    </div>
@endforeach
<div class="success_msg"></div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script src="{{ URL::asset('js/modal.js') }}"></script>
    {{-- <script src="{{ URL::asset('js/project.js') }}"></script> --}}


<script>
    var quickTaskForm = `
  
<div class="modal" id="quick_add_task" style="z-index:1; ">
    <div class="modal-content" style="width: 35% !important; font-size:4px; border-radius:12px; left:50%; ">
        <!-- Top Section: Title and Steps -->
        <div class="container mt-1">
        <h5 class="text-left mb-4">Quickly Add Tasks</h5>
        <hr>
        <form class="quick-add"  enctype="multipart/form-data">
            @csrf
@method('post')
            <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="projectName">Project Name</label>

        <br>

            <select class="form-control select2" name="project" id="projectName" required>
                <option value="" selected disabled>Select a project</option>
                @foreach ($data as $project)
                  
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                               
                            </optgroup>
                       
                @endforeach
            </select>


        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="listName">List Name</label>
            <select class="form-control select2" name="list" id="list" required>
                <option value="Select a project">Select a Task List</option>
                @foreach ($lists as $list)
                  
                                    <option value="{{ $list->id }}">{{ $list->task_list_name }}</option>
                               
                            </optgroup>
                       
                @endforeach
            </select>
        </div>
    </div>
</div>

<br>
<div class="form-group">
    <label for="taskNames">Task Name(one Task per line)</label>
    <textarea rows="8" cols="40" class="text allow-paste form-control hasChanged" name="tasksText" autofocus=""></textarea>

</div>


    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="assignTo">Assign To</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text h-5" style="height: 35px;"><i class="fas fa-user text-dark"></i></span>
                    </div>
                    <select class="select2" name="doer" id="doer" required style="font-size: 16px;">
    <option value="" selected>Select a List</option>
    @foreach ($team as $users)
        <option value="{{ $users->id }}">{{ $users->name }}</option>
    @endforeach
</select>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="startDate">Start Date(optional)</label>
                <input type="date" class="form-control" name="startDate" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="dueDate">Due Date(optional)</label>
                <input type="date" class="form-control" name="dueDate" required>
            </div>
        </div>
        
    </div>
    <hr class="mt-0">
<div class="col-md-4">
    <div class="form-group">
        <label for="whoCanSee">Who can see?</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" style="height: 35px;"><i class="fa fa-lock text-dark"></i></span>
            </div>
            <input type="text" class="form-control" id="whoCanSee" placeholder="Everybody on the project" required>
        </div>
    </div>
</div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="row">
                <div class="col text-left">
                    <button type="button" class="btn btn-transparent close-form">Close</button>
                </div>
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary rounded-pill quick-submit">Add Task</button>
                </div>
            </div>
        </div>
    </div>
</div>
               

</form>

    </div>

    </div>
</div>`;




$("body").on("click", ".quick-add-task", function() {
    $('body .more_options').hide();
    $('body .all_projects').append(quickTaskForm); // Append it to the body

    // Set the z-index and position of the form
//     $('#quick_add_task').css({
//     'z-index': '1',
//     'position': '',
//     'top': '50%',
//     'left': '50%',
//     'transform': 'translate(-50%)'
// });



    $('#quick_add_task').show(); // Show the modal
    $(".select2").select2();
    var taskId = $(this).data('task-id'); // Get the task ID from the clicked element

    console.log(taskId);

    // Set the task ID as the data-task-id of the form
    $('#edt_tsk_list').attr('data-task-id', taskId);

});



    //quick add submition 





    $("body").on("click", '.close-form', function() {

        $("body #quick_add_task").remove()
location.reload()

    });

    $(document).ready(function() {
        $('body').on('click', '.quick-submit', function(e) {
            e.preventDefault();

            var formData = new FormData($('.quick-add')[0]);
            var id = $('#my-great-dropzone').data('task-list-id');
            var actionRoute = '/submit-form';

            var requestBody = {
                key1: 'value1',
                key2: 'value2'
            };

            formData.append('json_body', JSON.stringify(requestBody));

            // Send the request
            $.ajax({
                url: actionRoute,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $(".success_msg").html(showMessage('success', response.success))

                    // Handle success
                    $("body #quick_add_task").remove()
                },
                error: function(error) {
                    // Handle error
                }
            });
        });
    });

    // <!-- add task form js  
    $(document).ready(function() {


        $("#notes").summernote(
            {
       
                height:90,
                toolbar: [
                    ['font', ['bold', 'italic', 'strikethrough']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['undo', 'redo']]
                ],
           
       
            //  [
            //     // ['style', ['style']],
            //     [
            //         "font",
            //         [
            //             "bold",
            //             "italic",
            //             "strikethrough",
            //         ],
            //     ],
            //     ["para", ["ul", "ol"]],
            //     ["insert", ["link", "picture", "video"]],
            //     ["view", ["undo", "redo"]], // ['fullscreen', 'codeview', 'help']
            // ],
            // toolbar: [
            //     ['style', ['style']],
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

        }
        );

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



    // document.getElementById('taskNames').addEventListener('keydown', function(e) {
    //     if (e.keyCode === 13) {
    //         document.execCommand('insertHTML', false, '<br><br>');
    //         e.preventDefault();
    //     }
    // });
    
 
     $(document).ready(function() {
    $(".edit_prjct").on("click", function(e) {
        $('body .more_options').hide();
        var projectId = $(this).closest('ul').data('prjct_id');
        $.ajax({
            url: '/project/' + projectId,
            type: 'GET',
            success: function(response) {
                var emodal = response.html;
                $('body .all_projects').append(emodal);
                
            },
            error: function(error) {
                console.log(error);
            } 
        });
    });
});

</script>

<style>
      .select2-container .select2-selection--single {
        font-size: 12px;
        height: 35px;
    }
    textarea {
        margin-bottom: 8px;
        resize: vertical;
        line-height: 25px;
        width: 100%;
        height: 100px;
        padding: 0 3px;
        background: #fff url(//twa-prod.teamwork.com/tko/public/legacy/images/quickAdd/back_lines.gif);
    }

    .lined-textarea {
        height: 20px;
        border: 1px solid #ccc;
        min-height: 150px;
        padding: 5px;
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.0em;
        position: relative;
    }

    .lined-textarea:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: repeating-linear-gradient(transparent, transparent 19px, #ccc 19px, #ccc 20px);
        pointer-events: none;
    }



    /* styling for add task form  */

    .sjt {
        width: 100%;
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

    .show {
        display: block;
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

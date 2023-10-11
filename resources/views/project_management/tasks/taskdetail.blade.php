<div class="new_tasks_container">
    <div class="new_acrodian side_open">
        <div class="new_task_list open">
            <div class="new_tasks_list" style="flex: 1;">
                <h4 class="new_tlt"> Task List </h4>
                <div class="new_task_con">
                {{$task->subject}}
            </div>
                <div>
                    <h4>start date</h4>
                    {{ $task->start_date }}
                </div>
                <div>
                    <h4>due date</h4>
                    {{ $task->due_date }}
                </div>
            </div>
            <div class="new_accr_btn">
                <i class="fa-solid fa-circle-chevron-left new_accr_btn_ac"></i>
            </div>
        </div>
        <div class="new_tasks_contaier">
            <div class="task">
                <!-- Heading with Delete Button and Menu Button -->
                <div class="heading">
                    <h4>
                        Task Details 
                    </h4>
                    <div class="buttons">
                        <span id="edit-task" class="edit-task-option" data-task-id="{{ $task->id }}">
                            <i class="fa-solid fa-pencil option_list_icon edit-task"></i>
                            Edit Task
                        </span>
                        <div class="tdropdown">
                            <i class="fa-solid fa-ellipsis tellipsisBtn" onclick="myFunction(this)"></i>
                            <div class="tdropdown-content">
                                <!-- Your dropdown content goes here -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>       
            
                <!-- Task Details -->
                <div class="task-details">
                    <!-- Task Completion Link -->
                    <a href="#" class="task-complete-link"><i class="fa-regular fa-circle-check" data-task-id="{{ $task->id }}"></i></a>
            
                    {{-- <span>{{ $task->id }}</span> --}}
                    <span>{{ $task->subject }}</span>
                    <div class="icons">
                        <li><i class="fa-regular fa-calendar clndr"></i></li>
                        <li class="icons"><i class="fa-regular fa-eye"></i></li>
                    </div>
                </div>
                <hr>
            
                <!-- File Section -->
                <div class="file">
                    <label for="file">File:</label>
                    @if(!empty($task->{'file-name'}))
                    {{-- $pathToFile = Storage::path('uploads/myfile.jpg'); --}}
            
                    <a href="{{Storage::url('public/'.$task->{'file-name'}) }}" target="_blank">
                        {{ str_replace('uploads/', '', $task->{'file-name'}) }}
                    </a>
                @endif
                
                
                
                   
                </div>
                <hr>
            </div>
            
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ URL::asset('css/new_project.css') }}">
<style>

.task {
            display: inline-block;
            margin-bottom: 10px;
           
            padding: 10px;
            width: 100%;
            
        }
        .heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.buttons {
    display: flex;
    align-items: center;
}

.edit-task-option,
.tdropdown {
    margin-left: 10px;
}

       
      

        .delete-btn {
            border-radius: 10%;
            border: 1px solid #ccc;
            padding: 4px;
            margin-left: 10px;
            cursor: pointer;
        }

        .tdropdown,
        .task-details,
        .icons {
            display: inline-block;
        }

        .icons li {
            display: inline-block;
            margin-right: 5px;
        }

        .file {
            margin-top: 10px;
            width: 80%; /* Widened the file section */
        }

      
        .edit-task-option {
    display: inline-block;
    padding: 8px 16px;
    border: none;
    border-radius: 12px; /* Adjust the value for the desired radius */
    background-color: #007bff; /* Adjust the background color as needed */
    color: #fff; /* Text color */
    cursor: pointer;
    font-size: 14px;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s;
    
}

.edit-task-option:hover {
    background-color: #0056b3; /* Change the hover color if desired */
}

    .new_acrodian.side_open {
        display: flex;
        gap: 20px;
        width: 100%;
        height: 100%;
    }

    .new_task_list {
        display: flex;
        max-width: 100%;
    }

    .new_task_list.open{
        flex: 1;
    }

    .new_task_list.close{
        flex: inherit;
    }

    .new_tasks_contaier {
        flex: 2;
    }

    span.new_add_task_list {
        position: absolute;
        right: 18px;
        cursor: pointer;
        color: #4461D7;
        opacity: 0;
    }

    h6.new_tlt:hover > span.new_add_task_list{
        opacity: 1;
    }

    h6.new_tlt {
        position: relative;
    }

    .new_task_con li {
        justify-content: space-between;
        display: flex;
        padding: 3px 10px;
        cursor: pointer;
    }

    .new_task_con li.active, .new_task_con li:hover {
        background-color: #494b50;
        box-shadow: inset 5px 0 0 0px #4461d7;
    }

    span.new_task_counter, .new_list_counter {
        background-color: #f5f7fa;
        padding: 0px 10px;
        border-radius: 20px;
        font-size: 11px;
        line-height: 1.8;
    }

    .new_accr_btn{
        border-left: 1px solid #dadada;
        cursor: pointer;
    }

    .new_accr_btn {
        border-left: 1px solid #dadada;
    }

    .new_accr_btn i {
        margin-left: -11px;
        font-size: 20px;
    }

    .new_tasks_contaier .top h2 {
        font-size: 18px;
    }

    .new_tasks_contaier .top {
        display: flex;
        justify-content: space-between;
    }

    .new_actions label {
        border: 1px solid #f1f1f1;
        border-radius: 20px;
        padding: 0 10px;
        height: 30px;
    }

    .new_actions input#new_search_task {
        border: 0;
        background-color: transparent;
        font-size: 12px;
        padding: 5px 10px 5px 3px;
        font-weight: 400;
        color: #0B0E1F;
        width: 90%;
    }

    .new_actions .new_add_task_list {
        border-radius: 20px;
        padding: 5px 10px;
        color: #fff;
        font-weight: 400;
        letter-spacing: normal;
    }

    .new_rotateright{
        -ms-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }
    
/* EDIT TASK FORM  */


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
</style>

<script src="{{ URL::asset('js/new_modal.js') }}"></script>
<script src="{{ URL::asset('js/new_project.js') }}"></script>

<script>
    $(".new_accr_btn_ac").on("click", function(e){
        $(".new_tasks_list").slideToggle(0.5)
        $(".new_task_list").toggleClass('open')
        $(this).toggleClass('new_rotateright')
    })

    // $(".new_list_btn").on("click", function(){
    //     $(".new_list_btn").removeClass('active')
    //     $(this).toggleClass('active')
    // })

    

   


</script>

<form action="#" id="my-great-dropzone" enctype="multipart/form-data">
    <div class="add_task">
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
                                    id="attch_file"
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
</form>

<style>
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

<script>
    $(document).ready(function () {
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
        $("body").on("click", ".task_bar ul li", function () {
            var tabs = $(this).index();
            $(this).parent().find(".active").removeClass("active");
            $(this).addClass("active");

            // if($(this).parents().eq(1).next().hasClass('task_content')){
            //     var tab = $(this).parent().next()
            // } else {
            var tab = $(this).parents().eq(1).next();
            // }

            tab.find(".task_tab").each(function (index) {
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
        myDropzone.on("dragenter", function () {
            $("#my-great-dropzone").addClass("dragover");
        });

        // Remove the class when the file is dragged away
        myDropzone.on("dragleave", function () {
            $("#my-great-dropzone").removeClass("dragover");
        });

        // Handle the file when it's added to Dropzone
        myDropzone.on("addedfile", function (file) {
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
            deleteButton.addEventListener("click", function () {
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
            myDropzone.on("processing", function (file) {
                // Add a custom CSS class to the file's preview element during processing
                file.previewElement.classList.add("custom-processing-file");

                // You can define your custom CSS rules for .custom-processing-file in your stylesheets
            });

            // Update the progress while uploading
            myDropzone.on("uploadprogress", function (file, progress) {
                // Update the progress in your custom file element (e.g., a progress bar)
                // Example: file.previewElement.querySelector(".custom-progress").style.width = progress + "%";
                progress_prctSpan.textContent = progress + "%"
            });
        });



        // Handle the file upload manually
        myDropzone.on("success", function (file, response) {
            // Assuming the server returns the uploaded file's URL in the response
            var imageUrl = response.imageUrl;

            // Insert the image URL into Summernote
            $("#notes").summernote("editor.insertImage", imageUrl);
        });

        // Listen for changes in the file input
        $("#attch_file").on("change", function (event) {
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

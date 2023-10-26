@extends('main')
@section('title', 'Project Management')


@section('content')
    <div class="page_top">
        <div class="content">
            <div>
                <h2><i class="fa-solid fa-user-group" style="margin-right: 15px;"></i> All Projects </h2>
                <div class="back_link">
                    <a href="/" style="margin-right: 10px;"><i class="fa-solid fa-chevron-left"></i></a>
                    <a href="/">Home</a>/<a href="#">Projects</a>
                </div>

            </div>

            <div>
                <a id="openModalBtn" href="#" class="button">Add Project</a>
            </div>
        </div>
    </div>





    <div class="all_projects">
        @include('project_management.create_projects.row')

    </div>

    @include('project_management.create_projects.add-project')

@endsection

<link rel="stylesheet" href="{{ URL::asset('css/project.css') }}">


@section('script')

<strong><script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script></strong>
{{-- <script>
    tinymce.init({
      selector: "#notes"
    });
  </script> --}}
    <script src="{{ URL::asset('js/modal.js') }}"></script>
    <script src="{{ URL::asset('js/project.js') }}"></script>

    <script>
        // Submit form
        $("body").on("submit", "#pro-form", function(e) {
            e.preventDefault()
            var btn = $("#nextBtn")
            btn.val("Please wait...")

            $.ajax({
                url: '{{ route('saveProject') }}',
                data: $("#pro-form").serialize(),
                method: 'post',
                // dataType: 'json',
                headers: {
                    // 'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status == 400) {
                        showError('prjct_name', res.message.prjct_name)
                        btn.val("Create New Project")
                    } else if (res.status == 200) {
                        $(".success_msg").html(showMessage('success', res.message))
                        $("#pro-form")[0].reset()
                        removeValidtationClasses("#pro-form")
                        btn.val("Create New Project")
                        $(".modal").hide()

                        reloadProjects()
                    } else {
                        $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                        btn.val("Create New Project")
                    }
                }
            })
        })

        $("body").on('click', ".fvrt", function() {
            $(this).toggleClass('stared')
            var prjct_id = $(this).parents().eq(2).data('prjct_id')

            $.ajax({
                url: '{{ route('fvrtProject') }}',
                method: 'post',
                headers: {
                    // 'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    fvrt: 1,
                    id: prjct_id
                },
                success: function(data) {

                }
            })
        })

        $("body").on('click', ".edit_prjct", function(e) {
            var id = $(this).parent().data('prjct_id')
            $.ajax({
                url: `{{ route('getEditProject', ':id') }}`.replace(':id', id),
                method: 'get',
                success: function(data) {
                    $("main.content:first").append(data)

                    // $.getScript('{{ URL::asset('js/modal.js') }}', function() {
                    // After script is loaded or reloaded, initialize events
                    modal("edit_project", "Update")
                    // });
                }
            })


        })

        $("body").on("submit", "#eidtform", function(e) {
            e.preventDefault()
            var btn = $(this).find("#nextBtn");

            btn.val("Please wait...")

            $.ajax({
                url: '{{ route('updateProject') }}',
                dataType: 'json',
                method: 'post',
                data: $(this).serialize(),
                success: function(res) {

                    if (res.status == 400) {
                        showError('prjct_name', res.message.prjct_name)
                        btn.val("Update")
                    } else if (res.status == 200) {
                        $(".success_msg").html(showMessage('success', res.message))
                        $("#edit_project").remove()

                        reloadProjects()
                    } else {
                        $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                        btn.val("Update")
                    }
                }
            })
        })

        // Delete reocrd
        $("body").on("click", ".delete", function() {
            var id = $(this).parent().data("prjct_id")
            var confirmed = confirm("Are you sure you want to delete!")

            if (confirmed) {
                $.ajax({
                    url: '{{ route('deleteProject', ':id') }}'.replace(":id", id),
                    method: "delete",
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res, textStatus, jqXHR) {
                        if (jqXHR.status === 200) {
                            $(".success_msg").html(showMessage('success',
                                "Record deleted successfully"))

                            reloadProjects()

                        } else {
                            $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                        }
                    },
                    error: function(xhr, status, error) {
                        // Check the status code
                        if (xhr.status === 404) {
                            $(".success_msg").html(showMessage('fail', "Request URL not found"))
                        } else {
                            $(".success_msg").html(showMessage('fail',
                                'Request failed with status code:', xhr.status))
                        }
                    }
                })
            }
        })

        // Get modal for assigning users
        $("body").on("click", ".add_users", function() {
            var id = $(this).parent().data("prjct_id")
            $.ajax({
                url: '{{ route('getPeopleForProject', ':id') }}'.replace(':id', id),
                success: function(res) {
                    $("main.content:first").append(res)
                }
            })
        })

        // Get modal for Updating Owner
        $("body").on("click", ".update_owner", function() {
            var id = $(this).parent().data("prjct_id")
            $.ajax({
                url: '{{ route('getOwnerForProject', ':id') }}'.replace(':id', id),
                success: function(res) {
                    loadScript(
                        "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"
                    )
                    $("main.content:first").append(res)


                }
            })
        })

        // Add Users for the project
        $("body").on("submit", "#addUser", function(e) {
            e.preventDefault()

            $.ajax({
                url: '{{ route('addPeopleForProject') }}',
                method: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(res) {
                    if (res.status == 400) {
                        showError('prjct_name', res.message.prjct_name)
                        btn.val("Update")
                    } else if (res.status == 200) {
                        $(".success_msg").html(showMessage('success', res.message))
                        $("#addUsersModal").remove()

                        reloadProjects()
                    } else {
                        $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                        btn.val("Update")
                    }
                }
            })
        })

        // Sumit new owners
        $("body").on("submit", "#addOwner", function(e) {
            e.preventDefault()

            $.ajax({
                url: '{{ route('addOwnerForProject') }}',
                method: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(res) {
                    if (res.status == 400) {
                        showError('prjct_name', res.message.prjct_name)
                        btn.val("Update")
                    } else if (res.status == 200) {
                        $(".success_msg").html(showMessage('success', res.message))
                        $("#addownerModal").remove()

                        reloadProjects()
                    } else {
                        $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                        btn.val("Update")
                    }
                }
            })
        })


        //tasklists for project 
        $("body").on("click", ".prjct_btn", function(e) {
            var id = $(this).data("prjct_id")
            $.ajax({
                url: '{{ route('taskindex', 'id') }}'.replace('id', id),
                success: function(res) {
                    window.location.href = '{{ route('taskview', ':id') }}'.replace(':id', id);
                    document.body.innerHTML =
                        res; // This replaces the entire content of the page with the response
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            })
        })
    </script>
@endsection

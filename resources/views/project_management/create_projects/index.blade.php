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

    <script src="{{ URL::asset('js/modal.js') }}"></script>
    <script src="{{ URL::asset('js/project.js') }}"></script>

    <script>
        // Submit form
        $("body").on("submit", "#form", function(e){
            e.preventDefault()
            var btn = $("#nextBtn")
            btn.val("Please wait...")

            $.ajax({
                url: '{{ route('saveProject') }}',
                data: $("#form").serialize(),
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
                        $("#form")[0].reset()
                        removeValidtationClasses("#form")
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

        $("body").on('click', ".fvrt", function(){
            $(this).toggleClass('stared')
            var prjct_id = $(this).parents().eq(2).data('prjct_id')

            $.ajax({
                url: '{{ route('fvrtProject') }}',
                method: 'post',
                headers: {
                    // 'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {fvrt : 1, id: prjct_id},
                success: function(data){

                }
            })
        })

        $("body").on('click', ".edit_prjct", function(e){
            var id = $(this).parent().data('prjct_id')
            $.ajax({
                url: `{{ route('getEditProject', ':id') }}`.replace(':id', id),
                method: 'get',
                success: function(data){
                    $("main.content:first").append(data)

                    // $.getScript('{{ URL::asset('js/modal.js') }}', function() {
                        // After script is loaded or reloaded, initialize events
                        modal("edit_project", "Update")
                    // });
                }
            })


        })

        $("body").on("submit", "#eidtform", function(e){
            e.preventDefault()
            var btn = $("#nextBtn")
            btn.val("Please wait...")

            $.ajax({
                url: '{{ route('updateProject') }}',
                dataType: 'json',
                method: 'post',
                data: $(this).serialize(),
                success: function(res){

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
        $("body").on("click", ".delete", function(){
            var id = $(this).parent().data("prjct_id")
            var confirmed = confirm("Are you sure you want to delete!")

            if(confirmed){
                $.ajax({
                    url: '{{ route('deleteProject', ':id') }}'.replace(":id", id),
                    method: "delete",
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res, textStatus, jqXHR){
                        if(jqXHR.status === 200){
                            $(".success_msg").html(showMessage('success', "Record deleted successfully"))

                            reloadProjects()

                        } else {
                            $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                        }
                    },
                    error: function(xhr, status, error){
                        // Check the status code
                        if (xhr.status === 404) {
                            $(".success_msg").html(showMessage('fail', "Request URL not found"))
                        } else {
                            $(".success_msg").html(showMessage('fail', 'Request failed with status code:', xhr.status))
                        }
                    }
                })
            }
        })

        // Get modal for assigning users
        $("body").on("click", ".add_users", function(){
            var id = $(this).parent().data("prjct_id")
            $.ajax({
                url: '{{ route('getPeopleForProject', ':id') }}'.replace(':id', id),
                success: function(res){
                    $("main.content:first").append(res)
                }
            })
        })

        // Get modal for Updating Owner
        $("body").on("click", ".update_owner", function(){
            var id = $(this).parent().data("prjct_id")
            $.ajax({
                url: '{{ route('getOwnerForProject', ':id') }}'.replace(':id', id),
                success: function(res){
                    loadScript("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js")
                    $("main.content:first").append(res)


                }
            })
        })

        // Add Users for the project
        $("body").on("submit", "#addUser", function(e){
            e.preventDefault()

            $.ajax({
                url: '{{ route('addPeopleForProject') }}',
                method: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(res){
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
        $("body").on("submit", "#addOwner", function(e){
            e.preventDefault()

            $.ajax({
                url: '{{ route('addOwnerForProject') }}',
                method: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(res){
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

        // Open task list for the project
        $("body").on("click", ".prjct_btn", function(e){
            var id = $(this).data("prjct_id")
            $.ajax({
                url: '{{ route('taskindex', ':id') }}'+'?gettask=1'.replace(':id', id),
                success: function(res){
                    // loadScript("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js")
                    $("main.content:first").html(res)
                    url = '/project/'+ id + '/tasks/list'


                    // document.getElementById("content").innerHTML = response.html;
                    // document.title = response.pageTitle;
                    // window.history.pushState(res,"Tasks", url);
                    // // Dispatch a custom event to notify your application of the URL change
                    // var urlChangeEvent = new CustomEvent('urlChange', { detail: { data: res } });
                    // window.dispatchEvent(urlChangeEvent);

                    history.pushState('', 'Tasks', url); // 'data', 'title', newurl

                    // changeURLWithData(url, 'Tasks');

                }
            })
        })

        window.onpopstate = function(event) {
            if(event && event.state) {
                // event.state.foo
            }
        }

        // Listen for the custom 'urlChange' event
        // window.addEventListener('urlChange', function(event) {
        //     // Handle the URL change and data update here
        //     var data = event.detail.data;
        //     // Update the page content with the data
        //     // document.open();
        //     // document.write(data);
        //     // document.close();
        //     $("main.content:first").html(data)
        // });

        // // Listen to the popstate event (back/forward navigation)
        // window.addEventListener('popstate', function(event) {
        //     // Check if the event state is null (first-time page load)
        //     console.log(event);
        //     if (event.state === null) {
        //         // Define your initial state data
        //         var initialState = {
        //             someData: 'initial data'
        //         };

        //         // Use replaceState to set the initial state
        //         history.replaceState(initialState, document.title, window.location.href);

        //         // You can also trigger your custom event or update the page content here
        //         // Example: triggerCustomEvent(initialState);
        //     } else {
        //         // The event state contains the data you previously pushed to the history stack
        //         var state = event.state;
        //         // Trigger the custom 'urlChange' event with the state data
        //         var urlChangeEvent = new CustomEvent('urlChange', { detail: { data: state } });
        //         window.dispatchEvent(urlChangeEvent);
        //     }

        // });

        function changeURLWithData(newURL, title, data) {
            history.pushState(data, title, newURL);
            // Dispatch a custom event to notify your application of the URL change
            var urlChangeEvent = new CustomEvent('urlChange', { detail: { data: data } });
            window.dispatchEvent(urlChangeEvent);
        }
    </script>
@endsection

@extends('main')
@section('title', 'Team')


@section('content')


<div class="page_top">
    <div class="content">
        <div>
            <h2><i class="fa-solid fa-people-group" style="margin-right: 15px;"></i> Team</h2>
            <div class="back_link">
                <a href="/" style="margin-right: 10px;"><i class="fa-solid fa-chevron-left"></i></a>
                <a href="/">Home</a>/<a href="#">Team</a>
            </div>

        </div>

        <div>
            <a href="/register-team-member" class="button">+ Add New</a>
        </div>
    </div>
</div>

<div class="table">
    <table id="table">
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Phone Number</td>
                <td>Notes</td>
                <td>Actions</td>
            </tr>
        </thead>

        <tbody id="tablebody">
            @include('team.row')
        </tbody>
    </table>
</div>

@endsection


@section('script')
    <script>
        table1_dt = $('#table').DataTable({
            "bStateSave": true,
            responsive: true,
        });

        $("body").on("click", ".row_drop_btn", function(){
            var drop_down_menu = $(this).next()
            if(drop_down_menu.css('display') == 'block'){
                drop_down_menu.css({display: 'none'})
            } else {
                $(".dropdown-menu").css({display: 'none'})
                drop_down_menu.css({display: 'block'})
            }
        })

        $("body").on("click", ".edit", function(){
            var id = $(this).data("id")

            $.ajax({
                url: '{{ route("team") }}',
                method: 'get',
                data: {id : id},
                success: function(res){
                    window.location = '/team/' + id
                    // window.location.replace('/client/' + id)   // history.pushState({}, '', '/client/' + id) // .replace('/client/' + id)
                    // document.open();
                    // document.write(res);
                    // document.close();
                }
            })
        })

        $("body").on("click", '.delete', function(){
            var id = $(this).data("id")

            if (confirm('Are you sure you want to delete this record?')) {

                $.ajax({
                    url: `/team/${id}`,
                    method: 'delete',
                    data: {id : id},
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res, textStatus, jqXHR){
                        if(jqXHR.status === 200){
                            $(".success_msg").html(showMessage('success', "Record deleted successfully"))
                            $('body #table').DataTable().destroy();
                            $("#tablebody").html(res)
                            $('body #table').DataTable().draw();
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
    </script>

@endsection

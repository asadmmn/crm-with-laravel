@extends('main')
@section('title', 'Clients')


@section('content')


<div class="page_top">
    <div class="content">
        <div>
            <h2><i class="fa-solid fa-user-group" style="margin-right: 15px;"></i> Clients</h2>
            <div class="back_link">
                <a href="/" style="margin-right: 10px;"><i class="fa-solid fa-chevron-left"></i></a>
                <a href="/">Home</a>/<a href="#">Clients</a>
            </div>

        </div>

        <div>
            <a href="/register-client" class="button">+ Add new Client</a>
        </div>
    </div>
</div>

<div class="table">
    <table id="clients">
        <thead>
            <tr>
                <td>#</td>
                <td>Client</td>
                <td>Domain</td>
                <td>Serice Package</td>
                <td>Link Needed / Links Budget</td>
                <td>Cr</td>
                <td>Notes</td>
                <td>Actions</td>
            </tr>
        </thead>

        <tbody id="client_body">
            @include('clients.row')
        </tbody>
    </table>
</div>

@endsection


@section('script')
    <script>
        table1_dt = $('#clients').DataTable({
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
                url: '{{ route("client") }}',
                method: 'get',
                data: {id : id},
                success: function(res){
                    window.location = '/client/' + id
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
                    url: `/client/${id}`,
                    method: 'delete',
                    data: {id : id},
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res, textStatus, jqXHR){
                        if(jqXHR.status === 200){
                            $(".success_msg").html(showMessage('success', "Record deleted successfully"))
                            $('body #clients').DataTable().destroy();
                            $("#client_body").html(res)
                            $('body #clients').DataTable().draw();
                        } else {
                            $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                        }

                        console.log(jqXHR.status);
                        // window.location = '/client/' + id
                        // window.location.replace('/client/' + id)   // history.pushState({}, '', '/client/' + id) // .replace('/client/' + id)
                        // document.open();
                        // document.write(res);
                        // document.close();
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

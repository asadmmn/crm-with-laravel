<div class="tasks_container">
    <div class="acrodian side_open">
        <div class="task_list open">
            <div class="tasks_list" style="flex: 1;">
                <h6 class="tlt"><i class="fa-solid fa-list-ul"></i> Task Lists <span class="add_task_list">+ Add</span></h6>
                <div class="task_con">
                    <ul>
                        <li class="list_btn">All Lists <span class="task_counter">6</span></li>
                        <li class="list_btn active">List 1 <span class="list_counter">0</span></li>
                        <li class="list_btn">List 1 <span class="list_counter">0</span></li>
                        <li class="list_btn">List 1 <span class="list_counter">0</span></li>
                    </ul>
                </div>
            </div>

            <div class="accr_btn">

                <i class="fa-solid fa-circle-chevron-left accr_btn_ac"></i>
            </div>
        </div>

        <div class="tasks_contaier">
            @include('project_management.tasks.single_task')
        </div>
    </div>
</div>

@include('project_management.tasks.task_list_form')

<link rel="stylesheet" href="{{ URL::asset('css/project.css') }}">
<style>
    .acrodian.side_open {
        display: flex;
        gap: 20px;
        width: 100%;
        height: 100%;
    }

    .task_list {

        display: flex;
        max-width: 300px;
    }

    .task_list.open{
        flex: 1;
    }

    .task_list.close{
        flex: inherit;
    }

    .tasks_contaier {
        flex: 2;
    }

    span.add_task_list {
        position: absolute;
        right: 18px;
        cursor: pointer;
        color: #4461D7;
        opacity: 0;
    }

    h6.tlt:hover > span.add_task_list{
        opacity: 1;
    }

    h6.tlt {
        /* display: flex; */
        /* justify-content: space-between; */
        position: relative;
    }

    .task_con li {
        justify-content: space-between;
        display: flex;
        padding: 3px 10px;
        cursor: pointer;
    }

    .task_con li.active, .task_con li:hover {
        background-color: #F2F4FC;
        /* border-left: 3px solid blue; */
        box-shadow: inset 5px 0 0 0px #4461d7;
    }

    span.task_counter, .list_counter {
        background-color: #f5f7fa;
        padding: 0px 10px;
        border-radius: 20px;
        font-size: 11px;
        line-height: 1.8;
    }

    .accr_btn{
        border-left: 1px solid #dadada;
        cursor: pointer;
    }

    .accr_btn {
        border-left: 1px solid #dadada;
    }

    .accr_btn i {
        margin-left: -11px;
        font-size: 20px;
    }

    .tasks_contaier .top h2 {
        font-size: 18px;
    }

    .tasks_contaier .top {
        display: flex;
        justify-content: space-between;
    }

    .actions label {
        border: 1px solid #f1f1f1;
        border-radius: 20px;
        padding: 0 10px;
        height: 30px;
    }

    .actions input#search_task {
        border: 0;
        background-color: transparent;
        font-size: 12px;
        padding: 5px 10px 5px 3px;
        font-weight: 400;
        color: #0B0E1F;
        width: 90%;
    }

    .actions .add_task_list {
        border-radius: 20px;
        padding: 5px 10px;
        color: #fff;
        font-weight: 400;
        letter-spacing: normal;
    }

    .rotateright{
        -ms-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }
</style>

<script src="{{ URL::asset('js/modal.js') }}"></script>
<script src="{{ URL::asset('js/project.js') }}"></script>

<script>
    $(".accr_btn_ac").on("click", function(e){
        $(".tasks_list").slideToggle(0.5)

        $(".task_list").toggleClass('open')
        $(this).toggleClass('rotateright')
    })

    $(".list_btn").on("click", function(){
        $(".list_btn").removeClass('active')
        $(this).toggleClass('active')
    })

    $(".add_task_list").on("click", function(e){
        $("#add_project").toggle()
    })
</script>

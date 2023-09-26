<div class="top">
    <div class="top_heading">
        <h2>Tasks</h2>
        <div class="btn_container">
            <button class="text_btn">
                <i class="fa-solid fa-ellipsis"></i>
            </button>

            <div class="btn_con">
                <ul>
                    <li><i class="fa-solid fa-pencil option_list_icon"></i> <span class="option_list_text">Edit List</span></li>
                    <li><i class="fa-regular fa-copy option_list_icon"></i> <span class="option_list_text">Move or Copy</span></li>
                    <li><i class="fa-solid fa-sort option_list_icon"></i> <span class="option_list_text">Reorder Tasks By...</span></li>
                    <li><i class="fa-solid fa-file option_list_icon"></i> <span class="option_list_text">Reports</span></li>
                    <li><i class="fa-solid fa-trash option_list_icon"></i> <span class="option_list_text">Delete List</span></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="actions">
        <label>
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="search_task" id="search_task" placeholder="Assignee or task name">
        </label>

        <button class="add_task_list">+ Add Task List</button>
        <button class="text_btn">
            <i class="fa-solid fa-ellipsis"></i>
        </button>
    </div>
</div>

<div class="tasks">
    <div class="task_con">
        <div class="task_binding">
            <div class="actions">
                <button class="edit_task"><i class="fa-solid fa-pencil"></i></button>
                <button class="open_task"><i class="fa-solid fa-chevron-right"></i></button>
                <button class="mark_task_completed"><span></span><i class="fa-solid fa-check"></i></button>
            </div>

            <div class="task_content">
                <div class="task_owner"><i class="fa-regular fa-user"></i></div>
                <p class="task_text">This is task text</p>
                <!-- HTML Input Fields -->
                <input type="text" id="startDateInput" class="hoverable">
                {{-- <input type="text" id="dueDateInput" class="hoverable"> --}}
                <input type="text" id="dueDateInput" placeholder="Hover to see calendar">


            </div>
        </div>
    </div>
</div>
<div id="calendar" class="hidden"></div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">





<script>
  $(document).ready(function () {
    var $ = jQuery.noConflict();
    // Initialize the Datepicker on input field focus
    $('#dueDateInput').focus(function() {
        $(this).datepicker({
            format: 'yyyy-mm-dd', // Adjust the format as needed
            // Add any other Datepicker options here
        });
    });
    
    // Initialize datepicker for Start Date
    $('#startDateInput').datepicker({
      format: 'yyyy-mm-dd', // Adjust the format as needed
    });

    // // Initialize datepicker for Due Date
    // $('#dueDateInput').datepicker({
    //   format: 'yyyy-mm-dd', // Adjust the format as needed
    // });



    // Function to calculate remaining time
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

    // Hover event handler for hoverable inputs
    $('.hoverable').hover(
      function () {
        // Show the datepicker
        $(this).datepicker('show');
      },
      function () {
        // Hide the datepicker
        $(this).datepicker('hide');
      }
    );

    // Event listener for datepicker's "changeDate" event
    $('#startDateInput, #dueDateInput').on('changeDate', function () {
      // Calculate and display remaining time
      var remainingTime = calculateRemainingTime();
      $('.datepicker-days .datepicker-switch').text(remainingTime);
    });
  });


</script>

<style>
  /* CSS to style the calendar container */
/* #calendar {
  position: absolute;
  z-index: 9999;
  background-color: white;
  border: 1px solid #ccc;
  padding: 10px;
  box-shadow: 0px 0px 5px #888888;
} */

/* Hidden class to initially hide the calendar */
/* .hidden {
  display: none;
} */

</style>

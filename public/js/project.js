$(".project").on("click", ".prjct_more_options", function(){
    $(this).parent().next().slideToggle("0.")
})

var isInsideMyDiv = false;

// Set a flag when the mouse enters the div
$('.more_options').on('mouseenter', function() {
    isInsideMyDiv = true;
  });

// Reset the flag when the mouse leaves the div
$('.more_options').on('mouseleave', function() {
    isInsideMyDiv = false;
});

// Hide more options if clicked else where in body
$('body').on('click', function(event) {

    if (!isInsideMyDiv && event.target.class !== 'more_options' && !$(event.target).closest('.prjct_more_options').length) {
        $('.more_options').hide();
    }
});

$(".project").on("mouseenter click", ".owner", function(){
    var div = $(this)
    setTimeout(function() {
        div.children().eq(1).show()
    }, 300);
})

$(".project").on("mouseleave", ".owner", function(){
    var div = $(this)
    setTimeout(function() {
        div.children().eq(1).hide()
    }, 600);
})



// $(document).ready(function () {
    modal("add_project", "Create Project")
    


    // Close Modal
    $("body").on("click", ".close-btn", function(){
        $(this).parents().eq(2).hide()
        
    })

    // Remove modal box
    $("body").on('click', ".edit .close-btn, #addUsersModal .close-btn, #addownerModal .close-btn", function(){
        $(this).parents().eq(2).remove()
    })


    // slct_project btn
    $("body").on("click", ".slct_prjct_btn", function () {
        var html = `<div class="selected__check">
            <svg width="15" height="15" viewBox="0 0 42 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.307044 24.8107C3.83704 31.7207 7.36704 38.6408 10.897 45.5508C11.907 47.5408 14.877 46.9108 15.467 44.9508C20.097 29.5108 28.6971 15.4407 40.2871 4.25074C42.6071 2.01074 39.067 -1.51924 36.747 0.710761C24.547 12.4908 15.5171 27.3808 10.6371 43.6208L15.207 43.0208C11.677 36.1108 8.14704 29.1907 4.61704 22.2807C3.15704 19.4107 -1.16293 21.9408 0.297065 24.8008H0.307044V24.8107Z" fill="#138848"/>
            </svg>

        </div>`;
        $(".slct_prjct_btn").removeClass("active");
        $(".selected__check").remove();
        $(this).addClass("active");
        $(this).prepend(html);
    });

    // Switch Tabs
    $("body").on("click", ".tab", function(){
        var tabs = $(this).index()
        $(this).parent().find(".tab").removeClass("active")
        $(this).addClass("active")

        if($(this).parent().next().hasClass('tab_content')){
            var tab = $(this).parent().next()
        } else {
            var tab = $(this).parents().eq(1).next()
        }

        tab.find(".tab_c").each(function(index){
            if(index == tabs){

                $(this).show()
            } else {
                $(this).hide()
            }
        })
    })

    // Accrodian
    $("body").on("click", ".accrodian", function(e){
        e.preventDefault()

        var thi = $(this).toggleClass("active")
        var content = $(this).parent().next()
        content.slideToggle("0.1")

    })


// });


function loadScript(scriptUrl) {
    var script = document.createElement('script');
    script.src = scriptUrl;
    script.type = 'text/javascript';
    script.async = true;
    document.head.appendChild(script);
}

function reloadProjects(){
    $.ajax({
        url: '/projectList',
        success: function(data){
            $(".all_projects").html(data)
            loadScript("/js/project.js")
        }
    })
}


function generateColor(letter) {
    // Calculate a unique value for the letter based on its ASCII code
    const uniqueValue = letter.charCodeAt(0) % 360;

    // Convert the unique value to HSL color
    const hslColor = `hsl(${uniqueValue}, 70%, 50%)`;

    return hslColor;
  }

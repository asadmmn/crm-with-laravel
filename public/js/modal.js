function modal(id, btn_val){
    const modal = $("#" + id);
    const openModalBtn = $("#openModalBtn");
    const closeModalBtn = modal.find(".close-btn");
    const formSteps = modal.find(".form-step");
    const stepItems = modal.find(".step-item");
    const prevBtn = modal.find(".prev-btn");
    const nextBtn = modal.find(".next-btn");
    let currentStep = 0;

    function showStep(stepIndex) {
        formSteps.each(function (index) {
            if (index === stepIndex) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        currentStep = stepIndex;
        updateStepIndicators();
        updateButtonVisibility();
    }

    function handleNext(e) {
        if (currentStep < formSteps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function handlePrevious() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    function updateStepIndicators() {
        stepItems.each(function (index) {
            if (index === currentStep) {
                $(this).addClass("active");
            } else if([index + 1] === stepItems.length) {
                $(this).html(btn_val)
                $(this).attr('type', 'submit')
            } else {
                $(this).removeClass("active");
            }

            if (index < currentStep) {
                $(this).find(".step-circle")
                    .html(`<svg width="15" height="15" viewBox="0 0 42 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.307044 24.8107C3.83704 31.7207 7.36704 38.6408 10.897 45.5508C11.907 47.5408 14.877 46.9108 15.467 44.9508C20.097 29.5108 28.6971 15.4407 40.2871 4.25074C42.6071 2.01074 39.067 -1.51924 36.747 0.710761C24.547 12.4908 15.5171 27.3808 10.6371 43.6208L15.207 43.0208C11.677 36.1108 8.14704 29.1907 4.61704 22.2807C3.15704 19.4107 -1.16293 21.9408 0.297065 24.8008H0.307044V24.8107Z" fill="#138848"/>
                </svg>`);
            }
        });
    }

    function updateButtonVisibility() {
        prevBtn.toggleClass("hidden", currentStep === 0);
        nextBtn.toggleClass(
            "hidden",
            currentStep === formSteps.length 
        );
        if([currentStep + 1] == formSteps.length){
            nextBtn.html(btn_val)
            nextBtn.attr("type", 'submit')
        } else {
            nextBtn.html("Next")
            nextBtn.attr("type", 'button')
        }

        if(currentStep == 0){
            prevBtn.hide()
        } else {
            prevBtn.show()
        }
    }

    function updateDividerPositions() {
        const numSteps = formSteps.length;
        const dividerPositions = [];

        for (let i = 1; i < numSteps; i++) {
            dividerPositions.push((i / numSteps) * 100);
        }

        const dividers = $(".steps-divider");
        dividers.each(function (index) {
            $(this).css(
                "left",
                `calc(${dividerPositions[index]}% - 5px)`
            );
        });
    }

    // Show the first step initially
    showStep(currentStep);

    openModalBtn.on("click", function () {
        modal.show();
        updateStepIndicators();
        updateButtonVisibility();
        updateDividerPositions();
    });

    closeModalBtn.on("click", function () {
        modal.hide();
        currentStep = 0;
        showStep(currentStep);
        updateStepIndicators();
        updateButtonVisibility();
    });

    prevBtn.on("click", handlePrevious);
    nextBtn.on("click", function(e){

        if (currentStep < formSteps.length - 1) {
            currentStep++;
            showStep(currentStep);
            e.preventDefault()
        }
    });

    stepItems.each(function (index) {
        $(this).on("click", function () {
            showStep(index);
        });
    });

    // formSteps.on("submit", function (event) {
    //     event.preventDefault();
    //     confirm("Are you sure!")
    //     // Handle form submission or validation here
    // });
}

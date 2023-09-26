@php
    if (!function_exists('generateRandomColor')) {
        function generateRandomColor($letter)
        {
            // Generate a hash value from the letter
            $hash = crc32($letter);

            // Use the hash value to generate RGB values
            $red = ($hash & 0xff0000) >> 16;
            $green = ($hash & 0x00ff00) >> 8;
            $blue = $hash & 0x0000ff;

            // Create a CSS color string
            $color = sprintf('#%02X%02X%02X', $red, $green, $blue);

            return $color;
        }
    }
@endphp

<div class="modal" id="add_project">
    <div class="modal-content">
        <!-- Top Section: Title and Steps -->
        <div class="top-section">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <h2>Add New Project</h2>
            <div class="steps">
                <div class="step-item active">
                    <div class="step-circle">1</div>
                    Project Options
                </div>
                <!-- <div class="step_divider"></div> -->
                <div class="step-item">
                    <div class="step-circle">2</div>
                    Details
                </div>
                <!-- <div class="step_divider"></div> -->
                <div class="step-item">
                    <div class="step-circle">3</div>
                    Add People
                </div>
                <!-- <div class="step_divider"></div> -->
                <div class="step-item">
                    <div class="step-circle">4</div>
                    Advanced options
                </div>
            </div>
        </div>

        <!-- Middle Section: Form Inputs -->
        <form id="form">
            <div class="middle-section">

                    <div class="form-step slct_proj" data-step="1">
                        <div class="box_container">
                            <button type="button" class="active slct_prjct_btn" >
                                <span class="slct_prj_icon">
                                    <div class="selected__check">
                                        <!-- <i class="fa-solid fa-check"></i> -->
                                        <svg width="15" height="15" viewBox="0 0 42 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.307044 24.8107C3.83704 31.7207 7.36704 38.6408 10.897 45.5508C11.907 47.5408 14.877 46.9108 15.467 44.9508C20.097 29.5108 28.6971 15.4407 40.2871 4.25074C42.6071 2.01074 39.067 -1.51924 36.747 0.710761C24.547 12.4908 15.5171 27.3808 10.6371 43.6208L15.207 43.0208C11.677 36.1108 8.14704 29.1907 4.61704 22.2807C3.15704 19.4107 -1.16293 21.9408 0.297065 24.8008H0.307044V24.8107Z" fill="#138848"/>
                                        </svg>
                                    </div>
                                    <div class="box">
                                        <svg
                                            data-v-3c1d4231=""
                                            width="100"
                                            height="100"
                                            viewBox="0 0 100 100"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                data-v-3c1d4231=""
                                                opacity="0.3"
                                                d="M50 100C77.6142 100 100 77.6142 100 50C100 22.3858 77.6142 0 50 0C22.3858 0 0 22.3858 0 50C0 77.6142 22.3858 100 50 100Z"
                                                fill="white"
                                            ></path>
                                            <path
                                                data-v-3c1d4231=""
                                                d="M50.0001 89.8178C71.9908 89.8178 89.8178 71.9908 89.8178 50.0001C89.8178 28.0094 71.9908 10.1824 50.0001 10.1824C28.0094 10.1824 10.1824 28.0094 10.1824 50.0001C10.1824 71.9908 28.0094 89.8178 50.0001 89.8178Z"
                                                fill="white"
                                            ></path>
                                            <path
                                                data-v-3c1d4231=""
                                                d="M67.5051 63.0275L51.1251 46.04C49.8426 44.735 45.8713 48.4025 46.9963 49.7863L62.7463 67.2913C63.9388 68.8213 68.9451 64.4788 67.5051 63.0275Z"
                                                fill="#A3E0FC"
                                            ></path>
                                            <path
                                                data-v-3c1d4231=""
                                                d="M43.9025 46.625C43.2296 45.9916 42.248 45.8111 41.3938 46.1637C40.325 46.6587 40.1225 47.7725 40.8313 48.9762C41.1238 49.4712 40.8875 49.82 39.0763 51.3837C37.5575 52.6662 31.0325 44.375 32.1238 43.3287C33.215 42.2825 33.395 41.8775 33.9013 42.2037C34.6973 42.5217 35.6022 42.3946 36.2798 41.8696C36.9574 41.3446 37.3065 40.5002 37.1975 39.65C37.1419 39.5168 37.1419 39.3669 37.1975 39.2337C37.2468 39.1157 37.324 39.0115 37.4225 38.93C38.75 37.715 39.875 36.5562 40.7075 35.825C45.8713 31.325 48.5825 32.5062 51.9575 35.5662C52.7563 36.2975 51.9575 37.22 50.8325 36.9275C46.04 35.5437 44.51 38.975 47.3113 42.125L50.5175 45.815C51.0688 46.5687 47.66 50.315 46.9963 49.7525L43.9025 46.625Z"
                                                fill="#D6DEE7"
                                            ></path>
                                            <path
                                                data-v-3c1d4231=""
                                                d="M47.9525 48.6275L33.5638 63.0725C32.3488 64.2987 31.0775 68.4613 33.0013 67.8988C34.5178 67.538 35.9479 66.8803 37.2088 65.9637C40.1113 63.0612 45.14 58.01 51.4176 51.3388C50.09 50 49.28 50 47.9525 48.6275Z"
                                                fill="#D6DEE7"
                                            ></path>
                                            <path
                                                data-v-3c1d4231=""
                                                d="M59 33.7888C56.0066 36.6661 53.1641 39.6964 50.4838 42.8675C52.025 44.3413 49.8313 46.7488 48.11 45.4438C47.3563 46.1413 46.1525 46.895 46.0738 47.4012C45.905 48.3913 50.9225 53.6675 52.61 53.7463C53.1521 53.297 53.6159 52.761 53.9825 52.16C52.7563 50.8775 54.4775 48.5263 56.1313 49.6625C59.5063 46.7038 62.8813 43.565 66.0763 40.325C71.51 34.8238 64.085 29.0863 59 33.7888Z"
                                                fill="#63C0F9"
                                            ></path>
                                        </svg>
                                    </div>
                                </span>
                            </button>

                            <label>Start from scratch</label>
                        </div>

                        <div class="box_container">
                            <button type="button" class="slct_prjct_btn">
                                <span class="slct_prj_icon">
                                    <div class="box">
                                        <svg
                                            data-v-3c1d4231=""
                                            width="80"
                                            height="80"
                                            viewBox="0 0 80 80"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                data-v-3c1d4231=""
                                                d="M40.0001 79.8178C61.9908 79.8178 79.8178 61.9908 79.8178 40.0001C79.8178 18.0093 61.9908 0.182343 40.0001 0.182343C18.0094 0.182343 0.182373 18.0093 0.182373 40.0001C0.182373 61.9908 18.0094 79.8178 40.0001 79.8178Z"
                                                fill="white"
                                            ></path>
                                            <path
                                                data-v-3c1d4231=""
                                                d="M59.9337 42.601C59.9337 35.274 59.9834 31.3895 59.8922 30.701C59.9585 29.9785 59.7511 29.4855 59.0624 29.528C53.3451 29.0265 44.3171 29.426 41.7447 29.0775C41.3962 28.6015 41.0394 27.1905 40.6743 26.74C40.3092 26.2895 39.4296 25.176 39.0147 24.5725C38.4007 23.5525 37.8696 23.5015 35.7371 23.578C24.3358 23.9265 22.9251 23.2975 22.2364 23.7905C21.0664 26.57 22.0456 54.926 22.112 55.011C22.112 56.3625 22.643 56.3965 23.2488 56.3965C33.5962 56.3455 58.2824 56.864 58.8632 56.5325C59.0574 56.5308 59.2416 56.4442 59.3694 56.2945C59.5027 56.1328 59.5761 55.9281 59.5768 55.7165C60 51.39 59.942 46.987 59.9337 42.601Z"
                                                fill="#63C0F9"
                                            ></path>
                                        </svg>
                                    </div>
                                </span>
                            </button>

                            <label>Select from template</label>
                        </div>
                    </div>
                    <div class="form-step" data-step="2" style="flex-direction: column">
                        <div class="input_group" style="width: 100%">
                            <div class="input">
                                <div class="input">
                                    <label for="project_name" >Choose a name</label>
                                    <input type="text" name="project_name" id="project_name" placeholder="Give Your project a name" />
                                </div>
                            </div>

                            <div class="input">
                                <label for="company">Choose a company</label >
                                <select name="company" id="company">
                                    <option value="Domain Bird"> Domain Bird </option>
                                </select>
                            </div>
                        </div>

                        <div class="textarea" style="width: 100%">
                            <textarea name="notes" id="notes"  cols=""  rows="5" placeholder="Add a description" style="width: 100%"></textarea>
                        </div>
                    </div>
                    <div class="form-step" data-step="3">
                        <div class="contaier">
                            <div class="ppl">
                                <div class="p">D</div>
                                <div class="p">NA</div>
                                <div class="p">Pl</div>
                            </div>
                            <div class="search_ppl">
                                <input type="search" name="ppl_search" id="ppl_search" placeholder="Search"/>
                                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                            </div>

                            <div class="ppl_show">
                                <div class="tab_nav">
                                    <div class="tab active">
                                        People
                                        <div class="count_ppl">5</div>
                                    </div>
                                    <div class="tab">
                                        Teams
                                        <div class="count_ppl"></div>
                                    </div>
                                </div>

                                <div class="tab_content">
                                    <div class="tab_c" data-step="1">
                                        <div class="top">
                                            <p>Domain Bird</p>
                                            <button class="accrodian">
                                                <i class="fa-solid fa-angle-up" ></i>
                                            </button>
                                        </div>
                                        <div class="cont">
                                            @if (count($team) === 0)
                                                <a href="/register-team-member" style="font-size: 12px; text-decoration: underline; color: #3a3a3a;">Add team members</a>
                                            @else
                                                @foreach ($team as $t)
                                                    <label>
                                                        <input type="checkbox" name="add_ppl[]" id="" class="add_ppl" value="{{ $t->id }}"/>
                                                        <div class="p" style="background-color: {{ generateRandomColor($t->name[0]) }};">{{ $t->name[0] }}</div>
                                                        {{ $t->name }}
                                                    </label>
                                                @endforeach
                                            @endif


                                        </div>
                                    </div>

                                    <div class="tab_C">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-step" data-step="4">
                        <div class="contaier">
                            <div class="input" style="width: 100%;">
                                <label for="project_cat">Add project Category</label>
                                <select name="proj_category" id="proj_category">
                                    <option value="No Category">No Category</option>
                                    <option value="Category 1">Category 1</option>
                                </select>
                            </div>

                        </div>
                    </div>

            </div>

            <!-- Footer Section: Buttons -->
            <div class="footer-section">
                <button type="button" class="prev-btn" id="prevBtn">
                    Previous
                </button>
                <button type="submit" class="next-btn" id="nextBtn">
                    Next
                </button>
                <button type="button" class="cancel-btn" id="closeModalBtn">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

{{-- @endsection --}}

{{-- @section('script')
<script>

</script>
@endsection

@section('style')


@endsection --}}

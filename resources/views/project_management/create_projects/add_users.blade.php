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

<div class="modal" id="addUsersModal" style="display: block;">
    <div class="modal-content">
        <!-- Top Section: Title and Steps -->
        <div class="top-section">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <h2>Add People to Project</h2>
        </div>

        <!-- Middle Section: Form Inputs -->
        <form id="addUser">
            <div class="middle-section">

                <input type="hidden" name="id" value="{{  $id ?? '' }}">
                @csrf

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
                                        @foreach ($data as $t)
                                            <label>
                                                <input type="checkbox" name="add_ppl[]" id="" class="add_ppl" value="{{ $t->id }}"/>
                                                <div class="p" style="background-color: {{ generateRandomColor($t->name[0]) }};">{{ $t->name[0] }}</div>
                                                {{ $t->name }}
                                            </label>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="tab_C">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Section: Buttons -->
            <div class="footer-section">
                <button type="submit" class="next-btn" id="nextBtn">
                    Add Selected Users
                </button>
                <button type="button" class="cancel-btn" id="closeModalBtn">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

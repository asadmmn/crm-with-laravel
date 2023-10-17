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

<div class="modal edit" id="edit_project" style="display: block;">
    <div class="modal-content">
        <!-- Top Section: Title and Steps -->
        <div class="top-section">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <h2>Edit a Project</h2>
            <div class="steps">
                <!-- <div class="step_divider"></div> -->
                <div class="step-item">
                    <div class="step-circle">1</div>
                    Details
                </div>
                <!-- <div class="step_divider"></div> -->
                <div class="step-item">
                    <div class="step-circle">2</div>
                    Advanced options
                </div>
            </div>
        </div>

        <!-- Middle Section: Form Inputs -->
        <form id="eidtform">
            <div class="middle-section">

                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                @csrf

                <div class="form-step" data-step="1" style="flex-direction: column">
                    <div class="input_group" style="width: 100%">
                        <div class="input">
                            <div class="input">
                                <label for="project_name">Choose a name</label>
                                <input type="text" name="project_name" id="project_name"
                                    placeholder="Give Your project a name" value="{{ $data->project_name ?? '' }}" />
                            </div>
                        </div>

                        <div class="input">
                            <label for="company">Choose a company</label>
                            <select name="company" id="company">
                                <option value="Domain Bird"> Domain Bird </option>
                            </select>
                        </div>
                    </div>

                    <div class="textarea" style="width: 100%">
                        <textarea name="notes" id="notes" cols="" rows="5" placeholder="Add a description"
                            style="width: 100%">{{ $data->notes ?? '' }}</textarea>
                    </div>
                </div>

                <div class="form-step" data-step="2" style="display: none;">
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
                <button type="button" class="next-btn" id="nextBtn">
                    Next
                </button>
                <button type="button" class="cancel-btn" id="closeModalBtn">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

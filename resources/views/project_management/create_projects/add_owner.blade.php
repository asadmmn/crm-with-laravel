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

<div class="modal" id="addownerModal" style="display: block;">
    <div class="modal-content">
        <!-- Top Section: Title and Steps -->
        <div class="top-section">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <h2>Add Owner to Project</h2>
        </div>

        <!-- Middle Section: Form Inputs -->
        <form id="addOwner">
            <div class="middle-section">

                <input type="hidden" name="id" value="{{  $id ?? '' }}">
                @csrf

                <div class="form-step" data-step="3">
                    <div class="input">
                        <label for="user">Choose User</label>
                        <select name="owner" id="owner">
                            <option value="0">No project owner</option>
                            {{-- @foreach ($data as $u)
                                <div>
                                    <div class="p" style="background-color: {{ generateRandomColor($u->name[0]) }};">{{ $u->name[0] }}</div>
                                    <option value="{{ $u->id }}">

                                        {{ $u->name }}
                                    </option>
                                </div>

                            @endforeach --}}


                        </select>
                    </div>
                </div>

            </div>

            <!-- Footer Section: Buttons -->
            <div class="footer-section">
                <button type="submit" class="next-btn" id="nextBtn">
                    Update Owner
                </button>
                <button type="button" class="cancel-btn" id="closeModalBtn">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    <script>

        var frameworks = {!! json_encode($data->toArray()) !!}

        $('#owner').empty();
        $("#owner").select2({
            data: frameworks,
            templateResult: format,
            templateSelection: format,
            escapeMarkup: function(m) {
                return m;
            },

            placeholder: " Click here to select",
        }).val('No Project Owner').trigger("change");

        function format(state) {
            var options = ''
            var name = state.name
            if (!state.id) return state.name; // optgroup
                options += `<span style="display: flex; align-items: center;"><div class="p" style="background-color: ${generateColor(name[0])}; width: 22px;height: 22px;font-size: 13px;line-height: 1.5;margin-right: 7px;"">${state.name[0]}</div>` + state.name +"</span>";
            return options
        }
    </script>
</div>

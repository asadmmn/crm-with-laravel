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

@foreach ($data as $item)
    <div class="project" data-prjct_id="{{ $item->id }}">
        <div class="top">
            <div class="prjct_breif">
                @php
                    $star = $item->fvrt == 1 ? 'stared' : '';
                @endphp
                <div class="fvrt {{ $star }}"><i class="fa-solid fa-star"></i></div>
                <div class="prjct_name">

                    <a href="#" class="prjct_btn"
                        data-prjct_id="{{ $item->id }}">{{ $item->project_name }}</a><br>
                    <span class="light_font">{{ $item->company }}</span>
                </div>
                <div class="ppl" style="gap: 15px; margin-left: 0; flex: 1;">
                    <div class="prjct_more_options">
                        <i class="fa-solid fa-ellipsis" id="" style="color: #dadada; cursor: pointer;"></i>
                    </div>
                    <div class="owner">
                        @php
                            $owner = '<i class="fa-regular fa-circle-user"></i>';
                            $color = '#dadada';
                            if ($item->owner > 0) {
                                $owner = $item->owner;
                            }
                            // $color = generateRandomColor($item->owner[0])
                        @endphp

                        @if ($item->owner == 0)
                            <div class="p" style="background-color: transparent; color: #dadada;font-size: 25px;">
                                <i class="fa-regular fa-circle-user"></i></div>
                        @else
                            <div class="p"
                                style="background-color: {{ generateRandomColor($item->ownerName->name[0]) }};">
                                {{ $item->ownerName->name[0] }}</div>
                        @endif



                        <div class="options">
                            <ul data-prjct_id="{{ $item->id }}">
                                <li class="ass_owner">
                                    @if ($item->owner == 0)
                                        <div class="p" style="background-color: transparent;"><i
                                                class="fa-regular fa-circle-user"></i></div>No Project Owner
                                    @else
                                        <div class="p"
                                            style="background-color: {{ generateRandomColor($item->ownerName->name[0]) }}; font-size: 11px;">
                                            {{ $item->ownerName->name[0] }}</div>{{ $item->ownerName->name }}
                                    @endif

                                </li>
                                @if ($item->owner == 0)
                                    <li class="update_owner"><i class="fa-solid fa-user"></i> Choose Project Owner</li>
                                @else
                                    <li class="update_owner"><i class="fa-solid fa-user"></i> Update Project Owner</li>
                                @endif

                            </ul>
                        </div>
                    </div>

                </div>

                <div class="more_options">
                    <div class="tab_nav">
                        <div class="tab active">
                            Manage Project
                        </div>
                        <div class="tab">
                            Quick Add
                        </div>
                    </div>

                    <div class="tab_content">
                        <div class="tab_c" data-step="1">
                            <ul data-prjct_id="{{ $item->id }}">
                                <li class="edit_prjct"><i class="fa-solid fa-pen"></i> Edit project Details</li>
                                <li class="disabled"><i class="fa-regular fa-copy"></i> Copy</li>
                                <li class="disabled"><i class="fa-solid fa-briefcase"></i> Save as Template</li>
                                <li class="disabled"><i class="fa-solid fa-box-archive"></i> Archive</li>
                                <li class="disabled"><i class="fa-solid fa-plus"></i> More options</li>
                                <li class="delete"><i class="fa-solid fa-trash"></i> Delete</li>
                            </ul>

                        </div>

                        <div class="tab_C" style="display: none;">
                            <ul data-prjct_id="{{ $item->id }}">
                                <li class="disabled"><i class="fa-regular fa-square-check"></i> Add task</li>
                                <li class="disabled"><i class="fa-solid fa-chart-line"></i> Add budget</li>
                                <li class="add_users"><i class="fa-regular fa-user"></i> Add user</li>
                                <li class="disabled"><i class="fa-solid fa-envelope"></i> Add message</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab_nav">
                <div class="tab active">
                    About
                </div>
                <div class="tab">
                    Insights
                </div>
            </div>
        </div>

        <div class="tab_content">
            <div class="tab_c" data-step="1">
                {{-- <div class="top tags">
                    <p><span class="tag">test</span></p>
                    <button class="tag">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/price-tag--v1.png"
                            alt="price-tag--v1" />
                    </button>
                </div> --}}
                <div class="content">
                    <div class="updates">
                        <p>This Project has no recent updates</p>
                    </div>
                    <p><sup><i class="fa-solid fa-circle-info"></i></sup>{{ $item->notes }}</p>
                </div>

                <div class="ppl" style="margin-left: 15px;">
                    @foreach ($item->users as $u)
                        <div class="p" style="background-color: {{ generateRandomColor($u->name[0]) }};">
                            {{ $u->name[0] }}</div>
                    @endforeach
                </div>
            </div>

            <div class="tab_C" style="display: none;">

            </div>
        </div>
    </div>
@endforeach

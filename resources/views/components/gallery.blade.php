<div class="overlay-gallery"></div>
<div id="mini-gallery">

    <div class="gallery-images row">
        @php
            $col1 = [];
            $col2 = [];
            $col3 = [];
            $col4 = [];
            $i = 0;
            while ($i < count($images)) {
                if (isset($images[$i])) {
                    $col1[] = $images[$i];
                }
                $i++;
                if (isset($images[$i])) {
                    if (isset($images[$i])) {
                        $col2[] = $images[$i];
                    }
                }
                $i++;
                if (isset($images[$i])) {
                    $col3[] = $images[$i];
                }
                $i++;
                if (isset($images[$i])) {
                    $col4[] = $images[$i];
                }
                $i++;
            }
        @endphp
        <div class="col-md-3  mb-4 mb-lg-0 d-flex flex-column-reverse justify-content-end">
            @foreach ($col1 as $image)
            <div class="img-th">
                <img src="{{ '/uploads/campaigns/' . basename($image) }}"
                    class="w-100 shadow-1-strong rounded mb-0 img-gallery" alt="Boat on Calm Water" />
                </div>
            @endforeach
        </div>
        <div class="col-md-3  mb-4 mb-lg-0 d-flex flex-column-reverse justify-content-end">
            @foreach ($col2 as $image)
            <div class="img-th">
                <img src="{{ '/uploads/campaigns/' . basename($image) }}"
                    class="w-100 shadow-1-strong rounded mb-0 img-gallery" alt="Boat on Calm Water" />
            </div>
            @endforeach
        </div>
        <div class="col-md-3  mb-4 mb-lg-0 d-flex flex-column-reverse justify-content-end">
            @foreach ($col3 as $image)
            <div class="img-th">
                <img src="{{ '/uploads/campaigns/' . basename($image) }}"
                    class="w-100 shadow-1-strong rounded mb-0 img-gallery" alt="Boat on Calm Water" />
            </div>
            @endforeach
        </div>
        <div class="col-md-3  mb-4 mb-lg-0 d-flex flex-column-reverse justify-content-end">
            @foreach ($col4 as $image)
            <div class="img-th">
                <img src="{{ '/uploads/campaigns/' . basename($image) }}"
                    class="w-100 shadow-1-strong rounded mb-0 img-gallery" alt="Boat on Calm Water" />
            </div>
            @endforeach
        </div>
    </div>
    <script>
        $s('.overlay-gallery').click((e) => {
            e.target.remove()
            $s('#mini-gallery').remove()
        })
        $s('.img-gallery').click(e => {
            var image = $('<img>').attr('src', e.target.src);
            image.attr('alt', "");
            $('#summernote').summernote("insertImage", e.target.src);
            $s('.overlay-gallery').remove()
            $s('#mini-gallery').remove()
        })
    </script>
</div>

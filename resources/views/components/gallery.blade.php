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
                $col1[] = $images[$i];
                $i++;
                if (isset($images[$i])) {
                    $col2[] = $images[$i];
                    $i++;
                    $col3[] = $images[$i];
                    $i++;
                    $col4[] = $images[$i];
                    $i++;
                }
            }
        @endphp
        <div class="col-md-3  mb-4 mb-lg-0">
            @foreach ($col1 as $image)
                <img src="{{ '/uploads/campaigns/' . basename($image) }}"
                    class="w-100 shadow-1-strong rounded mb-4 img-gallery" alt="Boat on Calm Water" />
            @endforeach
        </div>
        <div class="col-md-3  mb-4 mb-lg-0">
            @foreach ($col2 as $image)
                <img src="{{ '/uploads/campaigns/' . basename($image) }}"
                    class="w-100 shadow-1-strong rounded mb-4 img-gallery" alt="Boat on Calm Water" />
            @endforeach
        </div>
        <div class="col-md-3  mb-4 mb-lg-0">
            @foreach ($col3 as $image)
                <img src="{{ '/uploads/campaigns/' . basename($image) }}"
                    class="w-100 shadow-1-strong rounded mb-4 img-gallery" alt="Boat on Calm Water" />
            @endforeach
        </div>
        <div class="col-md-3  mb-4 mb-lg-0">
            @foreach ($col4 as $image)
                <img src="{{ '/uploads/campaigns/' . basename($image) }}"
                    class="w-100 shadow-1-strong rounded mb-4 img-gallery" alt="Boat on Calm Water" />
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: lightgrey;
        }

        .fb-render {
            margin: auto;
            max-width: 1280px;
            padding: 20rem 15rem;
        }
    </style>
</head>

<body>
    <div class="fb-render">
        <textarea id="fb-template">
            <form-template>
                <fields>
                    <field name="select-1454177070204" label="Select" style="multiple" description="" required="false" className="form-control" type="select" >
                        <option value="option-1">Option 1</option>
                        <option value="option-2">Option 2</option>
                    </field> <field name="rich-text-1454177067296" label="Text Area" description="" className="form-control " required="false" type="textarea" />
                </fields>
            </form-template>
        </textarea>
    </div>
    <script src="/assets/js/plugins/jquery-3.5.1.min.js"></script>
    <script src="/assets/js/plugins/jquery-ui.min.js"></script>
    <script src="/assets/js/plugins/form-render.min.js"></script>
    <script>
        jQuery(function($) {
            var fbTemplate = document.getElementById('fb-template');
            $('.fb-render').formRender({
                dataType: 'xml',
                formData: fbTemplate.value
            });
        });
    </script>

</body>

</html>

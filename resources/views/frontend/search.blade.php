<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm thành phố</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>

        body{
            background: #0a0a0f;
        }

        h2{
            color: #fff3cd;
        }

        #suggestions {
            border: 1px solid #ccc;
            max-width: 300px;
            background: #fff;
            position: absolute;
            display: none;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
        }
        .suggestion-item:hover {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
<div style="width: 500px; margin: 10rem auto;">
    <h2>Tìm kiếm thành phố</h2>
    <input type="text" id="city-input" style="width: 20rem; height: 2rem; font-size: 1.25rem" placeholder="Nhập tên thành phố..." autocomplete="off">
    <div id="suggestions"></div>
</div>

<script>
    $(document).ready(function() {
        $('#city-input').on('input', function() {
            let query = $(this).val();
            if (query.length < 1) {
                $('#suggestions').hide();
                return;
            }

            $.ajax({
                url: "/api/search-city",
                type: "GET",
                data: { q: query },
                success: function(data) {
                    let suggestionsHtml = '';
                    data.forEach(city => {
                        suggestionsHtml += `<div class="suggestion-item" data-name="${city.name}">
                                                    ${city.name}
                                                </div>`;
                    });

                    if (data.length > 0) {
                        $('#suggestions').html(suggestionsHtml).show();
                    } else {
                        $('#suggestions').hide();
                    }
                }
            });
        });

        $(document).on('click', '.suggestion-item', function() {
            $('#city-input').val($(this).data('name'));
            $('#suggestions').hide();
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('#city-input, #suggestions').length) {
                $('#suggestions').hide();
            }
        });
    });
</script>
</body>
</html>

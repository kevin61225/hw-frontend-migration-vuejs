<?php
$movie_data_array = file_get_contents("js/file/movie.json");
?>

<html>

<head>
    <title>My Movies</title>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />
    <style>
        .container {
            margin-top: 12px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">My Movie List</a>
    </nav>
    <div class="container">
        <form>
            <div class="form-group">
                <label for="input-title-ch">Title in Chinese</label>
                <input type="text" class="form-control" id="input-title-ch" placeholder="金牌特務">
            </div>
            <div class="form-group">
                <label for="input-title-eng">Title in English</label>
                <input type="text" class="form-control" id="input-title-eng" placeholder="Kingsman">
            </div>
            <div class="form-group">
                <label for="input-intro">Intro</label>
                <input type="text" class="form-control" id="input-intro" placeholder="是一部於2015年上映，由英國、美國合拍的諜報喜劇動作片...">
            </div>
            <div id="button-insert" class="btn btn-primary">Insert</div>
        </form>
        <hr />
        <ul id="list-movie" class="list-group">
        </ul>
    </div>
</body>
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        let movie_data_array = JSON.parse(<?php echo json_encode($movie_data_array); ?>);
        let $list_movie = $('#list-movie');

        $('#button-insert').on('click', function() {
            let $movie_item = $('<li class="list-group-item">' + create_movie_div_item({
                'ch_name': $('#input-title-ch').val(),
                'eng_name': $('#input-title-eng').val(),
                'intro': $('#input-intro').val()
            }) + '</li>');
            $list_movie.prepend($movie_item);
            clean_form_data();
        });

        for (let i = 0; i < movie_data_array.length; i++) {
            let $movie_item = $('<li class="list-group-item">' + create_movie_div_item(movie_data_array[i]) + '</li>');
            $list_movie.append($movie_item);
        }
    });

    function create_movie_div_item(movie_info) {
        console.log(movie_info);
        let $movie_item = $('<div class="movie-item"> \
                <h3>' + movie_info.ch_name + '</h3> \
                <h4>' + movie_info.eng_name + '</h4> \
                <div class="movie-intro">' + movie_info.intro + '</div> \
            </div>');

        return $movie_item.html();
    }

    function clean_form_data() {
        $('#input-title-ch').val('');
        $('#input-title-eng').val('');
        $('#input-intro').val('');
    }
</script>

</html>
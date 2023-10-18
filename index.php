<!DOCTYPE html>
<html>
<head>
    <title>Vérification des Breadcrumbs</title>
</head>
<body>
    <h1>Vérification des Breadcrumbs</h1>
    <form id="breadcrumb-form">
        <label for="url">URL de la page :</label>
        <input type="text" id="url" name="url">
        <button type="submit">Vérifier</button>
    </form>
    <div id="result"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#breadcrumb-form').submit(function(e) {
                e.preventDefault();
                var url = $('#url').val();

                $.ajax({
                    type: 'POST',
                    url: 'check_breadcrumbs.php', // URL de votre script PHP de vérification
                    data: { url: url },
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>

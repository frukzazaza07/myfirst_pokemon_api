<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<body>
    <div class="container">
        <form action="" onsubmit="return false">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Search" id="txt-search">
                <button class="btn btn-primary btn-block" id="search-pokemon">ค้นหา</button>
            </div>

        </form>
        <table class="table table-striped text-center">
            <thead class=" table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">URL</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">ปิด</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $.get("https://pokeapi.co/api/v2/pokemon?limit=1000", function(data) {
        for (let i = 0; i < data.results.length; i++) {
            let templates = `<tr>
                            <th scope="row">${i+1}</th>
                            <td>${data.results[i].name}</td>
                            <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" onclick="pokemon_details('${data.results[i].url}', '${data.results[i].name}')">
                                Details
                            </button>
                            </td>
                            </tr>`;
            $('tbody').append(templates);
        }
    });

    function pokemon_details(url_details, name) {
        $.get("" + url_details, function(data) {
            console.log(data);

            $('#pokemon_detail').remove();
            let templates = `<div class="text-center" id="pokemon_detail">
                                <img src="${data.sprites.front_default}" width="300px" height="300px">
                                <div class="container" style="margin-bottom:30px;">
                                    <h4>ข้อมูลโปรเกมอน</h4>
                                    <hr style="margin: 10px 70px;">
                                    <span>ส่วนสูง ${data.height}</span> <span>น้ำหนัก ${data.weight}</span>
                                    <div id="type_pokemon">ประเภท </div>
                                </div>
                            </div>`;
            $('#exampleModalLongTitle').text('' + name);
            $('.modal-body').append(templates);
            for (let i = 0; i < data.types.length; i++) {
                let template;
                if (i == data.types.length - 1) {
                    template = `<span>${data.types[i].type.name}</span>`;
                } else {
                    template = `<span>${data.types[i].type.name},</span>`;
                }

                $('#type_pokemon').append(template);
            }
        });
    }
    $('#search-pokemon').click(function() {
        let txtSearch = document.getElementById('txt-search').value;
        let url_search = "https://pokeapi.co/api/v2/pokemon/" + txtSearch;
        $.get(url_search, function(data) {
            $('tbody > tr').remove();
            let templates = `<tr>
                            <th scope="row">${data.id}</th>
                            <td>${data.name}</td>
                            <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" onclick="pokemon_details('${url_search}','${data.name}')">
                                Details
                            </button>
                            </td>
                            </tr>`;
            $('tbody').append(templates);
        });
    });
</script>

</html>
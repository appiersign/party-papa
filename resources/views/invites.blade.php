<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        * {
            /*border: solid red;*/
        }
        body {
            background-color: #eee;
        }
    </style>
</head>
<body>
<main>
    <div class="container-fluid">
        <nav class="row navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid d-flex justify-content-between">
                <a class="navbar-brand" href="#">Invitee</a>
                <div id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="invites">Invites</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/guests">Guests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Admins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Users</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-8 offset-md-2 p-5 mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Invites</h3>
                        <div class="card p-5">
                            <table class="container table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Side</th>
                                    <th>Sent At</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Side</th>
                                    <th>Sent At</th>
                                </tr>
                                </tfoot>

                                <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">no invites yet!</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://kit.fontawesome.com/b53238e3c8.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

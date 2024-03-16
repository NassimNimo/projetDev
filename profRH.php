<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- <link rel="stylesheet" href="homeCand.css" /> -->

    <title>Espace candidat</title>
</head>

<body style="height: 100vh;
background: #C9CCD3;
background-image: linear-gradient(-180deg, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%);
background-blend-mode: lighten;
background-repeat: no-repeat;
background-size: cover;">
    <header style="position: relative;
    padding: 0 2rem;
    background-color: rgba(93, 117, 117, 0.735)">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">Work Wave
                    <img src="assets\png\workwave-favicon-black.png" alt="logo"
                        style="height: 30px; margin-right: 10px" />
                </a>

                <div class="side bar"></div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">

                            <!-- lien profil -->
                            <a href="#" class="btn btn-dark " style="height: 40px; margin-right: 10px">
                                Profile
                            </a>


                        </li>
                        <li class="nav-item">
                            <!-- lien vers acceuil -->
                            <a href="#" class="btn btn-dark " style="height: 40px; margin-right: 10px">
                                Acceuil
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>





    <div class="container-fluid mt-2 row content-center gutters-sm">

        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="./assets/otherassets/default-pfp.jpg" alt="Admin" class="rounded-circle"
                            width="150" />
                        <div class="mt-3">
                            <h4>
                                <?php echo "nnn" . ' ' . "nnnn"; ?>
                            </h4>
                            <p class="text-secondary mb-1">
                                <?php echo "nnnnnn"; ?>
                            </p>
                            <p class="text-muted font-size-sm">
                                <?php echo "nnnnnnnnnnn"; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" id="formData">

                <div class="sticky-top border border-dark p-3 " style="background-color: #2c4f43ba;
                border-bottom-left-radius: 20px; 
                border-bottom-right-radius: 20px; 
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); ">
                    <button type="submit" class="btn " style="color: antiquewhite; 
                    background-color: rgba(93, 117, 117, 0.735); 
                    border-color: black; 
                    margin: 4px;">Chercher</button>


                    <!-- domaine -->
                    <select class="form-select "
                        style="text-align: center; color: antiquewhite; background-color: rgba(93, 117, 117, 0.735); width: 100%; border-color: black; margin: 4px;">
                        <option selected>Domaine</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>


                    <!-- <div class="dropdown">
                        <button class="btn  dropdown-toggle"
                            style="color: antiquewhite; background-color: rgba(93, 117, 117, 0.735); width: 100%; border-color: black; margin: 4px;"
                            type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                            Domaine
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%;">
                            <span class="dropdown-item">Option 1</span>
                            <span class="dropdown-item">Option 2</span>
                            <span class="dropdown-item">Option 3</span>
                        </div>
                    </div> -->


                    <!-- technologie -->
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" style="color: antiquewhite; background-color: rgba(93, 117, 117, 0.735); width: 100%; border-color: black; margin: 4px;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                            Technologie
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%;">
                            <span class="dropdown-item" onclick="createBox('Option 1', this)">Option 1</span>
                            <span class="dropdown-item" onclick="createBox('Option 2', this)">Option 2</span>
                            <span class="dropdown-item" onclick="createBox('Option 3', this)">Option 3</span>
                        </div>
                    </div>

                    <div id="selectedBoxesContainer" class="container mt-3"></div>

                </div>


            </form>

        </div>

        <div class="col-12 col-md-8 mt-2">
            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- link to his profil -->
                        <a href="#" title="voir profile"> <img class="card-img" src="./assets/"
                                alt="Card image cap"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <a href="path/to/your/file.pdf" download="filename.pdf"
                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- link to his profil -->
                        <a href="#" title="voir profile"> <img class="card-img" src="mp.png" alt="Card image cap"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <a href="path/to/your/file.pdf" download="filename.pdf"
                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- link to his profil -->
                        <a href="#" title="voir profile"> <img class="card-img" src="./assets/"
                                alt="Card image cap"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <a href="path/to/your/file.pdf" download="filename.pdf"
                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- link to his profil -->
                        <a href="#" title="voir profile"> <img class="card-img" src="mp.png" alt="Card image cap"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <a href="path/to/your/file.pdf" download="filename.pdf"
                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- link to his profil -->
                        <a href="#" title="voir profile"> <img class="card-img" src="./assets/"
                                alt="Card image cap"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <a href="path/to/your/file.pdf" download="filename.pdf"
                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- link to his profil -->
                        <a href="#" title="voir profile"> <img class="card-img" src="mp.png" alt="Card image cap"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <a href="path/to/your/file.pdf" download="filename.pdf"
                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- link to his profil -->
                        <a href="#" title="voir profile"> <img class="card-img" src="./assets/"
                                alt="Card image cap"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <a href="path/to/your/file.pdf" download="filename.pdf"
                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- link to his profil -->
                        <a href="#" title="voir profile"> <img class="card-img" src="mp.png" alt="Card image cap"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <a href="path/to/your/file.pdf" download="filename.pdf"
                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
  <script>
        function createBox(option, element) {
            var newBox = document.createElement("div");
            newBox.innerHTML = `
            <div class="col">
            <input type="text" name="option[]" value="${option}" readonly style="background-color:#99acb1;">
        </div>
            <div class="col">
                
                <input placeholder="Formation/Langues/Experiences..." type="text" name="custom[]" />
                <input placeholder="Score" type="number" class="quantity-input" min="1" max="10" name="quantity[]"/>
            </div>
            `;


            newBox.classList.add("selected-box");
            document.getElementById("selectedBoxesContainer").appendChild(newBox);
            element.classList.add("disabled");

        }

        function submitForm() {
            document.getElementById("formData").submit(); // Submit the form
        }
    </script>


</body>

</html>
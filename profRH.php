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
                <a class="navbar-brand">Work Wave
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





    <div class="container-fluid mt-2 row content-center">

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
            <form method="GET" id="formData">

                <div class="sticky-top border border-dark p-3 " style="background-color: #2c4f43ba;
                border-bottom-left-radius: 20px; 
                border-bottom-right-radius: 20px; 
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); ">


                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Make a job offer</button>

                    <div class="offcanvas offcanvas-end" style="width: 50vw;" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel">Make a job offer :</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="container col-11 col-sm-10 col-md-8">
                                <form>
                                    <input type="hidden" name="idRecruteur" value="5">

                                    <!-- Text input -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="sujet" id="sujet" class="form-control" />
                                        <label class="form-label" for="sujet">Sujet</label>
                                    </div>

                                    <!-- Text input -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="ville" id="ville" class="form-control" />
                                        <label class="form-label" for="ville">Ville</label>
                                    </div>

                                    <!-- Message input -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <textarea class="form-control" id="form6Example7" rows="4"></textarea>
                                        <label class="form-label" name="description" for="description">Job
                                            details</label>
                                    </div>
                                    <button data-mdb-ripple-init type="submit"
                                        class="btn btn-primary btn-block mb-4">Publish</button>
                                    <button data-mdb-ripple-init type="submit"
                                        class="btn btn-outline-dark btn-block mb-4">Clear
                                        form</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary" name="chercher">Chercher</button>


                    <!-- domaine -->
                    <select class="form-select" name="profession" id="domainSelect"
                        style="text-align: center; color: antiquewhite; background-color: rgba(93, 117, 117, 0.735); width: 100%; border-color: black; margin: 4px;">
                        <option selected>Domaine</option>
                        <option>Journaliste</option>
                        <option>Médecin</option>
                        <option>Three</option>
                    </select>
                    <!-- <input type="text" name="profession" id=""> -->





                    <!-- technologie -->
                    <div class="dropdown">
                        <select class="btn dropdown-toggle"
                            style="color: antiquewhite; background-color: rgba(93, 117, 117, 0.735); width: 100%; border-color: black; margin: 4px;"
                            onchange="createBox(this)">
                            <option value="Option 1">Option 1</option>
                            <option value="Option 2">Option 2</option>
                            <option value="Option 3">Option 3</option>
                        </select>
                    </div>

                    <div id="selectedBoxesContainer" class="container mt-3"></div>

                </div>


            </form>

        </div>

        <div class="col-12 col-md-8 mt-2">
            <div class="card m-1">
                <div class="row no-gutters">
                    <div class="col-md-4">
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
            <?php

            require_once './server/DB_class.php';

            class cardClient
            {
                private $nom;
                private $prenom;
                private $profession;
                public $cv;
                public $score;
                public $id;

                public function __construct($id, $nom, $prenom, $profession)
                {
                    $this->id = $id;
                    $this->nom = $nom;
                    $this->prenom = $prenom;
                    $this->profession = $profession;
                    $this->score = 0;
                    $db = new DB_class();

                    $this->cv = $db->selectCVPath($id);
                }

                public function afficherDansCarte()
                {
                    echo '<div class="card m-1">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <!-- Lien vers le profil ou autre -->
                                    <a href="#" title="voir profil">
                                        <img class="card-img" src="./assets/" alt="Card image cap">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $this->nom . ' ' . $this->prenom . '</h5>
                                        <p class="card-text">' . $this->profession . '</p>
                                        <a  href="' . $this->cv . '" class="btn btn-primary btn-sm" target="_blank">Voir CV</a>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }

            $db = new DB_class();

            if (isset ($_GET['chercher'])) {
                $selectedProfession = $_GET['profession'];
                // echo $selectedProfession;
            
                $users = $DB->getUsersByProfession($selectedProfession);
                if ($users) {



                    foreach ($users as $user) {
                        $clientIds[] = $user['id'];
                        $client = new cardClient($user['id'], $user['nom'], $user['prenom'], $selectedProfession);
                        $clientTable[] = $client;
                        $client->afficherDansCarte();
                    }
                }
            }

            ?>


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
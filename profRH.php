<?php

require_once "./server/DB_class.php";

$DB = new DB_class();

session_start();

if (!isset ($_SESSION['id'])) {
    header("Location: ./signin-page.php");
    exit();
}

$professions = $DB->fetchProfessions();
$userData = $DB->getHRByID($_SESSION['id']);
$condidats = $DB->getCandidates($userData['id']);

/////////////////////////////////////////////////////
//fach tbghi dir chi score ha kifach tzido //////////
/////////////////////////////////////////////////////
$condidats[0]['score'] = 89;

// echo "<pre>";
// var_dump($userData);
// echo "</pre>"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.css" />

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
    background-color: #212529">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand">Work Wave
                    <img src="assets\png\workwave-favicon-white.png" alt="logo"
                        style="height: 30px; margin-right: 10px" />
                </a>

                <div class="side bar"></div>

                </button>
                <a href="./signin-page.php" class="btn btn-danger my-sm-0 ml-2">
                    Log-out
                </a>
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
                                <?php echo $userData['HRManagerNom'] . ' ' . $userData['HRManagerPrenom']; ?>
                            </h4>
                            <p class="text-secondary mb-1">
                                <?php echo "societe : " . $userData['nomSociete']; ?>
                            </p>
                            <p class="text-muted font-size-sm">
                                <?php echo $userData['industyName']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid bg-dark sticky-top border border-dark rounded mt-1 pt-2">


                <button class="btn btn-outline-light mb-1" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Make a job offer</button>

                <div class="offcanvas offcanvas-end" style="width: 80vw;" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container col-11 col-sm-10 col-md-8 ">
                            <form id="jobOffer" method="post" action="./server/jobOffer/jobOffer.php">
                                <h2 class="offcanvas-title m-3 text-center" id="offcanvasRightLabel">Make a job
                                    offer :</h2>

                                <input type="hidden" name="idRec" value=<?php echo $userData['id']; ?>>

                                <!-- Text input -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <input required type="text" name="sujet" id="sujet" class="form-control" />
                                    <label class="form-label" for="sujet">Sujet</label>
                                </div>

                                <!-- profession -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <select required class="form-select" aria-label="Large select example" name="prof"
                                        id="profession">
                                        <option selected disabled></option>
                                        <?php
                                        // Check if records were found
                                        if (count($professions) > 0) {
                                            // Output data of each row as options for the select list
                                            foreach ($professions as $row) {
                                                echo '<option value="' . $row["id"] . '">' . $row["nom"] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="-1" selected disabled >No job titles found</option>';
                                        }
                                        ?>
                                    </select>
                                    <label class="form-label" for="prof">Proffession a chercher</label>
                                </div>


                                <!-- Text input -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <input type="text" name="ville" id="ville" class="form-control" />
                                    <label class="form-label" for="ville">Ville</label>
                                </div>

                                <!-- type -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <input type="text" name="type" id="type" class="form-control" />
                                    <label class="form-label" for="type">Type d'offre</label>
                                </div>

                                <!-- duree -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <input type="text" name="duree" id="duree" class="form-control" />
                                    <label class="form-label" for="duree">Duree</label>
                                </div>

                                <!-- Message input -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <textarea required class="form-control" name="desc" id="desc" rows="4"></textarea>
                                    <label class="form-label" name="description" for="description">Job
                                        details</label>
                                </div>

                                <!-- exp -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <input type="text" name="exp" id="exp" class="form-control" />
                                    <label class="form-label" for="exp">Experiences</label>
                                </div>

                                <button data-mdb-ripple-init type="submit" id="clear"
                                    class="btn btn-dark btn-block mb-4">Publish</button>

                            </form>
                            <div class="alert alert-success" id="jobOffer-alert" role="alert">
                                A simple success alert—check it out!
                            </div>
                        </div>
                    </div>
                </div>

                <form method="GET" id="formData">

                    <button type="submit" class="btn btn-light" name="chercher">Chercher</button>


                    <!-- domaine -->
                    <select class="form-select" name="profession" id="domainSelect"
                        style="text-align: center; color: antiquewhite; background-color: rgba(93, 117, 117, 0.735); width: 100%; border-color: black; margin: 4px;">
                        <option selected disabled>Domaine</option>
                        <?php

                        // Check if records were found
                        if (count($professions) > 0) {
                            // Output data of each row as options for the select list
                            foreach ($professions as $row) {
                                echo '<option value="' . $row["id"] . '">' . $row["nom"] . '</option>';
                            }
                        } else {
                            echo '<option value="-1" selected disabled >No job titles found</option>';
                        }
                        ?>
                    </select>
                    <!-- <input type="text" name="profession" id=""> -->

                    <!-- technologie -->
                    <div class="dropdown">
                        <select class="btn dropdown-toggle"
                            style="color: antiquewhite; background-color: rgba(93, 117, 117, 0.735); width: 100%; border-color: black; margin: 4px;"
                            onchange="createBox(this.value,this)">
                            <option selected disabled>technologies</option>
                            <?php
                            $professions = $DB->fetchProfessions();
                            // Check if records were found
                            if (count($professions) > 0) {
                                // Output data of each row as options for the select list
                                foreach ($professions as $row) {
                                    echo '<option value="' . $row["id"] . '">' . $row["nom"] . '</option>';
                                }
                            } else {
                                echo '<option value="-1" selected disabled >No job titles found</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div id="selectedBoxesContainer" class="container mt-3"></div>

            </div>


            </form>

        </div>

        <div class="col-12 col-md-8 mt-2">
            <?php

            if (count($condidats) > 0) {
                // Output data of each row as options for the select list
                foreach ($condidats as $row) {

                    $localFilePath = $row["path"];
                    $localFilePath = str_replace('\\', '/', $localFilePath);
                    $documentName = basename($localFilePath);
                    $baseURL = 'http://localhost/';
                    $documentURL = $baseURL . 'CV/' . $documentName;
                    echo $documentURL;

                    echo '  <div class="card m-1">
                                <div class="row no-gutters m-2">
                                    <div class="col-md-3">
                                    <a href="#" title="voir profile"> <img class="card-img" src="./assets/otherassets/default-pfp.jpg" style="width: 200px !important;"
                                        alt="Card image cap"></a>
                                    </div>
                                    <div class="col-md-9">
                                    <h3 class="text-center">' . $row['jobTitle'] . '</h3>
                                        <div class="card-body">
                                            <h5 class="card-title">' . $row['nom'] . ' ' . $row['prenom'] . '</h5>
                                            <p class="card-text">' . $row['prof'] . '</p>


                                            <div class="d-flex justify-content-between">
                                                <a href="'. $documentURL .'" download="' . $row['nom'] . '_' . $row['prenom'] . '_CV.pdf"
                                                class="btn btn-primary btn-sm ">Telecharger cv</a>
                                                <p >' . (isset ($row['score']) ? 'score : <span id="score">' . $row['score'] : '</span>') . '</p>
                                            </div>
                                        </div>
                                    </div>
                
                                </div>
                                </div>';
                }
            } else {
                echo '<option value="-1" selected disabled >No job titles found</option>';
            }
            ?>
            <div class="card m-1">

                <div class="row no-gutters m-2">
                    <div class="col-md-3">
                        <a href="#" title="voir profile"> <img class="card-img"
                                src="./assets/otherassets/default-pfp.jpg" style="width: 200px !important;"
                                alt="Card image cap"></a>
                    </div>
                    <div class="col-md-9">
                        <h3 class="text-center">Tilte</h3>
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prenom</h5>
                            <p class="card-text">Eleve ingenieur</p>

                            <div class="d-flex justify-content-between">
                                <a href="path/to/your/file.pdf" download="filename.pdf"
                                    class="btn btn-primary btn-sm ">Telecharger cv</a>
                                <p>
                                    <?php echo isset ($score) ? "score : 50" : ""; ?>
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        class domain {

            listTech = [];

            constructor(nom, ...list) {
                this.nom = nom;
                this.listTech = list;
            }

        }
    </script>
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

            // Désactiver l'option sélectionnée
            element.querySelector(`option[value="${option}"]`).disabled = true;

        }
        function submitForm() {
            document.getElementById("formData").submit(); // Submit the form
        }


    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./server/jobOffer/jobOffer.js"></script>

</body>

</html>
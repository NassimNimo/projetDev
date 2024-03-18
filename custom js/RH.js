function createCard(row) {
    // Create elements
    var card = document.createElement('div');
    card.classList.add('card', 'm-1');

    var cardRow = document.createElement('div');
    cardRow.classList.add('row', 'no-gutters', 'm-2');

    var imageCol = document.createElement('div');
    imageCol.classList.add('col-md-3');

    var imageLink = document.createElement('a');
    imageLink.href = '#';
    imageLink.title = 'voir profile';
    var image = document.createElement('img');
    image.classList.add('card-img');
    image.src = './assets/otherassets/default-pfp.jpg';
    image.style.width = '200px';
    image.alt = 'Card image cap';
    imageLink.appendChild(image);
    imageCol.appendChild(imageLink);

    var contentCol = document.createElement('div');
    contentCol.classList.add('col-md-9');

    var title = document.createElement('h3');
    title.classList.add('text-center');
    title.textContent = row['jobTitle'];

    var cardBody = document.createElement('div');
    cardBody.classList.add('card-body');

    var cardTitle = document.createElement('h5');
    cardTitle.classList.add('card-title');
    cardTitle.textContent = row['nom'] + ' ' + row['prenom'];

    var clientIDSpan = document.createElement('span');
    clientIDSpan.classList.add('clientID');

    cardTitle.appendChild(clientIDSpan);

    var cardText = document.createElement('p');
    cardText.classList.add('card-text');
    cardText.textContent = row['prof'];

    var buttonDiv = document.createElement('div');
    buttonDiv.classList.add('d-flex', 'justify-content-between');

    var cvLink = document.createElement('a');
    cvLink.href = row['path'];
    cvLink.download = row['nom'] + '_' + row['prenom'] + '_CV.pdf';
    cvLink.classList.add('btn', 'btn-primary', 'btn-sm');
    cvLink.textContent = 'Telecharger cv';

    var scorePara = document.createElement('p');
    if (row['score']) {
        scorePara.textContent = 'score : ' + row['score'];
    } else {
        scorePara.textContent = '';
    }

    // Assemble elements
    buttonDiv.appendChild(cvLink);
    buttonDiv.appendChild(scorePara);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardBody.appendChild(buttonDiv);
    contentCol.appendChild(title);
    contentCol.appendChild(cardBody);
    cardRow.appendChild(imageCol);
    cardRow.appendChild(contentCol);
    card.appendChild(cardRow);

    return card;
}

// function get(id_domain) {

//     xhr.open('GET', 'fetch_data.php?id=' + id, true);
//     xhr.onload = function () {
//         if (xhr.status >= 200 && xhr.status < 300) {
//             // Request was successful
//             var responseData = JSON.parse(xhr.responseText);
//             console.log(responseData);
//             // Process the responseData as needed
//         } else {
//             // Request failed
//             console.error('Request failed with status:', xhr.status);
//         }
//     };
//     xhr.onerror = function () {
//         // Network errors
//         console.error('Request failed');
//     };
//     xhr.send();

// }

function clearWrapper(wrapper) {
    if (wrapper) {
        while (wrapper.firstChild) {
            wrapper.removeChild(wrapper.firstChild);
        }
    } else {
        console.error("Wrapper element with id '" + wrapperId + "' not found.");
    }
}

function createBox(option, element) {
    var newBox = document.createElement("div");
    newBox.innerHTML = `
        <div class="col">
            <input type="text" name="option_${option}" value="${option}" readonly style="background-color:#99acb1;">
        </div>
        <div class="col">
            <input placeholder="Formation/Langues/Experiences..." type="text" name="custom_${option}" />
            <input placeholder="Score" type="number" class="quantity-input" min="1" max="10" name="score_${option}"/>
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

function giveScore(X) {

}





function main(condidats) {
    let CondidatWrapper = document.getElementById("condidat-wrapper")
    clearWrapper(CondidatWrapper);
    console.log(condidats);
    condidats.forEach(element => {
        var card = createCard(element);
        CondidatWrapper.appendChild(card);
    });
}
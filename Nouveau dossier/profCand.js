// upload d'une photot de profil

function previewImage(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const imagePreview = document.getElementById('imagePreview');
      imagePreview.src = e.target.result;
      imagePreview.style.display = 'block'; // Display the preview image
    }
    reader.readAsDataURL(file);
  }
}

document.getElementById('formFileSm').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const previewImage = document.getElementById('previewImage');
      previewImage.src = e.target.result;
    }
    reader.readAsDataURL(file);
  }
});

// Modification partie 'about Me'
function enableEditing() {
  var contentInput = document.getElementById("editableContent");
  var editButton = document.getElementById("editButton");
  var saveButton = document.getElementById("saveButton");

   // Activer le bouton "Enregistrer" et le champ de texte
   saveButton.style.display = "inline-block";
   contentInput.disabled = false;
   
   // Désactiver le bouton "Modifier"
   editButton.disabled = true;


   }

    // Enregistrement partie 'about Me'
  function saveChanges() {
    var contentInput = document.getElementById("editableContent");
    var editButton = document.getElementById("editButton");
    var saveButton = document.getElementById("saveButton");
    
    // Masquer le bouton "Enregistrer" et désactiver le champ de texte
    saveButton.style.display = "none";
    contentInput.disabled = true;
    
    // Activer le bouton "Modifier"
    editButton.disabled = false;
  }
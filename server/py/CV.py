import sys
from pdfminer.high_level import extract_text
from cv_module import CV_class


def search_in_table(table_name, value_to_search):
    data = None
    if table_name == 'formation_data':
        data = formation_data
    elif table_name == 'experience_data':
        data = experience_data
    elif table_name == 'langue_data':
        data = langue_data
    elif table_name == 'loisir_data':
        data = loisir_data
    elif table_name == 'projet_data':
        data = projet_data
        
    if data:
        return value_to_search in data
    return False



score = 0
category = sys.argv[1].lower()
detail = sys.argv[2]
score_increment = int(sys.argv[3])

if category == 'formation':
    if search_in_table('formation_data', detail.lower()):
        score += score_increment
elif category == 'experience':
    if search_in_table('experience_data', detail.lower()):
        score += score_increment
elif category == 'langue':
    if search_in_table('langue_data', detail.lower()):
        score += score_increment
elif category == 'loisir':
    if search_in_table('loisir_data', detail.lower()):
        score += score_increment
elif category == 'projet':
    if search_in_table('projet_data', detail.lower()):
        score += score_increment

# Affichage du score
print("Score:", score)
# Print the command-line arguments for debugging
print("Command-line arguments:", sys.argv)

# Ensure the correct command-line arguments are provided
if len(sys.argv) < 2:
    print("Usage: python CV.py <path_to_pdf>")
    sys.exit(2)

# Extract text from the PDF file
pdf_path = sys.argv[1]
print(pdf_path)
try:
    text = extract_text(pdf_path)
except Exception as e:
    print("An error occurred while extracting text from the PDF:", e)
    sys.exit(1)

# Create an instance of CV_class and extract sections
cv = CV_class()
cv.extract_values(text)

# Access the extracted sections
print("Formation:", cv.formation)
print("Compétence:", cv.compétence)
print("Profil:", cv.profil)
print("Contacts:", cv.contacts)
print("Langue:", cv.langue)
print("Loisir:", cv.loisir)
print("Projet:", cv.projet)
print("Experience:", cv.experience)


formation_data = cv.formation
competence_data = cv.compétence
profil_data = cv.profil
contacts_data = cv.contacts
langue_data = cv.langue
loisir_data = cv.loisir
projet_data = cv.projet
experience_data = cv.experience



# total_score = cv.calculate_total_score()
# print("Total Score:", total_score)
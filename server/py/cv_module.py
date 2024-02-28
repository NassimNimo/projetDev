class CV_class:
    def __init__(self):
        self.formation = []
        self.compétence = []
        self.profil = []
        self.contacts = []
        self.langue = []
        self.loisir = []
        self.projet = []
        self.experience = []

        # Define scoring weights for each attribute
        self.scoring_weights = {
            "formation": 1,
            "compétence": 1,
            "profil": 1,
            "contacts": 1,
            "langue": 1,
            "loisir": 1,
            "projet": 1,
            "experience":1
        }


    key_words = {
        "formation": ["éducation", "formation", "qualifications", "certifications", "diplômes", "ateliers",
                        "séminaires", "diplomas", "apprentissages", "parcours"],
        "compétence": ["compétences", "capacités", "expertises", "compétences techniques", "compétences douces",
                        "maîtrise des langues", "compétences analytiques", "compétences en communication",
                        "compétences en leadership", "compétences en résolution de problèmes", "travail d'équipe",
                        "gestion du temps", "adaptabilité", "créativité", "skills", "abilities", "competencies",
                        "expertise", "technical skills", "soft skills", "language proficiency", "analytical skills",
                        "communication skills", "leadership skills", "problem-solving skills", "teamwork",
                        "time management", "adaptability", "creativity"],
        "profil": ["profil", "résumé", "objectif", "à propos de moi", "résumé professionnel", "résumé de carrière",
                    "déclaration personnelle", "objectif de carrière", "profil professionnel", "réalisations clés",
                    "objectifs de carrière", "forces", "aspirations de carrière", "déclaration de mission",
                    "proposition de valeur", "profile", "summary", "objective", "about me", "professional summary",
                    "career summary", "personal statement", "career objective", "professional profile",
                    "key achievements", "career goals", "strengths", "career aspirations", "mission statement",
                    "value proposition"],
        "contacts": ["coordonnées", "détails de contact", "informations personnelles", "adresse", "numéro de téléphone",
                        "adresse email", "profil linkedin", "site web", "liens des réseaux sociaux",
                        "réseautage professionnel", "contact information", "contact details", "personal information",
                        "address", "phone number", "email address", "linkedin profile", "website", "social media links",
                        "professional networking", "contact"],
        "langue": ["langues", "language skills", "langue maternelle", "langue étrangère", "niveau de langue",
                    "langues maîtrisées", "language", "mother tongue", "foreign language", "language proficiency",
                    "language level"],
        "projet": ["projets", "projet" ,"projects", "project experience", "personal projects", "professional projects",
                    "project management", "project development", "project execution", "project planning",
                    "project coordination"],
        "experience": ["expérience", "experience", "work experience", "professional experience", "job experience", "work history",
                        "employment history", "career history"],
        "loisir": ["loisirs", "intérêts", "passions", "hobbies", "interests"]
    }
# Method to calculate the total score based on extracted data
    def calculate_total_score(self):
        total_score = 0
        for attribute in self.scoring_weights:
            # Get the score for the attribute and multiply it by the number of elements in the attribute
            total_score += self.scoring_weights[attribute] * len(getattr(self, attribute))
        return total_score
    
    def extract_values(self, TXT):
        lines = [line.strip() for line in TXT.split('\n') if line.strip()]
        print(TXT)
        att=""
        for line in lines:
            for attribute, elements in self.key_words.items():
                for element in elements:
                    if line.lower().split()[0] == element:
                        att = attribute
            if hasattr(self, att):
                getattr(self, att).append(line)

        return self

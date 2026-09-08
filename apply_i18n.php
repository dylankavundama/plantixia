<?php
$content = file_get_contents('index.html');

$css_add = <<<EOD
        [data-theme="light"] {
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #0f172a;
            --text-dim: #64748b;
            --border: rgba(0, 0, 0, 0.1);
        }
        body { transition: background-color 0.3s, color 0.3s; }
        .card { transition: background 0.3s, color 0.3s, transform 0.4s; }
        .nav-links a { transition: color 0.3s; }
        .theme-btn, .lang-btn { background: transparent; border: none; cursor: pointer; color: var(--text); display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; transition: 0.3s; }
        .theme-btn:hover, .lang-btn:hover { background: rgba(16, 185, 129, 0.1); color: var(--primary); }
EOD;
$content = str_replace('        :root {', $css_add . "\n" . '        :root {', $content);

$nav_btns = <<<EOD
                <button onclick="toggleTheme()" class="theme-btn" id="theme-toggle" title="Changer le thème">
                    <i data-lucide="sun"></i>
                </button>
                <button onclick="toggleLanguage()" class="lang-btn" id="lang-toggle" title="Changer la langue" style="font-weight: bold; font-size: 0.9rem;">EN</button>
EOD;
$content = str_replace('<a href="#contact" class="btn-sm" style="background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text);">Pitch Deck</a>',
                       '<a href="#contact" class="btn-sm" style="background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text);" data-i18n="nav_pitch">Pitch Deck</a>' . "\n" . $nav_btns, $content);

$replacements = [
    '<a href="#vision">Vision</a>' => '<a href="#vision" data-i18n="nav_vision">Vision</a>',
    '<a href="#problem">L\'Enjeu</a>' => '<a href="#problem" data-i18n="nav_problem">L\'Enjeu</a>',
    '<a href="#tech">Technologie</a>' => '<a href="#tech" data-i18n="nav_tech">Technologie</a>',
    '<a href="#benefits">Avantages</a>' => '<a href="#benefits" data-i18n="nav_benefits">Avantages</a>',
    '<a href="#features">Fonctionnalités</a>' => '<a href="#features" data-i18n="nav_features">Fonctionnalités</a>',
    '<a href="#pricing">Tarifs</a>' => '<a href="#pricing" data-i18n="nav_pricing">Tarifs</a>',
    '<a href="#download" class="btn-sm">Télécharger</a>' => '<a href="#download" class="btn-sm" data-i18n="nav_download">Télécharger</a>',
    
    '<h1 data-t="hero_title">Le Futur de l\'Agriculture est <span>Intelligent</span>.</h1>' => '<h1 data-i18n="hero_title">Le Futur de l\'Agriculture est <span data-i18n="hero_title_span">Intelligent</span>.</h1>',
    '<p data-t="hero_desc">Sauver les récoltes mondiales en mettant la puissance de l\'IA entre les mains de chaque agriculteur. Diagnostic instantané, conseils d\'experts et communauté réunie.</p>' => '<p data-i18n="hero_desc">Sauver les récoltes mondiales en mettant la puissance de l\'IA entre les mains de chaque agriculteur. Diagnostic instantané, conseils d\'experts et communauté réunie.</p>',
    '<a href="#features" class="btn-sm" style="padding: 1rem 2rem; font-size: 1rem;">Découvrir le projet</a>' => '<a href="#features" class="btn-sm" style="padding: 1rem 2rem; font-size: 1rem;" data-i18n="hero_btn_discover">Découvrir le projet</a>',
    'Notre vision <i data-lucide="arrow-right"></i>' => '<span data-i18n="hero_btn_vision">Notre vision</span> <i data-lucide="arrow-right"></i>',
    
    '<p style="color: var(--text-dim); text-transform: uppercase; font-size: 0.8rem; font-weight: 700;">Précision IA</p>' => '<p style="color: var(--text-dim); text-transform: uppercase; font-size: 0.8rem; font-weight: 700;" data-i18n="stat_precision">Précision IA</p>',
    '<p style="color: var(--text-dim); text-transform: uppercase; font-size: 0.8rem; font-weight: 700;">Pertes Évitées</p>' => '<p style="color: var(--text-dim); text-transform: uppercase; font-size: 0.8rem; font-weight: 700;" data-i18n="stat_losses">Pertes Évitées</p>',
    '<p style="color: var(--text-dim); text-transform: uppercase; font-size: 0.8rem; font-weight: 700;">Diagnostic</p>' => '<p style="color: var(--text-dim); text-transform: uppercase; font-size: 0.8rem; font-weight: 700;" data-i18n="stat_diag">Diagnostic</p>',
    
    '<h2 style="font-size: clamp(2rem, 5vw, 3rem); margin-bottom: 2rem;">L\'enjeu de la <span>Sécurité Alimentaire</span>.</h2>' => '<h2 style="font-size: clamp(2rem, 5vw, 3rem); margin-bottom: 2rem;" data-i18n="prob_title">L\'enjeu de la <span>Sécurité Alimentaire</span>.</h2>',
    '<p style="margin-bottom: 1.5rem;">Chaque année, plus de **40% des récoltes mondiales** sont détruites par des parasites et des maladies, menaçant la subsistance de millions de familles.</p>' => '<p style="margin-bottom: 1.5rem;" data-i18n="prob_desc1">Chaque année, plus de **40% des récoltes mondiales** sont détruites par des parasites et des maladies, menaçant la subsistance de millions de familles.</p>',
    '<p style="color: var(--text-dim);">Plantixia répond à cette urgence en démocratisant l\'accès à l\'expertise agronomique de pointe, là où les infrastructures traditionnelles font défaut.</p>' => '<p style="color: var(--text-dim);" data-i18n="prob_desc2">Plantixia répond à cette urgence en démocratisant l\'accès à l\'expertise agronomique de pointe, là où les infrastructures traditionnelles font défaut.</p>',
    '<h4 style="font-size: 1.5rem; margin-bottom: 1rem;">Le fossé technologique</h4>' => '<h4 style="font-size: 1.5rem; margin-bottom: 1rem;" data-i18n="prob_card_title">Le fossé technologique</h4>',
    '<p style="font-size: 0.95rem;">La majorité des agriculteurs dans les zones émergentes n\'ont pas accès à un expert en temps réel. Nous transformons chaque smartphone en un laboratoire ambulant.</p>' => '<p style="font-size: 0.95rem;" data-i18n="prob_card_desc">La majorité des agriculteurs dans les zones émergentes n\'ont pas accès à un expert en temps réel. Nous transformons chaque smartphone en un laboratoire ambulant.</p>',
    
    '<h2>Excellence <span>Technologique</span></h2>' => '<h2 data-i18n="tech_title">Excellence <span>Technologique</span></h2>',
    '<p>Une architecture multi-moteurs unique pour une fiabilité inégalée.</p>' => '<p data-i18n="tech_subtitle">Une architecture multi-moteurs unique pour une fiabilité inégalée.</p>',
    '<h3>Intelligence Artificielle Avancée</h3>' => '<h3 data-i18n="tech_1_t">Intelligence Artificielle Avancée</h3>',
    '<p>Notre technologie d\'intelligence artificielle croise plusieurs algorithmes d\'analyse visuelle pour éliminer les faux positifs et garantir un diagnostic précis à 98%.</p>' => '<p data-i18n="tech_1_d">Notre technologie d\'intelligence artificielle croise plusieurs algorithmes d\'analyse visuelle pour éliminer les faux positifs et garantir un diagnostic précis à 98%.</p>',
    '<h3>Big Data Agricole</h3>' => '<h3 data-i18n="tech_2_t">Big Data Agricole</h3>',
    '<p>Notre base de données propriétaire apprend de chaque scan, permettant une détection prédictive des épidémies régionales.</p>' => '<p data-i18n="tech_2_d">Notre base de données propriétaire apprend de chaque scan, permettant une détection prédictive des épidémies régionales.</p>',
    '<h3>Scalabilité Cloud</h3>' => '<h3 data-i18n="tech_3_t">Scalabilité Cloud</h3>',
    '<p>Une infrastructure légère et ultra-rapide capable de supporter des millions d\'utilisateurs avec une latence minimale.</p>' => '<p data-i18n="tech_3_d">Une infrastructure légère et ultra-rapide capable de supporter des millions d\'utilisateurs avec une latence minimale.</p>',
    
    '<h2>Pourquoi <span>Plantixia</span> ?</h2>' => '<h2 data-i18n="ben_title">Pourquoi <span>Plantixia</span> ?</h2>',
    '<p>Des bénéfices tangibles pour transformer l\'agriculture.</p>' => '<p data-i18n="ben_subtitle">Des bénéfices tangibles pour transformer l\'agriculture.</p>',
    '<h4>Gain de Temps</h4>' => '<h4 data-i18n="ben_1_t">Gain de Temps</h4>',
    '<p style="color: var(--text-dim); font-size: 0.9rem;">Obtenez un diagnostic en quelques secondes, sans attendre la visite d\'un expert sur le terrain.</p>' => '<p style="color: var(--text-dim); font-size: 0.9rem;" data-i18n="ben_1_d">Obtenez un diagnostic en quelques secondes, sans attendre la visite d\'un expert sur le terrain.</p>',
    '<h4>Réduction des Coûts</h4>' => '<h4 data-i18n="ben_2_t">Réduction des Coûts</h4>',
    '<p style="color: var(--text-dim); font-size: 0.9rem;">Évitez l\'achat de produits inadaptés en identifiant avec précision la source du problème.</p>' => '<p style="color: var(--text-dim); font-size: 0.9rem;" data-i18n="ben_2_d">Évitez l\'achat de produits inadaptés en identifiant avec précision la source du problème.</p>',
    '<h4>Sécurité des Récoltes</h4>' => '<h4 data-i18n="ben_3_t">Sécurité des Récoltes</h4>',
    '<p style="color: var(--text-dim); font-size: 0.9rem;">Anticipez les épidémies grâce aux alertes communautaires et protégez vos rendements.</p>' => '<p style="color: var(--text-dim); font-size: 0.9rem;" data-i18n="ben_3_d">Anticipez les épidémies grâce aux alertes communautaires et protégez vos rendements.</p>',
    '<h4>Proximité Locale</h4>' => '<h4 data-i18n="ben_4_t">Proximité Locale</h4>',
    '<p style="color: var(--text-dim); font-size: 0.9rem;">Une interface intuitive disponible en langues locales pour une accessibilité totale.</p>' => '<p style="color: var(--text-dim); font-size: 0.9rem;" data-i18n="ben_4_d">Une interface intuitive disponible en langues locales pour une accessibilité totale.</p>',

    '<h2 data-t="feat_title">Fonctionnalités Clés</h2>' => '<h2 data-i18n="feat_title">Fonctionnalités Clés</h2>',
    '<p data-t="feat_desc">Une suite d\'outils professionnels pour maximiser vos rendements.</p>' => '<p data-i18n="feat_desc">Une suite d\'outils professionnels pour maximiser vos rendements.</p>',
    '<h3>Scanner IA</h3>' => '<h3 data-i18n="feat_1_t">Scanner IA</h3>',
    '<p>Identifiez instantanément les maladies, parasites et carences nutritionnelles grâce à notre triple moteur IA.</p>' => '<p data-i18n="feat_1_d">Identifiez instantanément les maladies, parasites et carences nutritionnelles grâce à notre triple moteur IA.</p>',
    '<h3>Support Experts</h3>' => '<h3 data-i18n="feat_2_t">Support Experts</h3>',
    '<p>Connectez-vous avec des ingénieurs agronomes certifiés pour des consultations personnalisées en temps réel.</p>' => '<p data-i18n="feat_2_d">Connectez-vous avec des ingénieurs agronomes certifiés pour des consultations personnalisées en temps réel.</p>',
    '<h3>Communauté</h3>' => '<h3 data-i18n="feat_3_t">Communauté</h3>',
    '<p>Partagez vos diagnostics, apprenez des autres agriculteurs et suivez l\'évolution des épidémies dans votre région.</p>' => '<p data-i18n="feat_3_d">Partagez vos diagnostics, apprenez des autres agriculteurs et suivez l\'évolution des épidémies dans votre région.</p>',

    '<h2>Nos <span>Licences</span> et Abonnements</h2>' => '<h2 data-i18n="price_title">Nos <span>Licences</span> et Abonnements</h2>',
    '<p>Des offres adaptées à chaque besoin, du cultivateur individuel aux grandes coopératives.</p>' => '<p data-i18n="price_subtitle">Des offres adaptées à chaque besoin, du cultivateur individuel aux grandes coopératives.</p>',
    '<h3>Individuel Mensuel</h3>' => '<h3 data-i18n="price_1_t">Individuel Mensuel</h3>',
    '<p style="color: var(--text-dim);">Pour les particuliers et petits exploitants.</p>' => '<p style="color: var(--text-dim);" data-i18n="price_1_d">Pour les particuliers et petits exploitants.</p>',
    '<span>/mois</span>' => '<span data-i18n="price_mo">/mois</span>',
    '<li><i data-lucide="check-circle"></i> Scans illimités</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_f1">Scans illimités</span></li>',
    '<li><i data-lucide="check-circle"></i> Diagnostics instantanés par IA</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_f2">Diagnostics instantanés par IA</span></li>',
    '<li><i data-lucide="check-circle"></i> Accès à la communauté</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_f3">Accès à la communauté</span></li>',
    '<li><i data-lucide="check-circle"></i> Historique des détections</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_f4">Historique des détections</span></li>',
    
    '<h3>Individuel Annuel</h3>' => '<h3 data-i18n="price_2_t">Individuel Annuel</h3>',
    '<p style="color: var(--text-dim);">La solution la plus économique.</p>' => '<p style="color: var(--text-dim);" data-i18n="price_2_d">La solution la plus économique.</p>',
    '<span>/an</span>' => '<span data-i18n="price_yr">/an</span>',
    '<li><i data-lucide="check-circle"></i> <b>Toutes les options mensuelles</b></li>' => '<li><i data-lucide="check-circle"></i> <b data-i18n="price_2_f1">Toutes les options mensuelles</b></li>',
    '<li><i data-lucide="check-circle"></i> Économisez l\'équivalent d\'un mois</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_2_f2">Économisez l\'équivalent d\'un mois</span></li>',
    '<li><i data-lucide="check-circle"></i> Support prioritaire</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_2_f3">Support prioritaire</span></li>',
    '<li><i data-lucide="check-circle"></i> Accès hors-ligne limité</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_2_f4">Accès hors-ligne limité</span></li>',
    '<a href="#download" class="btn-sm" style="text-align: center; margin-top: 1rem; display: block;">S\'abonner</a>' => '<a href="#download" class="btn-sm" style="text-align: center; margin-top: 1rem; display: block;" data-i18n="btn_subscribe">S\'abonner</a>',
    
    '<h3>Licence Entreprise</h3>' => '<h3 data-i18n="price_3_t">Licence Entreprise</h3>',
    '<p style="color: var(--text-dim);">Pour les coopératives et grandes exploitations.</p>' => '<p style="color: var(--text-dim);" data-i18n="price_3_d">Pour les coopératives et grandes exploitations.</p>',
    '<li><i data-lucide="check-circle"></i> Multi-comptes B2B gérés par admin</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_3_f1">Multi-comptes B2B gérés par admin</span></li>',
    '<li><i data-lucide="check-circle"></i> Panneau d\'administration dédié</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_3_f2">Panneau d\'administration dédié</span></li>',
    '<li><i data-lucide="check-circle"></i> Suivi des activités et mouvements</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_3_f3">Suivi des activités et mouvements</span></li>',
    '<li><i data-lucide="check-circle"></i> Consultation avec experts agronomes</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_3_f4">Consultation avec experts agronomes</span></li>',
    '<li><i data-lucide="check-circle"></i> Détection prédictive régionale</li>' => '<li><i data-lucide="check-circle"></i> <span data-i18n="price_3_f5">Détection prédictive régionale</span></li>',
    '<button onclick="openRequestModal()" class="btn-sm" style="width: 100%; border: none; cursor: pointer; text-align: center; margin-top: 1rem; display: block; background: var(--secondary); color: white; font-size: 0.85rem; font-family: inherit;">S\'inscrire</button>' => '<button onclick="openRequestModal()" class="btn-sm" style="width: 100%; border: none; cursor: pointer; text-align: center; margin-top: 1rem; display: block; background: var(--secondary); color: white; font-size: 0.85rem; font-family: inherit;" data-i18n="btn_register">S\'inscrire</button>',
    
    '<h2 data-t="app_title">Interface Mobile</h2>' => '<h2 data-i18n="app_title">Interface Mobile</h2>',
    '<p>Un design épuré, pensé pour le terrain.</p>' => '<p data-i18n="app_desc">Un design épuré, pensé pour le terrain.</p>',
    
    '<h2 data-t="team_title">L\'Équipe</h2>' => '<h2 data-i18n="team_title">L\'Équipe</h2>',
    '<p>L\'alliance de l\'expertise technologique et de l\'ingénierie agronomique.</p>' => '<p data-i18n="team_subtitle">L\'alliance de l\'expertise technologique et de l\'ingénierie agronomique.</p>',
    
    '<h2 style="font-size: clamp(2rem, 5vw, 3.5rem); margin-bottom: 1.5rem; color: white;">Prêt à <span>Transformer</span> votre Récolte ?</h2>' => '<h2 style="font-size: clamp(2rem, 5vw, 3.5rem); margin-bottom: 1.5rem; color: white;" data-i18n="dl_title">Prêt à <span>Transformer</span> votre Récolte ?</h2>',
    '<p style="font-size: clamp(1rem, 2vw, 1.25rem); opacity: 0.9; margin-bottom: 3rem; max-width: 700px; margin-left: auto; margin-right: auto; color: white;">
                        Rejoignez la révolution Plantixia. Disponible dès maintenant pour tous les agriculteurs, gratuitement.
                    </p>' => '<p style="font-size: clamp(1rem, 2vw, 1.25rem); opacity: 0.9; margin-bottom: 3rem; max-width: 700px; margin-left: auto; margin-right: auto; color: white;" data-i18n="dl_desc">
                        Rejoignez la révolution Plantixia. Disponible dès maintenant pour tous les agriculteurs, gratuitement.
                    </p>',
    
    '<div style="font-size: 0.7rem; text-transform: uppercase; opacity: 0.8; line-height: 1;">Obtenir sur</div>' => '<div style="font-size: 0.7rem; text-transform: uppercase; opacity: 0.8; line-height: 1;" data-i18n="dl_get">Obtenir sur</div>',
    '<div style="font-size: 0.7rem; text-transform: uppercase; opacity: 0.8; line-height: 1;">Direct</div>' => '<div style="font-size: 0.7rem; text-transform: uppercase; opacity: 0.8; line-height: 1;" data-i18n="dl_direct">Direct</div>',
    
    '<h2 style="margin-bottom: 1.5rem; font-size: clamp(2rem, 5vw, 3rem);">Prêt à <span>cultiver le futur</span> ?</h2>' => '<h2 style="margin-bottom: 1.5rem; font-size: clamp(2rem, 5vw, 3rem);" data-i18n="ftr_title">Prêt à <span>cultiver le futur</span> ?</h2>',
    '<p style="color: var(--text-dim); margin-bottom: 2.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">Rejoignez des milliers d\'agriculteurs qui protègent déjà leurs récoltes avec l\'intelligence de Plantixia.</p>' => '<p style="color: var(--text-dim); margin-bottom: 2.5rem; max-width: 600px; margin-left: auto; margin-right: auto;" data-i18n="ftr_desc">Rejoignez des milliers d\'agriculteurs qui protègent déjà leurs récoltes avec l\'intelligence de Plantixia.</p>',
    '<div style="font-size: 0.7rem; text-transform: uppercase;">Disponible sur</div>' => '<div style="font-size: 0.7rem; text-transform: uppercase;" data-i18n="ftr_avail">Disponible sur</div>',
    '<div style="font-size: 0.6rem; opacity: 0.7; text-transform: uppercase;">Directement</div>' => '<div style="font-size: 0.6rem; opacity: 0.7; text-transform: uppercase;" data-i18n="ftr_direct">Directement</div>',
    '<div style="font-size: 1rem; font-weight: 800; line-height: 1;">Télécharger APK</div>' => '<div style="font-size: 1rem; font-weight: 800; line-height: 1;" data-i18n="ftr_apk">Télécharger APK</div>',
    ' Nous Contacter' => ' <span data-i18n="ftr_contact">Nous Contacter</span>',
    '<p>&copy; 2026 Plantixia. Tous droits réservés.</p>' => '<p data-i18n="ftr_rights">&copy; 2026 Plantixia. Tous droits réservés.</p>'
];

foreach ($replacements as $k => $v) {
    $content = str_replace($k, $v, $content);
}


$js_add = <<<EOD
        const translations = {
            fr: {
                nav_vision: "Vision", nav_problem: "L'Enjeu", nav_tech: "Technologie", nav_benefits: "Avantages", nav_features: "Fonctionnalités", nav_pricing: "Tarifs", nav_download: "Télécharger", nav_pitch: "Pitch Deck",
                hero_title: "Le Futur de l'Agriculture est <span>Intelligent</span>.", hero_desc: "Sauver les récoltes mondiales en mettant la puissance de l'IA entre les mains de chaque agriculteur. Diagnostic instantané, conseils d'experts et communauté réunie.", hero_btn_discover: "Découvrir le projet", hero_btn_vision: "Notre vision",
                stat_precision: "Précision IA", stat_losses: "Pertes Évitées", stat_diag: "Diagnostic",
                prob_badge: "L'Enjeu &amp; Notre Mission",
                prob_title: "Une Solution Stratégique face aux <span>Épidémies Agricoles</span>",
                prob_desc: "Chaque année, plus de 40% des récoltes mondiales sont détruites par des maladies et des ravageurs non anticipés. Plantixia fournit une réponse technologique accessible et adaptée à tous les acteurs clés de la chaîne agricole :",
                prob_target1_tag: "Terrain &amp; Récoltes",
                prob_target1_title: "Agriculteurs &amp; Maraîchers",
                prob_target1_desc: "Diagnostiquez instantanément les maladies sur vos plantes en 3 secondes depuis votre smartphone, recevez le bon traitement sans délai et localisez les intrants dans la boutique locale pour sauver vos récoltes.",
                prob_target2_tag: "Groupements &amp; Filières",
                prob_target2_title: "Organisations &amp; Coopératives",
                prob_target2_desc: "Supervisez l'état sanitaire des parcelles de vos membres, anticipez les besoins collectifs en traitements homologués et sécurisez la rentabilité et les rendements de toute votre filière.",
                prob_target3_tag: "Souveraineté &amp; Veille",
                prob_target3_title: "Gouvernements &amp; Décideurs",
                prob_target3_desc: "Cartographiez les foyers d'infection en temps réel, déployez des alertes phytosanitaires préventives ciblées avant la propagation des épidémies et protégez la souveraineté alimentaire nationale.",
                prob_target4_tag: "Impact &amp; Croissance",
                prob_target4_title: "Investisseurs &amp; Partenaires",
                prob_target4_desc: "Soutenez une infrastructure AgriTech propriétaire et scalable, répondant à un besoin vital de subsistance alimentaire tout en valorisant la donnée et l'innovation technologique de terrain.",
                tech_title: "Excellence <span>Technologique</span>", tech_subtitle: "Une architecture d'intelligence artificielle unique pour une fiabilité inégalée.", tech_1_t: "Intelligence Artificielle Avancée", tech_1_d: "Notre technologie d'intelligence artificielle croise plusieurs algorithmes d'analyse visuelle pour éliminer les faux positifs et garantir un diagnostic précis à 98%.", tech_2_t: "Big Data Agricole", tech_2_d: "Notre base de données propriétaire apprend de chaque scan, permettant une détection prédictive des épidémies régionales.", tech_3_t: "Scalabilité Cloud", tech_3_d: "Une infrastructure légère et ultra-rapide capable de supporter des millions d'utilisateurs avec une latence minimale.",
                ben_title: "Pourquoi <span>Plantixia</span> ?", ben_subtitle: "Des bénéfices tangibles pour transformer l'agriculture.", ben_1_t: "Gain de Temps", ben_1_d: "Obtenez un diagnostic en quelques secondes, sans attendre la visite d'un expert sur le terrain.", ben_2_t: "Réduction des Coûts", ben_2_d: "Évitez l'achat de produits inadaptés en identifiant avec précision la source du problème.", ben_3_t: "Sécurité des Récoltes", ben_3_d: "Anticipez les épidémies grâce aux alertes communautaires et protégez vos rendements.", ben_4_t: "Proximité Locale", ben_4_d: "Une interface intuitive disponible en langues locales pour une accessibilité totale.",
                feat_title: "Fonctionnalités Clés", feat_desc: "Une suite d'outils professionnels pour maximiser vos rendements.", feat_1_t: "Scanner IA", feat_1_d: "Identifiez instantanément les maladies, parasites et carences nutritionnelles grâce à notre triple moteur IA.", feat_2_t: "Support Experts", feat_2_d: "Connectez-vous avec des ingénieurs agronomes certifiés pour des consultations personnalisées en temps réel.", feat_3_t: "Communauté", feat_3_d: "Partagez vos diagnostics, apprenez des autres agriculteurs et suivez l'évolution des épidémies dans votre région.",
                price_title: "Nos <span>Licences</span> et Abonnements", price_subtitle: "Des offres adaptées à chaque besoin, du cultivateur individuel aux grandes coopératives.", price_1_t: "Individuel Mensuel", price_1_d: "Pour les particuliers et petits exploitants.", price_mo: "/mois", price_f1: "Scans illimités", price_f2: "Diagnostics instantanés par IA", price_f3: "Accès à la communauté", price_f4: "Historique des détections", price_2_t: "Individuel Annuel", price_2_d: "La solution la plus économique.", price_yr: "/an", price_2_f1: "Toutes les options mensuelles", price_2_f2: "Économisez l'équivalent d'un mois", price_2_f3: "Support prioritaire", price_2_f4: "Accès hors-ligne limité", btn_subscribe: "S'abonner", price_3_t: "Licence Entreprise", price_3_d: "Pour les coopératives et grandes exploitations.", price_3_f1: "Multi-comptes B2B gérés par admin", price_3_f2: "Panneau d'administration dédié", price_3_f3: "Suivi des activités et mouvements", price_3_f4: "Consultation avec experts agronomes", price_3_f5: "Détection prédictive régionale", btn_register: "S'inscrire",
                app_title: "Interface Mobile", app_desc: "Un design épuré, pensé pour le terrain.",
                surv_badge: "Plateforme Web &amp; Décideurs", surv_title: "Tableau de Bord &amp; <span>Surveillance Épidémiologique</span>", surv_desc: "Supervision nationale, cartographie des foyers d'infection en temps réel et alertes préventives ciblées pour les coopératives et décideurs.",
                team_title: "L'Équipe", team_subtitle: "L'alliance de l'expertise technologique et de l'ingénierie agronomique.",
                dl_title: "Prêt à <span>Transformer</span> votre Récolte ?", dl_desc: "Rejoignez la révolution Plantixia. Disponible dès maintenant pour tous les agriculteurs, gratuitement.", dl_get: "Obtenir sur", dl_direct: "Direct",
                ftr_title: "Prêt à <span>cultiver le futur</span> ?", ftr_desc: "Rejoignez des milliers d'agriculteurs qui protègent déjà leurs récoltes avec l'intelligence de Plantixia.", ftr_avail: "Disponible sur", ftr_direct: "Directement", ftr_apk: "Télécharger APK", ftr_contact: "Nous Contacter", ftr_rights: "&copy; 2026 Plantixia. Tous droits réservés."
            },
            en: {
                nav_vision: "Vision", nav_problem: "The Issue", nav_tech: "Technology", nav_benefits: "Benefits", nav_features: "Features", nav_pricing: "Pricing", nav_download: "Download", nav_pitch: "Pitch Deck",
                hero_title: "The Future of Agriculture is <span>Intelligent</span>.", hero_desc: "Saving global harvests by putting the power of AI in the hands of every farmer. Instant diagnosis, expert advice, and a united community.", hero_btn_discover: "Discover the project", hero_btn_vision: "Our vision",
                stat_precision: "AI Precision", stat_losses: "Losses Avoided", stat_diag: "Diagnosis",
                prob_badge: "The Challenge &amp; Our Mission",
                prob_title: "A Strategic Solution to <span>Agricultural Epidemics</span>",
                prob_desc: "Every year, over 40% of global harvests are destroyed by unanticipated pests and diseases. Plantixia provides an accessible, tailored technological response for every key stakeholder in the agricultural chain:",
                prob_target1_tag: "Field &amp; Harvests",
                prob_target1_title: "Farmers &amp; Growers",
                prob_target1_desc: "Instantly diagnose crop diseases in 3 seconds from your smartphone, receive the exact treatment without delay, and find available inputs in nearby pharmacies to protect your yields.",
                prob_target2_tag: "Groups &amp; Supply Chains",
                prob_target2_title: "Cooperatives &amp; Organizations",
                prob_target2_desc: "Monitor the crop health of your member farms, anticipate collective needs for certified treatments, and secure the profitability and yields of your entire supply chain.",
                prob_target3_tag: "Security &amp; National Monitoring",
                prob_target3_title: "Governments &amp; Policymakers",
                prob_target3_desc: "Map infection outbreaks in real time, deploy targeted preventative phytosanitary alerts before epidemics spread, and protect national food security.",
                prob_target4_tag: "Impact &amp; Growth",
                prob_target4_title: "Investors &amp; Partners",
                prob_target4_desc: "Back a proprietary, scalable AgriTech infrastructure solving a vital food security challenge while unlocking the value of field data and deep technology.",
                tech_title: "Technological <span>Excellence</span>", tech_subtitle: "A unique artificial intelligence architecture for unmatched reliability.", tech_1_t: "Advanced Artificial Intelligence", tech_1_d: "Our artificial intelligence technology merges multiple visual analysis algorithms to eliminate false positives and ensure a 98% accurate diagnosis.", tech_2_t: "Agricultural Big Data", tech_2_d: "Our proprietary database learns from every scan, enabling predictive detection of regional epidemics.", tech_3_t: "Cloud Scalability", tech_3_d: "A lightweight and ultra-fast infrastructure capable of supporting millions of users with minimal latency.",
                ben_title: "Why <span>Plantixia</span>?", ben_subtitle: "Tangible benefits to transform agriculture.", ben_1_t: "Time Saving", ben_1_d: "Get a diagnosis in seconds, without waiting for an expert's field visit.", ben_2_t: "Cost Reduction", ben_2_d: "Avoid purchasing inappropriate products by accurately identifying the source of the problem.", ben_3_t: "Harvest Security", ben_3_d: "Anticipate epidemics with community alerts and protect your yields.", ben_4_t: "Local Proximity", ben_4_d: "An intuitive interface available in local languages for total accessibility.",
                feat_title: "Key Features", feat_desc: "A suite of professional tools to maximize your yields.", feat_1_t: "AI Scanner", feat_1_d: "Instantly identify diseases, pests, and nutritional deficiencies with our triple AI engine.", feat_2_t: "Expert Support", feat_2_d: "Connect with certified agronomists for personalized real-time consultations.", feat_3_t: "Community", feat_3_d: "Share your diagnoses, learn from other farmers, and track the evolution of epidemics in your region.",
                price_title: "Our <span>Licenses</span> and Subscriptions", price_subtitle: "Offers tailored to every need, from the individual grower to large cooperatives.", price_1_t: "Individual Monthly", price_1_d: "For individuals and smallholders.", price_mo: "/month", price_f1: "Unlimited scans", price_f2: "Instant AI diagnostics", price_f3: "Community access", price_f4: "Detection history", price_2_t: "Individual Annual", price_2_d: "The most economical solution.", price_yr: "/year", price_2_f1: "All monthly options", price_2_f2: "Save the equivalent of one month", price_2_f3: "Priority support", price_2_f4: "Limited offline access", btn_subscribe: "Subscribe", price_3_t: "Enterprise License", price_3_d: "For cooperatives and large farms.", price_3_f1: "Multi-B2B accounts managed by admin", price_3_f2: "Dedicated administration panel", price_3_f3: "Tracking activities and movements", price_3_f4: "Consultation with agronomic experts", price_3_f5: "Predictive regional detection", btn_register: "Register",
                app_title: "Mobile Interface", app_desc: "A sleek design, built for the field.",
                surv_badge: "Web Platform &amp; Policymakers", surv_title: "Dashboard &amp; <span>Epidemiological Surveillance</span>", surv_desc: "National monitoring, real-time infection outbreak mapping, and targeted preventative alerts for cooperatives and decision-makers.",
                team_title: "The Team", team_subtitle: "The alliance of technological expertise and agronomic engineering.",
                dl_title: "Ready to <span>Transform</span> your Harvest?", dl_desc: "Join the Plantixia revolution. Available now for all farmers, for free.", dl_get: "Get it on", dl_direct: "Direct",
                ftr_title: "Ready to <span>cultivate the future</span>?", ftr_desc: "Join thousands of farmers who are already protecting their harvests with Plantixia's intelligence.", ftr_avail: "Available on", ftr_direct: "Directly", ftr_apk: "Download APK", ftr_contact: "Contact Us", ftr_rights: "&copy; 2026 Plantixia. All rights reserved."
            }
        };

        let currentLang = localStorage.getItem('plantixia_lang') || 'fr';
        let currentTheme = localStorage.getItem('plantixia_theme') || 'dark';

        function applyTheme(theme) {
            if(theme === 'light') {
                document.documentElement.setAttribute('data-theme', 'light');
                document.getElementById('theme-toggle').innerHTML = '<i data-lucide="moon"></i>';
            } else {
                document.documentElement.removeAttribute('data-theme');
                document.getElementById('theme-toggle').innerHTML = '<i data-lucide="sun"></i>';
            }
            lucide.createIcons();
            currentTheme = theme;
            localStorage.setItem('plantixia_theme', theme);
        }

        function toggleTheme() {
            applyTheme(currentTheme === 'dark' ? 'light' : 'dark');
        }

        function applyLanguage(lang) {
            document.getElementById('lang-toggle').innerText = lang === 'fr' ? 'EN' : 'FR';
            const els = document.querySelectorAll('[data-i18n]');
            els.forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (translations[lang][key]) {
                    el.innerHTML = translations[lang][key];
                }
            });
            currentLang = lang;
            localStorage.setItem('plantixia_lang', lang);
        }

        function toggleLanguage() {
            applyLanguage(currentLang === 'fr' ? 'en' : 'fr');
        }

        // Init
        applyTheme(currentTheme);
        applyLanguage(currentLang);
EOD;

$content = str_replace('        lucide.createIcons();', $js_add . "\n" . '        lucide.createIcons();', $content);

file_put_contents('index.html', $content);
echo "index.html updated successfully!";

<?php
return [

    '_Objectives' => [
        'title' => 'Fixer des objectifs',
        'fields' => [
            'Element' => 'Élément/Indicateur',
            'Status' => 'Ligne de base',
            'Objective' => 'Statut optimal ou favorable',
            'comments' => 'Commentaires'
        ],
    ],

    'Designation' => [
        'title' => 'Désignationss',
        'fields' => [
            'Aspect' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Intégration',
            'SignificativeClassification' => 'Désignation hautement significative',
            'IncludeInStatistics' => 'Doit-il être prioritaire dans la gestion?',
            'Comments' => 'Commentaires/Explications',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'pas d’intégration',
                '1' => 'faible intégration',
                '2' => 'intégration modérée',
                '3' => 'haute intégration',
            ]
        ],
        'module_subTitle' => 'Valeur et importance - Désignations',
        'module_info_EvaluationQuestion' => [
            'Evaluate the Intégration of values and importance of designations (national designation and international designations, e.g., World Heritage site or Ramsar site) for the management of the conserved area'
        ],
        'WARNING_on_save' => 'AVERTISSEMENT!! <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>I1, PR6</i>',
    ],

    'KeyElements' => [
        'title' => 'Eléments clés de l’espace conservé',
        'fields' => [
            'Aspect' => 'Key element / service',
            'Importance' => 'Importance',
            'EvaluationScore' => 'Intégration',
            'IncludeInStatistics' => 'Doit-il être prioritaire dans la gestion?',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Services écosystémiques',
            'group1' => 'Éléments clés de la biodiversité',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'pas d’intégration',
                '1' => 'faible intégration',
                '2' => 'intégration modérée',
                '3' => 'haute intégration',
            ]
        ],
        'module_subTitle' => 'Éléments clés animaux, plantes, habitats (protégés, exploités, en voie de disparition, envahissants, etc.) et services (services d’approvisionnement, de contrôle, culturels, de soutien)',
        'module_info_EvaluationQuestion' => [
            'L\'espace conservé a-t-elle priorisé les éléments clés dans sa gestion ? L\'évaluation doit évaluer la nécessité de
             prioriser les éléments clés dans la gestion de l\'espace conservé. L\'évaluation utilise une liste classée basée sur les analyses de SA1, SA2 et C3.1.1'
        ],
        'module_info_Rating' => [
            'Évaluer la nécessité de prioriser les éléments clés dans la gestion de l\'espace conservé'
        ],
        'from_group' => 'De la catégorie',
        'key_elements_importance_composition' => 'Importance composition: :imp_dir (de :num_dir partie(s) prenante(s) direct) + :imp_ind (de :num_ind partie(s) prenante(s) indirect)',
        'num_stakeholders' => 'Indiqué par :num_dir partie(s) prenante(s) direct et par :num_ind partie(s) prenante(s) indirect',
        'ranking' => 'Classement',
        'WARNING_on_save' => 'AVERTISSEMENT!! <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>P6, I1, PR6</i>',
    ],

    'SupportsAndConstraints' => [
        'title' => 'Contraintes ou soutiens de la part des parties prenantes',
        'fields' => [
            'Partie prenante'       => 'Partie prenante',
            'Weight'            => 'Implication de la partie prenante (0-100)',
            'ConstraintLevel'   => 'Niveau de la contrainte/du conflit ou du soutien/de la conformité',
            'Comments'          => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Utilisateurs directs',
            'group1' => 'Utilisateurs indirects',
        ],
        'ratingLegend' => [
            'ConstraintLevel' => [
                '-3' => 'Contraintes/conflits sévères',
                '-2' => 'Contraintes/conflits modérés',
                '-1' => 'Contraintes/conflits mineurs',
                '0' => 'Pas de contraintes/conflits mais pas non plus de rôle de soutien',
                '+1' => 'Soutiens /conformités faibless',
                '+2' => 'Soutiens/conformités modérés',
                '+3' => 'Soutiens/conformités solides',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Les contraintes/conflits ou les soutiens/conformités des parties prenantes peuvent être mesurés par l’intensité de leurs contraintes/conflits ou de leurs soutiens/conformités à l’égard de l’espace conservé'
        ],
        'module_info_Rating' => [
            'Évaluer les contraintes/conflits ou les facteurs de soutien/conformité les plus importants de l’environnement politique, institutionnel et social dans la gestion de l’espace conservé'
        ]
    ],

    'SupportsAndConstraintsIntegration' => [
        'title' => 'Intégration of Partie prenantes\' constraints or supports in management and governance',
        'fields' => [
            'Partie prenante'       => 'Partie prenante',
            'Intégration'       => 'Intégration',
            'IncludeInStatistics' => 'Doit-il être prioritaire dans la gestion?',
            'Comments'          => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Utilisateurs directs',
            'group1' => 'Utilisateurs indirects',
        ],
        'ratingLegend' => [
            'Intégration' => [
                '0' => 'pas d’intégration',
                '1' => 'faible intégration',
                '2' => 'intégration modérée',
                '3' => 'haute intégration',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L\'évaluation évalue la nécessité de prioriser la minimisation des contraintes de gestion ou la maximisation
             de l\'accompagnement des acteurs dans la gestion de l\'espace conservé. L\'évaluation utilise la liste de classement basée sur l\'intégration
             de la contrainte/du conflit des parties prenantes (C2.1) ou des scores de soutien/conformité avec l\'implication des parties prenantes
             dans la gestion des valeurs espace conservé (SA1 du contexte d\'intervention).'
        ],
        'module_info_Rating' => [
            'Évaluer l\'intégration actuelle dans la gestion des contraintes ou de l\'accompagnement des parties prenantes'
        ],
        'ranking' => 'Notation (C2.1)',
        'WARNING_on_save' => 'AVERTISSEMENT!! <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>I1, PR6</i>',
    ],


    'ThreatsBiodiversity' => [
        'title' => 'Analyse des menaces pesant sur les éléments clés de la biodiversité de l’espace conservé',
        'fields' => [
            'Criteria' => 'Critère',
            'Impact' => 'Impact/ Gravité',
            'Extension' => 'Échelle/ Étendue',
            'Duration' => 'Durée/irréversibilité',
            'Trend' => 'Tendence',
            'Probability' => 'Probabilité de la menace à l’avenir',
            'Note' => 'Note',
        ],
        'groups' => [
            'group0' => 'Animaux',
            'group1' => 'Végétaux',
            'group2' => 'Habitats',
        ],
        'ratingLegend' => [
            'Impact' => [
                '0' => 'Peu sévère',
                '1' => 'Modéré',
                '2' => 'Fort',
                '3' => 'Sévère',
            ],
            'Extension' => [
                '0' => 'Localisée <5%',
                '1' => 'Eparse 5-15%',
                '2' => 'Largement dispersé 15-50%',
                '3' => 'Partout >50%',
            ],
            'Duration' => [
                '0' => 'Récente < 5 years',
                '1' => 'A durée 5-20 years',
                '2' => 'Dure de plus 20-100 years',
                '3' => 'Est permanent  >100 years',
            ],
            'Trend' => [
                '-2' => 'En baisse',
                '-1' => 'Légèrement en baisse',
                '0' => 'Aucun changement',
                '1' => 'Légèrement en hausse',
                '2' => 'En hausse',
            ],
            'Probability' => [
                '0' => 'Très faible',
                '1' => 'Faible',
                '2' => 'Moyenne',
                '3' => 'Elevée',
            ],
        ],
        'module_info' => 'Evaluez le niveau des menaces qui pèsent sur les éléments clés de la biodiversité identifiés dans CTX4.1, CTX4.2, CTX4.3'
    ],

    'Threats' => [
        'title' => 'Analyse des menaces espace conservé',
        'fields' => [
            'Value' => 'Valeurs',
            'Impact' => 'Impact/ Gravité',
            'Extension' => 'Échelle/ Étendue',
            'Duration' => 'Durée/irréversibilité',
            'Trend' => 'Tendence',
            'Probability' => 'Probabilité de la menace à l’avenir',
        ],
        'ratingLegend' => [
            'Impact' => [
                '0' => 'Peu sévère',
                '1' => 'Modéré',
                '2' => 'Fort',
                '3' => 'Sévère',
            ],
            'Extension' => [
                '0' => 'Localisée <5%',
                '1' => 'Eparse 5-15%',
                '2' => 'Largement dispersé 15-50%',
                '3' => 'Partout >50%',
            ],
            'Duration' => [
                '0' => 'Récente < 5 years',
                '1' => 'A durée 5-20 years',
                '2' => 'Dure de plus 20-100 years',
                '3' => 'Est permanent  >100 years',
            ],
            'Trend' => [
                '-2' => 'En baisse',
                '-1' => 'Légèrement en baisse',
                '0' => 'Aucun changement',
                '1' => 'Légèrement en hausse',
                '2' => 'En hausse',
            ],
            'Probability' => [
                '0' => 'Très faible',
                '1' => 'Faible',
                '2' => 'Moyenne',
                '3' => 'Elevée',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'L’espace conservé a-t-elle clairement identifié les menaces susceptibles d’affecter la biodiversité, le patrimoine culturel ou les services écosystémiques de l’aire ?'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau des menaces les plus importantes dans la gestion de l’espace conservé sur la base de l’analyse du calculateur de menaces au point SA 2 du contexte d’intervention et automatiquement rapporté ci-dessous. Évaluation des menaces (rapportée automatiquement à partir du SA 2) Priorité dans la gestion Commentaires/explications'
        ],
        'num_stakeholders' => 'Indiqué par :num_dir partie(s) prenante(s) direct et par :num_ind partie(s) prenante(s) indirect',
    ],

    'ThreatsIntegration' => [
        'title' => 'Intégration des menaces',
        'fields' => [
            'Threat'       => 'Menace',
            'Intégration'       => 'Intégration',
            'IncludeInStatistics' => 'Doit-il être prioritaire dans la gestion?',
            'Comments'          => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'Intégration' => [
                '0' => 'pas d’intégration',
                '1' => 'faible intégration',
                '2' => 'intégration modérée',
                '3' => 'haute intégration',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L\'évaluation évalue la nécessité de hiérarchiser les menaces afin de minimiser leurs effets et leur impact sur l\'espace conservé
             gestion. L\'évaluation utilise la liste de classement basée sur l\'analyse des menaces in C3.1.1 et C3.1.2'
        ],
        'module_info_Rating' => [
            'Évaluer l\'intégration actuelle des menaces dans la gestion de l\'espace conservé'
        ],
        'ranking' => 'Notation (C3.1)',
        'WARNING_on_save' => 'AVERTISSEMENT!! <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) :<i>I1, PR6</i>',
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adéquation des dispositions légales et réglementaires',
        'fields' => [
            'Regulation' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Classement et désignation (par exemple, aire conservée, forêt communautaire)',
            'Clarté de la démarcation juridique de l’espace conservé (par exemple, frontières naturelles telles que les rivières, frontières non naturelles, droits coutumiers, enclaves)',
            'Règles internes pour la gestion de l’espace conservé',
            'Ratification et application des conventions internationales (CITES, CDB, Nagoya, CMS, patrimoine mondial, RAMSAR, etc.)',
            'Lois locales sur l’espace conservé et la conservation (fermeture spatiale et temporelle de l’exploitation, de la chasse, de la pêche ; quotas, limites sur le contrôle du nombre et de la taille des navires ; interdiction des méthodes ou des engins d’exploitation, de chasse et de pêche, etc.)',
            'Lois nationales sur l’environnement (gestion des ressources naturelles, conservation, espace conservé))',
            'Autres lois nationales (droits fonciers et de propriété, impôts, droit des affaires, etc.)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat',
                '1' => 'Plutôt inadéquat',
                '2' => 'Adéquat',
                '3' => 'Totalement adéquat',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les dispositions légales et réglementaires actuelles sont-elles adaptées aux activités de conservation et de gestion des ressources naturelles dans l’espace conservé ?',
            '<i>Une législation et des dispositions réglementaires adéquates constituent la base d’une gouvernance et d’un cadre de gestion efficaces et solides pour l’espace conservé et, plus important encore, pour assurer sa viabilité à long terme pour les générations actuelles et futures.</i>'
        ],
        'module_info_Rating' => [
            'Identifier et évaluer l’adéquation des dispositions légales et réglementaires actuelles en matière de conservation et de gestion des ressources naturelles dans l’espace conservé'
        ]
    ],

    'DesignAdequacy' => [
        'title' => 'Conception, taille et forme de l’espace conservé',
        'fields' => [
            'Values' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Taille (surface)',
            'Configuration ou forme de l’espace conservé',
            'Intégration des aires frontalières (en dehors de l’espace conservé qui ont des règles spéciales sur l’utilisation des ressources pour l’intégrité des captages d’eau, des corridors pour la faune, des activités d’exploitation, de chasse et de pêche, etc.)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat',
                '1' => 'Plutôt inadéquat',
                '2' => 'Adéquat',
                '3' => 'Totalement adéquat',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'La conception, la taille et la forme de l’espace conservé sont-ils adaptés à la gestion durable et à la gouvernance de ses éléments clés ?',
            'L’analyse doit montrer si la conception, la taille et la forme sont adaptés à la gestion durable et à la gouvernance des éléments clés, ou si un meilleur agencement doit être proposé, si cela est possible'
        ],
        'module_info_Rating' => [
            'Évaluer si la conception et la disposition de l’espace conservé (sur la base de l’analyse du contexte du point d’intervention CTX2) sont adéquates pour garantir une bonne gestion de ses éléments clés'
        ]
    ],

    'BoundaryLevel' => [
        'title' => 'Démarcation de l’espace conservé',
        'fields' => [
            'Boundaries' => 'Degré de démarcation de limites',
            'BoundariesComments' => 'Commentaires/Explication',
            'Adequacy' => 'Adéquation des limites',
            'EvaluationScore' => 'Adéquation',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Correspondance entre les limites marquées et la situation juridiqueg',
            'Adéquation des limites marquées',
            'Limites marquées par des éléments naturels (par exemple des rivières)',
            'Limites clairement délimitées, sans ambiguïté et donc facilement interprétables (par exemple, panneaux, poteaux, marqueurs, clôtures, bouées, etc.)',
            'Reconnaissance des limites par les autorités',
            'Reconnaissance des limites par les communautés/utilisateurs',
            'Approche collaborative incluant les agences nationales et les parties prenantes concernées dans la délimitation des limites',
            'Publication d’informations sur la délimitation des limites',
            'Délimitation et développement des limites juridiques en conformité avec les statuts juridiques et les lois internationales si nécessaire',
            'Démarcation à l’aide de la source officielle de données de référence',
            'Limites enregistrées avec des coordonnées géographiques (degré, min, sec)',
            'Délimitation des zones d’utilisation des aires protégées (zonage)',
            'Délimitation des limites, ou d’une partie d’entre elles, qui sont ambulatoires [par exemple, les berges, les rivières, etc.] et qui pourraient devoir être révisées',
            'Délimitation par des éléments naturels à l’aide d’une déclaration claire (par exemple, données sur les inondations dues aux marées ou aux cours d’eau - moyenne des basses eaux, moyenne des hautes eaux, etc.)'
        ],
        'ratingLegend' => [
            'Boundaries' => [
                '0' => '0–15%',
                '1' => '16–30%',
                '2' => '31–45%',
                '3' => '46–60%',
                '4' => '61–75%',
                '5' => '76–90%',
                '6' => '91–100%'
            ],
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (Pas de correspondance avec statut juridique / délimitation aléatoire, 0-30% des besoins)',
                '1' => 'Plutôt inadéquat (Correspondance inadéquate avec le statut juridique / délimitation ambiguë de 31 à 60 % des besoins)',
                '2' => 'Adéquat (Correspondance assez adéquate avec le statut juridique / pas clairement délimité, 61-90% des besoins)',
                '3' => 'Totalement adéquat (Correspondance complète avec le statut juridique / clairement délimité, 91-100% des besoins)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les limites de l’espace conservé sont-elles marquées et adéquates ?',
            'La délimitation des espace conservé est utile d’un point de vue juridique, car elle permet de définir exactement où les contrôles spécifiques à l’espace conservé peuvent être mis en œuvre (par exemple, la surveillance et les sanctions peuvent être appliquées en cas d’utilisation non durable des éléments clés)'
        ],
        'module_info_Rating' => [
            'Évaluer  <ol type="A"><li>le degré de marquage des limites de l’aire espace conservé</li><li>l’adéquation de la démarcation des limites pour la gestion de l’espace conservé</li></ol>'
        ]
    ],

    'ManagementPlan' => [
        'title' => 'Management plan',
        'fields' => [
            'PlanExistence' => 'A) Existe-t-il un plan de gestion ?',
            'PrintedCopy' => 'L\'entité de gestion dispose-t-elle d\'un exemplaire imprimé ?',
            'KnowledgePercentage' => 'Pourcentage de participants ou d\'employés à qui le plan a été expliqué',
            'PlanUptoDate' => 'Le plan de gestion est-il à jour ?',
            'PlanApproved' => 'Le plan de gestion a-t-il été approuvé ?',
            'PlanImplemented' => 'Le plan de gestion a-t-il été mis en œuvre ?',
            'PlanAdequacyScore' => 'B) Adéquation concernant la clarté et l’applicabilité du plan de gestion',
            'Comments' => 'Comments / Explanation',
        ],
        'ratingLegend' => [
            'KnowledgePercentage' => [
                '0' => 'moin de 10%',
                '1' => '10–50%',
                '2' => '51%-80%',
                '3' => 'plus que 80%',
            ],
            'PlanAdequacyScore' => [
                '0' => 'La clarté et l’applicabilité de la vision, de la mission et des objectifs sont totalement inadéquates (0-30% des besoins)',
                '1' => 'La clarté et l’applicabilité de la vision, de la mission et des objectifs sont quelque peu inadéquates (31-60% des besoins)',
                '2' => 'La clarté et l’applicabilité de la vision, de la mission et des objectifs sont adéquates (61-90% des besoins)',
                '3' => 'La clarté et l’applicabilité de la vision, de la mission et des objectifs sont totalement adéquates (91-100% des besoins)'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Existe-t-il un plan de gestion ? Si oui, est-il adéquat et pratique à mettre en œuvre pour l’espace conservé ?',
            'Le plan de gestion est un document qui définit l’approche et les objectifs de la gestion. La consultation la plus large possible des parties prenantes et l’élaboration d’objectifs pouvant être acceptés et respectés par tous ceux qui ont un intérêt dans l’utilisation et la survie de l’aire concernée sont essentielles à la réussite du plan (extrait de l’UICN/WDPA : Guidelines for recognising and reporting other effective area-based conservation measures, 2017)'
        ],
        'module_info_Rating' => [
            'Evaluate: A) le statut du plan de gestion, B) l’adéquation en ce qui concerne la clarté et l’applicabilité :'
        ]
    ],

    'WorkPlan' => [
        'title' => 'Plan de travail',
        'fields' => [
            'PlanExistence' => 'A) Existe-t-il un plan de travail ? Oui/Non',
            'PrintedCopy' => 'L\'entité de gestion dispose-t-elle d\'un exemplaire imprimé ?',
            'KnowledgePercentage' => 'Pourcentage de participants ou d\'employés à qui le plan a été expliqué',
            'PlanUptoDate' => 'Le plan de travail est-il à jour (couvrant la période actuelle) ? Oui/Non',
            'PlanApproved' => 'Le plan de travail a-t-il été officiellement approuvé ? Oui/Non',
            'PlanImplemented' => 'Le plan de travail ou de suivi a-t-il été mis en œuvre ? Oui/Non',
            'PlanAdequacyScore' => 'B) Adéquation concernant la clarté et l’applicabilité des activités et des résultats établis du plan de travail/action ou du plan de surveillance',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'KnowledgePercentage' => [
                '0' => 'moin de 10%',
                '1' => '10–50%',
                '2' => '51%-80%',
                '3' => 'plus que 80%',
            ],
            'PlanAdequacyScore' => [
                '0' => 'La clarté et l’applicabilité des activités et des résultats attendus sont totalement inadéquates',
                '1' => 'La clarté et l’applicabilité des activités et des résultats attendus sont quelque peu inadéquates',
                '2' => 'La clarté et l’applicabilité des activités et des résultats attendus sont adéquates',
                '3' => 'La clarté et l’applicabilité des activités et des résultats attendus sont totalement adéquates'
            ],
        ],
        'module_info_Rating' => 'Évaluer : A) le statut du plan de travail, B) la clarté et l’applicabilité des activités et des résultats établis dans le plan de travail',
        'module_info_EvaluationQuestion' => [
            'Existe-t-il un plan de travail ? Si oui, est-il adéquat et pratique à mettre en œuvre pour l’espace conservé ?',
            'Un plan de travail décrit les activités spécifiques à mettre en œuvre pour suivre les progrès accomplis dans la réalisation des résultats de l’espace conservé. Il fournit les informations nécessaires pour mesurer le succès de l’espace conservé dans ses efforts de conservation (effets et impacts).'
        ]
    ],

    'Objectives' => [
        'title' => 'Objectifs de l’espace conservé',
        'fields' => [
            'Objective' => 'Objectif',
            'Existence' => 'Existant dans le plan de gestion',
            'EvaluationScore' => 'Adéquation',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Adéquation des objectifs du plan de gestion pour les éléments clés',
            'group1' => 'Objectifs prospectifs pour les éléments clés priorisés dans la gestion, automatiquement signalés à partir du contexte de gestion',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les objectifs fixés pour l’espace conservé sont-ils adéquats ?',
            'Les buts et objectifs de l’espace conservé doivent être clairement compris. Ils doivent être bien définis et formulés de manière à faciliter le suivi, mais aussi se rapporter aux valeurs clés de l’espace conservé (c’est-à-dire les espèces ou les écosystèmes importants) ou aux principaux domaines d’activité de la gestion (par exemple, le tourisme, l’éducation)'
        ],
        'module_info_Rating' => [
            'Évaluer la pertinence des objectifs du plan de gestion pour les éléments clés de l\'espace conservé, en fonction des objectifs existants du plan de gestion et du contexte de gestion'
        ],
        'WARNING_on_save' => 'AVERTISSEMENT!! <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>O/C1</i>',
    ],

    'ObjectivesContext' => [
        'module_info' =>
            'Établir et décrire les objectifs de conservation pour le contexte de gestion de l\'espace conservé. Les objectifs listés ci-dessous
            seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants),
            phases du processus et pour le suivi des activités de gestion de l\'espace conservé.'
    ],

    'ObjectivesPlanification' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour la planification de l’espace conservé<br />Les objectifs énumérés ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases du processus, et pour le suivi des activités de gestion de l’espace conservé'
    ],

    'InformationAvailability' => [
        'title' => 'Basic information',
        'fields' => [
            'Element' => 'Classement - Concept mesuré - Variables',
            'EvaluationScore' => 'Disponibilité de l’information',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Pas ou peu d’informations disponibles pour aider à la gestion (0-30% des besoins)',
                '1' => 'Très peu d’informations disponibles - insuffisantes pour aider à la gestion (31-60% des besoins)',
                '2' => 'Informations disponibles mais modérément suffisantes pour aider à la gestion (61-90% des besoins)',
                '3' => 'Informations disponibles et largement suffisantes pour aider à la gestion (90-100% des besoins)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Disposez-vous d\'informations suffisantes et pertinentes pour appuyer le processus décisionnel de l’espace conservé ?',
            'Une gestion efficace de l’espace conservé nécessite des connaissances et des informations suffisantes pour éclairer la prise de décision. Sans information, une bonne gestion est hautement improbable'
        ],
        'module_info_Rating' => [
            'Évaluer la disponibilité des informations nécessaires pour soutenir la gestion des éléments clés de l\'espace conservé,
            hiérarchisés dans la gestion, automatiquement signalés à partir du contexte de gestion'
        ]
    ],

    'CapacityAdequacy' => [
        'title' => 'Capacités de gestion et de gouvernance',
        'fields' => [
            'Member' => 'Membre',
            'Weight' => 'Implication',
            'Adequacy' => 'Adéquation',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Composition et personnel ou membres de l\'Entité de Gestion (rapporté automatiquement par CTX 3.1.2)',
            'group1' => 'Parties prenantes impliquées dans la gestion et l’utilisation des ressources naturelles (reportées automatiquement par SA.1 et SA.2)'
        ],
        'ratingLegend' => [
            'Adequacy' => [
                '0' => 'Capacités du personnel inexistantes ou très faibles (0-30% des besoins)',
                '1' => 'Capacités du personnel insuffisantes (31-60% des besoins)',
                '2' => 'Capacités du personnel adéquates, mais des améliorations supplémentaires sont nécessaires (61-90% des besoins)',
                '3' => 'Capacités du personnel totalement suffisant (91-100% des besoins)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L\'entité ou les entités en charge de la gestion et de la gouvernance ont-elles une capacité suffisante pour gérer et gouverner l\'espace conservé'
        ],
        'module_info_Rating' => [
            'Des ressources humaines qualifiées, compétentes, engagées et adéquates sont essentielles au succès des espace conservé'
        ]
    ],

    'BudgetAdequacy' => [
        'title' => 'Current budget',
        'fields' => [
            'EvaluationScore' => 'Adéquation du budget actuel',
            'Comments' => 'Commentaires/Explications',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Pas de budget (0% des besoins)',
                '1' => 'Insuffisant pour les activités de gestion essentielles (entre 1 et 25% des besoins)',
                '2' => 'Insuffisant pour de nombreuses activités de gestion (26-50% des besoins)',
                '3' => 'Adéquat pour les activités de gestion essentielles (entre 51 et 70% des besoins)',
                '4' => 'Adéquat pour de nombreuses activités mais pas toutes (entre 71% et 90% des besoins)',
                '5' => 'Adéquat pour toutes les activités (91% ou plus des exigences)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Le budget actuel est-il suffisant pour une gestion appropriée de l’espace conservé ?',
            'Les espace conservé préparent leur budget annuel de fonctionnement chaque année ou pour plusieurs années. Des documents clés relatifs à la planification financière et au budget sont nécessaires pour améliorer l’efficience et l’efficacité opérationnelles'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation du financement de l’espace conservé pour l’année en cours par rapport aux besoins de conservation (sur la base de l’analyse du contexte d’intervention, point CTX 3.2)'
        ]
    ],

    'BudgetSecurization' => [
        'title' => 'Securing the budget',
        'fields' => [
            'Percentage' => 'A) Evaluer en pourcentage la "Sécurité des financements futurs',
            'EvaluationScore' => 'B) Évaluer en années la "Période de sécurité des financements futurs',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'Percentage' => [
                '0' => 'Les besoins financiers de base pour la gestion de l’espace conservé ne sont pas assurés (0-20% des besoins assurés)',
                '1' => 'Les besoins financiers de base pour la gestion de l’espace conservé sont très faiblement assurés (21-40% des besoins assurés)',
                '2' => 'Les besoins financiers de base pour la gestion de l’espace conservé sont faiblement assurés (41-60% des besoins assurés)',
                '3' => 'Les besoins financiers de base pour la gestion de l’espace conservé sont partiellement assurés (61-75% des besoins assurés)',
                '4' => 'Les besoins financiers de base pour la gestion de l’espace conservé sont relativement bien assurés (76-90% des besoins assurés)',
                '5' => 'Les besoins financiers de base pour la gestion de l’espace conservé sont assurés (> 90% des besoins assurés)',
            ],
            'EvaluationScore' => [
                '0' => 'Les besoins financiers de base pour la gestion de l’espace conservé ne sont assurés que pour 1 an (année en cours)',
                '1' => 'Les besoins financiers de base pour la gestion de l’espace conservé sont assurés pour 2 ans (année en cours +1 an)',
                '2' => 'Les besoins financiers de base pour la gestion de l’espace conservé sont assurés pour 3 ans (année en cours +2 ans)',
                '3' => 'Les besoins financiers de base pour la gestion de l’espace conservé sont assurés pour 4 ans et plus. (année en cours +3 ans et plus)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Quelle part du budget requis est assurée, et pour combien de temps, pour couvrir les besoins de base en matière de gestion de l’espace conservé ?',
            'Un budget sûr et fiable est essentiel pour la planification et la gestion de l’espace conservé, pour les activités à grande échelle et à long terme'
        ],
        'module_info_Rating' => [
            'Évaluer : A) la sécurité du financement et B) la période de sécurité du financement pour les années à venir par rapport aux exigences de conservation dans l’espace conservé'
        ]
    ],

    'ManagementEquipmentAdequacy' => [
        'title' => 'Infrastructure, équipement et installations',
        'fields' => [
            'Equipment' => 'Critères - Concept mesuré - Variable',
            'Adequacy' => 'A) Adéquation des infrastructures, des équipements et des installations (CTX 3.3)',
            'PresentNeeds' => 'B) Besoins actuels en matière de disponibilité pour la gestion de l’espace conservé',
            'Comments' => 'Commentaires/Explication',
        ],
        'adequacy' => 'Adéquation de l’infrastructure, de l’équipement et des installations',
        'ratingLegend' => [
            'Adequacy' => [
                '0' => 'Complètement inadéquat (0-30% des besoins)',
                '1' => 'Quelque peu inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)',
            ],
            'PresentNeeds' => [
                '0' => 'Normal',
                '1' => 'Elevé',
                '2' => 'Très élevé',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'L’infrastructure, l’équipement et les installations de l’espace conservé sont-ils adaptés aux exigences de la gestion ? L’infrastructure, l’équipement et les installations sont importants pour garantir et améliorer l’efficacité opérationnelle de l’espace conservé'
        ],
        'module_info_Rating' => [
            'Évaluer : A) l’adéquation des infrastructures, des équipements et des installations (résultats calculés automatiquement sur la base de l’analyse du contexte d’intervention, point CTX 3.3), B) les besoins actuels en matière de disponibilité d’infrastructures, d’équipements et d’installations spécifiques pour l’espace conservé',
        ]
    ],

    'ObjectivesIntrants' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour les intrants de l’espace conservé<br />Les objectifs énumérés ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases du processus et le suivi des activités de gestion de l’espace conservé'
    ],

    'ObjectivesProcessus' => [
        'module_info' => 'Établir et décrire les objectifs de conservation liés au processus de mise en œuvre de l’espace conservé Les objectifs saisis ci-dessous seront utilisés pour améliorer la gestion, et plus particulièrement pour la planification, la mobilisation des ressources (intrants), les phases du processus, et pour le suivi des activités de gestion de l’espace conservé'
    ],

    'StaffCompetence' => [
        'title' => 'Compétences/formation du personnel',
        'fields' => [
            'Member' => 'Critères - Concept mesuré - Variable',
            'Weight' => 'Implication',
            'Adequacy' => 'Adéquation des activités de renforcement des capacités pour l’entité de gestion de l’espace conservé',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Composition et personnel ou membres de l’espace conservé',
            'group1' => 'Parties prenantes impliquées dans la gestion et l’utilisation des ressources naturelles de l’espace conservé'
        ],
        'ratingLegend' => [
            'Adequacy' => [
                '0' => 'Activités de renforcement des capacités totalement inadéquates',
                '1' => 'Activités de renforcement des capacités plutôt adéquates',
                '2' => 'Activités de renforcement des capacités adéquates, mais des améliorations sont nécessaires',
                '3' => 'Activités de renforcement des capacités pleinement adéquates (suffisantes et mises à jour)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L\'entité spécifique de gestion et de gouvernance de l\'espace conservé ou la combinaison d\'entités mettent-elles en œuvre des
             programme(s) de formation et de renforcement des capacités répondant aux besoins de leurs membres pour atteindre les objectifs de l\'espace conservé?',
            'Une main-d\'œuvre qualifiée, compétente et engagée est essentielle au succès des espace conservé'
        ],
        'module_info_Rating' => [
            'Évaluer l\'adéquation des activités de renforcement des capacités pour l\'entité spécifique de gestion et de gouvernance de l\'espace conservé
            ou la combinaison d\'entités membres (identifiées dans CTX 3.1.2 et CTX 5 - Utilisateurs directs)'
        ]
    ],

    'HRmanagementPolitics' => [
        'title' => 'Politiques et procédures RH',
        'fields' => [
            'Conditions' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation des politiques et procédures de gestion des ressources humaines',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Rémunération et avantages sociaux des salariés',
            'Compensations pour les tâches basées sur la participation',
            'Affectation d’un emploi ou d’une tâche',
            'Santé, sécurité et sûreté',
            'L’équité entre les sexes et l’équité ethnique',
            'Gestion des relations avec les parties prenantes dans le cadre des tâches à accomplir',
            'Règles réduisant le favoritisme et la discrimination dans l’attribution des tâches',
            'L’équité dans la responsabilité des activités menées'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Complètement inadéquat (0-30% des besoins)',
                '1' => 'Quelque peu inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’entité spécifique ou la combinaison d’entités de l’espace conservé chargée de la gestion et de la gouvernance a-t-elle adopté des politiques de gestion adéquates pour motiver et retenir ses ressources humaines ?'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des dispositions des politiques de gestion des ressources humaines',
            'Adéquation des politiques de gestion des ressources humaines'
        ],
        'module_info' => 'Dispositions des politiques de gestion des ressources humaines de l’entité ou de la combinaison d’entités spécifiques de l’espace conservé en matière de gestion et de gouvernance (identifiées dans SA 1 ou CTX 3.1.1) :',
    ],

    'AdministrativeManagement' => [
        'title' => 'Budget et finances',
        'fields' => [
            'Aspect' => 'Critères - Concept mesuré - Variables',
            'EvaluationScore' => 'Rating: Mise en place des éléments de base de la gestion budgétaire et financière',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Responsabilité : vous êtes en mesure d’expliquer et de démontrer à toutes les parties prenantes comment vous avez utilisé vos ressources et ce que vous avez réalisé',
            'Transparence : votre organisation est transparente en ce qui concerne son travail et ses finances, et met les informations à la disposition de toutes les parties prenantes',
            'Intégrité : les membres de votre organisation agissent avec honnêteté et correction',
            'Gestion financière : votre organisation prend soin des ressources financières qui lui sont allouées et veille à ce qu’elles soient utilisées aux fins prévues',
            'Normes comptables : le système d’enregistrement et de documentation financière de votre organisation est conforme aux normes comptables externes reconnues'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Jamais',
                '1' => 'Rarement',
                '2' => 'Parfois',
                '3' => 'Souvent',
                '4' => 'Toujours'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Le budget et les ressources financières sont-ils bien gérés pour répondre aux besoins essentiels et prioritaires de l’espace conservé en matière de gestion ?',
            'La gestion budgétaire et financière d’une espace conservé doit être solide pour permettre une budgétisation et une allocation des ressources adéquates. Une gestion budgétaire et financière efficace n’est possible que si l’on dispose d’un plan de gestion et de travail solide assorti d’objectifs clairs'
        ],
        'module_info_Rating' => [
            'Évaluer la mise en place des éléments de base qui doivent être en place pour obtenir de bonnes pratiques en matière de gestion budgétaire et financière'
        ]
    ],

    'EquipmentMaintenance' => [
        'title' => 'Entretien des infrastructures',
        'fields' => [
            'Equipment' => 'Critères - Concept mesuré - Variables',
            'EvaluationScore' => 'Notation: Adéquation de la maintenance',
            'AdequacyLevel' => 'Valeur de CTX 3.3',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30% of the needs)',
                '1' => 'Plutôt inadéquat (31-60% of the needs)',
                '2' => 'Adéquat (61-90% of the needs)',
                '3' => 'Totalement adéquat (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’infrastructure, l’équipement et les installations de l’espace conservé sont-ils correctement entretenus ?',
            'Une infrastructure, un équipement et des installations mal entretenus s’usent non seulement plus rapidement, mais gaspillent également les ressources et réduisent fondamentalement la capacité de l’espace conservé à atteindre ses objectifs'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau de maintenance des infrastructures, des équipements et des installations par rapport aux exigences de gestion de l’espace conservé (sur la base de l’analyse du contexte d’intervention, point CTX 3.3)'
        ]
    ],

    'ManagementActivities' => [
        'title' => 'Gestion des éléments clés',
        'fields' => [
            'Activity' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation of management actions',
            'InManagementPlan' => 'Action incluse dans le plan de gestion',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Éléments clés de l’espace conservé'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30% of the needs)',
                '1' => 'Plutôt inadéquat (31-60% of the needs)',
                '2' => 'Adéquat (61-90% of the needs)',
                '3' => 'Totalement adéquat (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Existe-t-il des mesures de gestion spécifiques pour les éléments clés de l’espace conservé ?',
            'Pour garantir une gestion durable des éléments clés de l’espace conservé, les parties prenantes/associations de gestion doivent évaluer les pratiques et les actions qui peuvent inclure la conservation/restauration des espèces animales (par exemple, les abeilles) et végétales (par exemple, la pharmacopée), la gestion des incendies, les travaux de re-végétalisation, le contrôle des espèces envahissantes, la gestion des ressources culturelles, l’endiguement des menaces, etc.'
        ],
        'module_info_Rating' => [
            'Sur la base de la liste des éléments clés identifiés dans le contexte d’intervention SA 2 et classés par ordre de priorité dans l’analyse de gestion C1, C2, C3.2 et C4 évaluer l’adéquation des pratiques et actions de gestion correspondantes'
        ]
    ],

    'LawEnforcementImplementation' => [
        'title' => 'Résolution des problèmes litigieux',
        'fields' => [
            'Element' => 'Critères - Concept mesuré - Variable',
            'Adequacy' => 'Adéquation',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Activités de contrôle sur terre et en mer',
            'group1' => 'Actions en réponse à des activités illégales ou à la résolution de questions litigieuses',
        ],
        'predefined_values' => [
            'group0' => [
                'Gestion de l’organisation des unités/groupes de contrôle',
                'Nombre d’unités/groupes de contrôle par mois',
                'Utilisation d’un contrôle collaboratif grâce à la collaboration avec les parties prenantes',
                'Organisation d’unités/groupes de contrôle en collaboration avec les agents forestiers et maritimes et les agents assermentés',
                'Unités/groupes de contrôle équipés de divers moyens (par exemple, types de patrouilles tels que points d’observation, patrouilles à pied, à vélo, à moto, unités/groupes assistés par des véhicules/bateaux, etc.)',
                'Utilisation du GPS ou d’autres outils de soutien pour effectuer le briefing et le débriefing des unités/groupes de contrôle',
                'Application du contrôle par des unités/groupes opérant pendant la nuit ou des heures non programmées',
                'Mise à jour et utilisation permanentes d’une fiche d’information simple décrivant le zonage, les contrôles, les restrictions et les activités illégales'
            ],
            'group1' => [
                'Unité spécifique ou administrateur / gardien orientant et soutenant les unités/groupes de contrôle contre les activités illégales ou les questions litigieuses',
                'Organisation du système d’informateurs orientation et soutien orientation et soutien des unités/groupes de contrôle contre les activités illégales ou les questions litigieuses',
                'Système de mise en œuvre d’actions légales contre les activités illégales',
                'Un système pour résoudre les questions litigieuses',
                'System to solve contentious issues',
                'Jugements obtenus selon les règles traditionnelles',
                'Collaboration avec des ONG spécialisées dans les lois terrestres et marines, l’application, etc. (droits, règles, etc.) sur la gestion durable des éléments clés de l’espace conservé'
            ]
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30%)',
                '1' => 'Plutôt inadéquat (31-60%)',
                '2' => 'Adéquat (61-90%)',
                '3' => 'Totalement adéquat (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Dans quelle mesure le contrôle et les actions contre les activités illégales visant à garantir la durabilité de la gestion des éléments clés de l’espace conservé sont-ils adéquats ?',
            'Le contrôle (activités d’observation et collecte de données) est une activité essentielle pour faire respecter les règles juridiques, traditionnelles et spécifiques existantes afin de garantir la gestion à long terme des éléments clés de l’espace conservé'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des éléments de la gestion des patrouilles de gardes forestiers visant à assurer la protection à long terme de la biodiversité et d’autres valeurs',
            'Évaluer les mesures prises pour lutter contre les activités illégales ou pour résoudre les questions litigieuses dans le cadre de la gestion durable des éléments clés de l’espace conservé'
        ]
    ],

    'StakeholderCooperation' => [
        'title' => 'Collaboration des parties prenantes',
        'fields' => [
            'Element' => 'Critères - Concept mesuré - Variable',
            'Weight' => 'Implication de la partie prenante (0-100)',
            'Cooperation' => 'Degré de coopération',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Utilisateurs directs',
            'group1' => 'Utilisateurs indirects',
        ],
        'ratingLegend' => [
            'Cooperation' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Pas de coopération - Pas de représentation ou de consultation des parties prenantes, pas d’engagement, pas de prise en compte des connaissances et des perspectives locales',
                '1' => 'Très peu de coopération - Représentation ou consultation sporadique des parties prenantes, engagement minimal, faible prise en compte des connaissances et perspectives locales',
                '2' => 'Coopération modérée - Représentation ou consultation modérée des parties prenantes, engagement occasionnel, prise en compte des connaissances et perspectives locales',
                '3' => 'Coopération très élevée - Représentation ou consultation des parties prenantes bien établie, engagement important, prise en compte totale des connaissances et des perspectives locales'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Existe-t-il des mesures pour améliorer la coopération des parties prenantes dans la gouvernance et la gestion de l’espace conservé ?',
            'L’évaluation vise à déterminer le degré de coopération et de participation effective des parties prenantes qui contribue à la légitimité et à l’efficacité de la gouvernance de l’espace conservé'
          ],
          'module_info_Rating' => [
            'Évaluer le niveau de l’implication, de la participation, de l’engagement et des connaissances et perspectives locales des parties prenantes dans la gouvernance et la gestion de l’espace conservé'
          ]
      ],

    'AssistanceActivities' => [
        'title' => 'Avantages pour les communautés locales',
        'fields' => [
            'Activity' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation des services ou des activités d’assistance',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Eléments du niveau de vie matériel',
            'group1' => 'Éléments du niveau de vie immatériel'
        ],
        'predefined_values' => [
            'group0' => [
                'Soutenir la sécurité alimentaire (petite agriculture, pêche à petite échelle, récolte, chasse, etc.)',
                'Soutien aux entreprises locales (transformation de la production agricole alimentaire, pêche, construction de hangars à bateaux, stationnement de bateaux, produits forestiers, etc.)',
                'Soutien aux entreprises touristiques (distribution des revenus du tourisme, produits traditionnels et artisanaux pour les touristes, produits agricoles ou de la mer, etc.)',
                'Soutien aux voies de financement locales',
                'Soutien à la résolution des conflits entre l’homme et la faune sauvage - compensation',
                'Soutien à l’emploi des ressources humaines locales dans l’espace conservé, dans le tourisme, etc.',
                'Soutenir les prestataires de services locaux',
                'Fourniture de ressources naturelles en cas de besoin (par exemple, eau, fibres, etc. provenant des espace conservé pendant les crises ou contribution matérielle pour les bâtiments sociaux tels que l’hôpital, l’école)',
                'Fournir l’alimentation en énergie, le raccordement électrique, l’approvisionnement en eau, la construction, l’entretien et l’amélioration des routes, etc.'
            ],
            'group1' => [
                'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des éléments clés de l’espace conservé (approvisionnement et culture)',
                'Fourniture d’infrastructures d’éducation et de santé (bâtiments, eau potable)',
                'Fourniture de services éducatifs (enseignement), de services de santé (soins de santé)',
                'Fourniture de services culturels (physiques - intellectuels - emblématiques - spirituels - interaction avec les services de l’espace conservé)',
                'Facilitation de la résolution de problèmes sociaux',
                'Renforcement de l’identité et du sentiment d’appartenance des peuples autochtones et des communautés locales (IPLC)',
                'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des éléments clés de l’espace conservé (approvisionnement et culture)',
                'Fourniture d’infrastructures d’éducation et de santé (bâtiments, eau potable)',
                'Fourniture de services éducatifs (enseignement), de services de santé (soins de santé)',
                'Fourniture de services culturels (physiques - intellectuels - emblématiques - spirituels - interaction avec les services de l’espace conservé)',
                'Facilitation de la résolution de problèmes sociaux',
                'Renforcement de l’identité et du sentiment d’appartenance des peuples autochtones et des communautés locales (IPLC)'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30%)',
                '1' => 'Plutôt inadéquat (31-60%)',
                '2' => 'Adéquat (61-90%)',
                '3' => 'Totalement adéquat (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’espace conservé mène-t-elle des activités/programmes destinés à fournir des avantages/une assistance appropriés aux communautés ?',
            'Les OECO doivent contribuer au développement durable et au bien-être économique des parties prenantes. En conséquence, les normes internationales en matière de bonnes pratiques encouragent une évaluation des OECO qui tienne compte des résultats écologiques et socio-économiques (Sources UNESCO - UICN)'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des activités/programmes mis en œuvre par l’espace conservé pour fournir des avantages/une assistance aux parties prenantes'
        ],
    ],

    'EnvironmentalEducation' => [
        'title' => 'Éducation environnementale',
        'fields' => [
            'Activity' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation des activités d’éducation à l’environnement et de sensibilisation du public',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Programmes de conservation des parties prenantes de l’espace conservé',
            'Programmes de sensibilisation des acteurs de l’espace conservé',
            'Programmes de sensibilisation des parties prenantes autres que celles de l’espace conservé',
            'Programme d’éducation à l’environnement dans les écoles du paysage de l’espace conservé',
            'Radio - Programmes télévisés sur l’espace conservé (par exemple, sur les stations de radio communautaires)',
            'Conférences et débats sur l’espace conservé',
            'Visites guidées pour les acteurs de l’espace conservé',
            'Déchets et opérations de nettoyage',
            'Sensibilisation du public (par exemple, les écomusées)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30%)',
                '1' => 'Plutôt inadéquat (31-60%)',
                '2' => 'Adéquat (61-90%)',
                '3' => 'Totalement adéquat (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’espace conservé mène-t-elle des activités/programmes d’éducation environnementale et de sensibilisation du public spécifiquement liés aux besoins et aux objectifs de conservation/gestion des éléments clés ?',
            'L’éducation environnementale peut aider les individus à trouver un équilibre entre leurs propres besoins vitaux et les besoins de l’environnement naturel qui fournit des services (approvisionnement, régulation, culture et soutien) aux parties prenantes à l’intérieur et à l’extérieur, près et loin de l’espace conservé (en tenant compte de la désignation spécifique de l’espace conservé). Cet objectif pourrait être atteint en renforçant la sensibilisation et en changeant effectivement le point de vue des parties prenantes sur l’espace conservé'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des activités/programmesd’éducation à l’environnement et de sensibilisation du public soutenus par l’espace conservé'
        ]
    ],

    'VisitorsManagement' => [
        'title' => 'La gestion du tourisme',
        'fields' => [
            'Aspect' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation of visitor facilities and services',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Existence d’objectifs spécifiques pour le tourisme et la gestion des visiteurs',
            'Existence de procédures de gestion du tourisme',
            'Sensibilisation aux conséquences des activités d’écotourisme',
            'Actions visant à minimiser les changements induits par l’homme (transport, logement et activités de loisirs)',
            'Diversification du tourisme par la promotion des valeurs biophysiques, culturelles et sociales',
            'Avantages économiques pour la gestion et la gouvernance des espace conservé',
            'Gestion de l’hébergement, de la restauration et des activités de loisirs (également pour les personnes handicapées)',
            'Les guides touristiques de l’espace conservé',
            'Données de suivi du tourisme'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30%)',
                '1' => 'Plutôt inadéquat (31-60%)',
                '2' => 'Adéquat (61-90%)',
                '3' => 'Totalement adéquat (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’espace conservé gère-t-elle (conçoit-elle, met-elle en place, entretient-elle et améliore-t-elle) les installations, les services et l’impact du tourisme environnemental sur les visiteurs ?',
            'Le tourisme se produit dans des contextes historiques, culturels et géographiques uniques, impliquant de multiples valeurs et acteurs de l’espace conservé. Une gestion efficace du tourisme dans l’espace conservé exige une appréciation et une compréhension des contextes de durabilité environnementale, sociale et économique, ainsi qu’une gestion compatible des installations et des services destinés aux visiteurs'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation de la gestion des installations et des services destinés aux visiteurs, ainsi que l’impact sur le tourisme environnemental et culturel de l’espace conservé'
        ]
    ],

    'NaturalResourcesMonitoring' => [
        'title' => 'Veille et recherche',
        'fields' => [
            'Aspect' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation du suivi',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Utilisation des données de suivi pour induire des changements dans la gestion et la gouvernance de l’espace conservé',
            'Suivi des éléments clés',
            'Surveillance des menaces pesant sur l’espace conservé',
            'Suivi du niveau de vie matériel et immatériel des parties prenantes',
            'Recherche sur les éléments clés',
            'Recherche sur le niveau de vie matériel et immatériel des parties prenantes'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30%)',
                '1' => 'Plutôt inadéquat (31-60%)',
                '2' => 'Adéquat (61-90%)',
                '3' => 'Totalement adéquat (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les systèmes de suivi et de recherche permettent-ils de suivre efficacement les éléments clés de l’espace conservé ?',
            'Pour anticiper les problèmes potentiels et planifier les meilleures interventions, il est indispensable de bien comprendre les tendances des éléments clés de l’environnement et des services de l’espace conservé tels que la biodiversité, l’approvisionnement (eau, nourriture, etc.), la qualité des forêts, les menaces, etc.'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des systèmes de suivi et de recherche mis en place pour les éléments clés de l’espace conservé'
        ]
    ],

    'WorkProgramImplementation' => [
        'title' => 'Activités de mise en œuvre du plan de travail/action',
        'fields' => [
            'Category' => 'Catégories d’activités',
            'Activity' => 'Activité',
            'TargetedActivity' => 'Activité ciblée',
            'EvaluationScore' => 'Niveau de mise en œuvre',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Aucun ou très faible niveau de mise en œuvre des activités ciblées pour l’année écoulée (entre 0 et 25%)',
                '1' => 'Faible niveau de mise en œuvre des activités ciblées pour l’année écoulée (entre 26 et 50%)',
                '2' => 'Niveau modéré de mise en œuvre des activités ciblées pour l’année écoulée (entre 51 et 75%)',
                '3' => 'Niveau élevé de mise en œuvre des activités ciblées pour l’année écoulée (entre 76 et 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Dans quelle mesure l’espace conservé a-t-elle mis en œuvre les principales activités du plan de travail/action ?',
            'La mise en œuvre est la réalisation ou l’exécution du plan de travail/action annuel ou pluriannuel concernant les activités de l’espace conservé'
        ],
        'module_info_Rating' => [
            'Évaluez le niveau de mise en œuvre des priorités définies dans le plan de travail/action de l’année précédente (dans la case "commentaires", indiquez l’année de référence si vous utilisez un plan de travail/action pluriannuel)',
            '<b>Catégorie d’activités </b>: gestion des éléments clés, contrôle, éducation à l’environnement, gestion du tourisme, etc.',
            '<b>Activité</b>: action appartenant à l’une des principales catégories d’activités et exécutée dans un but particulier',
            'Sans plan de travail/d’action, vous pouvez vous référer aux catégories et aux activités de l’élément Processus : Gestion et protection des éléments clés ; Relations avec les parties prenantes ; Tourisme ; Surveillance et recherche ; etc.'
        ]
    ],

    'ManagementGovernance' => [
        'title' => 'Contrôle de l’aire',
        'fields' => [
            'Patrol' => 'A) Aire sous le contrôle',
            'Comments' => 'Commentaires/Explication'
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'La surface sous contrôle est minime (de 0 à 25% de la surface)',
                '1' => 'La surface sous contrôle est limitée (de 26 à 50% de la surface)',
                '2' => 'La surface sous contrôle est suffisantee (de 51 à 75% de la surface)',
                '3' => 'La surface sous contrôle est très bonne (plus de 76% de la surface)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Quelle est l’étendue actuelle du contrôle de la gestion et de la gouvernance des éléments clés de l’espace conservé ?',
            'La capacité à assurer le contrôle et la collecte d’informations sur les éléments clés prioritaires de la gestion et de la gouvernance de l’espace conservé permet de prévenir ou de minimiser les activités illégales ou les questions litigieuses'
        ],
        'module_info_Rating' => [
            'Évaluer le contrôle des éléments clés considérés comme prioritaires dans la gestion et la gouvernance de l’espace conservé'
        ]
    ],

    'AchievedObjectives' => [
        'title' => 'Atteinte des objectifs à long terme de la gestion et de la gouvernance de l’espace conservé',
        'fields' => [
            'Objective' => 'Principaux objectifs à long terme',
            'EvaluationScore' => 'Niveau d’atteinte des objectifs',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'aucun ou très faible niveau d’atteinte (entre 0 et 25%)',
                '1' => 'faible niveau d’atteinte (entre 26 et 50%)',
                '2' => 'niveau d’atteinte modéré (entre 51 et 75%)',
                '3' => 'niveau élevé d’atteinte (entre 76 et 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Dans quelle mesure l’espace conservé a-t-elle atteint les principaux objectifs de son plan de gestion et de gouvernance ?',
            '(Sur la base de l\'analyse du contexte d\'intervention, point CTX1.5 Vision – Objectifs ou éléments de planification, point P6 – Objectifs existants du plan de gestion).',
            'Les buts et objectifs d’une espace conservé doivent être clairement compris si l’on veut que la gestion soit réussie sur la base de résultats mesurables'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau de réalisation des principaux objectifs à long terme liés aux éléments clés de l’espace conservé'
        ]
    ],

    'KeyElementsImpact' => [
        'title' => 'Effets sur les éléments clés de la conservation',
        'fields' => [
            'KeyElement' => 'Élément clé de conservation',
            'StatusSH' =>   'Statut',
            'TrendSH' =>    'Tendance',
            'EffectSH' =>   'Effet',
            'ReliabilitySH' =>  'Fiabilité des informations',
            'CommentsSH' =>     'Commentaires/explications',
            'StatusER' =>   'Statut',
            'TrendER' =>    'Tendance',
            'EffectER' =>   'Effet',
            'ReliabilityER' =>  'Fiabilité des informations',
            'CommentsER' =>     'Commentaires/explications',
        ],
        'from_sa' => 'De parties prenantes',
        'from_external_source' => 'De source externe',
        'groups' => [
            'group0' => 'Principales espèces animales',
            'group1' => 'Principales espèces végétales',
            'group2' => 'Habitats clés',
        ],
        'module_info_EvaluationQuestion' => [
            'La gestion et la gouvernance exercent-elles des effets positifs ou négatifs sur les éléments clés de conservation de l\'espace conservé ?',
            'L\'un des principaux objectifs de l\'espace conservé est de fournir des résultats positifs et durables pour la conservation in situ
             de la biodiversité. La comparaison des évaluations des utilisateurs directs et indirects et des données techniques sur le même élément clé, permet une analyse détaillée et une interprétation des résultats, en mettant en évidence
             observations spécifiques, divergences, domaines d\'alignement et recommandations potentielles de modifications ou d\'adoption
             les meilleures pratiques. Les résultats de la comparaison entre l\'évaluation interne et les données externes sur la même clé
             des éléments de conservation peuvent être fournis dans la section des commentaires.'
        ],
        'module_info_Rating' => [
            'Assurer une double analyse collaborative entre les utilisateurs directs et indirects, les parties prenantes ou leurs représentants sur A) l’état et B) les tendances des éléments clés de la conservation de l’espace conservé'
        ],
        'ratingLegend' => [
            'StatusSH' => [
                '-2' => 'En diminution',
                '-1' => 'En légère diminution',
                '0' => 'No change',
                '+1' => 'En légère augmentation',
                '+2' => 'En augmentation'
            ],
            'TrendSH' => [
                '-2' => 'En diminution',
                '-1' => 'En légère diminution',
                '0' => 'No change',
                '+1' => 'En légère augmentation',
                '+2' => 'En augmentation'
            ]
        ]
    ],

    'LifeQualityImpact' => [
        'title' => 'Impacts sur les communautés locales',
        'fields' => [
            'Element' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Effets',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Eléments du niveau de vie matériel',
            'group1' => 'Eléments du niveau de vie immatériel',
        ],
        'predefined_values' => [
            'group0' => [
                'Sécurité alimentaire (petite agriculture, petite pêche, récolte, chasse, etc.)',
                'Entreprises locales (transformation de la production agricole alimentaire, pêche, construction de hangars à bateaux, stationnement de bateaux, produits forestiers, etc.)',
                'Résolution des conflits homme-faune - compensation',
                'Emploi des ressources humaines locales dans l’espace conservé, dans le tourisme, etc.',
                'Ressources naturelles en cas de besoin (par exemple, eau, fibres, etc. provenant des espace conservé pendant les crises ou contribution matérielle pour les bâtiments sociaux tels que l’hôpital, l’école)',
                'Alimentation en énergie, raccordement électrique, approvisionnement en eau - raccordement, construction, entretien et amélioration des routes, etc.'
            ],
            'group1' => [
                'Conflits et renforcement de la gestion et de l’utilisation durables des éléments clés de l’espace conservé (approvisionnement et culture)',
                'Éducation, infrastructures de santé (bâtiments, eau potable)',
                'Services éducatifs (enseignement), services de santé (soins de santé)',
                'Services culturels (physiques - intellectuels - emblématiques - spirituels - interaction des services de l’espace conservé),',
                'Résolution de problèmes sociaux',
                'Identité et sentiment d’appartenance des peuples autochtones et des communautés locales (IPLC)'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '-3' => 'Effets très dommageables',
                '-2' => 'Effets dommageables',
                '-1' => 'Effets légèrement dommageables',
                '0' => 'Neutre',
                '+1' => 'Effets légèrement favorables',
                '+2' => 'Effets favorables',
                '+3' => 'Effets très favorables'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'La gestion et la gouvernance de l’espace conservé ont-elles des effets positifs ou négatifs sur la qualité de vie des parties prenantes ?',
            'La gestion et la gouvernance de l’espace conservé doivent être très attentives aux effets sur la qualité de vie des acteurs locaux. La disponibilité des ressources essentielles peut affecter la qualité de la vie en ayant des répercussions sur la consommation, le revenu et la richesse (niveau de vie matériel) et sur la qualité de vie, la santé et les relations sociales et culturelles (niveau de vie immatériel)'
        ],
        'module_info_Rating' => [
            'Évaluer les effets de la gestion et de la gouvernance de l’espace conservé sur les parties prenantes'
        ]
    ],

    'EmpowermentGovernance' => [
        'title' => 'Parties prenantes, autonomisation',
        'fields' => [
            'Conditions' => 'Critères - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation de l’autonomisation des parties prenantes',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'IMPLICATION',
            'group1' => 'RESPONSABILITÉ',
            'group2' => 'DIRECTION'
        ],
        'predefined_values' => [
            'group0' => [
                'Représentation : mécanismes existants qui garantiront la représentation légitime des parties prenantes dans le processus décisionnel de l’espace conservé',
                'Acceptation : compréhension et reconnaissance des droits coutumiers sur les services écosystémiques',
                'Acceptation : acceptation sociale de la légitimité des droits légaux des services écosystémiques',
                'Orientation vers le consensus : prise de décision maintenant un dialogue actif et recherchant un consensus sur des solutions qui répondent, au moins en partie, aux préoccupations et aux intérêts de chacun'
            ],
            'group1' => [
                'Respect des accords : contrôle du respect des accords conclus entre les différentes parties prenantes',
                'L’équité dans les coûts et les bénéfices associés à la conservation : maximiser les bénéfices écologiques, sociaux, économiques et culturels des espace conservé sans encourir de coûts inutiles ni causer de dommages aux communautés locales',
                'Efficacité de la gestion : application de la gouvernance existante des services écosystémiques efficace et efficiente dans la fourniture des avantages écologiques, sociaux, économiques et culturels de l’espace conservé'
            ],
            'group2' => [
                'Orientation (vision) : développement et application d’une vision stratégique cohérente (perspective à long terme) basée sur des valeurs convenues et une appréciation des complexités écologiques, historiques, sociales et culturelles',
                'Légalisation : promouvoir la légalisation des droits des parties prenantes dans la gestion et la gouvernance des services écosystémiques afin de maximiser les bénéfices écologiques, sociaux, économiques et culturels des écosystèmes protégés et conservés',
                'Respect des valeurs : soutenir l’amélioration de toutes les valeurs écologiques, d’approvisionnement, de contrôle et culturelles de l’espace conservé dans l’intérêt des communautés'
            ]
        ],

        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’espace conservé',
                '0' => 'Inadéquat (0-30% of the needs)',
                '1' => 'Plutôt inadéquat (31-60% of the needs)',
                '2' => 'Adéquat (61-90% of the needs)',
                '3' => 'Totalement adéquat (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'La direction de l’espace conservé encourage-t-elle activement les initiatives d’autonomisation des parties prenantes afin de garantir une plus grande implication des parties prenantes pour une mise en œuvre plus efficace et plus percutante des mesures de conservation ?',
            'L’autonomisation des parties prenantes est la pierre angulaire de la gestion et de la gouvernance d’une espace conservé, jouant un rôle essentiel dans la promotion d’un engagement significatif, d’une responsabilité partagée et d’une prise de décision collaborative entre les diverses parties prenantes. En responsabilisant les parties prenantes, l’espace conservé cherche à exploiter leurs connaissances, leurs perspectives et leurs contributions collectives, ce qui conduit en fin de compte à une mise en œuvre plus complète, plus durable et plus efficace des mesures de conservation',
        ],
        'module_info_Rating' => [
            'Évaluer la promotion des initiatives d’autonomisation des parties prenantes en vue d’une mise en œuvre plus complète, durable et efficace des mesures de conservation',
        ]
    ],
];

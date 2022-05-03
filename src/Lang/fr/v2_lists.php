<?php

return [

    'languages' => [
        'fr'        => 'français',
        'en'        => 'anglais',
        'sp'        => 'espagnol',
        'pt'        => 'portugais'
    ],

    'NonWdpaPaDef' => [
        '1' => 'répond aux définitions des aires protégées de l\'UICN et/ou de la CDB',
        '0' => 'répond à la définition CBD d\'un OECM',
    ],

    'NonWdpaDesignType' => [
        'Régional',
        'National',
        'International',
        'Non applicable'
    ],

    'NonWdpaTypology' => [
        '2' => 'principalement ou entièrement marine',
        '1' => 'côtière: marine et terrestre',
        '0' => 'principalement ou entièrement terrestre'
    ],

    'NonWdpaStatus' => [
        'Proposé',
        'Inscrit',
        'Adopté',
        'Désigné',
        'Établi'
    ],

    'PaType' => [
        'terrestrial'           => 'terrestre',
        'marine_and_coastal'    => 'maritime et côtier',
        'oecm_terrestrial'      => 'OECMs (Other effective area-based conservation measures) - Terrestrial',
        'oecm_marine'           => 'OECMs (Other effective area-based conservation measures) - Marine',
        'icca_terrestrial'      => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine'           => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine'
    ],

    'MarineDesignation' => [
        'XXXXXXXXX No-Entry zone',
        'XXXXXXXXX No-Take zone',
        'XXXXXXXXX Multi-purposes MPA - Buffer zones for traditional use',
        'XXXXXXXXX Multi-purposes MPA - Buffer zones for educational and/or recreational activities',
        'XXXXXXXXX Multi-purposes MPA - Other',
        'XXXXXXXXX Marine reserves',
        'XXXXXXXXX Wildlife refuges',
        'XXXXXXXXX Fish management zone',
        'XXXXXXXXX Other',
    ],

    'EcoType' => [
        'Désert',
        'Savanes',
        'Miombo',
        'Forêts claires',
        'Forêts sèches',
        'Forêts tropicales',
        'Hautes montagnes',
        'Lacs / Rivières',
        'Zones humides',
        'Mangroves',
        'Côtière',
        'Mer/Océan'
    ],

    'InstitutionType' => [
        'Académique',
        'Confessionnel',
        'Indépendant',
        'ONG / ASBL',
        'Organisation internationale',
        'Privé',
        'Projet / Programme',
        'Public (étatique)',
        'Autre'
    ],

    'PartnershipsType' => [
        'Financier',
        'scientifique',
        'recherche',
        'parrainage',
        'jumelage',
        'expertise',
        'prestation de service',
        'concession (p.ex. tourisme)',
        'collaboration',
        'PPP (Partenariat Publique/Privé)'
    ],

    'GovernanceType' => [
        'Gouvernance par le gouvernement',
        'Gouvernance partagée',
        'Gouvernance privée',
        'Gouvernance par les communautés locales et les populations autochtones'
    ],

    'Designation' => [
        'ASEAN Heritage Parks (ASEAN)',
        'Alliance for Zero Extinction Sites (AZE)',
        'Barcelona Convention',
        'Biodiversity Hotspots',
        'Endemic Bird Areas',
        'High Biodiversity Wilderness Area',
        'IUCN Important Sites for Freshwater Biodiversity',
        'Important Bird Areas (IBA)',
        'Important Plant Areas (IPA)',
        'Key Biodiversity Areas (KBA)',
        'Natura 2000',
        'OSPAR Marine Protected Areas',
        'Ramsar Wetlands',
        'Species Grid',
        'UNESCO MAB',
        'World Heritage Sites'
    ],

    'LandCoverUseTake' => [
        'Forêt',
        'Savane arbustive',
        'Savane herbacée',
        'Prairies',
        'Eau',
        'Cultures / Plantations',
        'Habitations',
        'Routes'
    ],

    'SpeciesReliability' => [
        'Haute', 'Moyenne', 'Faible'
    ],

    'MarineHabitatsPresence' => [
        'Présent', 'Absent', 'Dominant'
    ],

    'EcosystemServicesImportance' => [
        '_' => null,        // need to force string keys
        '0' => 'Locale',
        '1' => 'Plus grand',
    ]

];

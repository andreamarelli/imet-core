<?php

return [

    'languages' => [
        'fr'        => 'French',
        'en'        => 'English',
        'sp'        => 'Spanish',
        'pt'        => 'Portuguese'
    ],

    'NonWdpaPaDef' => [
        '1' => 'meets IUCN and/or CBD protected area definitions',
        '0' => 'meets the CBD definition of an conserved area',
    ],

    'NonWdpaDesignType' => [
        'National',
        'Regional',
        'International',
        'Not applicable'
    ],

    'NonWdpaTypology' => [
        '2' => 'predominantly or entirely marine',
        '1' => 'coastal: marine and terrestrial',
        '0' => 'predominantly or entirely terrestrial'
    ],

    'NonWdpaStatus' => [
        'Proposed',
        'Inscribed',
        'Adopted',
        'Designated',
        'Established'
    ],

    'OwnershipType' => [
        'state' => 'State',
        'communal' => 'Community',
        'individual_landowners' => 'Individual landowners',
        'for_profit_organizations' => 'For-profit organisations',
        'nonprofit_organizations' => 'Non-profit organisations',
        'joint_ownership' => 'Joint ownership',
        'multiple_ownership' => 'Multiple ownership',
        'contested' => 'Contested',
        'not_reported' => 'Not Reported',
    ],

    'PaType' => [
        'terrestrial'           => 'Terrestrial',
        'marine_and_coastal'    => 'Marine and coastal',
        'oecm_terrestrial'      => 'Conserved areas - Terrestrial',
        'oecm_marine'           => 'Conserved areas - Marine',
        'icca_terrestrial'      => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine'           => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine'
    ],

    'IUCNDesignation' => [
        'IA' => 'IA Strict Nature Reserve',
        'IB' => 'IB Wilderness Area',
        'II' => 'II National Park',
        'III' => 'III Natural Monument or Feature',
        'IV' => 'IV HABITAT/Species Management Area',
        'V' => 'V Protected Seascape',
        'VI' => 'VI Protected Area with Sustainable Use of Natural Resources',
        'not_reported' => 'Not reported'
    ],

    'MarineDesignation' => [
        'No-Entry zone',
        'No-Take zone',
        'Multi-purposes MPA - Buffer zones for traditional use',
        'Multi-purposes MPA - Buffer zones for educational and/or recreational activities',
        'Multi-purposes MPA - Other',
        'Marine reserves',
        'Wildlife refuges',
        'Fish management zone',
        'Other',
    ],

    'EcoType' => [
        'Desert',
        'Savannas',
        'Miombo',
        'Woodlands',
        'Dry Forest',
        'Tropical forest',
        'High mountain',
        'lake / river',
        'Wet area',
        'Mangroves',
        'Coast',
        'Sea/Ocean'
    ],

    'InstitutionType' => [
        'Academic',
        'Confessionnel',
        'Independent',
        'NGO / ASBL',
        'International organisation',
        'Private',
        'Project / Program',
        'Public (state)',
        'Other'
    ],

    'PartnershipsType' => [
        'financial',
        'scientific',
        'research',
        'sponsorship',
        'twinning',
        'expertise',
        'service delivery',
        'concession (eg. tourism)',
        'collaboration',
        'PPP (Public/Private Partnership)'
    ],

    'GovernanceType' => [
        'Community-based conservation (CBC)',
        'CBM (Community-based management (CBM)',
        'CBA (Conservation Based Area)',
        'Locally Managed Marine Areas - LMMA',
        'Indigenous Community Conserved Areas - ICCAs',
        'Protected and Conserved Areas (PCAs)',
        'Other'
    ],

    'TerrestrialOrMarine' => [
        'terrestrial' => 'Terrestrial',
        'marine' => 'Marine',
    ],

    'SpecialDesignation' => [
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

    'SpeciesReliability' => [
        'High', 'Medium', 'Poor'
    ],

    'Habitats' => [
        'artificial'                => 'Artificial - plantations, gardens, pasturelands',
        'desert'                    => 'Desert – hot, cold, temperate',
        'forest_temperate_boreal'   => 'Forest - boreal and temperate',
        'forest_dry'                => 'Forest - subtropical/tropical dry',
        'forest_moist_lowland'      => 'Forest - subtropical/tropical moist lowland',
        'forest_moist_montane'      => 'Forest - subtropical/tropical moist montane',
        'grassland_dry_moist'       => 'Grassland - subtropical/tropical dry or moist',
        'grassland_temperate'       => 'Grassland - temperate',
        'marine_coastal'            => 'Marine - coastal',
        'marine_coral_reefs'        => 'Marine - coral reefs',
        'marine_intertidal'         => 'Marine - intertidal',
        'marine_oceanic'            => 'Marine - oceanic and deep ocean',
        'marine_pelagic'            => 'Marine - pelagic',
        'marine_subtidal'           => 'Marine - subtidal',
        'rocky'                     => 'Rocky areas - mountains, cliffs',
        'savanna_dry'               => 'Savanna - dry',
        'savanna_moist'             => 'Savanna - moist',
        'shrubland_temperate_boreal' => 'Shrubland - boreal and temperate',
        'shrubland_dry_moist'       => 'Shrubland - Subtropical/tropical dry or moist',
        'shrubland_high_altitude'   => 'Shrubland - Subtropical/tropical high altitude',
        'swamp'                     => 'Swamp - subtropical/tropical',
        'wetlands_lakes'            => 'Wetlands (inland) - lake',
        'wetlands_rivers'           => 'Wetlands (inland) - rivers, streams, waterfalls',
        'wetlands_shrub'            => 'Wetlands (inland) - shrub dominated wetlands',
    ],

    'EcosystemServicesImportance' => [
        'null' => null,        // need to force string keys
        '0' => 'Local',
        '1' => 'Larger',
    ]

];

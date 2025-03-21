<?php

return [

    'Objectives' => [
        'title' => 'Estableciendo objetivos',
        'fields' => [
            'Element' =>        'Elemento / indicador',
            'Status' =>         'Linea base',
            'Objective' =>      'Objetivo – Estado óptimo o favorable',
            'Comments' =>       'Comentarios'
        ]
    ],

    'Objectives1' => [
        'module_info' => 'Establecer y describir los objetivos para la gobernanza, las asociaciones y la designación del área protegida.<br /> Los objetivos ingresados a continuación se utilizarán para mejorar la gestión, y más específicamente para la planificación, la movilización de recursos (insumos), las fases del proceso y para el seguimiento de las actividades de gestión del área protegida.'
    ],
    'Objectives2' => [
        'module_info' => 'Establecer y describir los objetivos relacionados con <b>los límites, el índice de configuración, la extensión de las patrullas y la aplicación de la ley y el contexto territorial del área protegida</b><br /> Los objetivos ingresados a continuación se utilizarán para mejorar la gestión, y más específicamente para la planificación, la movilización de recursos (insumos), las fases del proceso y para el seguimiento de las actividades de gestión del área protegida.'
    ],
    'Objectives3' => [
        'module_info' => 'Establecer y describir los objetivos para <b>recursos humanos y financieros/apoyo de las asociaciones en la gestión</b> del área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el seguimiento de las actividades de gestión del área protegida'
    ],
    'Objectives4' => [
        'module_info' => 'Establecer y describir los objetivos de los factores clave: <b> i) especies de animales; ii) especies de plantas; iii) hábitats y; iv) cambio de cobertura de uso del suelo </b> del área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el monitoreo de las actividades de gestión del área protegida'
    ],
    'Objectives5' => [
        'module_info' => 'Establecer y describir los objetivos para <b>amenazas</b> frente al área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión, y más concretamente para la planificación, la movilización de recursos (insumos), las fases del proceso y para el monitoreo de las actividades de gestión del área protegida'
    ],
    'Objectives6' => [
        'module_info' => 'Establecer y describir los objetivos para <b>los efectos del cambio climático</b> frente al área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y la supervisión de las actividades de gestión del área protegida'
    ],
    'Objectives7' => [
        'module_info' => 'Establecer y describir los objetivos para <b> los servicios y funciones ecosistémicas y la dependencia de estos servicios de las comunidades/sociedades</b> en el área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar el manejo, y más específicamente para la planificación, la movilización de recursos (insumos), las fases del proceso y para el monitoreo de las actividades de manejo del área protegida'
    ],

    'GeneralInfo' => [
        'title' => 'Datos básicos',
        'fields' => [
            'CompleteName' => 'Nombre completo del área protegida',
            'CompleteNameWDPA' => 'Nombre con el cual se hace referencia al área protegida',
            'WDPA' => 'WDPA ID (www.protectedplanet.net)',
            'UsedName' => 'Nombre por el que se hace referencia al área protegida',
            'Type' => 'Tipología',
            'NationalCategory' => 'Categoría nacional',
            'IUCNCategory1' => '1a categoría de la UICN',
            'IUCNCategory2' => '2ª categoría de la UICN',
            'IUCNCategory3' => '3ª categoría de la UICN',
            'MarineDesignation' => 'Designación marina',
            'Country' => 'País',
            'CreationYear' => 'Año de creación',
            'Institution' => 'Institución(es) supervisora(s)',
            'Biome' => 'Bioma',
            'Ecoregions' => 'Ecorregión(es) de referencia [Ecorregiones G200, Olson, WWF; Spalding M. et alt. 2007]',
            'Ecotype' => 'Ecotipos (hasta tres elementos predominantes)',
            'ReferenceText' => 'Referencia del texto de designación oficial',
            'ReferenceTextDocument' => '',
            'ReferenceTextValues' => '¿Cuál es la importancia del área protegida y sus principales valores para los que fue designada? (Proporcione una lista y luego una breve descripción.)',
        ],
        'module_info' => '<b>Introducción a la tipología</b>: El IMET identifica tres categorías de áreas protegidas: (1)
            Terrestres (2) Marinas y Costeras (3) área conservada.
            En la sección Gobernanza (CTX 1.2) puede precisar la tipología de gestión y gobernanza de estas tres tipologías
            de áreas protegidas. Si está analizando un Área Protegida y Conservada (ACP), puede especificar el contexto
            territorial en CTX 2.4. Área protegida (definición general): Un área protegida es un espacio geográfico claramente
            definido, reconocido, dedicado y gestionado, a través de medios legales u otros medios efectivos, para lograr
            la conservación a largo plazo de la naturaleza con los servicios ecosistémicos y los valores culturales asociados.
            (Definición de la UICN 2008)',
        'type_info' => [
            'terrestrial' => 'Una zona terrestre protegida (TPA) es una porción de tierra protegida por restricciones y
                leyes especiales para la conservación del entorno natural. Incluyen grandes extensiones de terreno reservadas
                para la protección de la vida silvestre y su hábitat; áreas de gran belleza natural o interés único; áreas que
                contienen formas raras de vida vegetal y animal; áreas que representan una formación geológica inusual; lugares
                de interés histórico y prehistórico; áreas que contienen ecosistemas de especial importancia para la investigación
                y el estudio científico; y áreas que salvaguardan las necesidades de la biosfera. (GEMET- DODERO / WPR) (comprobamos
                si hay una descripción del CDB)',
            'marine_and_coastal' => 'Una zona marina y costera protegida (AMP o AMPC) es "una zona dentro del medio marino
                o adyacente a él, junto con sus aguas suprayacentes y la flora, la fauna y los rasgos históricos y culturales
                asociados, que ha sido reservada por la legislación u otros medios eficaces, incluida la costumbre, con el
                efecto de que su biodiversidad marina y/o costera goce de un nivel de protección mayor que el de su entorno"
                (Convenio sobre la Diversidad Biológica - CDB)',
            'oecm' => 'Un área geográficamente definida
                que no es un Área Protegida, que se gobierna y gestiona de manera que logra resultados positivos y sostenidos
                a largo plazo para la conservación insitu de la biodiversidad, con funciones y servicios ecosistémicos asociados
                y, cuando corresponda, valores culturales, espirituales, socioeconómicos y otros valores relevantes a nivel
                local" (CDB, 2018)',
            'icca' => '(ICCAs Territorios y áreas conservadas por pueblos indígenas y comunidades locales) Un ecosistema
                natural y/o modificado, que contiene valores significativos de biodiversidad, beneficios ecológicos y valores
                culturales, conservado voluntariamente por los pueblos indígenas y las comunidades locales, a través de leyes
                consuetudinarias u otros medios efectivos (CDB -Reconocimiento y apoyo a las ICCAs)'
        ]
    ],

    'Governance' => [
        'title' => 'Gobernanza y asociación',
        'fields' => [
            'Partner' => 'Enumere las asociaciones / socios (si las hay)',
            'InstitutionType' => 'Tipo de institución',
            'PartnershipsType1' => 'La asociación más importante: Primero',
            'PartnershipsType2' => 'Segunda',
            'PartnershipsType3' => 'Tercera',
            'Type' => 'Modelo de gestión',
            'Comments' => 'Información adicional sobre el modelo de gobernanza (si es necesario)',
        ],
        'governance' => 'Gobernanza',
        'partnership' => 'Asociación',
    ],

    'SpecialStatus' => [
        'title' => 'Designaciones especiales (Patrimonio Mundial, MAB, sitio Ramsar, IBAs, SPAMI, LMMA, etc.)',
        'fields' => [
            'Designation' => 'Designación',
            'RegistrationDate' => 'Fecha de inscripción',
            'Code' => 'Código',
            'Area' => 'Área (ha)',
            'DesignationCriteria' => 'Criterio de designación',
            'upload' => 'Subir',
        ],
        'groups' => [
            'conventions'  => 'Designaciones (inclusiones) en la lista de convenciones internacionales (Patrimonio Mundial, RAMSAR, etc.)',
            'networks'     => 'Pertenencia a una red internacional reconocida oficialmente (MAB, RAPAC, Red Parques, Lista Verde, etc.)',
            'conservation' => 'Designación del estado de importancia de la conservación por los organismos internacionales (IBA, AZE, etc.)',
            'marine_pa'    => 'Designación de áreas marinas protegidas',
        ]
    ],

    'Networks' => [
        'title' => 'Pertenencia a redes de gestión local',
        'fields' => [
            'NetworkName' => 'Nombre',
            'ProtectedAreas' => 'Nombres de otras áreas protegidas dentro de la red',
        ],
        'groups' => [
            'group0' => 'Red transfronteriza',
            'group1' => 'Red de paisaje (áreas protegidas terrestres y marinas) - Red (red marina)',
            'group2' => 'Otras redes',
        ]
    ],

    'Missions' => [
        'title' => 'Visión - Misión - Objetivos',
        'fields' => [
            'LocalVision' => 'A nivel local o nacional Visión',
            'LocalMission' => 'Misión',
            'LocalObjective' => 'Objetivos',
            'LocalSource' => 'Fuente',
            'LocalManagementPlan' => 'Archivo (Plan de manejo o gestión)',
            'InternationalVision' => 'A nivel internacional Visión',
            'InternationalMission' => 'Misión',
            'InternationalObjective' => 'Objetivos',
            'InternationalSource' => 'Fuente',
            'InternationalManagementPlan' => 'Archivo (Plan de manejo o gestión)',
            'Observation' => 'Observaciones',
        ]
    ],

    'Contexts' => [
        'title' => 'Referencias del contexto histórico, político, legal, institucional y socioeconómico del área protegida',
        'fields' => [
            'Context' => 'Contexto o elementos específicos',
            'file' => 'Archivo(s)',
            'Summary' => 'Resumen',
            'Source' => 'Recursos',
            'Observations' => 'Notas',
        ],
        'predefined_values' => [
            'Contexto histórico',
            'Contexto socioeconómico',
            'Contexto político (país)',
            'Contexto jurídico',
            'Contexto institucional'
        ],
        'module_info' => 'Datos a nivel nacional con verificación a nivel local'
    ],

    'GeographicalLocation' => [
        'title' => 'Ubicación',
        'fields' => [
            'LimitsExist' => 'Existencia de límites oficiales georreferenciados (sí/no)',
            'Shapefile' => 'Archivo SIG',
            'SourceSHP' => 'Fuente del archivo SIG',
            'Coordinates' => 'Coordenadas geográficas (línea base o punto clave del área protegida)',
            'SourceCoords' => 'Fuente',
            'AdministrativeLocation' => 'Ubicación administrativa del área protegida (provincia, región, etc.)',
        ]
    ],

    'Areas' => [
        'title' => 'Áreas terrestres del área protegida y el contexto de conservación',
        'fields' => [
            'BoundaryLength' => 'Límites',
            'AdministrativeArea' => 'Superficie administrativa',
            'WDPAArea' => 'Superficie según WDPA',
            'GISArea' => 'Superficie real del área (SIG para el área protegida o la autoridad responsable de las áreas protegidas) correspondiente al archivo cargado',
            'TerrestrialArea' => 'Área protegida terrestre',
            'MarineArea' => 'Área protegida marina y costera',
            'PercentageNationalNetwork' => 'Superficie % de la red nacional de áreas protegidas',
            'PercentageEcoregion' => 'Superficie % de la ecorregión',
            'PercentageTransnationalNetwork' => 'Superficie % de la red transfronteriza',
            'PercentageLandscapeNetwork' => 'Superficie % de paisaje/red',
            'Index' => 'Índice de configuración <br />&radic;(3.14)/(6.28)*perímetro/&radic;(área) =<br /> bueno 1 - 1.5; promedio 1.5 - 2; bajo > 2',
            'Observations' => 'Notas',
        ]
    ],

    'Sectors' => [
        'title' => 'Patrullaje y aplicación de la ley: área o sectores terrestres y/o zona o sectores marinos y costeros',
        'fields' => [
            'Name' => 'Sector',
            'TerrestrialOrMarine' => '¿Terrestres o marinos?',
            'UnderControlArea' => 'Km² de área cubierta por patrullaje',
            'UnderControlPatrolKm' => 'Km de patrullajes',
            'UnderControlPatrolManDay' => 'Día de patrullaje',
            'SectorMap' => 'Mapas de zonificación',
            'Source' => 'Fuente',
            'Observations' => 'Notas',
        ],
        'module_info' => 'Patrullaje: Para una gestión eficaz, algunos estudios y directrices de gestión de parques sugieren un promedio de 1 a 4
            días de patrullaje por kilómetro cuadrado por año. Esto significa que por cada kilómetro cuadrado de área protegida,
            lo ideal es que los guardabosques pasen entre 1 y 4 días patrullando cada año.<br />Mayor intensidad en áreas de alto 
            riesgo: En áreas con alta presión de caza furtiva o biodiversidad significativa, la tasa recomendada puede aumentar
            a 5-10 días de patrullaje por kilómetro cuadrado por año o incluso más (Parque Nacional Kruger, Sudáfrica: Debido a 
            las intensas amenazas de caza furtiva de rinocerontes, algunas partes de Kruger experimentan intensidades de patrullaje 
            de 10 días de patrullaje por kilómetro cuadrado por año o más). Menor intensidad en áreas de menor riesgo: En cambio, 
            las regiones con menores riesgos o donde las amenazas a la vida silvestre son mínimas podrían requerir menos patrullajes, 
            posiblemente menos de 1 día de patrullaje por kilómetro cuadrado por año.',
        'area_percentage'               => '% de área',
        'average_time'                  => 'Patrullaje promedio * d * km² del sector',
    ],

    'TerritorialReferenceContext' => [
        'title' => 'Contexto territorial de referencia (Paisaje) del Área Protegida',
        'fields' => [
            'FunctionalHasNoTakeArea' => '¿El área funcional del ecosistema corresponde al área de veda?',
            'FunctionalArea' => 'Estimación del área funcional del ecosistema que es importante para el mantenimiento de la biodiversidad del área protegida: a) en Km² y b) como ancho de la franja exterior.',
            'FunctionalPopulation' => 'Estimación del tamaño de la población local que vive dentro del área funcional del ecosistema',
            'EcologicalAspects' => 'Estimación de la presencia de los factores ambientales, por ejemplo, las áreas de distribución de las especies emblemáticas (en Km2) (Km2)',
            'BenefitArea' => 'Estimación de la superficie habitada alrededor del área protegida que se beneficia de los servicios del ecosistema o funciones ambientales que genera el área protegida: a) en km² y b) como ancho de la franja exterior',
            'BenefitPopulation' => 'Estimación del tamaño de la población local que vive dentro del área de influencia socioeconómica',
            'BenefitSocioEconomicAspects' => 'Liste y describa los factores socioeconómicos y administrativos (por ejemplo, las funciones tradicionales o modernas sobre los recursos naturales establecidas por las autoridades tradicionales y modernas) que influyen en el ordenamiento de las áreas protegidas.',
            'SpillOverArea' => 'Estimar los efectos del DERRAME en el área marina protegida, es decir, el tamaño del área crucial para mantener el aprovisionamiento de servicios del ecosistema (pesca) que proporciona el área protegida: a) en km² y b) como ancho de la franja exterior.',
            'SpillOverEvalPredatory0_500' => '',
            'SpillOverEvalPredatory500_1000' => '',
            'SpillOverEvalPredatory200_3000' => '',
            'SpillOverEvalComposition0_500' => '',
            'SpillOverEvalComposition500_1000' => '',
            'SpillOverEvalComposition200_3000' => '',
            'SpillOverEvalDistance0_500' => '',
            'SpillOverEvalDistance500_1000' => '',
            'SpillOverEvalDistance200_3000' => '',
        ],
        'info' => [
            'spillover_eval' =>
                'El movimiento neto de individuos desde las reservas marinas (también conocidas como áreas marinas protegidas
                sin capturas) hacia los caladeros restantes se conoce como spill-over. El desbordamiento puede contribuir a
                aliviar la pobreza, aunque su efecto está modulado por el número de pescadores y la intensidad de la pesca.
                En general:
                <ul>
                    <li>Fuerte efecto positivo cuando la pesquería está mal gestionada</li>
                    <li>Efecto positivo ligero cuando la pesquería está bien gestionada, pero efecto positivo para las especies con mayor movimiento y crecimiento más lento</li>
                    <li>Evaluar el efecto de desbordamiento de una reserva es capaz de proporcionar un beneficio neto para una pesquería (de Garry Russ & Angel Alcala, Enhanced biodiversity beyond marine reserve boundaries: the cup spill-over):<ul>
                    <li>peces depredadores (los peces grandes y depredadores son más comunes dentro y justo fuera de las reservas que más lejos)</li>
                    <li>composición exterior e interior (la composición de la comunidad fuera de las reservas se asemeja más a la interior con el tiempo)</li>
                    <li>distancia de detección del efecto de desbordamiento (la distancia desde la frontera y el tiempo tras el establecimiento de la reserva son las variables con mayor efecto sobre la abundancia de peces; caché de peces: A) 500 m y más cerca; B) 500 a 1000 m; C) 2000 a 3000 m</li>
                </ul>',
            'spill_over_variation' => 'SPILL-OVER Variación dentro y fuera de la AMP',
            'variation' => 'Variación dentro y fuera de la AMP',
            '0_500' => '0 a 500m',
            '500_1000' => '500 a 1000m',
            '2000_3000' => '2000 a 3000m',
            'predatory' => 'Peces depredadores',
            'composition' => 'Composición de la comunidad de peces',
            'distance' => 'Distancia de efecto indirecto',
        ],
        'ratingLegend' => [
            'SpillOverEvalPredatory0_500' => [
                '-2' => 'Fuerte diferencia negativa',
                '-1' => 'Diferencia negativa mínima',
                '0' => 'No hay diferencia',
            ]
        ],
        'categories' => [
            'FunctionalEcosystemArea' => 'Área funcional del ecosistema',
            'BenefitsOfEcosystemServicesArea' => 'Área que se beneficia de los servicios y/o funciones del ecosistema del área protegida',
            'SpillOverArea' => 'Área de efectos de derrame',
        ],
        'module_info' => '<b>Paisaje</b>: La gobernanza y la gestión vinculadas de un área protegida y sus territorios circundantes
            pueden contribuir a la conservación de la biodiversidad y la resiliencia climática, el mantenimiento de los
            recursos naturales y los servicios ecosistémicos que garantizan el desarrollo sostenible de las comunidades
            locales.<br />
            <b>Áreas Protegidas y Conservadas (APC)</b>: Son una de las herramientas más eficaces para prevenir la pérdida
            de ecosistemas y especies naturales, así como para lograr el desarrollo sostenible a largo plazo, incluidas
            las metas 11 y 12 de Aichi y varios Objetivos de Desarrollo Sostenible (ODS). En algunas regiones, las ACP son
            el centro del desarrollo económico, a través del turismo, el uso sostenible de los recursos y como fuentes de
            agua dulce. Las ACP también contribuyen a la seguridad alimentaria mediante el mantenimiento de los servicios
            ecosistémicos que apoyan la agricultura, protegiendo los recursos esenciales para los programas de cultivo y
            proporcionando espacio para los sistemas agrícolas y de pastoreo tradicionales respetuosos con la biodiversidad.
            Las ACP también desempeñan un papel importante en la resiliencia climática, tanto al almacenar y secuestrar
            carbono como al garantizar que los ecosistemas sigan proporcionando bienes y servicios a las sociedades humanas (WWF).',
    ],

    'ManagementStaff' => [
        'title' => 'Tamaño y composición del personal: Personal del área protegida',
        'fields' => [
            'Function' => 'Funciones',
            'ExpectedPermanent' => 'Personal planificado o adecuado *',
            'ActualPermanent' => 'Personal actual',
            'Observations' => 'Notas',
            'difference' => 'Diferencia',
            'Source' => 'Fuente',
        ],
        'module_info' => 'El sistema estadístico permite sólo catorce (14) líneas para identificar las funciones del personal del área protegida'
    ],

    'ManagementStaffPartners' => [
        'title' => 'Tamaño y composición del personal: Personal de las organizaciones asociadas',
        'fields' => [
            'Partner' => 'Socios',
            'Coordinators' => 'Coordinadores (número)',
            'Technicians' => 'Personal técnico y administrativo (número)',
            'Auxiliaries' => 'Personal de apoyo (número)',
        ]
    ],

    'ManagementStaffCommunities' => [
        'title' => 'Tamaño y composición del personal: Personal de las Comunidades',
        'fields' => [
            'Community' => 'Nombre de la Comunidad',
            'Role1' => 'Rol',
            'StaffNUmberRole1' => 'Número',
            'Role2' => 'Rol',
            'StaffNUmberRole2' => 'Número',
            'Role3' => 'Rol',
            'StaffNUmberRole3' => 'Número',
        ]
    ],

    'FinancialResources' => [
        'title' => 'Recursos financieros: Presupuesto y gastos de gestión',
        'fields' => [
            'Currency' => 'Tipo de moneda',
            'ReferenceYear' => 'Año de referencia',
            'ManagementFinancialPlanCosts' => 'Gastos de funcionamiento estimados en el Plan de gestión/plan financiero ($ o €/año)',
            'OperationalWorkPlanCosts' => 'Gastos de funcionamiento estimados a partir del plan operativo / plan de trabajo (presupuestados anualmente)',
            'TotalBudget' => 'Presupuesto anual total disponible',
        ],
        'amount'                        => 'Total',
        'functioning_costs'             => 'Costos de operación ($ o euros/km2/año)',
        'estimation_financial_plan'     => 'Porcentaje de recursos requeridos por el plan financiero/plan de trabajo (presupuestado anualmente)',
        'estimation_operational_plan'   => 'Porcentaje de los recursos requeridos por el plan de trabajo (presupuestado anualmente)',
        'module_info' => 'Costos totales estimados sobre la base del Plan de gestión/plan financiero'
    ],

    'FinancialAvailableResources' => [
        'title' => 'Recursos financieros: Presupuesto disponible',
        'fields' => [
            'BudgetType' => '',
            'NationalBudget' => 'Presupuesto nacional',
            'OwnRevenues' => 'Ingresos de las operaciones del área protegida',
            'Disputes' => 'Ingresos por litigios (tesoro nacional)',
            'Partners' => 'Contribuciones de los socios',
            'total' => 'Total',
            'percentage' => '% del presupuesto previsto',
        ],
        "predefined_values" => [
            "% anual total disponible",
            "% anual total disponible para el funcionamiento",
            "% anual total disponible para inversiones"
        ],
        'module_info' => 'Las cantidades en la misma moneda especificadas en <b>CTX 3.2.1</b>',
        'sum_error' => 'El total debe corresponder al presupuesto total declarado en el módulo <b>CTX 3.2.1</b>'
    ],

    'FinancialResourcesBudgetLines' => [
        'title' => 'Recursos financieros: Partidas presupuestarias del plan operativo/plan de trabajo (presupuestadas anualmente)',
        'fields' => [
            'Line' => 'Partidas del presupuesto',
            'Amount' => 'Cantidad ($ o euros/año)',
            'BudgetSource' => 'Fuente del financiamiento',
            'function_costs' => 'Costos de operación ($ o EUR/Km²/año)',
            'percentage' => '% del presupuesto disponible',
        ],
        'module_info' => 'Las cantidades en la misma moneda especificadas en <b>CTX 3.2.1</b>',
        'sum_error' => 'El total debe corresponder al presupuesto total declarado en el módulo <b>CTX 3.2.1</b>'
    ],

    'FinancialResourcesPartners' => [
        'title' => 'Rol de los socios en el apoyo al área protegida',
        'fields' => [
            'Partner' => 'Socios',
            'Funding' => 'Apoyos (financiación/proyecto/actividades)',
            'Contribution' => 'Monto ($ o euros/año)',
            'StartDate' => 'Proyectos por comenzar',
            'EndDate' => 'Fin esperado',
            'Observations' => 'Notas',
            'Currency' => 'Tipo de moneda',
        ],
        'module_info' => 'Las cantidades en la misma moneda especificadas en <b>CTX 3.2.1</b>'
    ],

    'Equipments' => [
        'title' => 'Disponibilidad de infraestructura, equipo e instalaciones',
        'fields' => [
            'Resource' => 'Categoría',
            'AdequacyLevel' => 'Adecuación',
            'Comments' => 'Fuente/Nota'
        ],
        'groups' => [
            'group0' => 'Infraestructura y bienes administrativos',
            'group1' => 'Alojamiento',
            'group2' => 'Instalaciones turísticas',
            'group3' => 'Medios de transporte',
            'group4' => 'Equipo contra la caza furtiva y/o control y vigilancia',
            'group5' => 'Medios de comunicación',
            'group6' => 'Tecnología de Información',
            'group7' => 'Equipo de generación de agua/energía para servicios',
            'group8' => 'Equipo de mantenimiento para (ver categorías)',
            'group9' => 'Caminos y pistas',
            'group10' => 'Hidrovías',
            'group11' => 'Pistas de aterrizaje',
            'group12' => 'Enlaces y conexiones de la zona protegida con el mundo exterior'
        ],
        'predefined_values' => [
            'group0' =>  ['Oficinas','Puestos de control o campamentos de guardaparques','Puntos de barrera o casetas de control','Infraestructura científicas','Garaje y taller de mantenimiento','Espacio para las botellas y otros equipos de buceo', 'Cobertizos para barcos', 'Aparcamiento de coches-barcos','Miscelánea (revista, radio, etc.)','Centro de atención médica'],
            'group1' =>  ['Para oficiales y suboficiales', 'Para el personal de los guardaparques', 'Para el personal de apoyo', 'Para el personal científico'],
            'group2' =>  ['Hoteles (capacidad de hospedaje)', 'Eco-albergues (capacidad de hospedaje)', 'Campamentos (capacidad de hospedaje)', 'Instalaciones de recepción para los turistas', 'Punto observación de fauna y paisaje', 'Rutas turísticas disponibles (km)'],
            'group3' =>  ['Vehículos/autos y caminonetas', 'Motos/cuadratracks', 'Bicicletas', 'Barcos y/o lanchas', 'Motores fuera de borda', 'Piragua y/o bote a remo', 'Avión, ultraligero', 'Transporte pesado'],
            'group4' =>  ['Radares de control', 'Armas', 'Cartuchos', 'Uniformes', 'Raciones (viáticos)', 'GPS, brújulas', 'Equipo de campamento y de monte'],
            'group5' =>  ['Radios VHF/HF', 'V-SAT', 'Teléfonos fijos', 'Teléfonos celular (GSM)', 'Teléfonos satelitales', 'Conexión a Internet'],
            'group6' =>  ['Computadoras de escritorio', 'Impresoras', 'Fotocopiadoras', 'Computadoras portátiles', 'Inversor'],
            'group7' =>  ['Generadores de energía', 'Instalación eléctrica solar', 'Instalación hidroeléctrica', 'Instalación eléctrica eólica', 'Suministro de agua'],
            'group8' =>  ['Vehículos/barcos', 'Radios', 'Edificios', 'Red eléctrica', 'Red hidráulica', 'Transporte pesado'],
            'group9' =>  ['Caminos/senderos dentro del área protegida', 'Los caminos dentro del área protegida', 'El camino a lo largo del límite del área protegida'],
            'group10' => ['Las vías fluviales dentro del área protegida'],
            'group11' => ['Pistas de aterrizaje dentro y/o fuera del área protegida'],
            'group12' => ['Principales rutas de comunicación terrestre', 'Vías navegables interiores y marítimas', 'Conexiones aéreas nacionales e internacionales']
        ],
        'ratingLegend' => [
            'AdequacyLevel' => [
                '0' => 'Totalmente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Totalmente adecuado (91-100% de las necesidades)',
            ]
        ]
    ],

    'AnimalSpecies' => [
        'title' => 'Especies animales (emblemáticas, en peligro, endémicas, explotadas, invasoras, etc.) utilizadas como indicadores del estado de conservación del área protegida y que requieren ser monitoreadas a lo largo del tiempo',
        'fields' => [
            'SpeciesID' => 'Especies',
            'FlagshipSpecies' => 'BAN',
            'EndangeredSpecies' => 'EN',
            'EndemicSpecies' => 'EDM',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'EBNC',
            'PopulationEstimation' => 'Estado actual estimado',
            'DesiredPopulation' => 'Estado de conservación favorable',
            'TrendRating' => 'Tendencia',
            'Reliability' => 'Fiabilidad',
            'Comments' => 'Fuente/Nota',
        ],
        'module_info' => 'Estado de conservación favorable: Según Natura 2000, el estado de conservación de las especies se considerará "favorable" cuando:<ul>los datos sobre la dinámica de la población de la especie en cuestión indican que se mantiene a largo plazo como un componente viable de sus hábitats naturales, y</li><li>el área de distribución natural de la especie no se está reduciendo ni es probable que se reduzca en un futuro previsible, y existe, y probablemente seguirá existiendo, un hábitat suficientemente grande para mantener sus poblaciones a largo plazo</li></ul>Clasificación: Evaluar a partir de la lista de especies que se supone que existen (véanse las listas de la UICN de A - mamíferos, B - aves y C - anfibios), un número limitado de especies clave de la zona protegida.<br /> <b>Indicadores de especies</b> <ul> <li><b>BAN</b>: Especies emblemáticas o bandera</li> <li><b>EN</b>: Especies en peligro (amenazadas)</li> <li><b>EDM</b>: Especies endémicas</li> <li><b>EXP</b>: Especies explotadas</li> <li><b>INV</b>: Especies invasoras</li> <li><b>EBNC</b>: Especie con bajo nivel de conocimiento</li> </ul> <b>Población estimada:</b> Programa de monitoreo y vigilancia ecológica y generación de un gráfico de tendencias multianual.',
        'validation_min3' => 'Por favor, codifique al menos 3 especies clave',
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'VegetalSpecies' => [
        'title' => 'Especies vegetales (emblemáticas, en peligro, endémicas, explotadas, invasoras, etc.) utilizadas como indicadores del estado del área protegida y que requieren vigilancia a lo largo del tiempo.',
        'fields' => [
            'Species' => 'Especies',
            'FlagshipSpecies' => 'BAN',
            'EndangeredSpecies' => 'EN',
            'EndemicSpecies' => 'EDM',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'EBNC',
            'PopulationEstimation' => 'Estado actual estimado',
            'DesiredPopulation' => 'Estado de conservación favorable',
            'TrendRating' => 'Tendencia',
            'Reliability' => 'Fiabilidad',
            'Comments' => 'Fuente/Nota',
        ],
        'module_info' => 'Estado de conservación favorable:<br />Según Natura 2000, el estado de conservación de las especies se considerará "favorable" cuando:<ul><li>los datos sobre la dinámica de la población de la especie en cuestión, indican que se mantiene a largo plazo como un componente viable de sus hábitats naturales, y</li><li>el área de distribución natural de la especie no se está reduciendo ni es probable que se reduzca en un futuro previsible, y existe, y probablemente seguirá existiendo, un hábitat suficientemente grande para mantener sus poblaciones a largo plazo</li></ul>Clasificación: Evaluar a partir de la lista de plantas que se supone que existen (ver las listas disponibles y la información del parque), un número limitado de plantas clave del área protegida<br /> <b>Indicadores de especies</b> <ul> <li><b>BAN</b>: Especies emblemáticas o bandera</li> <li><b>EN</b>: Especies en peligro de extinción (amenazadas)</li> <li><b>EDM</b>: Especies endémicas</li> <li><b>EXP</b>: Especies explotadas</li> <li><b>INV</b>: Especies invasoras</li> <li><b>EBNC</b>: Especies con bajo nivel de conocimiento</li> </ul> <b>Población estimada:</b> Programa de monitoreo y vigilancia ecológica y generación de un gráfico de tendencias multianual.<br /> <b>Fiabilidad de la información</b> <ul> <li>1: Bajo<li>2: Medio<li>3: Alto</li> </ul>',
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'Habitats' => [
        'title' => 'Hábitats seleccionados como indicadores del área protegida y que deberán ser monitoreados a lo largo del tiempo.',
        'fields' => [
            'EcosystemType' => 'Tipo de hábitat',
            'Value' => 'Descripción del estado o valor',
            'Area' => 'Superficie (ha)',
            'DesiredConservationStatus' => 'Estado de conservación favorable',
            'Trend' => 'Tendencia',
            'Reliability' => 'Fiabilidad de la información',
            'Sectors' => 'Sectores',
            'Comments' => 'Comentarios/Fuente'
        ],
        'module_info' => 'Nota: Estado de conservación favorable:<br /> Según Natura 2000, el estado de conservación de un hábitat natural se considerará "favorable" cuando:<ul><li><li>su rango natural y las áreas que cubre dentro de ese rango son estables o están en aumento, y</li><li>la estructura y las funciones específicas necesarias para su mantenimiento a largo plazo existen y es probable que sigan existiendo en el futuro previsible</li></ul>Clasificación: Seleccionar y evaluar los parámetros más importantes relacionados con el ecosistema y el hábitat de los ecosistemas y hábitats terrestres y marinos del área protegida.<br /> <b>Nota</b>: La evaluación de hábitats sigue emergiendo como una disciplina, ya que es altamente compleja. La clasificación prevé la siguiente división del territorio: Bioma, Ecorregión, Ecosistema, Hábitat. Las características/valores de los hábitats pueden evaluarse como: <ul> <li>i) bajo amenaza de extinción (dentro de su área de distribución natural),</li> <li>ii) tener un alcance natural reducido,</li> <li>iii) en declive,</li> <li>iv) un ejemplo destacado de características específicas, etc.</li> </ul> La evaluación de los hábitats también puede realizarse desde la perspectiva de: <ul> <li>i) reproducción,</li> <li>ii) nutrición,</li> <li>iii) protección de las especies, etc.</li> </ul> <br /> <b>Fiabilidad de la información</b> <ul> <li>1: Bajo<li>2: Medio<li>3: Alto</li> </ul>',
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'MenacesPressions' => [
        'title' => 'Presiones y amenazas',
        'fields' => [
            'Value' => 'Valores',
            'Impact' => 'Impacto/Severidad',
            'Extension' => 'Escala/Extensión',
            'Duration' => 'Cuánto tiempo/Irreversibilidad',
            'Trend' => 'Tendencia',
            'Probability' => 'Probabilidad de una amenaza en el futuro',
        ],
        'groups' => [
            'group0' => 'Comercial y residencial',
            'group1' => 'Cultivos anuales o multianuales (no leñosos)',
            'group2' => 'Plantaciones de madera y de pasta de papel',
            'group3' => 'Ganadería de pequeña y gran escala',
            'group4' => 'Acuicultura marina y de agua dulce',
            'group5' => 'Otra tipología de producción',
            'group6' => 'Energía y minería',
            'group7' => 'Transporte e infraestructura',
            'group8' => 'Caza y recolección de animales terrestres',
            'group9' => 'Recolección y cosecha de plantas terrestres',
            'group10' => 'La silvicultura y la explotación de la madera',
            'group11' => 'La pesca y la recolección de recursos acuáticos',
            'group12' => 'Perturbación/intrusión humana',
            'group13' => 'Quemas/incendios',
            'group14' => 'Represas y gestión o uso del agua',
            'group15' => 'Otros cambios en el ecosistema',
            'group16' => 'Especies invasoras/problemáticas',
            'group17' => 'Aguas residuales domésticas y urbanas',
            'group18' => 'Efluentes industriales y militares',
            'group19' => 'Efluentes agrícolas y forestales',
            'group20' => 'Basura y residuos sólidos',
            'group21' => 'Contaminación atmosférica',
            'group22' => 'Uso excesivo de energía',
            'group23' => 'Fenómenos geológicos',
            'group24' => 'El cambio climático y los fenómenos',
            'group25' => 'Otras presiones y amenazas'
        ],
        'predefined_values' => [
            'group0' => [
                'Zonas urbanas y residenciales',
                'Zonas comerciales',
                'Áreas turísticas y recreativas',
                'Áreas de enclave',
                'Vías marítimas, puertos, construcciones marítimas',
                'Actividades interiores'
            ],
            'group1' => [
                'Cultivo itinerante',
                'La agricultura en pequeña escala',
                'Grandes empresas agroindustriales',
                'Producción de frutas/huerto vegetal'
            ],
            'group2' => [
                'Pequeñas plantaciones',
                'Plantaciones agroindustriales'
            ],
            'group3' => [
                'El pastoreo nómada',
                'La ganadería y el pastoreo en pequeñas granjas',
                'La ganadería y el pastoreo agroindustrial'
            ],
            'group4' => [
                'Acuicultura de subsistencia o artesanal',
                'Sobre nutriente',
                'Acuicultura industrial'
            ],
            'group6' => [
                'Perforación (gas y petróleo)',
                'Operaciones de minería o canteras',
                'Energías renovables'
            ],
            'group7' => [
                'Carreteras',
                'Redes y líneas de servicios públicos y de comunicación (electricidad, teléfono, acueducto, etc.)',
                'Vías navegables y rutas marítimas',
                'Navegación comercial',
                'Navegación privada',
                'Corredores aéreos',
                'Ferrocarriles'
            ],
            'group8' => [
                'Caza de animales terrestres',
                'Recolección de animales vivos'
            ],
            'group9' => [
                'Recolección de plantas',
                'Cosecha de plantas'
            ],
            'group10' => [
                'Operaciones madereras en pequeña escala',
                'Operaciones de leña a gran escala',
                'Operaciones de leña en pequeña escala',
                'Operaciones madereras a gran escala',
                'Estacas/postes para la construcción'
            ],
            'group11' => [
                'Pesca de subsistencia o en pequeña escala',
                'La pesca a gran escala',
                'La recolección de recursos acuáticos de subsistencia o en pequeña escala',
                'Recolección en gran escala de recursos acuáticos',
                'La recolección de mariscos',
                'Captura/extracción ilegal de fauna marina',
                'Sobrepesca y pesca destructiva',
                'Explotación de especies en peligro',
                'Arrastreros/marinos',
            ],
            'group12' => [
                'Actividades recreativas',
                'Obras y otras actividades',
                'Ruido y otras formas de contaminaciónn',
                'Deportes al aire libre, actividades de ocio y recreativas',
                'Múltiples intrusiones y perturbaciones humanas',
                'Pesca recreativa con anzuelo y sedal',
                'Pesca recreativa con arpón',
                'Baño y pisoteo',
                'Buceo',
                'Guerras, disturbios civiles y ejercicios militares'
            ],
            'group13' => [
                'Frecuencia e intensidad de los incendios',
                'Cambios inducidos por el hombre en las condiciones hidráulicas',
                'Cambios en las condiciones abióticas',
                'Cambios en las condiciones bióticas'
            ],
            'group14' => [
                'Extracción de aguas superficiales (uso doméstico)',
                'Extracción de aguas superficiales (uso comercial)',
                'Extracción de aguas superficiales (uso agrícola)',
                'Extracción de aguas superficiales (uso desconocido)',
                'Extracción de agua subterránea (uso doméstico)',
                'Extracción de agua subterránea (uso comercial)',
                'Extracción de agua subterránea (uso agrícola)',
                'Extracción de agua subterránea (uso desconocido)',
                'Pequeñas presas',
                'Grandes presas',
                'Presas (tamaño desconocido)'
            ],
            'group16' => [
                'Especies o enfermedades introducidas invasivas',
                'Especies o enfermedades endémicas problemáticas',
                'Especies problemáticas o enfermedades de origen desconocido',
                'El material genético introducido',
                'Enfermedades virales o priónicas',
                'Enfermedad de causa desconocida',
                'Evolución bioceánica',
                'Relaciones faunísticas interespecíficas',
                'Modificaciones múltiples del ecosistema'
            ],
            'group17' => [
                'Aguas residuales y alcantarillas',
                'Fugas de líquido y gas',
                'Plásticos'
            ],
            'group18' => [
                'La marea negra',
                'Descargas de buques',
                'Fuga de la minería'
            ],
            'group19' => [
                'Carga de nutrientes',
                'Erosión del suelo y sedimentación',
                'Herbicidas y pesticidas',
                'Contaminación de las cuencas hidrográficas'
            ],
            'group20' => [
                'Desechos municipales',
                'Chatarra/desechos flotantes de barcos de recreo',
                'Los escombros de la construcción',
                'Los residuos que enredan la vida silvestre'
            ],
            'group21' => [
                'Lluvia ácida',
                'Nube de contaminación',
                'Ozono'
            ],
            'group22' => [
                'Contaminación lumínica',
                'Contaminación por calor',
                'Contaminación acústica'
            ],
            'group23' => [
                'Volcanes',
                'Terremotos y tsunamis',
                'Avalanchas y deslizamientos de tierra',
                'Procesos naturales abióticos'
            ],
            'group24' => [
                'Daños y cambios en el hábitat',
                'Sequías',
                'Las temperaturas extremas',
                'Tormentas e inundaciones',
                'Aumento de las precipitaciones y cambios estacionales',
                'Calentamiento, acidificación, blanqueo, desoxigenación'
            ],
            'group25' => [
                'Conflicto entre los seres humanos y la fauna y flora silvestres'
            ]
        ],
        'categories' => [
            'title1' => 'Comercial y residencial',
            'title2' => 'Agricultura y acuicultura',
            'title3' => 'Energía y minería',
            'title4' => 'Transporte e infraestructura',
            'title5' => 'Utilización de los recursos biológicos',
            'title6' => 'Intrusiones/perturbaciones humanas',
            'title7' => 'Cambios en el sistema natural',
            'title8' => 'Especies invasoras/problemáticas',
            'title9' => 'Contaminación',
            'title10' =>'Fenómenos geológicos',
            'title11' =>'Cambio climático y fenómenos',
            'title12' =>'Otras presiones y amenazas'
        ],
        'ratingLegend' => [
            'Impacto' => [
                '0' => 'Suave',
                '1' => 'Moderado',
                '2' => 'Alto',
                '3' => 'Severo',
            ],
            'Extensión' => [
                '0' => 'Localizado <5%',
                '1' => 'Escaso 5-15%',
                '2' => 'Ampliamente disperso 15-50%',
                '3' => 'En todas partes>50%',
            ],
            'Duración' => [
                '0' => 'A corto plazo <5 años',
                '1' => 'Medio plazo 5-20 años',
                '2' => 'Muy largo plazo 20-100 años',
                '3' => 'Permanente>100 años',
            ],
            'Tendencia' => [
                '-2' => 'Disminuye',
                '-1' => 'Ligeramente decreciente',
                '0' => 'No hay cambios',
                '1' => 'Ligeramente creciente',
                '2' => 'Incrementa',
            ],
            'Probabilidad de la amenaza en el futuro' => [
                '0' => 'Muy bajo',
                '1' => 'Bajo',
                '2' => 'Medio',
                '3' => 'Alto',
            ],
        ],
        'module_info' => 'La calculadora de amenazas sirve para calcular el impacto de las puntuaciones de las amenazas en un área protegida específica. Usando su mejor juicio profesional, evalúe el impacto de la amenaza explotando cinco categorías de puntuación: (1) Impacto/Severidad; (2) Escala/Extensión; (3) Duración/Irreversibilidad; (4) Tendencia; (5) Probabilidad de la amenaza en el futuro',
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ClimateChange' => [
        'title' => 'Cambio climático y conservación/ Elementos clave afectados por el cambio climático',
        'fields' => [
            'Value' => 'Elemento clave',
            'Description' => 'Descripción de los efectos del cambio climático',
            'Trend' => 'Efectos del cambio climático',
            'Notes' => 'Notas',
        ],
        'groups' => [
            'group0' => 'Especies animales afectadas por el cambio climático',
            'group1' => 'Especies vegetales afectadas por el cambio climático',
            'group2' => 'Hábitats afectados por el cambio climático',
            'group3' => 'Servicios/funciones de los ecosistemas afectados por el cambio climático',
            'group4' => 'Valores e importancia afectados por el cambio climático',
            'group5' => 'Otros',
        ],
        'module_info' => 'Los productos de la siguiente sección apoyarán las decisiones de gestión para asegurar que el área protegida adopte medidas para minimizar los efectos del cambio climático. El análisis asegurará la incorporación de los valores pertinentes en el sistema de gestión del área protegida',
        'ratingLegend' => [
            'Trend' => [
              '0' => 'Muy afectado por el cambio climático',
              '1' => 'Moderadamente afectado por el cambio climático',
              '2' => 'Poco afectado por el cambio climático',
              '3' => 'No afectado por el cambio climático',
            ]
        ],
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.4</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'EcosystemServices' => [
        'title' => 'Servicios/funciones Ecosistémicas - importancia, dependencia de las comunidades y tendencia de los servicios/funciones del ecosistema que proporciona el área protegida',
        'fields' => [
            'Element' => 'Servicios/funciones Ecosistémicas',
            'Importance' => 'Importancia',
            'ImportanceRegional' => 'Dependencia de los servicios/funciones ecosistémicas',
            'ImportanceGlobal' => 'Tendencia',
            'Observations' => 'Descripción / Condición',
        ],
        'groups' => [
            'group0' => 'Nutrición',
            'group1' => 'Materiales',
            'group2' => 'Energía',
            'group3' => 'Remediación de materiales de desecho, sustancias tóxicas y otra contaminación',
            'group4' => 'Remediación de los flujos',
            'group5' => 'Interacciones físicas y experiencia',
            'group6' => 'Interacciones y actuaciones intelectuales',
            'group7' => 'Espiritual y/o emblemático',
            'group8' => 'Otros servicios/funciones ecosistémicas cultural',
            'group9' => 'Servicios de apoyo',
        ],
        'predefined_values' => [
            'group0' => ['Suministro de agua - ilegal', 'Suministro de agua - legal', 'Alimentación humana (tubérculos, frutas, miel, setas, algas, etc.) - ilegal', 'Alimentación humana (tubérculos, frutas, miel, setas, algas, etc.) - legal', 'Alimentación humana  - animal (carne silvestre/de granja, insectos) - ilegal', 'Alimentación humana  - animal (carne silvestre/de granja, insectos) - legal', 'Medicamentos y biotecnología azul (aceite de pescado) - ilegal', 'Medicamentos y biotecnología azul (aceite de pescado) - legal', 'Alimentación con peces y ganado (silvestre, de granja, cebo) - ilegal', 'Alimentación con peces y ganado (silvestre, de granja, cebo) - legal'],
            'group1' => ['Madera de alto valor - ilegal', 'Madera de alto valor - legal', 'Madera para la construcción local - ilegal', 'Madera para la construcción local - legal','Fibras del tallo (palmas, tasta, chillca, wamanpito, etc.) - ilegal', 'Fibras del tallo (palmas, tasta, chillca, wamanpito, etc.) - legal', 'Otras fibras (hojas, kapok, coco, etc.) - ilegal', 'Otras fibras (hojas, kapok, coco, etc.) - legal', 'Recursos ornamentales y de acuario (colección de semillas, conchas y peces) - ilegal', 'Recursos ornamentales y de acuario (colección de semillas, conchas y peces) - legal', 'Arena (para la construcción) - ilegal', 'Arena (para la construcción) - legal', 'Algas/conchas - ilegal', 'Algas/conchas - legal', 'Tierras de cultivo (agricultura, ganadería, bosques) - ilegal', 'Tierras de cultivo (agricultura, ganadería, bosques) - legal'],
            'group2' => ['Leña y biocombustibles - ilegal', 'Leña y biocombustibles - legal', 'Generación de energía con agua - ilegal', 'Generación de energía con agua - legal', 'Fertilizante - ilegal', 'Fertilizante - legal'],
            'group3' => ['Regulación de gases (secuestro C)', 'Disposición /Enterramiento/eliminación/neutralización de residuos', 'Regulación de los desechos (absorción de nutrientes)', 'Prevención de la erosión costera'],
            'group4' => ['Control de inundaciones', 'Control de sequías', 'Protección contra tormentas', 'Control de la erosión hídrica', 'Control de la erosión eólica', 'Prevención de la erosión costera'],
            'group5' => ['Beneficios estéticos y paisajíticos (integridad del ecosistema)', 'Ecoturismo y observación de la naturaleza', 'Caminatas, excursiones y recreación en general', 'Navegación, natación y buceo', 'Snorkel, navegación y buceo', 'Caza o pesca si está permitido', 'Pesca tradicional especificada'],
            'group6' => ['Investigación y ciencia', 'Educacional', 'La herencia cultural'],
            'group7' => ['Simbólico o histórico', 'Sagrado y/o religioso'],
            'group8' => ['Conservación ex situ'],
            'group9' => ['Producción primaria neta (vegetación)', 'Ciclo de nutrientes (descomposición y mineralización de la basura)', 'Hábitats importantes (hábitats de anidación de aves - playas de desove - guardería)', 'Formación del paisaje marino', 'Especies formadoras de hábitat (por ejemplo, corales)', 'Polinización (plantas)', 'Ciclo del agua', 'Paisaje marino: heterogeneidad/complejidad del hábitat (apoyando la diversidad)'],
        ],
        'categories' => [
            'title1' => 'Provisión',
            'title2' => 'Regulación',
            'title3' => 'Cultural',
            'title4' => 'Apoyo',
        ],
        'module_info' => '<b>Servicios/funciones ecosistémicas - importancia, dependencia de las comunidades/sociedades y tendencia de los servicios/funciones ecosistémicas proporcionados por el área protegida</b> <ul> <li>Los productos de la siguiente sección apoyarán las decisiones de gestión para asegurar que se preserven los servicios/funciones  ecosistémicas prestados por el área protegida para el bienestar humano. El análisis asegurará la incorporación de los valores pertinentes en el sistema de gestión del área protegida</li> <li>Clasificación: Evaluación sobre la base de: A) la importancia de determinados servicios/funciones ecosistémicas, B) la dependencia de la población local del servicio/funciones ecosistémicas y C) la tendencia de la cantidad o calidad de los servicios/funciones ecosistémicas prestados por el área protegida, utilizando las escalas siguientes</li> <li>•	No se necesita una medición precisa del valor para asignar una calificación.</li> <li>La especificación de la naturaleza del aprovisionamiento como legal o ilegal depende de la designación del área protegida y de las costumbres legales existentes para la zona evaluada.</li> </ul>',
        'ratingLegend' => [
            'Importance' => [
                'Local' => 'Importancia limitada a las comunidades locales o regionales (por ejemplo, tubérculos, frutas, leña, etc.)',
                'Larger' => 'La importancia se extiende a las sociedades nacionales y globales (cuenca, turismo, etc.)'
            ],
            'ImportanceRegional' => [
                '0' => 'muy bajo',
                '1' => 'bajo',
                '2' => 'medio',
                '3' => 'alto',
            ],
            'ImportanceGlobal' => [
                '-2' => 'Disminuye',
                '-1' => 'Ligeramente decreciente',
                '0' => 'Sin cambios',
                '1' => 'Ligeramente creciente',
                '2' => 'Incrementa'
            ]
        ],
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.5</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

];

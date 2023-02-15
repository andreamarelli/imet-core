<?php
return [

    '_Objectives' => [
        'title' => 'Setting objectives',
        'fields' => [
            'Element' => 'Element/Indicator',
            'Status' => 'Baseline',
            'Objective' => 'Optimal or favourable status',
            'comments' => 'Comments'
        ],
    ],

    'Designation' => [
        'title' => 'Designations',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Integration',
            'SignificativeClassification' => 'Highly significant international designation',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no integration',
                '1' => 'low integration',
                '2' => 'moderate integration',
                '3' => 'high integration',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Designations',
        'module_info_EvaluationQuestion' => [
            'Evaluate the integration of values and importance of designations (national designation and international designations, e.g., World Heritage site or Ramsar site) for the management of the OECM'
        ]
    ],

    'ObjectivesKeyElements' => [
        'module_info' => 'Establish and describe conservation objectives for the designation and the key elements of the OECM. The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'ObjectivesSupportsAndConstraints' => [
        'module_info' => 'Establish and describe conservation objectives for mitigation constraints/conflicts or enhancing supporting/complying factors for the OECM. The objectives entered below will be used for improving management, and more specifically for planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM.'
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adequacy of legal and regulatory provisions',
        'fields' => [
            'Regulation' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Gazetting and designation (e.g., conserved area, community forest)',
            'Clarity of legal demarcation of the OECM (e.g. natural boundaries such as rivers, non-',
            'natural boundaries, customary rights, enclaves).',
            'Internal rules for the management of the OECM',
            'Ratification and application of international conventions (CITES, CBD, Nagoya, CMS,',
            'World Heritage, RAMSAR, etc.)',
            'Locally established laws on OECM and conservation (spatial and temporal harvesting,',
            'hunting, fishing closures; quotas limits on control on the number and size of vessels;',
            'bans on harvesting-hunting-fishing methods or gear, etc.)',
            'National environmental laws (natural resources management, conservation, OECM)',
            'Other national laws (land and property rights, taxes, business laws, etc.)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate',
                '1' => 'Somewhat inadequate',
                '2' => 'Adequate',
                '3' => 'Fully adequate',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the current legal and regulatory provisions adequate for conservation and natural resources management activities in the OECM?',
            '<i>Adequate legislation and regulatory provisions are the basis for an effective and robust governance and management framework for the OECM and, more importantly, for ensuring its long-term sustainability for current and future generations</i>'
        ],
        'module_info_Rating' => [
            'Identify and evaluate the adequacy of current legal and regulatory provisions for conservation and natural resources management in the OECM'
        ]
    ],

    'DesignAdequacy' => [
        'title' => 'Design and layout of the OECM',
        'fields' => [
            'Values' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Size (surface area)',
            'Configuration or shape of the OECM',
            'Border zone integration (outside of the OECM that have special rules on resources use for the integrity of water catchment, corridors for wildlife, harvesting-hunting-fishing activities, etc.)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate',
                '1' => 'Somewhat inadequate',
                '2' => 'Adequate',
                '3' => 'Fully adequate',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the design and layout of the OECM adequate for the sustainable management and governance of its key elements?',
            'The analysis should show whether the design and layout are adequate to the sustainable management and governance of the key elements, or whether an improved layout should be proposed, if feasible.'
        ],
        'module_info_Rating' => [
            'Evaluate if the design and layout of the OECM (based on analysis of the Context of intervention point CTX2) is adequate for ensuring that its key elements can be well managed.'
        ]
    ],

    'BoundaryLevel' => [
        'title' => 'Demarcation of the OECM',
        'fields' => [
            'Boundaries' => 'Degree of marked boundaries',
            'BoundariesComments' => 'Comments/Explanation',
            'Adequacy' => 'Adequacy of the boundaries',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Correspondence of the marked boundaries with respect to the legal standing',
            'Adequacy of marked boundaries',
            'Boundaries marked by natural elements (e.g. rivers)',
            'Clearly demarcated, unambiguous and therefore easily interpreted boundaries (e.g., signs, posts, markers, fences, buoys, etc.)',
            'Recognition of boundaries by the authorities',
            'Recognition of boundaries by communities/users',
            'Collaboration approach including national agencies and relevant stakeholders in the demarcation of boundaries',
            'Publication of information of the boundaries demarcation',
            'Demarcation and development of legal boundaries consistent with legal statutes and international laws if necessary',
            'Demarcation using the official source of reference data',
            'Boundaries recorded with geographic coordinates (degree, min, sec)',
            'Demarcation of PA use zones (zoning)',
            'Demarcation of boundaries, or part of them, that are ambulatory [e.g. banks, rivers, etc.] and may need to be revised',
            'Demarcation by natural elements using a clear statement (e.g. tidal or river flooding data – average low water, average high water, etc.)'
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
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (Lack of correspondence with legal standing / randomly demarcated, 0-30% of the needs)',
                '1' => 'Somewhat inadequate (Inadequate correspondence to the legal standing / ambiguous demarcated 31-60% of the needs)',
                '2' => 'Adequate (Quite adequate correspondence to the legal standing / not clearly demarcated,61-90% of the needs)',
                '3' => 'Fully adequate (full Correspondence to the legal standing / clearly demarcated, 91-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the boundary of the OECM marked and adequate?',
            'Demarcation of OECMs is useful from legal perspective, since it allows defining exactly where the controls specific for the OECM can be enforced (e.g., monitoring and sanctions can be applied in not sustainable use of the key elements).'
        ],
        'module_info_Rating' => [
            'Evaluate  <ol type="A"><li>the degree to which the boundaries of OECM area marked</li><li>the adequacy of the borders demarcation for the management of the OECM</li></ol>'
        ]
    ],

    'ManagementPlan' => [
        'title' => 'Management plan',
        'fields' => [
            'PlanExistence' => 'A) Is there a management plan?',
            'PlanUptoDate' => 'Is the management plan up to date?',
            'PlanApproved' => 'Has the management plan been approved?',
            'PlanImplemented' => 'Is the management plan been implemented?',
            'PlanAdequacyScore' => 'B) Adequacy regarding the clarity and applicability',
            'Comments' => 'Comments / Explanation',
        ],
        'ratingLegend' => [
            'PlanAdequacyScore' => [
                '0' => 'The clarity and applicability of the vision, mission and objectives are completely inadequate (0-30% of needs)',
                '1' => 'The clarity and applicability of the vision, mission and objectives are somewhat inadequate (31-60% of needs)',
                '2' => 'The clarity and applicability of the vision, mission and objectives are adequate (61-90% of needs)',
                '3' => 'The clarity and applicability of the vision, mission and objectives are fully adequate (91-100% of needs)'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Is there a management plan? If yes, is it adequate and practical to implement for the OECM?',
            'The Management Plan is a document which sets management approach and goals for management. Critical to the success of the plan is the widest possible consultation with stakeholders and development of objectives that can be agreed and adhered to by all who have interest in the use and ongoing survival of the area concerned (from IUCN/WDPA: Guidelines for recognising and reporting other effective area-based conservation measures, 2017)'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the status of the management plan, B) Adequacy of the management plan to the needs of conservation B) Adequacy regarding the clarity and applicability:'
        ]
    ],

    'WorkPlan' => [
        'title' => 'Work plan',
        'fields' => [
            'PlanExistence' => 'A) Is there a workplan? Yes/no',
            'PlanUptoDate' => 'Is the workplan up to date (covering current period)? Yes/no',
            'PlanApproved' => 'as the workplan been officially approved? Yes/no',
            'PlanImplemented' => 'Is the workplan or monitoring plan being implemented? Yes/no',
            'PlanAdequacyScore' => 'B) Adequacy regarding the clarity and applicability of the activities and established results of the work/action plan or monitoring plan',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'PlanAdequacyScore' => [
                '0' => 'The clarity and applicability of activities and expected results are fully inadequate',
                '1' => 'The clarity and applicability of activities and expected results are somewhat inadequate ',
                '2' => 'The clarity and applicability of activities and expected results are adequate',
                '3' => 'The clarity and applicability of activities and expected results are fully adequate'
            ],
        ],
        'module_info_Rating' => 'Evaluate: A) Status of the workplan plan, B) Clarity and applicability of the workplan established activities and results',
        'module_info_EvaluationQuestion' => [
            'Is there a work plan? If yes, is it adequate and practical to implement for the OECM?',
            'A workplan describes specific activities to be implemented allows monitoring progress in achieving outputs of the OECM. It provides necessary information to measure the success of the OECM in its conservation efforts (outcomes).'
        ]
    ],

    'Objectives' => [
        'title' => 'Objectives of the OECM',
        'fields' => [
            'Objective' => 'Objective',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Governance from C1.2',
            'Key elements of the OECM automatically reported from C1.2',
            'Support to the local economy',
            'Support social aspects of the stakeholders',
            'Tourism',
            'Management systems – human resources, finances, purchasing',
            'Infrastructure and equipment',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the objectives set for the OECM adequate?',
            'The goals and objectives of the OECM must be clearly understood. They should be well -defined and worded to facilitate monitoring but also should relate to the key values of OECM (i.e. important species or ecosystems) or to major areas of management activity (e.g. tourism, education).'
        ],
        'module_info_Rating' => [
            'Evaluate adequacy of the management plan objectives for the key elements of the OECM, based on the analysis of the intervention context, points: CTX1.5, CTX 4, 5, 6, 7 and context of management, points from C 1.1 to C 1.5)'
        ]
    ],

    'ObjectivesPlanification' => [
        'module_info' => 'Establish and describe conservation objectives for planning of the OECM<br />The objectives listed below will be used for improving management, and more spe cifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM.'
    ],



    'BudgetAdequacy' => [
        'title' => 'Current budget',
        'fields' => [
            'EvaluationScore' => 'Adequacy of current budget',
            'Percentage' => 'Percentage indicating the extent to which the budget is adequate relative to the requirements',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No budget (0% of requirements)',
                '1' => 'Inadequate for even essential management activities (between 1 and 25% of requirements)',
                '2' => 'Inadequate for many management activities (26-50% of requirements)',
                '3' => 'Adequate for essential management activities (between 51 and 70% of requirements)',
                '4' => 'Adequate for many but not all activities (between 71% and 90% of requirements)',
                '5' => 'Adequate for all activities (91% or more of requirements)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the current budget adequate for appropriate management of the OECM?',
            'OECMs prepare their annual operating budgets each year or for several years. Key financial planning and budget documents are necessary to improve operational efficiency and effectiveness.'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of current year funding of the OECM in relation to conservation requirements (based on the analysis of the context of intervention, point CTX 3.2)'
        ]
    ],

    'BudgetSecurization' => [
        'title' => 'Securing the budget',
        'fields' => [
            'Percentage' => 'A) Evaluate in percent the "Security of future funding"',
            'EvaluationScore' => 'B) Evaluate in years the "Period of security of future funding"',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'Percentage' => [
                '0' => 'Basic financial needs for the OECM management are not secured (0–20% of needs secured)',
                '1' => 'Basic financial needs for the OECM management are very weakly secured (21–40% of needs secured)',
                '2' => 'Basic financial needs for the OECM management are weakly secured (41-60% of needs secured)',
                '3' => 'Basic financial needs for the OECM management are partially secured (61–75% of needs secured)',
                '4' => 'Basic financial needs for the OECM management are relatively well secured (76-90% of needs secured)',
                '5' => 'Basic financial needs for the OECM management are secured (> 90% of needs secured)',
            ],
            'EvaluationScore' =>[
                '0' => 'Basic financial needs for the OECM management are secured only for 1 year (current year)',
                '1' => 'Basic financial needs for the OECM management are secured for 2 years (current year +1 year)',
                '2' => 'Basic financial needs for the OECM management are secured for 3 years (current year +2 years)',
                '3' => 'Basic financial needs for the OECM management are secured for 4 – and more years. (current year +3 years and more)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'How much of the required budget is secured, and for how long, to cover basic OECM management needs?',
            'Secure and reliable budget is critical for OECM planning and management, for large -scale and long- term activities.'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the security of funding and B) the period of security of funding for the forthcoming years in relation to conservation requirements in the OECM'
        ]
    ],


    'ObjectivesIntrants' => [
        'module_info' => 'Establish and describe conservation objectives for inputs of the OECM<br />The objectives listed below will be used for improving management, and more specifically for planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM.'
    ],


    'ObjectivesProcessus' => [
        'module_info' => 'Establish and describe conservation objectives related to implementation process of the OECM The objectives entered below will be used for improving management, and mo re specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM.'
    ],


];
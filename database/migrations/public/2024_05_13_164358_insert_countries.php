<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $fields = ['iso2', 'iso3', 'iso', 'name_fr', 'name_en', 'name_sp', 'name_pt', 'region_id'];
        $records = [
            ['AW', 'ABW', '533', 'Aruba', 'Aruba', 'Aruba', 'Aruba', null],
            ['AF', 'AFG', '4', 'Afghanistan', 'Afghanistan', 'Afganistán', 'Afeganistão', null],
            ['AI', 'AIA', '660', 'Anguilla', 'Anguilla', 'Anguilla', 'Anguilla', null],
            ['AX', 'ALA', '248', 'Îles Åland', 'Åland Islands', 'Islas Åland', 'Ilhas Aland', null],
            ['AL', 'ALB', '8', 'Albanie', 'Albania', 'Albania', 'Albânia', null],
            ['AN', 'ANT', '530', 'Antilles Néerlandaises', 'Netherlands Antilles', 'Antillas Holandesas', 'Antilhas Holandesas', null],
            ['AE', 'ARE', '784', 'Émirats Arabes Unis', 'United Arab Emirates', 'Emiratos Árabes Unidos', 'Emirados Árabes Unidos', null],
            ['AR', 'ARG', '32', 'Argentine', 'Argentina', 'Argentina', 'Argentina', null],
            ['AM', 'ARM', '51', 'Arménie', 'Armenia', 'Armenia', 'Armênia', null],
            ['AS', 'ASM', '16', 'Samoa Américaines', 'American Samoa', 'Samoa americana', 'Samoa Americana', null],
            ['TF', 'ATF', '260', 'Terres Australes Françaises', 'French Southern Territories', 'Territorios Sureños de Francia', 'Territórios do Sul da França', null],
            ['AU', 'AUS', '36', 'Australie', 'Australia', 'Australia', 'Austrália', null],
            ['AT', 'AUT', '40', 'Autriche', 'Austria', 'Austria', 'Áustria', null],
            ['WY', 'AWY', null, 'Far Far Away', 'Far Far Away', 'Far Far Away', 'Tão Tão Distante', null],
            ['AZ', 'AZE', '31', 'Azerbaïdjan', 'Azerbaijan', 'Azerbaiyán', 'Azerbaijão', null],
            ['BI', 'BDI', '108', 'Burundi', 'Burundi', 'Burundi', 'Burundi', null],
            ['BE', 'BEL', '56', 'Belgique', 'Belgium', 'Bélgica', 'Bélgica', null],
            ['BJ', 'BEN', '204', 'Bénin', 'Benin', 'Benin', 'Benin', null],
            ['BF', 'BFA', '854', 'Burkina Faso', 'Burkina Faso', 'Burkina Faso', 'Burkina faso', null],
            ['BD', 'BGD', '50', 'Bangladesh', 'Bangladesh', 'Bangladesh', 'Bangladesh', null],
            ['BG', 'BGR', '100', 'Bulgarie', 'Bulgaria', 'Bulgaria', 'Bulgária', null],
            ['BH', 'BHR', '48', 'Bahreïn', 'Bahrain', 'Bahrain', 'Bahrein', null],
            ['BA', 'BIH', '70', 'Bosnie-Herzégovine', 'Bosnia and Herzegovina', 'Bosnia y Herzegovina', 'Bósnia e Herzegovina', null],
            ['BY', 'BLR', '112', 'Bélarus', 'Belarus', 'Belarus', 'Bielo-Rússia', null],
            ['BM', 'BMU', '60', 'Bermudes', 'Bermuda', 'Bermuda', 'Bermudas', null],
            ['BO', 'BOL', '68', 'Bolivie', 'Bolivia', 'Bolivia', 'Bolívia', null],
            ['BR', 'BRA', '76', 'Brésil', 'Brazil', 'Brasil', 'Brasil', null],
            ['BN', 'BRN', '96', 'Brunéi Darussalam', 'Brunei Darussalam', 'Brunei Darussalam', 'Brunei Darussalam', null],
            ['BT', 'BTN', '64', 'Bhoutan', 'Bhutan', 'Bhutan', 'Butão', null],
            ['BV', 'BVT', '74', 'Île Bouvet', 'Bouvet Island', 'Isla Bouvet', 'Ilha Bouvet', null],
            ['CA', 'CAN', '124', 'Canada', 'Canada', 'Canadá', 'Canadá', null],
            ['CC', 'CCK', '166', 'Îles Cocos (Keeling)', 'Cocos (Keeling) Islands', 'Islas Cocos (Keeling)', 'Ilhas Cocos (Keeling)', null],
            ['CH', 'CHE', '756', 'Suisse', 'Switzerland', 'Suiza', 'Suíço', null],
            ['CL', 'CHL', '152', 'Chili', 'Chile', 'Chile', 'Pimenta', null],
            ['CN', 'CHN', '156', 'Chine', 'China', 'China', 'China', null],
            ['CO', 'COL', '170', 'Colombie', 'Colombia', 'Colombia', 'Colômbia', null],
            ['CR', 'CRI', '188', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica', null],
            ['CX', 'CXR', '162', 'Île Christmas', 'Christmas Island', 'Isla Navidad', 'Ilha do Natal', null],
            ['KY', 'CYM', '136', 'Îles Caïmanes', 'Cayman Islands', 'Islas Caimán', 'Ilhas Cayman', null],
            ['CY', 'CYP', '196', 'Chypre', 'Cyprus', 'Chipre', 'Chipre', null],
            ['CZ', 'CZE', '203', 'République Tchèque', 'Czech Republic', 'Chequia', 'Czechia', null],
            ['DE', 'DEU', '276', 'Allemagne', 'Germany', 'Alemania', 'Alemanha', null],
            ['DK', 'DNK', '208', 'Danemark', 'Denmark', 'Dinamarca', 'Dinamarca', null],
            ['DZ', 'DZA', '12', 'Algérie', 'Algeria', 'Argelia', 'Argélia', null],
            ['EC', 'ECU', '218', 'Équateur', 'Ecuador', 'Ecuador', 'Equador', null],
            ['EG', 'EGY', '818', 'Égypte', 'Egypt', 'Egipto', 'Egito', null],
            ['EH', 'ESH', '732', 'Sahara Occidental', 'Western Sahara', 'Sáhara Occidental', 'Saara Ocidental', null],
            ['ES', 'ESP', '724', 'Espagne', 'Spain', 'España', 'Espanha', null],
            ['EE', 'EST', '233', 'Estonie', 'Estonia', 'Estonia', 'Estônia', null],
            ['FI', 'FIN', '246', 'Finlande', 'Finland', 'Finlandia', 'Finlândia', null],
            ['FK', 'FLK', '238', 'Îles (malvinas) Falkland', 'Falkland Islands', 'Islas Malvinas', 'Ilhas Malvinas', null],
            ['FR', 'FRA', '250', 'France', 'France', 'Francia', 'França', null],
            ['FO', 'FRO', '234', 'Îles Féroé', 'Faroe Islands', 'Islas Faroe', 'Ilhas Faroe', null],
            ['GB', 'GBR', '826', 'Royaume-Uni', 'United Kingdom', 'Reino Unido', 'Reino Unido', null],
            ['GE', 'GEO', '268', 'Géorgie', 'Georgia', 'Georgia', 'Georgia', null],
            ['GI', 'GIB', '292', 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Gibraltar', null],
            ['GP', 'GLP', '312', 'Guadeloupe', 'Guadeloupe', 'Guadalupe', 'Guadalupe', null],
            ['GR', 'GRC', '300', 'Grèce', 'Greece', 'Grecia', 'Grécia', null],
            ['GL', 'GRL', '304', 'Groenland', 'Greenland', 'Groenlandia', 'Groenlândia', null],
            ['GT', 'GTM', '320', 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', null],
            ['AO', 'AGO', '24', 'Angola', 'Angola', 'Angola', 'Angola', 'sa'],
            ['GU', 'GUM', '316', 'Guam', 'Guam', 'Guam', 'Guam', null],
            ['HK', 'HKG', '344', 'Hong-Kong', 'Hong Kong', 'Hong Kong', 'Hong Kong', null],
            ['HM', 'HMD', '334', 'Îles Heard et Mcdonald', 'Heard Island and McDonald Islands', 'Islas Heard e Islas McDonald', 'Ilhas Heard e Ilhas McDonald', null],
            ['HN', 'HND', '340', 'Honduras', 'Honduras', 'Honduras', 'Honduras', null],
            ['HR', 'HRV', '191', 'Croatie', 'Croatia', 'Croacia', 'Croácia', null],
            ['HU', 'HUN', '348', 'Hongrie', 'Hungary', 'Hungría', 'Hungria', null],
            ['ID', 'IDN', '360', 'Indonésie', 'Indonesia', 'Indonesia', 'Indonésia', null],
            ['IM', 'IMN', '833', 'Île de Man', 'Isle of Man', 'Isla de Man', 'Ilha de Man', null],
            ['IN', 'IND', '356', 'Inde', 'India', 'India', 'Índia', null],
            ['IO', 'IOT', '86', 'Territoire Britannique de l\'Océan Indien', 'British Indian Ocean Territory', 'Territorio Oceánico de la India Británica', 'Território Oceânico da Índia Britânica', null],
            ['IE', 'IRL', '372', 'Irlande', 'Ireland', 'Irlanda', 'Irlanda', null],
            ['IR', 'IRN', '364', 'République Islamique d\'Iran', 'Islamic Republic of Iran', 'Irán', 'Irã', null],
            ['IQ', 'IRQ', '368', 'Iraq', 'Iraq', 'Irak', 'Iraque', null],
            ['IS', 'ISL', '352', 'Islande', 'Iceland', 'Islandia', 'Islândia', null],
            ['IL', 'ISR', '376', 'Israël', 'Israel', 'Israel', 'Israel', null],
            ['IT', 'ITA', '380', 'Italie', 'Italy', 'Italia', 'Itália', null],
            ['JO', 'JOR', '400', 'Jordanie', 'Jordan', 'Jordania', 'Jordânia', null],
            ['JP', 'JPN', '392', 'Japon', 'Japan', 'Japón', 'Japão', null],
            ['KZ', 'KAZ', '398', 'Kazakhstan', 'Kazakhstan', 'Kazajstán', 'Cazaquistão', null],
            ['KG', 'KGZ', '417', 'Kirghizistan', 'Kyrgyzstan', 'Kirgistán', 'Quirguistão', null],
            ['KH', 'KHM', '116', 'Cambodge', 'Cambodia', 'Camboya', 'Camboja', null],
            ['KR', 'KOR', '410', 'République de Corée', 'Republic of Korea', 'Corea', 'Coréia', null],
            ['KW', 'KWT', '414', 'Koweït', 'Kuwait', 'Kuwait', 'Kuwait', null],
            ['LA', 'LAO', '418', 'République Démocratique Populaire Lao', 'Lao People\'s Democratic Republic', 'Laos', 'Laos', null],
            ['LB', 'LBN', '422', 'Liban', 'Lebanon', 'Líbano', 'Líbano', null],
            ['LY', 'LBY', '434', 'Jamahiriya Arabe Libyenne', 'Libyan Arab Jamahiriya', 'Libia', 'Líbia', null],
            ['LI', 'LIE', '438', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', null],
            ['LK', 'LKA', '144', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', null],
            ['LT', 'LTU', '440', 'Lituanie', 'Lithuania', 'Lituania', 'Lituânia', null],
            ['LU', 'LUX', '442', 'Luxembourg', 'Luxembourg', 'Luxemburgo', 'Luxemburgo', null],
            ['LV', 'LVA', '428', 'Lettonie', 'Latvia', 'Letonia', 'Letônia', null],
            ['MO', 'MAC', '446', 'Macao', 'Macao', 'Macao', 'Macau', null],
            ['MA', 'MAR', '504', 'Maroc', 'Morocco', 'Marruecos', 'Marrocos', null],
            ['MC', 'MCO', '492', 'Monaco', 'Monaco', 'Mónaco', 'Mônaco', null],
            ['MD', 'MDA', '498', 'République de Moldova', 'Republic of Moldova', 'Moldavia', 'Moldova', null],
            ['MV', 'MDV', '462', 'Maldives', 'Maldives', 'Maldivas', 'Maldivas', null],
            ['MX', 'MEX', '484', 'Mexique', 'Mexico', 'México', 'México', null],
            ['MK', 'MKD', '807', 'L\'ex-République Yougoslave de Macédoine', 'The Former Yugoslav Republic of Macedonia', 'Macedonia', 'Macedônia', null],
            ['MT', 'MLT', '470', 'Malte', 'Malta', 'Malta', 'Malte', null],
            ['MM', 'MMR', '104', 'Myanmar', 'Myanmar', 'Mianmar', 'Mianmar', null],
            ['MN', 'MNG', '496', 'Mongolie', 'Mongolia', 'Mongolia', 'Mongólia', null],
            ['MP', 'MNP', '580', 'Îles Mariannes du Nord', 'Northern Mariana Islands', 'Islas de Norte-Mariana', 'Ilhas Marianas do Norte', null],
            ['MS', 'MSR', '500', 'Montserrat', 'Montserrat', 'Montserrat', 'Montserrat', null],
            ['MQ', 'MTQ', '474', 'Martinique', 'Martinique', 'Martinica', 'Martinica', null],
            ['MY', 'MYS', '458', 'Malaisie', 'Malaysia', 'Malasia', 'Malásia', null],
            ['YT', 'MYT', '175', 'Mayotte', 'Mayotte', 'Mayote', 'Mayote', null],
            ['NC', 'NCL', '540', 'Nouvelle-Calédonie', 'New Caledonia', 'Nueva Caledonia', 'Nova Caledônia', null],
            ['NF', 'NFK', '574', 'Île Norfolk', 'Norfolk Island', 'Islas Norfolk', 'Ilhas Norfolk', null],
            ['NI', 'NIC', '558', 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicarágua', null],
            ['NL', 'NLD', '528', 'Pays-Bas', 'Netherlands', 'Holanda', 'Holanda', null],
            ['NO', 'NOR', '578', 'Norvège', 'Norway', 'Noruega', 'Noruega', null],
            ['NP', 'NPL', '524', 'Népal', 'Nepal', 'Nepal', 'Nepal', null],
            ['NZ', 'NZL', '554', 'Nouvelle-Zélande', 'New Zealand', 'Nueva Zelanda', 'Nova Zelândia', null],
            ['OM', 'OMN', '512', 'Oman', 'Oman', 'Omán', 'Omã', null],
            ['PK', 'PAK', '586', 'Pakistan', 'Pakistan', 'Pakistán', 'Paquistão', null],
            ['PA', 'PAN', '591', 'Panama', 'Panama', 'Panamá', 'Panamá', null],
            ['PN', 'PCN', '612', 'Pitcairn', 'Pitcairn', 'Pitcairn', 'Pitcairn', null],
            ['PE', 'PER', '604', 'Pérou', 'Peru', 'Perú', 'Peru', null],
            ['PH', 'PHL', '608', 'Philippines', 'Philippines', 'Filipinas', 'Filipinas', null],
            ['PL', 'POL', '616', 'Pologne', 'Poland', 'Polonia', 'Polônia', null],
            ['PR', 'PRI', '630', 'Porto Rico', 'Puerto Rico', 'Puerto Rico', 'Porto Rico', null],
            ['KP', 'PRK', '408', 'République Populaire Démocratique de Corée', 'Democratic People\'s Republic of Korea', 'Corea', 'Coréia', null],
            ['PT', 'PRT', '620', 'Portugal', 'Portugal', 'Portugal', 'Portugal', null],
            ['PY', 'PRY', '600', 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguai', null],
            ['PS', 'PSE', '275', 'Territoire Palestinien Occupé', 'Occupied Palestinian Territory', 'Palestina', 'Palestina', null],
            ['PF', 'PYF', '258', 'Polynésie Française', 'French Polynesia', 'Polinesia Francesa', 'Polinésia Francesa', null],
            ['QA', 'QAT', '634', 'Qatar', 'Qatar', 'Qatar', 'Catar', null],
            ['RE', 'REU', '638', 'Réunion', 'Réunion', 'Reunión', 'Reunião', null],
            ['RO', 'ROU', '642', 'Roumanie', 'Romania', 'Rumanía', 'Romênia', null],
            ['RU', 'RUS', '643', 'Fédération de Russie', 'Russian Federation', 'Rusia', 'Rússia', null],
            ['SA', 'SAU', '682', 'Arabie Saoudite', 'Saudi Arabia', 'Arabia Saudí', 'Arábia Saudita', null],
            ['CS', 'SCG', '0', 'Serbie-et-Monténégro', 'Serbia and Montenegro', 'Serbia y Montenegro', 'Sérvia e Montenegro', null],
            ['SG', 'SGP', '702', 'Singapour', 'Singapore', 'Singapur', 'Cingapura', null],
            ['GS', 'SGS', '239', 'Géorgie du Sud et les Îles Sandwich du Sud', 'South Georgia and the South Sandwich Islands', 'Georgia del Sur e Islas Sandwich del Sur', 'Geórgia do Sul e Ilhas Sandwich do Sul', null],
            ['SH', 'SHN', '654', 'Sainte-Hélène', 'Saint Helena', 'Santa Helena', 'Santa Helena', null],
            ['SJ', 'SJM', '744', 'Svalbard et Île Jan Mayen', 'Svalbard and Jan Mayen', 'Esvalbard y Jan Mayen', 'Esvalbard e Jan Mayen', null],
            ['SV', 'SLV', '222', 'El Salvador', 'El Salvador', 'El Salvador', 'O salvador', null],
            ['SM', 'SMR', '674', 'Saint-Marin', 'San Marino', 'San Marino', 'San Marino', null],
            ['PM', 'SPM', '666', 'Saint-Pierre-et-Miquelon', 'Saint-Pierre and Miquelon', 'San Pedro y Miquelon', '“São Pedro e Miquelão”', null],
            ['SK', 'SVK', '703', 'Slovaquie', 'Slovakia', 'Eslovaquia', 'Eslováquia', null],
            ['SI', 'SVN', '705', 'Slovénie', 'Slovenia', 'Eslovenia', 'Eslovênia', null],
            ['SE', 'SWE', '752', 'Suède', 'Sweden', 'Suecia', 'Suécia', null],
            ['SZ', 'SWZ', '748', 'Swaziland', 'Swaziland', 'Suazilandia', 'Suazilândia', null],
            ['SY', 'SYR', '760', 'République Arabe Syrienne', 'Syrian Arab Republic', 'Siria', 'Síria', null],
            ['TC', 'TCA', '796', 'Îles Turks et Caïques', 'Turks and Caicos Islands', 'Islas Turks y Caicos', 'Ilhas Turcas e Caicos', null],
            ['TH', 'THA', '764', 'Thaïlande', 'Thailand', 'Tailandia', 'Tailândia', null],
            ['TJ', 'TJK', '762', 'Tadjikistan', 'Tajikistan', 'Tajikistán', 'Tajiquistão', null],
            ['TK', 'TKL', '772', 'Tokelau', 'Tokelau', 'Tokelau', 'Toquelau', null],
            ['TM', 'TKM', '795', 'Turkménistan', 'Turkmenistan', 'Turmenistán', 'Turmenistão', null],
            ['TN', 'TUN', '788', 'Tunisie', 'Tunisia', 'Túnez', 'Tunísia', null],
            ['TR', 'TUR', '792', 'Turquie', 'Turkey', 'Turquía', 'Peru', null],
            ['TW', 'TWN', '158', 'Taïwan', 'Taiwan', 'Taiwán', 'Taiwan', null],
            ['UA', 'UKR', '804', 'Ukraine', 'Ukraine', 'Ucrania', 'Ucrânia', null],
            ['UM', 'UMI', '581', 'Îles Mineures Éloignées des États-Unis', 'United States Minor Outlying Islands', 'Islas Ultramarinas de Estados Unidos', 'Ilhas Distantes dos Estados Unidos', null],
            ['UY', 'URY', '858', 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguai', null],
            ['US', 'USA', '840', 'États-Unis', 'United States', 'Estados Unidos', 'Estados Unidos', null],
            ['UZ', 'UZB', '860', 'Ouzbékistan', 'Uzbekistan', 'Uzbekistán', 'Uzbequistão', null],
            ['VA', 'VAT', '336', 'Saint-Siège (état de la Cité du Vatican)', 'Vatican City State', 'Estado Vaticano', 'Estado do Vaticano', null],
            ['VE', 'VEN', '862', 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', null],
            ['VG', 'VGB', '92', 'Îles Vierges Britanniques', 'British Virgin Islands', 'Islas Vírgenes Británicas', 'Ilhas Virgens Britânicas', null],
            ['VI', 'VIR', '850', 'Îles Vierges des États-Unis', 'U.S. Virgin Islands', 'Islas Vírgenes Estadounidenses', 'Ilhas Virgens Americanas', null],
            ['VN', 'VNM', '704', 'Viet Nam', 'Vietnam', 'Vietnam', 'Vietnã', null],
            ['WF', 'WLF', '876', 'Wallis et Futuna', 'Wallis and Futuna', 'Wallis y Futuna', 'Wallis e Futuna', null],
            ['YE', 'YEM', '887', 'Yémen', 'Yemen', 'Yemen', 'Iémen', null],
            ['ZA', 'ZAF', '710', 'Afrique du Sud', 'South Africa', 'Sudáfrica', 'África do Sul', 'sa'],
            ['AG', 'ATG', '28', 'Antigua-et-Barbuda', 'Antigua and Barbuda', 'Antigua y Barbuda', 'Antiga e barbuda', 'ac'],
            ['BS', 'BHS', '44', 'Bahamas', 'Bahamas', 'Bahamas', 'Bahamas', 'ac'],
            ['BB', 'BRB', '52', 'Barbade', 'Barbados', 'Barbados', 'Barbados', 'ac'],
            ['BZ', 'BLZ', '84', 'Belize', 'Belize', 'Belize', 'Belize', 'ac'],
            ['AD', 'AND', '20', 'Andorre', 'Andorra', 'Andorra', 'Andorra', 'wa'],
            ['BW', 'BWA', '72', 'Botswana', 'Botswana', 'Botswana', 'Botswana', 'sa'],
            ['AQ', 'ATA', '10', 'Antarctique', 'Antarctica', 'Antartida', 'Antártica', 'ca'],
            ['CM', 'CMR', '120', 'Cameroun', 'Cameroon', 'Camerún', 'Camarões', 'ca'],
            ['CV', 'CPV', '132', 'Cap-vert', 'Cape Verde', 'Cabo Verde', 'Cabo Verde', 'wa'],
            ['KM', 'COM', '174', 'Comores', 'Comoros', 'Comoros', 'Comores', 'sa'],
            ['CI', 'CIV', '384', 'Côte d\'Ivoire', 'Côte d\'Ivoire', 'Costa de Marfil', 'Costa do Marfim', 'wa'],
            ['CU', 'CUB', '192', 'Cuba', 'Cuba', 'Cuba', 'Cuba', 'ac'],
            ['DJ', 'DJI', '262', 'Djibouti', 'Djibouti', 'Djibouti', 'Djibouti', 'ea'],
            ['DM', 'DMA', '212', 'Dominique', 'Dominica', 'Dominica', 'Dominica', 'ac'],
            ['ER', 'ERI', '232', 'Érythrée', 'Eritrea', 'Eritrea', 'Eritreia', 'ea'],
            ['FM', 'FSM', '583', 'États Fédérés de Micronésie', 'Federated States of Micronesia', 'Micronesia', 'Micronésia', 'ap'],
            ['ET', 'ETH', '231', 'Éthiopie', 'Ethiopia', 'Etiopía', 'Etiópia', 'ea'],
            ['FJ', 'FJI', '242', 'Fidji', 'Fiji', 'Fiji', 'Fiji', 'ap'],
            ['GA', 'GAB', '266', 'Gabon', 'Gabon', 'Gabón', 'Gabão', 'ca'],
            ['GM', 'GMB', '270', 'Gambie', 'Gambia', 'Gambia', 'Gâmbia', 'wa'],
            ['GH', 'GHA', '288', 'Ghana', 'Ghana', 'Ghana', 'Gana', 'wa'],
            ['GD', 'GRD', '308', 'Grenade', 'Grenada', 'Granada', 'Grenade', 'ac'],
            ['GN', 'GIN', '324', 'Guinée', 'Guinea', 'Guinea', 'Guiné', 'wa'],
            ['GW', 'GNB', '624', 'Guinée-Bissau', 'Guinea-Bissau', 'Guinea-Bissau', 'Guiné-Bissau', 'wa'],
            ['GQ', 'GNQ', '226', 'Guinée Équatoriale', 'Equatorial Guinea', 'Guinea Ecuatorial', 'Guiné Equatorial', 'ca'],
            ['GY', 'GUY', '328', 'Guyana', 'Guyana', 'Guayana', 'Guiana', 'ac'],
            ['GF', 'GUF', '254', 'Guyane Française', 'French Guiana', 'Guinea Francesa', 'Guiné Francesa', 'wa'],
            ['HT', 'HTI', '332', 'Haïti', 'Haiti', 'Haití', 'Haiti', 'ac'],
            ['CK', 'COK', '184', 'Îles Cook', 'Cook Islands', 'Islas Cook', 'Ilhas Cook', 'ap'],
            ['MH', 'MHL', '584', 'Îles Marshall', 'Marshall Islands', 'Islas Marshall', 'Ilhas Marshall', 'ap'],
            ['SB', 'SLB', '90', 'Îles Salomon', 'Solomon Islands', 'Islas Salomón', 'Ilhas Salomão', 'ap'],
            ['JM', 'JAM', '388', 'Jamaïque', 'Jamaica', 'Jamaica', 'Jamaica', 'ac'],
            ['KE', 'KEN', '404', 'Kenya', 'Kenya', 'Kenia', 'Quênia', 'ea'],
            ['KI', 'KIR', '296', 'Kiribati', 'Kiribati', 'Kiribati', 'Kiribati', 'ap'],
            ['LS', 'LSO', '426', 'Lesotho', 'Lesotho', 'Lesoto', 'Lesoto', 'sa'],
            ['LR', 'LBR', '430', 'Libéria', 'Liberia', 'Liberia', 'Libéria', 'wa'],
            ['MG', 'MDG', '450', 'Madagascar', 'Madagascar', 'Madagascar', 'Madagáscar', 'sa'],
            ['MW', 'MWI', '454', 'Malawi', 'Malawi', 'Malawi', 'Malawi', 'sa'],
            ['ML', 'MLI', '466', 'Mali', 'Mali', 'Mali', 'Mali', 'wa'],
            ['MU', 'MUS', '480', 'Maurice', 'Mauritius', 'Mauricio', 'Mauricio', 'sa'],
            ['MR', 'MRT', '478', 'Mauritanie', 'Mauritania', 'Mauritania', 'Mauritânia', 'wa'],
            ['MZ', 'MOZ', '508', 'Mozambique', 'Mozambique', 'Mozambique', 'Moçambique', 'sa'],
            ['NA', 'NAM', '516', 'Namibie', 'Namibia', 'Namibia', 'Namibia', 'sa'],
            ['NR', 'NRU', '520', 'Nauru', 'Nauru', 'Nauru', 'Nauru', 'ap'],
            ['NE', 'NER', '562', 'Niger', 'Niger', 'Níger', 'Níger', 'wa'],
            ['NG', 'NGA', '566', 'Nigéria', 'Nigeria', 'Nigeria', 'Nigéria', 'wa'],
            ['NU', 'NIU', '570', 'Niué', 'Niue', 'Niue', 'Niue', 'ap'],
            ['UG', 'UGA', '800', 'Ouganda', 'Uganda', 'Uganda', 'Uganda', 'ea'],
            ['PW', 'PLW', '585', 'Palaos', 'Palau', 'Palau', 'Palau', 'ap'],
            ['PG', 'PNG', '598', 'Papouasie-Nouvelle-Guinée', 'Papua New Guinea', 'Papúa Nueva Guinea', 'Papua Nova Guiné', 'ap'],
            ['CF', 'CAF', '140', 'République Centrafricaine', 'Central African', 'República Centroafricana', 'República Centro-Africano', 'ca'],
            ['CD', 'COD', '180', 'République Démocratique du Congo', 'Democratic Republic Of Congo', 'República Democrática del Congo', 'República Democrática do Congo', 'ca'],
            ['DO', 'DOM', '214', 'République Dominicaine', 'Dominican Republic', 'República Dominicana', 'República Dominicana', 'ac'],
            ['CG', 'COG', '178', 'République du Congo', 'Republic of Congo', 'Congo', 'Congo', 'ca'],
            ['TZ', 'TZA', '834', 'République-Unie de Tanzanie', 'United Republic Of Tanzania', 'Tanzania', 'Tanzânia', 'ea'],
            ['RW', 'RWA', '646', 'Rwanda', 'Rwanda', 'Ruanda', 'Ruanda', 'ea'],
            ['LC', 'LCA', '662', 'Sainte-Lucie', 'Saint Lucia', 'Santa Lucía', 'Santa Lúcia', 'ac'],
            ['KN', 'KNA', '659', 'Saint-Kitts-et-Nevis', 'Saint Kitts and Nevis', 'Santa Kitts y Nevis', 'São Cristóvão e Nevis', 'ac'],
            ['VC', 'VCT', '670', 'Saint-Vincent-et-les Grenadines', 'Saint Vincent and the Grenadines', 'San Vincente y Las Granadinas', 'São Vicente e Granadinas', 'ac'],
            ['WS', 'WSM', '882', 'Samoa', 'Samoa', 'Samoa', 'Samoa', 'ap'],
            ['ST', 'STP', '678', 'Sao Tomé-et-Principe', 'Sao Tome and Principe', 'Santo Tomé y Príncipe', 'São Tomé e Príncipe', 'ca'],
            ['SN', 'SEN', '686', 'Sénégal', 'Senegal', 'Senegal', 'Senegal', 'wa'],
            ['SC', 'SYC', '690', 'Seychelles', 'Seychelles', 'Seychelles', 'Seychelles', 'sa'],
            ['SL', 'SLE', '694', 'Sierra Leone', 'Sierra Leone', 'Sierra Leona', 'Serra Leoa', 'wa'],
            ['SO', 'SOM', '706', 'Somalie', 'Somalia', 'Somalia', 'Somália', 'ea'],
            ['SD', 'SDN', '729', 'Soudan', 'Sudan', 'Sudán', 'Sudão', 'ea'],
            ['SR', 'SUR', '740', 'Suriname', 'Suriname', 'Surinám', 'Suriname', 'ac'],
            ['TD', 'TCD', '148', 'Tchad', 'Chad', 'Chad', 'Chade', 'ca'],
            ['TL', 'TLS', '626', 'Timor-Leste', 'Timor-Leste', 'Timor Leste', 'Timor Leste', 'ap'],
            ['TG', 'TGO', '768', 'Togo', 'Togo', 'Togo', 'Ir', 'wa'],
            ['TO', 'TON', '776', 'Tonga', 'Tonga', 'Tongo', 'Tongo', 'ap'],
            ['TT', 'TTO', '780', 'Trinité-et-Tobago', 'Trinidad and Tobago', 'Trinidad y Tobago', 'Trinidad e Tobago', 'ac'],
            ['TV', 'TUV', '798', 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Tuvalu', 'ap'],
            ['VU', 'VUT', '548', 'Vanuatu', 'Vanuatu', 'Vanuatu', 'Vanuatu', 'ap'],
            ['ZM', 'ZMB', '894', 'Zambie', 'Zambia', 'Zambia', 'Zâmbia', 'sa'],
            ['ZW', 'ZWE', '716', 'Zimbabwe', 'Zimbabwe', 'Zimbabue', 'Zimbábue', 'sa']
        ];

        foreach ($records as $record) {
            DB::table('imet_countries')
                ->insert(array_combine($fields, $record));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('imet_countries')->truncate();
    }
};
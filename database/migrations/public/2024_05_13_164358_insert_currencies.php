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
        $fields = ['iso', 'name_fr', 'name_en', 'name_sp', 'name_pt'];
        $records = [
            ['ADP', 'Andorran Peseta', 'peseta andorrane', 'peseta andorrana', 'Peseta de Andorra'],
            ['AED', 'United Arab Emirates Dirham', 'dirham des Émirats arabes unis', 'dírham de los Emiratos Árabes Unidos', 'Dirrã dos Emirados Árabes Unidos'],
            ['AFA', 'Afghan Afghani (1927–2002)', 'afghani (1927–2002)', 'afgani (1927–2002)', 'Afegane (1927–2002)'],
            ['AFN', 'Afghan Afghani', 'afghani afghan', 'afgani', 'Afegane afegão'],
            ['ALK', 'Albanian Lek (1946–1965)', 'lek albanais (1947–1961)', 'Albanian Lek (1946–1965)', 'Lek Albanês (1946–1965)'],
            ['ALL', 'Albanian Lek', 'lek albanais', 'lek', 'Lek albanês'],
            ['AMD', 'Armenian Dram', 'dram arménien', 'dram', 'Dram armênio'],
            ['ANG', 'Netherlands Antillean Guilder', 'florin antillais', 'florín de las Antillas Neerlandesas', 'Florim das Antilhas Holandesas'],
            ['AOA', 'Angolan Kwanza', 'kwanza angolais', 'kuanza', 'Kwanza angolano'],
            ['AOK', 'Angolan Kwanza (1977–1991)', 'kwanza angolais (1977–1990)', 'kwanza angoleño (1977–1990)', 'Cuanza angolano (1977–1990)'],
            ['AON', 'Angolan New Kwanza (1990–2000)', 'nouveau kwanza angolais (1990–2000)', 'nuevo kwanza angoleño (1990–2000)', 'Novo cuanza angolano (1990–2000)'],
            ['AOR', 'Angolan Readjusted Kwanza (1995–1999)', 'kwanza angolais réajusté (1995–1999)', 'kwanza reajustado angoleño (1995–1999)', 'Cuanza angolano reajustado (1995–1999)'],
            ['ARA', 'Argentine Austral', 'austral argentin', 'austral argentino', 'Austral argentino'],
            ['ARL', 'Argentine Peso Ley (1970–1983)', 'Argentine Peso Ley (1970–1983)', 'Argentine Peso Ley (1970–1983)', 'Peso lei argentino (1970–1983)'],
            ['ARM', 'Argentine Peso (1881–1970)', 'Argentine Peso (1881–1970)', 'Argentine Peso (1881–1970)', 'Peso argentino (1881–1970)'],
            ['ARP', 'Argentine Peso (1983–1985)', 'peso argentin (1983–1985)', 'peso argentino (1983–1985)', 'Peso argentino (1983–1985)'],
            ['ARS', 'Argentine Peso', 'peso argentin', 'peso argentino', 'Peso argentino'],
            ['ATS', 'Austrian Schilling', 'schilling autrichien', 'chelín austriaco', 'Xelim austríaco'],
            ['AUD', 'Australian Dollar', 'dollar australien', 'dólar australiano', 'Dólar australiano'],
            ['AWG', 'Aruban Florin', 'florin arubais', 'florín arubeño', 'Florim arubano'],
            ['AZM', 'Azerbaijani Manat (1993–2006)', 'manat azéri (1993–2006)', 'manat azerí (1993–2006)', 'Manat azerbaijano (1993–2006)'],
            ['AZN', 'Azerbaijani Manat', 'manat azéri', 'manat azerí', 'Manat azeri'],
            ['BAD', 'Bosnia-Herzegovina Dinar (1992–1994)', 'dinar bosniaque', 'dinar bosnio', 'Dinar da Bósnia-Herzegovina (1992–1994)'],
            ['BAM', 'Bosnia-Herzegovina Convertible Mark', 'mark convertible bosniaque', 'marco convertible de Bosnia-Herzegovina', 'Marco bósnio-herzegovino conversível'],
            ['BAN', 'Bosnia-Herzegovina New Dinar (1994–1997)', 'Bosnia-Herzegovina New Dinar (1994–1997)', 'Bosnia-Herzegovina New Dinar (1994–1997)', 'Novo dinar da Bósnia-Herzegovina (1994–1997)'],
            ['BBD', 'Barbadian Dollar', 'dollar barbadien', 'dólar barbadense', 'Dólar barbadense'],
            ['BDT', 'Bangladeshi Taka', 'taka bangladeshi', 'taka', 'Taka bengalesa'],
            ['BEC', 'Belgian Franc (convertible)', 'franc belge (convertible)', 'franco belga (convertible)', 'Franco belga (conversível)'],
            ['BEF', 'Belgian Franc', 'franc belge', 'franco belga', 'Franco belga'],
            ['BEL', 'Belgian Franc (financial)', 'franc belge (financier)', 'franco belga (financiero)', 'Franco belga (financeiro)'],
            ['BGL', 'Bulgarian Hard Lev', 'lev bulgare (1962–1999)', 'lev fuerte búlgaro', 'Lev forte búlgaro'],
            ['BGM', 'Bulgarian Socialist Lev', 'Bulgarian Socialist Lev', 'Bulgarian Socialist Lev', 'Lev socialista búlgaro'],
            ['BGN', 'Bulgarian Lev', 'lev bulgare', 'lev búlgaro', 'Lev búlgaro'],
            ['BGO', 'Bulgarian Lev (1879–1952)', 'Bulgarian Lev (1879–1952)', 'Bulgarian Lev (1879–1952)', 'Lev búlgaro (1879–1952)'],
            ['BHD', 'Bahraini Dinar', 'dinar bahreïni', 'dinar bahreiní', 'Dinar bareinita'],
            ['BIF', 'Burundian Franc', 'franc burundais', 'franco burundés', 'Franco burundiano'],
            ['BMD', 'Bermudan Dollar', 'dollar bermudien', 'dólar de Bermudas', 'Dólar bermudense'],
            ['BND', 'Brunei Dollar', 'dollar brunéien', 'dólar bruneano', 'Dólar bruneano'],
            ['BOB', 'Bolivian Boliviano', 'boliviano bolivien', 'boliviano', 'Boliviano'],
            ['BOL', 'Bolivian Boliviano (1863–1963)', 'Bolivian Boliviano (1863–1963)', 'Bolivian Boliviano (1863–1963)', 'Boliviano (1863–1963)'],
            ['BOP', 'Bolivian Peso', 'peso bolivien', 'peso boliviano', 'Peso boliviano'],
            ['BOV', 'Bolivian Mvdol', 'mvdol bolivien', 'MVDOL boliviano', 'Mvdol boliviano'],
            ['BRB', 'Brazilian New Cruzeiro (1967–1986)', 'nouveau cruzeiro brésilien (1967–1986)', 'nuevo cruceiro brasileño (1967–1986)', 'Cruzeiro novo brasileiro (1967–1986)'],
            ['BRC', 'Brazilian Cruzado (1986–1989)', 'cruzado brésilien (1986–1989)', 'cruzado brasileño', 'Cruzado brasileiro (1986–1989)'],
            ['BRE', 'Brazilian Cruzeiro (1990–1993)', 'cruzeiro brésilien (1990–1993)', 'cruceiro brasileño (1990–1993)', 'Cruzeiro brasileiro (1990–1993)'],
            ['BRL', 'Brazilian Real', 'réal brésilien', 'real brasileño', 'Real brasileiro'],
            ['BRN', 'Brazilian New Cruzado (1989–1990)', 'nouveau cruzado', 'nuevo cruzado brasileño', 'Cruzado novo brasileiro (1989–1990)'],
            ['BRR', 'Brazilian Cruzeiro (1993–1994)', 'cruzeiro', 'cruceiro brasileño', 'Cruzeiro brasileiro (1993–1994)'],
            ['BRZ', 'Brazilian Cruzeiro (1942–1967)', 'Brazilian Cruzeiro (1942–1967)', 'Brazilian Cruzeiro (1942–1967)', 'Cruzeiro brasileiro (1942–1967)'],
            ['BSD', 'Bahamian Dollar', 'dollar bahaméen', 'dólar bahameño', 'Dólar bahamense'],
            ['BTN', 'Bhutanese Ngultrum', 'ngultrum bouthanais', 'gultrum', 'Ngultrum butanês'],
            ['BUK', 'Burmese Kyat', 'kyat birman', 'kyat birmano', 'Kyat birmanês'],
            ['BWP', 'Botswanan Pula', 'pula botswanais', 'pula', 'Pula botsuanesa'],
            ['BYB', 'Belarusian Ruble (1994–1999)', 'nouveau rouble biélorusse (1994–1999)', 'nuevo rublo bielorruso (1994–1999)', 'Rublo novo bielo-russo (1994–1999)'],
            ['BYN', 'Belarusian Ruble', 'rouble biélorusse', 'rublo bielorruso', 'Rublo bielorrusso'],
            ['BYR', 'Belarusian Ruble (2000–2016)', 'rouble biélorusse (2000–2016)', 'rublo bielorruso (2000–2016)', 'Rublo bielorrusso (2000–2016)'],
            ['BZD', 'Belize Dollar', 'dollar bélizéen', 'dólar beliceño', 'Dólar belizenho'],
            ['CAD', 'Canadian Dollar', 'dollar canadien', 'dólar canadiense', 'Dólar canadense'],
            ['CDF', 'Congolese Franc', 'franc congolais', 'franco congoleño', 'Franco congolês'],
            ['CHE', 'WIR Euro', 'euro WIR', 'euro WIR', 'Euro WIR'],
            ['CHF', 'Swiss Franc', 'franc suisse', 'franco suizo', 'Franco suíço'],
            ['CHW', 'WIR Franc', 'franc WIR', 'franco WIR', 'Franco WIR'],
            ['CLE', 'Chilean Escudo', 'Chilean Escudo', 'Chilean Escudo', 'Escudo chileno'],
            ['CLF', 'Chilean Unit of Account (UF)', 'unité d’investissement chilienne', 'unidad de fomento chilena', 'Unidades de Fomento chilenas'],
            ['CLP', 'Chilean Peso', 'peso chilien', 'peso chileno', 'Peso chileno'],
            ['CNX', 'Chinese People’s Bank Dollar', 'Chinese People’s Bank Dollar', 'Chinese People’s Bank Dollar', 'Dólar do Banco Popular da China'],
            ['CNY', 'Chinese Yuan', 'yuan renminbi chinois', 'yuan', 'Yuan chinês'],
            ['COP', 'Colombian Peso', 'peso colombien', 'peso colombiano', 'Peso colombiano'],
            ['COU', 'Colombian Real Value Unit', 'unité de valeur réelle colombienne', 'unidad de valor real colombiana', 'Unidade de Valor Real'],
            ['CRC', 'Costa Rican Colón', 'colón costaricain', 'colón costarricense', 'Colón costarriquenho'],
            ['CSD', 'Serbian Dinar (2002–2006)', 'dinar serbo-monténégrin', 'antiguo dinar serbio', 'Dinar sérvio (2002–2006)'],
            ['CSK', 'Czechoslovak Hard Koruna', 'couronne forte tchécoslovaque', 'corona fuerte checoslovaca', 'Coroa Forte checoslovaca'],
            ['CUC', 'Cuban Convertible Peso', 'peso cubain convertible', 'peso cubano convertible', 'Peso cubano conversível'],
            ['CUP', 'Cuban Peso', 'peso cubain', 'peso cubano', 'Peso cubano'],
            ['CVE', 'Cape Verdean Escudo', 'escudo capverdien', 'escudo de Cabo Verde', 'Escudo cabo-verdiano'],
            ['CYP', 'Cypriot Pound', 'livre chypriote', 'libra chipriota', 'Libra cipriota'],
            ['CZK', 'Czech Koruna', 'couronne tchèque', 'corona checa', 'Coroa tcheca'],
            ['DDM', 'East German Mark', 'mark est-allemand', 'ostmark de Alemania del Este', 'Ostmark da Alemanha Oriental'],
            ['DEM', 'German Mark', 'mark allemand', 'marco alemán', 'Marco alemão'],
            ['DJF', 'Djiboutian Franc', 'franc djiboutien', 'franco yibutiano', 'Franco djibutiense'],
            ['DKK', 'Danish Krone', 'couronne danoise', 'corona danesa', 'Coroa dinamarquesa'],
            ['DOP', 'Dominican Peso', 'peso dominicain', 'peso dominicano', 'Peso dominicano'],
            ['DZD', 'Algerian Dinar', 'dinar algérien', 'dinar argelino', 'Dinar argelino'],
            ['ECS', 'Ecuadorian Sucre', 'sucre équatorien', 'sucre ecuatoriano', 'Sucre equatoriano'],
            ['ECV', 'Ecuadorian Unit of Constant Value', 'unité de valeur constante équatoriale (UVC)', 'unidad de valor constante (UVC) ecuatoriana', 'Unidade de Valor Constante (UVC) do Equador'],
            ['EEK', 'Estonian Kroon', 'couronne estonienne', 'corona estonia', 'Coroa estoniana'],
            ['EGP', 'Egyptian Pound', 'livre égyptienne', 'libra egipcia', 'Libra egípcia'],
            ['ERN', 'Eritrean Nakfa', 'nafka érythréen', 'nakfa', 'Nakfa da Eritreia'],
            ['ESA', 'Spanish Peseta (A account)', 'peseta espagnole (compte A)', 'peseta española (cuenta A)', 'Peseta espanhola (conta A)'],
            ['ESB', 'Spanish Peseta (convertible account)', 'peseta espagnole (compte convertible)', 'peseta española (cuenta convertible)', 'Peseta espanhola (conta conversível)'],
            ['ESP', 'Spanish Peseta', 'peseta espagnole', 'peseta española', 'Peseta espanhola'],
            ['ETB', 'Ethiopian Birr', 'birr éthiopien', 'bir', 'Birr etíope'],
            ['EUR', 'Euro', 'euro', 'euro', 'Euro'],
            ['FIM', 'Finnish Markka', 'mark finlandais', 'marco finlandés', 'Marca finlandesa'],
            ['FJD', 'Fijian Dollar', 'dollar fidjien', 'dólar fiyiano', 'Dólar fijiano'],
            ['FKP', 'Falkland Islands Pound', 'livre des îles Malouines', 'libra malvinense', 'Libra malvinense'],
            ['FRF', 'French Franc', 'franc français', 'franco francés', 'Franco francês'],
            ['GBP', 'British Pound', 'livre sterling', 'libra británica', 'Libra britânica'],
            ['GEK', 'Georgian Kupon Larit', 'coupon de lari géorgien', 'kupon larit georgiano', 'Cupom Lari georgiano'],
            ['GEL', 'Georgian Lari', 'lari géorgien', 'lari', 'Lari georgiano'],
            ['GHC', 'Ghanaian Cedi (1979–2007)', 'cédi', 'cedi ghanés (1979–2007)', 'Cedi de Gana (1979–2007)'],
            ['GHS', 'Ghanaian Cedi', 'cédi ghanéen', 'cedi', 'Cedi ganês'],
            ['GIP', 'Gibraltar Pound', 'livre de Gibraltar', 'libra gibraltareña', 'Libra de Gibraltar'],
            ['GMD', 'Gambian Dalasi', 'dalasi gambien', 'dalasi', 'Dalasi gambiano'],
            ['GNF', 'Guinean Franc', 'franc guinéen', 'franco guineano', 'Franco guineano'],
            ['GNS', 'Guinean Syli', 'syli guinéen', 'syli guineano', 'Syli da Guiné'],
            ['GQE', 'Equatorial Guinean Ekwele', 'ekwélé équatoguinéen', 'ekuele de Guinea Ecuatorial', 'Ekwele da Guiné Equatorial'],
            ['GRD', 'Greek Drachma', 'drachme grecque', 'dracma griego', 'Dracma grego'],
            ['GTQ', 'Guatemalan Quetzal', 'quetzal guatémaltèque', 'quetzal guatemalteco', 'Quetzal guatemalense'],
            ['GWE', 'Portuguese Guinea Escudo', 'escudo de Guinée portugaise', 'escudo de Guinea Portuguesa', 'Escudo da Guiné Portuguesa'],
            ['GWP', 'Guinea-Bissau Peso', 'peso bissau-guinéen', 'peso de Guinea-Bissáu', 'Peso da Guiné-Bissau'],
            ['GYD', 'Guyanaese Dollar', 'dollar du Guyana', 'dólar guyanés', 'Dólar guianense'],
            ['HKD', 'Hong Kong Dollar', 'dollar de Hong Kong', 'dólar hongkonés', 'Dólar de Hong Kong'],
            ['HNL', 'Honduran Lempira', 'lempira hondurien', 'lempira hondureño', 'Lempira hondurenha'],
            ['HRD', 'Croatian Dinar', 'dinar croate', 'dinar croata', 'Dinar croata'],
            ['HRK', 'Croatian Kuna', 'kuna croate', 'kuna', 'Kuna croata'],
            ['HTG', 'Haitian Gourde', 'gourde haïtienne', 'gourde haitiano', 'Gourde haitiano'],
            ['HUF', 'Hungarian Forint', 'forint hongrois', 'forinto húngaro', 'Forint húngaro'],
            ['IDR', 'Indonesian Rupiah', 'roupie indonésienne', 'rupia indonesia', 'Rupia indonésia'],
            ['IEP', 'Irish Pound', 'livre irlandaise', 'libra irlandesa', 'Libra irlandesa'],
            ['ILP', 'Israeli Pound', 'livre israélienne', 'libra israelí', 'Libra israelita'],
            ['ILR', 'Israeli Shekel (1980–1985)', 'Israeli Shekel (1980–1985)', 'Israeli Shekel (1980–1985)', 'Sheqel antigo israelita'],
            ['ILS', 'Israeli New Shekel', 'nouveau shekel israélien', 'nuevo séquel israelí', 'Sheqel novo israelita'],
            ['INR', 'Indian Rupee', 'roupie indienne', 'rupia india', 'Rupia indiana'],
            ['IQD', 'Iraqi Dinar', 'dinar irakien', 'dinar iraquí', 'Dinar iraquiano'],
            ['IRR', 'Iranian Rial', 'rial iranien', 'rial iraní', 'Rial iraniano'],
            ['ISJ', 'Icelandic Króna (1918–1981)', 'Icelandic Króna (1918–1981)', 'Icelandic Króna (1918–1981)', 'Coroa antiga islandesa'],
            ['ISK', 'Icelandic Króna', 'couronne islandaise', 'corona islandesa', 'Coroa islandesa'],
            ['ITL', 'Italian Lira', 'lire italienne', 'lira italiana', 'Lira italiana'],
            ['JMD', 'Jamaican Dollar', 'dollar jamaïcain', 'dólar jamaicano', 'Dólar jamaicano'],
            ['JOD', 'Jordanian Dinar', 'dinar jordanien', 'dinar jordano', 'Dinar jordaniano'],
            ['JPY', 'Japanese Yen', 'yen japonais', 'yen', 'Iene japonês'],
            ['KES', 'Kenyan Shilling', 'shilling kényan', 'chelín keniano', 'Xelim queniano'],
            ['KGS', 'Kyrgystani Som', 'som kirghize', 'som', 'Som quirguiz'],
            ['KHR', 'Cambodian Riel', 'riel cambodgien', 'riel', 'Riel cambojano'],
            ['KMF', 'Comorian Franc', 'franc comorien', 'franco comorense', 'Franco comorense'],
            ['KPW', 'North Korean Won', 'won nord-coréen', 'won norcoreano', 'Won norte-coreano'],
            ['KRH', 'South Korean Hwan (1953–1962)', 'South Korean Hwan (1953–1962)', 'South Korean Hwan (1953–1962)', 'Hwan da Coreia do Sul (1953–1962)'],
            ['KRO', 'South Korean Won (1945–1953)', 'South Korean Won (1945–1953)', 'South Korean Won (1945–1953)', 'Won da Coreia do Sul (1945–1953)'],
            ['KRW', 'South Korean Won', 'won sud-coréen', 'won surcoreano', 'Won sul-coreano'],
            ['KWD', 'Kuwaiti Dinar', 'dinar koweïtien', 'dinar kuwaití', 'Dinar kuwaitiano'],
            ['KYD', 'Cayman Islands Dollar', 'dollar des îles Caïmans', 'dólar de las Islas Caimán', 'Dólar das Ilhas Caiman'],
            ['KZT', 'Kazakhstani Tenge', 'tenge kazakh', 'tenge kazako', 'Tenge cazaque'],
            ['LAK', 'Laotian Kip', 'kip loatien', 'kip', 'Kip laosiano'],
            ['LBP', 'Lebanese Pound', 'livre libanaise', 'libra libanesa', 'Libra libanesa'],
            ['LKR', 'Sri Lankan Rupee', 'roupie srilankaise', 'rupia esrilanquesa', 'Rupia ceilandesa'],
            ['LRD', 'Liberian Dollar', 'dollar libérien', 'dólar liberiano', 'Dólar liberiano'],
            ['LSL', 'Lesotho Loti', 'loti lesothan', 'loti lesothense', 'Loti do Lesoto'],
            ['LTL', 'Lithuanian Litas', 'litas lituanien', 'litas lituano', 'Litas lituano'],
            ['LTT', 'Lithuanian Talonas', 'talonas lituanien', 'talonas lituano', 'Talonas lituano'],
            ['LUC', 'Luxembourgian Convertible Franc', 'franc convertible luxembourgeois', 'franco convertible luxemburgués', 'Franco conversível de Luxemburgo'],
            ['LUF', 'Luxembourgian Franc', 'franc luxembourgeois', 'franco luxemburgués', 'Franco luxemburguês'],
            ['LUL', 'Luxembourg Financial Franc', 'franc financier luxembourgeois', 'franco financiero luxemburgués', 'Franco financeiro de Luxemburgo'],
            ['LVL', 'Latvian Lats', 'lats letton', 'lats letón', 'Lats letão'],
            ['LVR', 'Latvian Ruble', 'rouble letton', 'rublo letón', 'Rublo letão'],
            ['LYD', 'Libyan Dinar', 'dinar libyen', 'dinar libio', 'Dinar líbio'],
            ['MAD', 'Moroccan Dirham', 'dirham marocain', 'dírham marroquí', 'Dirrã marroquino'],
            ['MAF', 'Moroccan Franc', 'franc marocain', 'franco marroquí', 'Franco marroquino'],
            ['MCF', 'Monegasque Franc', 'Monegasque Franc', 'Monegasque Franc', 'Franco monegasco'],
            ['MDC', 'Moldovan Cupon', 'Moldovan Cupon', 'Moldovan Cupon', 'Cupon moldávio'],
            ['MDL', 'Moldovan Leu', 'leu moldave', 'leu moldavo', 'Leu moldávio'],
            ['MGA', 'Malagasy Ariary', 'ariary malgache', 'ariari', 'Ariary malgaxe'],
            ['MGF', 'Malagasy Franc', 'franc malgache', 'franco malgache', 'Franco de Madagascar'],
            ['MKD', 'Macedonian Denar', 'denar macédonien', 'dinar macedonio', 'Dinar macedônio'],
            ['MKN', 'Macedonian Denar (1992–1993)', 'Macedonian Denar (1992–1993)', 'Macedonian Denar (1992–1993)', 'Dinar macedônio (1992–1993)'],
            ['MLF', 'Malian Franc', 'franc malien', 'franco malí', 'Franco de Mali'],
            ['MMK', 'Myanmar Kyat', 'kyat myanmarais', 'kiat', 'Kyat mianmarense'],
            ['MNT', 'Mongolian Tugrik', 'tugrik mongol', 'tugrik', 'Tugrik mongol'],
            ['MOP', 'Macanese Pataca', 'pataca macanaise', 'pataca de Macao', 'Pataca macaense'],
            ['MRO', 'Mauritanian Ouguiya', 'ouguiya mauritanien', 'uguiya', 'Ouguiya mauritana'],
            ['MTL', 'Maltese Lira', 'lire maltaise', 'lira maltesa', 'Lira maltesa'],
            ['MTP', 'Maltese Pound', 'livre maltaise', 'libra maltesa', 'Libra maltesa'],
            ['MUR', 'Mauritian Rupee', 'roupie mauricienne', 'rupia mauriciana', 'Rupia mauriciana'],
            ['MVP', 'Maldivian Rupee (1947–1981)', 'Maldivian Rupee (1947–1981)', 'Maldivian Rupee (1947–1981)', 'Maldivian Rupee (1947–1981)'],
            ['MVR', 'Maldivian Rufiyaa', 'rufiyaa maldivien', 'rufiya', 'Rupia maldiva'],
            ['MWK', 'Malawian Kwacha', 'kwacha malawite', 'kwacha malauí', 'Kwacha malawiana'],
            ['MXN', 'Mexican Peso', 'peso mexicain', 'peso mexicano', 'Peso mexicano'],
            ['MXP', 'Mexican Silver Peso (1861–1992)', 'peso d’argent mexicain (1861–1992)', 'peso de plata mexicano (1861–1992)', 'Peso Prata mexicano (1861–1992)'],
            ['MXV', 'Mexican Investment Unit', 'unité de conversion mexicaine (UDI)', 'unidad de inversión (UDI) mexicana', 'Unidade Mexicana de Investimento (UDI)'],
            ['MYR', 'Malaysian Ringgit', 'ringgit malais', 'ringit', 'Ringgit malaio'],
            ['MZE', 'Mozambican Escudo', 'escudo mozambicain', 'escudo mozambiqueño', 'Escudo de Moçambique'],
            ['MZM', 'Mozambican Metical (1980–2006)', 'métical', 'antiguo metical mozambiqueño', 'Metical de Moçambique (1980–2006)'],
            ['MZN', 'Mozambican Metical', 'metical mozambicain', 'metical', 'Metical moçambicano'],
            ['NAD', 'Namibian Dollar', 'dollar namibien', 'dólar namibio', 'Dólar namibiano'],
            ['NGN', 'Nigerian Naira', 'naira nigérian', 'naira', 'Naira nigeriana'],
            ['NIC', 'Nicaraguan Córdoba (1988–1991)', 'cordoba', 'córdoba nicaragüense (1988–1991)', 'Córdoba nicaraguense (1988–1991)'],
            ['NIO', 'Nicaraguan Córdoba', 'córdoba oro nicaraguayen', 'córdoba nicaragüense', 'Córdoba nicaraguense'],
            ['NLG', 'Dutch Guilder', 'florin néerlandais', 'florín neerlandés', 'Florim holandês'],
            ['NOK', 'Norwegian Krone', 'couronne norvégienne', 'corona noruega', 'Coroa norueguesa'],
            ['NPR', 'Nepalese Rupee', 'roupie népalaise', 'rupia nepalí', 'Rupia nepalesa'],
            ['NZD', 'New Zealand Dollar', 'dollar néo-zélandais', 'dólar neozelandés', 'Dólar neozelandês'],
            ['OMR', 'Omani Rial', 'rial omanais', 'rial omaní', 'Rial omanense'],
            ['PAB', 'Panamanian Balboa', 'balboa panaméen', 'balboa panameño', 'Balboa panamenha'],
            ['PEI', 'Peruvian Inti', 'inti péruvien', 'inti peruano', 'Inti peruano'],
            ['PEN', 'Peruvian Sol', 'sol péruvien', 'sol peruano', 'Sol peruano'],
            ['PES', 'Peruvian Sol (1863–1965)', 'sol péruvien (1863–1985)', 'sol peruano (1863–1965)', 'Sol peruano (1863–1965)'],
            ['PGK', 'Papua New Guinean Kina', 'kina papouan-néo-guinéen', 'kina', 'Kina papuásia'],
            ['PHP', 'Philippine Peso', 'peso philippin', 'peso filipino', 'Peso filipino'],
            ['PKR', 'Pakistani Rupee', 'roupie pakistanaise', 'rupia pakistaní', 'Rupia paquistanesa'],
            ['PLN', 'Polish Zloty', 'zloty polonais', 'esloti', 'Zloti polonês'],
            ['PLZ', 'Polish Zloty (1950–1995)', 'zloty (1950–1995)', 'zloty polaco (1950–1995)', 'Zloti polonês (1950–1995)'],
            ['PTE', 'Portuguese Escudo', 'escudo portugais', 'escudo portugués', 'Escudo português'],
            ['PYG', 'Paraguayan Guarani', 'guaraní paraguayen', 'guaraní paraguayo', 'Guarani paraguaio'],
            ['QAR', 'Qatari Rial', 'rial qatari', 'rial catarí', 'Rial catariano'],
            ['RHD', 'Rhodesian Dollar', 'dollar rhodésien', 'dólar rodesiano', 'Dólar rodesiano'],
            ['ROL', 'Romanian Leu (1952–2006)', 'ancien leu roumain', 'antiguo leu rumano', 'Leu romeno (1952–2006)'],
            ['RON', 'Romanian Leu', 'leu roumain', 'leu rumano', 'Leu romeno'],
            ['RSD', 'Serbian Dinar', 'dinar serbe', 'dinar serbio', 'Dinar sérvio'],
            ['RUB', 'Russian Ruble', 'rouble russe', 'rublo ruso', 'Rublo russo'],
            ['RUR', 'Russian Ruble (1991–1998)', 'rouble russe (1991–1998)', 'rublo ruso (1991–1998)', 'Rublo russo (1991–1998)'],
            ['RWF', 'Rwandan Franc', 'franc rwandais', 'franco ruandés', 'Franco ruandês'],
            ['SAR', 'Saudi Riyal', 'rial saoudien', 'rial saudí', 'Riyal saudita'],
            ['SBD', 'Solomon Islands Dollar', 'dollar des îles Salomon', 'dólar salomonense', 'Dólar das Ilhas Salomão'],
            ['SCR', 'Seychellois Rupee', 'roupie des Seychelles', 'rupia seychellense', 'Rupia seichelense'],
            ['SDD', 'Sudanese Dinar (1992–2007)', 'dinar soudanais', 'dinar sudanés', 'Dinar sudanês (1992–2007)'],
            ['SDG', 'Sudanese Pound', 'livre soudanaise', 'libra sudanesa', 'Libra sudanesa'],
            ['SDP', 'Sudanese Pound (1957–1998)', 'livre soudanaise (1956–2007)', 'libra sudanesa antigua', 'Libra sudanesa (1957–1998)'],
            ['SEK', 'Swedish Krona', 'couronne suédoise', 'corona sueca', 'Coroa sueca'],
            ['SGD', 'Singapore Dollar', 'dollar de Singapour', 'dólar singapurense', 'Dólar singapuriano'],
            ['SHP', 'St. Helena Pound', 'livre de Sainte-Hélène', 'libra de Santa Elena', 'Libra de Santa Helena'],
            ['SIT', 'Slovenian Tolar', 'tolar slovène', 'tólar esloveno', 'Tolar Bons esloveno'],
            ['SKK', 'Slovak Koruna', 'couronne slovaque', 'corona eslovaca', 'Coroa eslovaca'],
            ['SLL', 'Sierra Leonean Leone', 'leone sierra-léonais', 'leona', 'Leone de Serra Leoa'],
            ['SOS', 'Somali Shilling', 'shilling somalien', 'chelín somalí', 'Xelim somaliano'],
            ['SRD', 'Surinamese Dollar', 'dollar surinamais', 'dólar surinamés', 'Dólar surinamês'],
            ['SRG', 'Surinamese Guilder', 'florin surinamais', 'florín surinamés', 'Florim do Suriname'],
            ['SSP', 'South Sudanese Pound', 'livre sud-soudanaise', 'libra sursudanesa', 'Libra sul-sudanesa'],
            ['STD', 'São Tomé & Príncipe Dobra', 'dobra santoméen', 'dobra', 'Dobra de São Tomé e Príncipe'],
            ['SUR', 'Soviet Rouble', 'rouble soviétique', 'rublo soviético', 'Rublo soviético'],
            ['SVC', 'Salvadoran Colón', 'colón salvadorien', 'colón salvadoreño', 'Colom salvadorenho'],
            ['SYP', 'Syrian Pound', 'livre syrienne', 'libra siria', 'Libra síria'],
            ['SZL', 'Swazi Lilangeni', 'lilangeni swazi', 'lilangeni', 'Lilangeni suazi'],
            ['THB', 'Thai Baht', 'baht thaïlandais', 'bat', 'Baht tailandês'],
            ['TJR', 'Tajikistani Ruble', 'rouble tadjik', 'rublo tayiko', 'Rublo do Tadjiquistão'],
            ['TJS', 'Tajikistani Somoni', 'somoni tadjik', 'somoni tayiko', 'Somoni tadjique'],
            ['TMM', 'Turkmenistani Manat (1993–2009)', 'manat turkmène', 'manat turcomano (1993–2009)', 'Manat do Turcomenistão (1993–2009)'],
            ['TMT', 'Turkmenistani Manat', 'nouveau manat turkmène', 'manat turcomano', 'Manat turcomeno'],
            ['TND', 'Tunisian Dinar', 'dinar tunisien', 'dinar tunecino', 'Dinar tunisiano'],
            ['TOP', 'Tongan Paʻanga', 'pa’anga tongan', 'paanga', 'Paʻanga tonganesa'],
            ['TPE', 'Timorese Escudo', 'escudo timorais', 'escudo timorense', 'Escudo timorense'],
            ['TRL', 'Turkish Lira (1922–2005)', 'livre turque (1844–2005)', 'lira turca (1922–2005)', 'Lira turca (1922–2005)'],
            ['TRY', 'Turkish Lira', 'livre turque', 'lira turca', 'Lira turca'],
            ['TTD', 'Trinidad & Tobago Dollar', 'dollar trinidadien', 'dólar de Trinidad y Tobago', 'Dólar de Trinidad e Tobago'],
            ['TWD', 'New Taiwan Dollar', 'nouveau dollar taïwanais', 'nuevo dólar taiwanés', 'Novo dólar taiwanês'],
            ['TZS', 'Tanzanian Shilling', 'shilling tanzanien', 'chelín tanzano', 'Xelim tanzaniano'],
            ['UAH', 'Ukrainian Hryvnia', 'hryvnia ukrainienne', 'grivna', 'Hryvnia ucraniano'],
            ['UAK', 'Ukrainian Karbovanets', 'karbovanetz', 'karbovanet ucraniano', 'Karbovanetz ucraniano'],
            ['UGS', 'Ugandan Shilling (1966–1987)', 'shilling ougandais (1966–1987)', 'chelín ugandés (1966–1987)', 'Xelim ugandense (1966–1987)'],
            ['UGX', 'Ugandan Shilling', 'shilling ougandais', 'chelín ugandés', 'Xelim ugandense'],
            ['USD', 'US Dollar', 'dollar des États-Unis', 'dólar estadounidense', 'Dólar americano'],
            ['USN', 'US Dollar (Next day)', 'dollar des Etats-Unis (jour suivant)', 'dólar estadounidense (día siguiente)', 'Dólar norte-americano (Dia seguinte)'],
            ['USS', 'US Dollar (Same day)', 'dollar des Etats-Unis (jour même)', 'dólar estadounidense (mismo día)', 'Dólar norte-americano (Mesmo dia)'],
            ['UYI', 'Uruguayan Peso (Indexed Units)', 'peso uruguayen (unités indexées)', 'peso uruguayo en unidades indexadas', 'Peso uruguaio en unidades indexadas'],
            ['UYP', 'Uruguayan Peso (1975–1993)', 'peso uruguayen (1975–1993)', 'peso uruguayo (1975–1993)', 'Peso uruguaio (1975–1993)'],
            ['UYU', 'Uruguayan Peso', 'peso uruguayen', 'peso uruguayo', 'Peso uruguaio'],
            ['UZS', 'Uzbekistani Som', 'sum ouzbek', 'sum', 'Som uzbeque'],
            ['VEB', 'Venezuelan Bolívar (1871–2008)', 'bolivar vénézuélien (1871–2008)', 'bolívar venezolano (1871–2008)', 'Bolívar venezuelano (1871–2008)'],
            ['VEF', 'Venezuelan Bolívar', 'bolivar vénézuélien', 'bolívar venezolano', 'Bolívar venezuelano'],
            ['VND', 'Vietnamese Dong', 'dông vietnamien', 'dong', 'Dong vietnamita'],
            ['VNN', 'Vietnamese Dong (1978–1985)', 'Vietnamese Dong (1978–1985)', 'Vietnamese Dong (1978–1985)', 'Dong vietnamita (1978–1985)'],
            ['VUV', 'Vanuatu Vatu', 'vatu vanuatuan', 'vatu', 'Vatu vanuatuense'],
            ['WST', 'Samoan Tala', 'tala samoan', 'tala', 'Tala samoano'],
            ['XAF', 'Central African CFA Franc', 'franc CFA (BEAC)', 'franco CFA BEAC', 'Franco CFA de BEAC'],
            ['XCD', 'East Caribbean Dollar', 'dollar des Caraïbes orientales', 'dólar del Caribe Oriental', 'Dólar do Caribe Oriental'],
            ['XEU', 'European Currency Unit', 'unité de compte européenne (ECU)', 'unidad de moneda europea', 'Unidade de Moeda Europeia'],
            ['XFO', 'French Gold Franc', 'franc or', 'franco oro francés', 'Franco-ouro francês'],
            ['XFU', 'French UIC-Franc', 'franc UIC', 'franco UIC francés', 'Franco UIC francês'],
            ['XOF', 'West African CFA Franc', 'franc CFA (BCEAO)', 'franco CFA BCEAO', 'Franco CFA de BCEAO'],
            ['XPF', 'CFP Franc', 'franc CFP', 'franco CFP', 'Franco CFP'],
            ['XRE', 'RINET Funds', 'type de fonds RINET', 'fondos RINET', 'Fundos RINET'],
            ['YDD', 'Yemeni Dinar', 'dinar du Yémen', 'dinar yemení', 'Dinar iemenita'],
            ['YER', 'Yemeni Rial', 'rial yéménite', 'rial yemení', 'Rial iemenita'],
            ['YUD', 'Yugoslavian Hard Dinar (1966–1990)', 'nouveau dinar yougoslave', 'dinar fuerte yugoslavo', 'Dinar forte iugoslavo (1966–1990)'],
            ['YUM', 'Yugoslavian New Dinar (1994–2002)', 'dinar yougoslave Noviy', 'super dinar yugoslavo', 'Dinar noviy iugoslavo (1994–2002)'],
            ['YUN', 'Yugoslavian Convertible Dinar (1990–1992)', 'dinar yougoslave convertible', 'dinar convertible yugoslavo', 'Dinar conversível iugoslavo (1990–1992)'],
            ['YUR', 'Yugoslavian Reformed Dinar (1992–1993)', 'Yugoslavian Reformed Dinar (1992–1993)', 'Yugoslavian Reformed Dinar (1992–1993)', 'Dinar reformado iugoslavo (1992–1993)'],
            ['ZAL', 'South African Rand (financial)', 'rand sud-africain (financier)', 'rand sudafricano (financiero)', 'Rand sul-africano (financeiro)'],
            ['ZAR', 'South African Rand', 'rand sud-africain', 'rand', 'Rand sul-africano'],
            ['ZMK', 'Zambian Kwacha (1968–2012)', 'kwacha zambien (1968–2012)', 'kwacha zambiano (1968–2012)', 'Cuacha zambiano (1968–2012)'],
            ['ZMW', 'Zambian Kwacha', 'kwacha zambien', 'kuacha zambiano', 'Kwacha zambiano'],
            ['ZRN', 'Zairean New Zaire (1993–1998)', 'nouveau zaïre zaïrien', 'nuevo zaire zaireño', 'Zaire Novo zairense (1993–1998)'],
            ['ZRZ', 'Zairean Zaire (1971–1993)', 'zaïre zaïrois', 'zaire zaireño', 'Zaire zairense (1971–1993)'],
            ['ZWD', 'Zimbabwean Dollar (1980–2008)', 'dollar zimbabwéen', 'dólar de Zimbabue', 'Dólar do Zimbábue (1980–2008)'],
            ['ZWL', 'Zimbabwean Dollar (2009)', 'dollar zimbabwéen (2009)', 'dólar zimbabuense', 'Dólar do Zimbábue (2009)'],
            ['ZWR', 'Zimbabwean Dollar (2008)', 'dollar zimbabwéen (2008)', 'Zimbabwean Dollar (2008)', 'Dólar do Zimbábue (2008)'],
        ];

        foreach ($records as $record) {
            DB::table('imet_currencies')
                ->insert(array_combine($fields, $record));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('imet_currencies')->truncate();
    }
};
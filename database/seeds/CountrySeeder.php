<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [ "country_iso_code"=>4,"name"=> "Afghanistan", "code"=> "af","code_long"=> "AFG","calling_code"=> 93,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>8,"name"=> "Albania", "code"=> "al","code_long"=> "ALB","calling_code"=> 355,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>12,"name"=> "Algeria", "code"=> "dz","code_long"=> "DZA","calling_code"=> 213,"continent"=> "AF","mena"=> 1],
            [ "country_iso_code"=>16,"name"=> "American Samoa", "code"=> "as","code_long"=> "ASM","calling_code"=> 1684,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>20,"name"=> "Andorra", "code"=> "ad","code_long"=> "AND","calling_code"=> 376,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>24,"name"=> "Angola", "code"=> "ao","code_long"=> "AGO","calling_code"=> 244,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>28,"name"=> "Antigua And Barbuda", "code"=> "ag","code_long"=> "ATG","calling_code"=> 1268,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>31,"name"=> "Azerbaijan", "code"=> "az","code_long"=> "AZE","calling_code"=> 994,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>32,"name"=> "Argentina", "code"=> "ar","code_long"=> "ARG","calling_code"=> 54,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>36,"name"=> "Australia", "code"=> "au","code_long"=> "AUS","calling_code"=> 61,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>40,"name"=> "Austria", "code"=> "at","code_long"=> "AUT","calling_code"=> 43,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>44,"name"=> "Bahamas", "code"=> "bs","code_long"=> "BHS","calling_code"=> 1242,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>48,"name"=> "Bahrain", "code"=> "bh","code_long"=> "BHR","calling_code"=> 973,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>50,"name"=> "Bangladesh", "code"=> "bd","code_long"=> "BGD","calling_code"=> 880,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>51,"name"=> "Armenia", "code"=> "am","code_long"=> "ARM","calling_code"=> 374,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>52,"name"=> "Barbados", "code"=> "bb","code_long"=> "BRB","calling_code"=> 1246,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>56,"name"=> "Belgium", "code"=> "be","code_long"=> "BEL","calling_code"=> 32,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>60,"name"=> "Bermuda", "code"=> "bm","code_long"=> "BMU","calling_code"=> 1441,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>64,"name"=> "Bhutan", "code"=> "bt","code_long"=> "BTN","calling_code"=> 975,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>68,"name"=> "Bolivia", "code"=> "bo","code_long"=> "BOL","calling_code"=> 591,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>70,"name"=> "Bosnia And Herzegovina", "code"=> "ba","code_long"=> "BIH","calling_code"=> 387,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>72,"name"=> "Botswana", "code"=> "bw","code_long"=> "BWA","calling_code"=> 267,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>76,"name"=> "Brazil", "code"=> "br","code_long"=> "BRA","calling_code"=> 55,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>84,"name"=> "Belize", "code"=> "bz","code_long"=> "BLZ","calling_code"=> 501,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>90,"name"=> "Solomon Islands", "code"=> "sb","code_long"=> "SLB","calling_code"=> 677,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>92,"name"=> "Virgin Islands", "code"=> "vg","code_long"=> "VGB","calling_code"=> 1284,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>96,"name"=> "Brunei", "code"=> "bn","code_long"=> "BRN","calling_code"=> 673,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>100,"name"=> "Bulgaria", "code"=> "bg","code_long"=> "BGR","calling_code"=> 359,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>104,"name"=> "Burma", "code"=> "mm","code_long"=> "MMR","calling_code"=> 95,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>108,"name"=> "Burundi", "code"=> "bi","code_long"=> "BDI","calling_code"=> 257,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>112,"name"=> "Belarus", "code"=> "by","code_long"=> "BLR","calling_code"=> 375,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>116,"name"=> "Cambodia", "code"=> "kh","code_long"=> "KHM","calling_code"=> 855,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>120,"name"=> "Cameroon", "code"=> "cm","code_long"=> "CMR","calling_code"=> 237,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>124,"name"=> "Canada", "code"=> "ca","code_long"=> "CAN","calling_code"=> 1,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>132,"name"=> "Cabo Verde", "code"=> "cv","code_long"=> "CPV","calling_code"=> 238,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>136,"name"=> "Cayman Islands", "code"=> "ky","code_long"=> "CYM","calling_code"=> 1345,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>140,"name"=> "Central African Republic", "code"=> "cf","code_long"=> "CAF","calling_code"=> 236,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>144,"name"=> "Sri Lanka", "code"=> "lk","code_long"=> "LKA","calling_code"=> 94,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>148,"name"=> "Chad", "code"=> "td","code_long"=> "TCD","calling_code"=> 235,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>152,"name"=> "Chile", "code"=> "cl","code_long"=> "CHL","calling_code"=> 56,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>156,"name"=> "China", "code"=> "cn","code_long"=> "CHN","calling_code"=> 86,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>158,"name"=> "Taiwan", "code"=> "tw","code_long"=> "TWN","calling_code"=> 886,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>162,"name"=> "Christmas Island", "code"=> "cx","code_long"=> "CXR","calling_code"=> 61,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>170,"name"=> "Colombia", "code"=> "co","code_long"=> "COL","calling_code"=> 57,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>174,"name"=> "Comoros", "code"=> "km","code_long"=> "COM","calling_code"=> 269,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>175,"name"=> "Mayotte", "code"=> "yt","code_long"=> "MYT","calling_code"=> 262,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>178,"name"=> "Congo (Brazzaville)", "code"=> "cg","code_long"=> "COG","calling_code"=> 242,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>180,"name"=> "Congo (Kinshasa)", "code"=> "cd","code_long"=> "COD","calling_code"=> 243,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>184,"name"=> "Cook Islands", "code"=> "ck","code_long"=> "COK","calling_code"=> 682,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>188,"name"=> "Costa Rica", "code"=> "cr","code_long"=> "CRI","calling_code"=> 506,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>191,"name"=> "Croatia", "code"=> "hr","code_long"=> "HRV","calling_code"=> 385,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>192,"name"=> "Cuba", "code"=> "cu","code_long"=> "CUB","calling_code"=> 53,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>196,"name"=> "Cyprus", "code"=> "cy","code_long"=> "CYP","calling_code"=> 357,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>203,"name"=> "Czechia", "code"=> "cz","code_long"=> "CZE","calling_code"=> 420,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>204,"name"=> "Benin", "code"=> "bj","code_long"=> "BEN","calling_code"=> 229,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>208,"name"=> "Denmark", "code"=> "dk","code_long"=> "DNK","calling_code"=> 45,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>212,"name"=> "Dominica", "code"=> "dm","code_long"=> "DMA","calling_code"=> 1767,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>214,"name"=> "Dominican Republic", "code"=> "do","code_long"=> "DOM","calling_code"=> 1809,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>218,"name"=> "Ecuador", "code"=> "ec","code_long"=> "ECU","calling_code"=> 593,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>222,"name"=> "El Salvador", "code"=> "sv","code_long"=> "SLV","calling_code"=> 503,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>226,"name"=> "Equatorial Guinea", "code"=> "gq","code_long"=> "GNQ","calling_code"=> 240,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>231,"name"=> "Ethiopia", "code"=> "et","code_long"=> "ETH","calling_code"=> 251,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>232,"name"=> "Eritrea", "code"=> "er","code_long"=> "ERI","calling_code"=> 291,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>233,"name"=> "Estonia", "code"=> "ee","code_long"=> "EST","calling_code"=> 372,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>234,"name"=> "Faroe Islands", "code"=> "fo","code_long"=> "FRO","calling_code"=> 298,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>238,"name"=> "Falkland Islands (Islas Malvinas)", "code"=> "fk","code_long"=> "FLK","calling_code"=> 500,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>239,"name"=> "South Georgia And South Sandwich Islands", "code"=> "gs","code_long"=> "SGS","calling_code"=> 500,"continent"=> "AN","mena"=> 0],
            [ "country_iso_code"=>242,"name"=> "Fiji", "code"=> "fj","code_long"=> "FJI","calling_code"=> 679,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>246,"name"=> "Finland", "code"=> "fi","code_long"=> "FIN","calling_code"=> 358,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>250,"name"=> "France", "code"=> "fr","code_long"=> "FRA","calling_code"=> 33,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>254,"name"=> "French Guiana", "code"=> "gf","code_long"=> "GUF","calling_code"=> 594,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>258,"name"=> "French Polynesia", "code"=> "pf","code_long"=> "PYF","calling_code"=> 689,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>262,"name"=> "Djibouti", "code"=> "dj","code_long"=> "DJI","calling_code"=> 253,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>266,"name"=> "Gabon", "code"=> "ga","code_long"=> "GAB","calling_code"=> 241,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>268,"name"=> "Georgia", "code"=> "ge","code_long"=> "GEO","calling_code"=> 995,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>270,"name"=> "Gambia, The", "code"=> "gm","code_long"=> "GMB","calling_code"=> 220,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>275,"name"=> "State of Palestine", "code"=> "ps","code_long"=> "PSE","calling_code"=> 970,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>276,"name"=> "Germany", "code"=> "de","code_long"=> "DEU","calling_code"=> 49,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>288,"name"=> "Ghana", "code"=> "gh","code_long"=> "GHA","calling_code"=> 233,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>292,"name"=> "Gibraltar", "code"=> "gi","code_long"=> "GIB","calling_code"=> 350,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>296,"name"=> "Kiribati", "code"=> "ki","code_long"=> "KIR","calling_code"=> 686,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>300,"name"=> "Greece", "code"=> "gr","code_long"=> "GRC","calling_code"=> 30,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>304,"name"=> "Greenland", "code"=> "gl","code_long"=> "GRL","calling_code"=> 299,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>308,"name"=> "Grenada", "code"=> "gd","code_long"=> "GRD","calling_code"=> 1473,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>312,"name"=> "Guadeloupe", "code"=> "gp","code_long"=> "GLP","calling_code"=> 590,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>316,"name"=> "Guam", "code"=> "gu","code_long"=> "GUM","calling_code"=> 1671,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>320,"name"=> "Guatemala", "code"=> "gt","code_long"=> "GTM","calling_code"=> 502,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>324,"name"=> "Guinea", "code"=> "gn","code_long"=> "GIN","calling_code"=> 224,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>328,"name"=> "Guyana", "code"=> "gy","code_long"=> "GUY","calling_code"=> 592,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>332,"name"=> "Haiti", "code"=> "ht","code_long"=> "HTI","calling_code"=> 509,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>340,"name"=> "Honduras", "code"=> "hn","code_long"=> "HND","calling_code"=> 504,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>348,"name"=> "Hungary", "code"=> "hu","code_long"=> "HUN","calling_code"=> 36,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>352,"name"=> "Iceland", "code"=> "is","code_long"=> "ISL","calling_code"=> 354,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>356,"name"=> "India", "code"=> "in","code_long"=> "IND","calling_code"=> 91,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>360,"name"=> "Indonesia", "code"=> "id","code_long"=> "IDN","calling_code"=> 62,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>364,"name"=> "Iran", "code"=> "ir","code_long"=> "IRN","calling_code"=> 98,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>368,"name"=> "Iraq", "code"=> "iq","code_long"=> "IRQ","calling_code"=> 964,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>372,"name"=> "Ireland", "code"=> "ie","code_long"=> "IRL","calling_code"=> 353,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>376,"name"=> "Israel", "code"=> "il","code_long"=> "ISR","calling_code"=> 972,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>380,"name"=> "Italy", "code"=> "it","code_long"=> "ITA","calling_code"=> 39,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>384,"name"=> "Côte D’Ivoire", "code"=> "ci","code_long"=> "CIV","calling_code"=> 225,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>388,"name"=> "Jamaica", "code"=> "jm","code_long"=> "JAM","calling_code"=> 1876,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>392,"name"=> "Japan", "code"=> "jp","code_long"=> "JPN","calling_code"=> 81,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>398,"name"=> "Kazakhstan", "code"=> "kz","code_long"=> "KAZ","calling_code"=> 7,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>400,"name"=> "Jordan", "code"=> "jo","code_long"=> "JOR","calling_code"=> 962,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>404,"name"=> "Kenya", "code"=> "ke","code_long"=> "KEN","calling_code"=> 254,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>408,"name"=> "Democratic People's Republic of Korea", "code"=> "kp","code_long"=> "PRK","calling_code"=> 850,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>410,"name"=> "Korea, South", "code"=> "kr","code_long"=> "KOR","calling_code"=> 82,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>414,"name"=> "Kuwait", "code"=> "kw","code_long"=> "KWT","calling_code"=> 965,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>417,"name"=> "Kyrgyzstan", "code"=> "kg","code_long"=> "KGZ","calling_code"=> 996,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>418,"name"=> "Lao People's Democratic Republic", "code"=> "la","code_long"=> "LAO","calling_code"=> 856,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>422,"name"=> "Lebanon", "code"=> "lb","code_long"=> "LBN","calling_code"=> 961,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>426,"name"=> "Lesotho", "code"=> "ls","code_long"=> "LSO","calling_code"=> 266,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>428,"name"=> "Latvia", "code"=> "lv","code_long"=> "LVA","calling_code"=> 371,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>430,"name"=> "Liberia", "code"=> "lr","code_long"=> "LBR","calling_code"=> 231,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>434,"name"=> "Libya", "code"=> "ly","code_long"=> "LBY","calling_code"=> 218,"continent"=> "AF","mena"=> 1],
            [ "country_iso_code"=>438,"name"=> "Liechtenstein", "code"=> "li","code_long"=> "LIE","calling_code"=> 423,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>440,"name"=> "Lithuania", "code"=> "lt","code_long"=> "LTU","calling_code"=> 370,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>442,"name"=> "Luxembourg", "code"=> "lu","code_long"=> "LUX","calling_code"=> 352,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>450,"name"=> "Madagascar", "code"=> "mg","code_long"=> "MDG","calling_code"=> 261,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>454,"name"=> "Malawi", "code"=> "mw","code_long"=> "MWI","calling_code"=> 265,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>458,"name"=> "Malaysia", "code"=> "my","code_long"=> "MYS","calling_code"=> 60,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>462,"name"=> "Maldives", "code"=> "mv","code_long"=> "MDV","calling_code"=> 960,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>466,"name"=> "Mali", "code"=> "ml","code_long"=> "MLI","calling_code"=> 223,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>470,"name"=> "Malta", "code"=> "mt","code_long"=> "MLT","calling_code"=> 356,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>474,"name"=> "Martinique", "code"=> "mq","code_long"=> "MTQ","calling_code"=> 596,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>478,"name"=> "Mauritania", "code"=> "mr","code_long"=> "MRT","calling_code"=> 222,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>480,"name"=> "Mauritius", "code"=> "mu","code_long"=> "MUS","calling_code"=> 230,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>484,"name"=> "Mexico", "code"=> "mx","code_long"=> "MEX","calling_code"=> 52,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>492,"name"=> "Monaco", "code"=> "mc","code_long"=> "MCO","calling_code"=> 377,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>496,"name"=> "Mongolia", "code"=> "mn","code_long"=> "MNG","calling_code"=> 976,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>498,"name"=> "Republic of Moldova", "code"=> "md","code_long"=> "MDA","calling_code"=> 373,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>499,"name"=> "Montenegro", "code"=> "me","code_long"=> "MNE","calling_code"=> 382,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>500,"name"=> "Montserrat", "code"=> "ms","code_long"=> "MSR","calling_code"=> 1664,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>504,"name"=> "Morocco", "code"=> "ma","code_long"=> "MAR","calling_code"=> 212,"continent"=> "AF","mena"=> 1],
            [ "country_iso_code"=>508,"name"=> "Mozambique", "code"=> "mz","code_long"=> "MOZ","calling_code"=> 258,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>512,"name"=> "Oman", "code"=> "om","code_long"=> "OMN","calling_code"=> 968,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>516,"name"=> "Namibia", "code"=> "","code_long"=> "NAM","calling_code"=> 264,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>524,"name"=> "Nepal", "code"=> "np","code_long"=> "NPL","calling_code"=> 977,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>528,"name"=> "Netherlands", "code"=> "nl","code_long"=> "NLD","calling_code"=> 31,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>531,"name"=> "Curaçao", "code"=> "cw","code_long"=> "CUW","calling_code"=> 599,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>533,"name"=> "Aruba", "code"=> "aw","code_long"=> "ABW","calling_code"=> 297,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>534,"name"=> "Sint Maarten", "code"=> "sx","code_long"=> "SXM","calling_code"=> 599,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>540,"name"=> "New Caledonia", "code"=> "nc","code_long"=> "NCL","calling_code"=> 687,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>548,"name"=> "Vanuatu", "code"=> "vu","code_long"=> "VUT","calling_code"=> 678,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>554,"name"=> "New Zealand", "code"=> "nz","code_long"=> "NZL","calling_code"=> 64,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>558,"name"=> "Nicaragua", "code"=> "ni","code_long"=> "NIC","calling_code"=> 505,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>562,"name"=> "Niger", "code"=> "ne","code_long"=> "NER","calling_code"=> 227,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>566,"name"=> "Nigeria", "code"=> "ng","code_long"=> "NGA","calling_code"=> 234,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>570,"name"=> "Niue", "code"=> "nu","code_long"=> "NIU","calling_code"=> 683,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>574,"name"=> "Norfolk Island", "code"=> "nf","code_long"=> "NFK","calling_code"=> 6723,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>578,"name"=> "Norway", "code"=> "no","code_long"=> "NOR","calling_code"=> 47,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>580,"name"=> "Northern Mariana Islands", "code"=> "mp","code_long"=> "MNP","calling_code"=> 1670,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>583,"name"=> "Federated States of Micronesia", "code"=> "fm","code_long"=> "FSM","calling_code"=> 691,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>584,"name"=> "Marshall Islands", "code"=> "mh","code_long"=> "MHL","calling_code"=> 692,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>585,"name"=> "Palau", "code"=> "pw","code_long"=> "PLW","calling_code"=> 680,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>586,"name"=> "Pakistan", "code"=> "pk","code_long"=> "PAK","calling_code"=> 92,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>591,"name"=> "Panama", "code"=> "pa","code_long"=> "PAN","calling_code"=> 507,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>598,"name"=> "Papua New Guinea", "code"=> "pg","code_long"=> "PNG","calling_code"=> 675,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>600,"name"=> "Paraguay", "code"=> "py","code_long"=> "PRY","calling_code"=> 595,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>604,"name"=> "Peru", "code"=> "pe","code_long"=> "PER","calling_code"=> 51,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>608,"name"=> "Philippines", "code"=> "ph","code_long"=> "PHL","calling_code"=> 63,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>612,"name"=> "Pitcairn Islands", "code"=> "pn","code_long"=> "PCN","calling_code"=> 64,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>616,"name"=> "Poland", "code"=> "pl","code_long"=> "POL","calling_code"=> 48,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>620,"name"=> "Portugal", "code"=> "pt","code_long"=> "PRT","calling_code"=> 351,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>624,"name"=> "Guinea-Bissau", "code"=> "gw","code_long"=> "GNB","calling_code"=> 675,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>626,"name"=> "Timor-Leste", "code"=> "tl","code_long"=> "TLS","calling_code"=> 670,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>634,"name"=> "Qatar", "code"=> "qa","code_long"=> "QAT","calling_code"=> 974,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>638,"name"=> "Reunion", "code"=> "re","code_long"=> "REU","calling_code"=> 262,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>642,"name"=> "Romania", "code"=> "ro","code_long"=> "ROU","calling_code"=> 40,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>643,"name"=> "Russian Federation", "code"=> "ru","code_long"=> "RUS","calling_code"=> 7,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>646,"name"=> "Rwanda", "code"=> "rw","code_long"=> "RWA","calling_code"=> 250,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>652,"name"=> "Saint Barthelemy", "code"=> "bl","code_long"=> "BLM","calling_code"=> 590,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>654,"name"=> "Saint Helena, Ascension, And Tristan Da Cunha", "code"=> "sh","code_long"=> "SHN","calling_code"=> 290,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>659,"name"=> "Saint Kitts And Nevis", "code"=> "kn","code_long"=> "KNA","calling_code"=> 1869,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>660,"name"=> "Anguilla", "code"=> "ai","code_long"=> "AIA","calling_code"=> 1264,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>662,"name"=> "Saint Lucia", "code"=> "lc","code_long"=> "LCA","calling_code"=> 1758,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>663,"name"=> "Saint Martin", "code"=> "mf","code_long"=> "MAF","calling_code"=> 590,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>666,"name"=> "Saint Pierre And Miquelon", "code"=> "pm","code_long"=> "SPM","calling_code"=> 508,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>670,"name"=> "Saint Vincent And The Grenadines", "code"=> "vc","code_long"=> "VCT","calling_code"=> 1784,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>674,"name"=> "San Marino", "code"=> "sm","code_long"=> "SMR","calling_code"=> 378,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>678,"name"=> "Sao Tome And Principe", "code"=> "st","code_long"=> "STP","calling_code"=> 239,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>682,"name"=> "Saudi Arabia", "code"=> "sa","code_long"=> "SAU","calling_code"=> 966,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>686,"name"=> "Senegal", "code"=> "sn","code_long"=> "SEN","calling_code"=> 221,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>688,"name"=> "Serbia", "code"=> "rs","code_long"=> "SRB","calling_code"=> 381,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>690,"name"=> "Seychelles", "code"=> "sc","code_long"=> "SYC","calling_code"=> 248,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>694,"name"=> "Sierra Leone", "code"=> "sl","code_long"=> "SLE","calling_code"=> 232,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>702,"name"=> "Singapore", "code"=> "sg","code_long"=> "SGP","calling_code"=> 65,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>703,"name"=> "Slovakia", "code"=> "sk","code_long"=> "SVK","calling_code"=> 421,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>704,"name"=> "Vietnam", "code"=> "vn","code_long"=> "VNM","calling_code"=> 84,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>705,"name"=> "Slovenia", "code"=> "si","code_long"=> "SVN","calling_code"=> 386,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>706,"name"=> "Somalia", "code"=> "so","code_long"=> "SOM","calling_code"=> 252,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>710,"name"=> "South Africa", "code"=> "za","code_long"=> "ZAF","calling_code"=> 27,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>716,"name"=> "Zimbabwe", "code"=> "zw","code_long"=> "ZWE","calling_code"=> 263,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>724,"name"=> "Spain", "code"=> "es","code_long"=> "ESP","calling_code"=> 34,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>728,"name"=> "South Sudan", "code"=> "ss","code_long"=> "SSD","calling_code"=> 211,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>729,"name"=> "Sudan", "code"=> "sd","code_long"=> "SDN","calling_code"=> 249,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>740,"name"=> "Suriname", "code"=> "sr","code_long"=> "SUR","calling_code"=> 597,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>748,"name"=> "Swaziland", "code"=> "sz","code_long"=> "SWZ","calling_code"=> 268,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>752,"name"=> "Sweden", "code"=> "se","code_long"=> "SWE","calling_code"=> 46,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>756,"name"=> "Switzerland", "code"=> "ch","code_long"=> "CHE","calling_code"=> 41,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>760,"name"=> "Syrian Arab Rebublic", "code"=> "sy","code_long"=> "SYR","calling_code"=> 963,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>762,"name"=> "Tajikistan", "code"=> "tj","code_long"=> "TJK","calling_code"=> 992,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>764,"name"=> "Thailand", "code"=> "th","code_long"=> "THA","calling_code"=> 66,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>768,"name"=> "Togo", "code"=> "tg","code_long"=> "TGO","calling_code"=> 228,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>776,"name"=> "Tonga", "code"=> "to","code_long"=> "TON","calling_code"=> 676,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>780,"name"=> "Trinidad And Tobago", "code"=> "tt","code_long"=> "TTO","calling_code"=> 868,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>784,"name"=> "United Arab Emirates", "code"=> "ae","code_long"=> "ARE","calling_code"=> 971,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>788,"name"=> "Tunisia", "code"=> "tn","code_long"=> "TUN","calling_code"=> 216,"continent"=> "AF","mena"=> 1],
            [ "country_iso_code"=>792,"name"=> "Turkey", "code"=> "tr","code_long"=> "TUR","calling_code"=> 90,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>795,"name"=> "Turkmenistan", "code"=> "tm","code_long"=> "TKM","calling_code"=> 993,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>796,"name"=> "Turks And Caicos Islands", "code"=> "tc","code_long"=> "TCA","calling_code"=> 1,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>798,"name"=> "Tuvalu", "code"=> "tv","code_long"=> "TUV","calling_code"=> 688,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>800,"name"=> "Uganda", "code"=> "ug","code_long"=> "UGA","calling_code"=> 256,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>804,"name"=> "Ukraine", "code"=> "ua","code_long"=> "UKR","calling_code"=> 380,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>807,"name"=> "North Macedonia", "code"=> "mk","code_long"=> "MKD","calling_code"=> 389,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>818,"name"=> "Egypt", "code"=> "eg","code_long"=> "EGY","calling_code"=> 20,"continent"=> "AF","mena"=> 1],
            [ "country_iso_code"=>826,"name"=> "United Kingdom of Great Britain and Northern Ireland", "code"=> "gb","code_long"=> "GBR","calling_code"=> 44,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>831,"name"=> "Guernsey", "code"=> "gg","code_long"=> "GGY","calling_code"=> 44,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>832,"name"=> "Jersey", "code"=> "je","code_long"=> "JEY","calling_code"=> 44,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>833,"name"=> "Isle Of Man", "code"=> "im","code_long"=> "IMN","calling_code"=> 44,"continent"=> "EU","mena"=> 0],
            [ "country_iso_code"=>834,"name"=> "United Republic of Tanzania", "code"=> "tz","code_long"=> "TZA","calling_code"=> 255,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>840,"name"=> "United States of America", "code"=> "us","code_long"=> "USA","calling_code"=> 1,"continent"=> "","mena"=> 0],
            [ "country_iso_code"=>854,"name"=> "Burkina Faso", "code"=> "bf","code_long"=> "BFA","calling_code"=> 226,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>858,"name"=> "Uruguay", "code"=> "uy","code_long"=> "URY","calling_code"=> 598,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>860,"name"=> "Uzbekistan", "code"=> "uz","code_long"=> "UZB","calling_code"=> 998,"continent"=> "AS","mena"=> 0],
            [ "country_iso_code"=>862,"name"=> "Venezuela (Bolivarian Republic of)", "code"=> "ve","code_long"=> "VEN","calling_code"=> 58,"continent"=> "SA","mena"=> 0],
            [ "country_iso_code"=>876,"name"=> "Wallis And Futuna", "code"=> "wf","code_long"=> "WLF","calling_code"=> 681,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>882,"name"=> "Samoa", "code"=> "ws","code_long"=> "WSM","calling_code"=> 685,"continent"=> "OC","mena"=> 0],
            [ "country_iso_code"=>887,"name"=> "Yemen", "code"=> "ye","code_long"=> "YEM","calling_code"=> 967,"continent"=> "AS","mena"=> 1],
            [ "country_iso_code"=>894,"name"=> "Zambia", "code"=> "zm","code_long"=> "ZMB","calling_code"=> 260,"continent"=> "AF","mena"=> 0],
            [ "country_iso_code"=>999,"name"=> "Kosovo", "code"=> "xk","code_long"=> "XKS","calling_code"=> 383,"continent"=> "","mena"=> 0]
        ];
        DB::table('countries')->insert($countries);
    }
}


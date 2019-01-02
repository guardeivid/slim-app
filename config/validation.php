<?php

//Without translate
//$config['translator'] = null;

//With translate a Spain
$config['translator'] = function($message)
{
    $messages = [
        //allOf(Validatable ...$rule)
        'All of the required rules must pass for {{name}}' => 'Todas las reglas deben pasar para {{name}}',
        'These rules must pass for {{name}}' => 'Estas reglas deben pasar para {{name}}',
        'None of these rules must pass for {{name}}' => 'Ninguna de éstas reglas deben pasar para {{name}}',
        'These rules must not pass for {{name}}' => 'Estas reglas no deben pasar para {{name}}',

        //age(int $minAge = null, int $maxAge = null)
        '{{name}} must be between {{minAge}} and {{maxAge}} years ago' => '{{name}} debe estar entre {{minAge}} y {{maxAge}} años atrás',
        '{{name}} must be lower than {{minAge}} years ago' => '{{name}} debe ser menor que {{minAge}} años atrás',
        '{{name}} must be greater than {{maxAge}} years ago' => '{{name}} debe ser mayor que {{maxAge}} años atrás',
        '{{name}} must not be between {{minAge}} and {{maxAge}} years ago' => '{{name}} no debe estar entre {{minAge}} and {{maxAge}} años atrás',
        '{{name}} must not be lower than {{minAge}} years ago' => '{{name}} no debe ser menor que {{minAge}} años atrás',
        '{{name}} must not be greater than {{maxAge}} years ago' => '{{name}} no debe ser mayor que {{maxAge}} años atrás',

        "{{name}} must be greater than {{interval}}" =>
        "{{name}} debe ser mayor que {{interval}}",
        "{{name}} must be greater than or equal to {{interval}}" =>
        "{{name}} debe ser mayor o igual que {{interval}}",
        "{{name}} must not be greater than {{interval}}" =>
        "{{name}} no debe ser mayor que {{interval}}",
        "{{name}} must not be greater than or equal to {{interval}}" =>
        "{{name}} no debe ser mayor o igual que {{interval}}",

        "{{name}} must be less than {{interval}}" =>
        "{{name}} debe ser menor que {{interval}}",
        "{{name}} must be less than or equal to {{interval}}" =>
        "{{name}} debe ser menor o igual que {{interval}}",
        "{{name}} must not be less than {{interval}}" =>
        "{{name}} no debe ser menor que {{interval}}",
        "{{name}} must not be less than or equal to {{interval}}" =>
        "{{name}} no debe ser menor o igual que {{interval}}",

        //alunm()
        '{{name}} must contain only letters (a-z) and digits (0-9)' => '{{name}} debe contener sólo letras (a-z) y dígitos (0-9)',
        '{{name}} must contain only letters (a-z), digits (0-9) and {{additionalChars}}' => '{{name}} debe contener sólo letras (a-z), dígitos (0-9) y {{additionalChars}}',
        '{{name}} must not contain letters (a-z) or digits (0-9)' => '{{name}} no debe contener letras (a-z) ni dígitos (0-9)',
        '{{name}} must not contain letters (a-z), digits (0-9) or {{additionalChars}}' => '{{name}} no debe contener letras (a-z), dígitos (0-9) o {{additionalChars}}',

        //alpha()
        '{{name}} must contain only letters (a-z)' => '{{name}} debe contener sólo letras (a-z)',
        '{{name}} must contain only letters (a-z) and "{{additionalChars}}"' => '{{name}} debe contener sólo letras (a-z) y "{{additionalChars}}"',
        '{{name}} must not contain letters (a-z)' => '{{name}} no debe contener letras (a-z)',
        '{{name}} must not contain letters (a-z) or "{{additionalChars}}"' => '{{name}} no debe contener letras (a-z) o "{{additionalChars}}"',

        //boolVal()
        '{{name}} must be a boolean value' => '{{name}} debe ser un valor booleano',
        '{{name}} must not be a boolean value' => '{{name}} no debe ser un valor booleano',

        //numeric()
        '{{name}} must be numeric' => '{{name}} debe ser un número',
        '{{name}} must not be numeric' => '{{name}} no debe ser un número',

        '{{name}} must be a string' => '{{name}} debe ser una cadena de texto',
        //noWhitespace()
        '{{name}} must not be empty' => '{{name}} no puede estar vacío',

        //positive()
        '{{name}} must be positive' => '{{name}} debe ser positivo',
        '{{name}} must not be positive' => '{{name}} no debe ser positivo',

        '{{name}} must have a length between {{minValue}} and {{maxValue}}' => '{{name}} deve possuir de {{minValue}} a {{maxValue}} caracteres',
    ];

    if ($messages[$message]){
        return $messages[$message];        
    }

    return $message; 
};

/*
 age(int $minAge = null, int $maxAge = null)
 allOf(Validatable ...$rule)
 alnum(string $additionalChars = null)
 alpha(string $additionalChars = null)
 alwaysInvalid()
 alwaysValid()
 arrayVal()
 arrayType()
 attribute(string $reference, Validatable $validator = null, bool $mandatory = true)
 bank(string $countryCode)
 bankAccount(string $countryCode)
 base()
 between($min = null, $max = null, bool $inclusive = true)
 bic(string $countryCode)
 boolType()
 boolVal()
 bsn()
 call()
 callableType()
 callback(callable $callback)
 charset($charset)
 cnh()
 cnpj()
 consonant(string $additionalChars = null)
 contains($containsValue, bool $identical = false)
 countable()
 countryCode()
 currencyCode()
 cpf()
 creditCard(string $brand = null)
 date(string $format = null)
 digit(string $additionalChars = null)
 directory()
 domain(bool $tldCheck = true)
 each(Validatable $itemValidator = null, Validatable $keyValidator = null)
 email()
 endsWith($endValue, bool $identical = false)
 equals($compareTo)
 even()
 executable()
 exists()
 extension(string $extension)
 factor(int $dividend)
 falseVal()
 fibonacci()
 file()
 filterVar(int $filter, $options = null)
 finite()
 floatVal()
 floatType()
 graph(string $additionalChars = null)
 hexRgbColor()
 identical($value)
 identityCard(string $countryCode)
 image(finfo $fileInfo = null)
 imei()
 in($haystack, bool $compareIdentical = false)
 infinite()
 instance(string $instanceName)
 intVal()
 intType()
 ip($ipOptions = null)
 iterableType()
 json()
 key(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 keyNested(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 keySet(Key ...$rule)
 keyValue(string $comparedKey, string $ruleName, string $baseKey)
 languageCode(string $set)
 leapDate(string $format)
 leapYear()
 length(int $min = null, int $max = null, bool $inclusive = true)
 lowercase()
 macAddress()
 max($maxValue, bool $inclusive = true)
 mimetype(string $mimetype)
 min($minValue, bool $inclusive = true)
 minimumAge(int $age)
 multiple(int $multipleOf)
 negative()
 no($useLocale = false)
 noneOf(Validatable ...$rule)
 not(Validatable $rule)
 notBlank()
 notEmpty()
 notOptional()
 noWhitespace()
 nullType()
 numeric()
 objectType()
 odd()
 oneOf(Validatable ...$rule)
 optional(Validatable $rule)
 perfectSquare()
 pesel()
 phone()
 phpLabel()
 positive()
 postalCode(string $countryCode)
 primeNumber()
 prnt(string $additionalChars = null)
 punct(string $additionalChars = null)
 readable()
 regex(string $regex)
 resourceType()
 roman()
 scalarVal()
 sf(string $name, array $params = null)
 size(string $minSize = null, string $maxSize = null)
 slug()
 space(string $additionalChars = null)
 startsWith($startValue, bool $identical = false)
 stringType()
 subdivisionCode(string $countryCode)
 symbolicLink()
 tld()
 trueVal()
 type(string $type)
 uploaded()
 uppercase()
 url()
 version()
 videoUrl(string $service = null)
 vowel()
 when(Validatable $if, Validatable $then, Validatable $when = null)
 writable()
 xdigit(string $additionalChars = null)
 yes($useLocale = false)
 zend($validator, array $params = null)
 */


/*
#: gettext.php:2
msgid "{{name}} must be iterable"
msgstr "{{nom}} doit être itérable"

#: gettext.php:3
msgid "{{name}} must not be iterable"
msgstr "{{name}} ne doit pas être listable"

#: gettext.php:4
msgid "{{name}} must be a valid slug"
msgstr "{{name}} doit être un identifiant d'URL valide"

#: gettext.php:5
msgid "{{name}} must not be a valid slug"
msgstr "{{name}} ne doit pas être un identifiant d'URL valide"

#: gettext.php:6
msgid "{{name}} must be identical as {{compareTo}}"
msgstr "{{name}} doit être identique à {{compareTo}}"

#: gettext.php:7
msgid "{{name}} must not be identical as {{compareTo}}"
msgstr "{{name}} doit être différent de {{compareTo}}"

#: gettext.php:8
msgid "{{name}} contain only hexadecimal digits"
msgstr "{{name}} ne doit contenir que des chiffres ou  "

#: gettext.php:9
msgid "{{name}} contain only hexadecimal digits and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des chiffres and \"{{additionalChars}}\""

#: gettext.php:10
msgid "{{name}} must not contain hexadecimal digits"
msgstr "{{name}} ne doit contenir aucun chiffre."

#: gettext.php:11
msgid "{{name}} must not contain hexadecimal digits or \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir aucun chiffre ni \"{{additionalChars}}\""

#: gettext.php:12
msgid "{{name}} must be equals {{compareTo}}"
msgstr "{{name}} doit être égal à {{compareTo}}"

#: gettext.php:13
msgid "{{name}} must not be equals {{compareTo}}"
msgstr "{{name}} ne doit pas être égal à {{compareTo}}"

#: gettext.php:14
msgid "{{name}} must be an object"
msgstr "{{name}} doit être un objet"

#: gettext.php:15
msgid "{{name}} must not be an object"
msgstr "{{name}} ne doit pas être un objet"

#: gettext.php:16
msgid "{{name}} must be an integer number"
msgstr "{{name}} doit être un nombre entier"

#: gettext.php:17
msgid "{{name}} must not be an integer number"
msgstr "{{name}} ne doit pas être un nombre entier"

#: gettext.php:18
msgid "{{name}} must be a valid roman number"
msgstr "{{name}} doit être un nombre romain"

#: gettext.php:19
msgid "{{name}} must not be a valid roman number"
msgstr "{{name}} ne doit pas être un nombre romain"

#: gettext.php:20
msgid "{{name}} must contain only printable characters"
msgstr "{{name}} ne doit contenir que des caractères imprimables"

#: gettext.php:21
msgid "{{name}} must contain only printable characters and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des caractères imprimables et \"{{additionalChars}}\""

#: gettext.php:22
msgid "{{name}} must not contain printable characters"
msgstr "{{name}} ne doit contenir aucun caractère imprimable"

#: gettext.php:23
msgid "{{name}} must not contain printable characters or \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir aucun caractères imprimables ni \"{{additionalChars}}\""

#: gettext.php:24
msgid "{{name}} must be a bank account"
msgstr "{{name}} doit être un compte bancaire"

#: gettext.php:25
msgid "{{name}} must not be a bank account"
msgstr "{{name}} ne doit pas être un compte bancaire"

#: gettext.php:26
msgid "{{name}} must exists"
msgstr "{{name}} doit exister"

#: gettext.php:27
msgid "{{name}} must not exists"
msgstr "{{name}} ne doit pas exister"

#: gettext.php:28
msgid "{{name}} must be null"
msgstr "{{name}} doit être null"

#: gettext.php:29
msgid "{{name}} must not be null"
msgstr "{{name}} ne doit pas être null"

#: gettext.php:30 gettext.php:31
msgid "Data validation failed for {{name}}"
msgstr "La validation des données a echoué pour {{name}}"

#: gettext.php:32
msgid "{{name}} must contain only letters (a-z)"
msgstr "{{name}} ne doit contenir que des lettres (a-z)"

#: gettext.php:33
msgid "{{name}} must contain only letters (a-z) and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des lettres (a-z) et \"{{additionalChars}}\""

#: gettext.php:34
msgid "{{name}} must not contain letters (a-z)"
msgstr "{{name}} ne doit contenir que des lettres (a-z)"

#: gettext.php:35
msgid "{{name}} must not contain letters (a-z) or \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir aucune lettre (a-z) ni  \"{{additionalChars}}\""

#: gettext.php:38
msgid "{{name}} must be a valid postal code on {{countryCode}}"
msgstr "{{name}} doit être un code postal vide pour {{countryCode}}"

#: gettext.php:39
msgid "{{name}} must not be a valid postal code on {{countryCode}}"
msgstr "{{name}} ne doit pas être un code postal vide pour {{countryCode}}"

#: gettext.php:40
msgid "{{name}} must be a subdivision code of Ivory Coast"
msgstr "{{name}} doit être un secteur de Ivory Coast"

#: gettext.php:41
msgid "{{name}} must be not a subdivision code of Ivory Coast"
msgstr "{{name}} ne doit pas être un secteur de Ivory Coast"

#: gettext.php:42
msgid "{{name}} must be a subdivision code of Brunei"
msgstr "{{name}} doit être un secteur de Brunei"

#: gettext.php:43
msgid "{{name}} must be not a subdivision code of Brunei"
msgstr "{{name}} ne doit pas être un secteur de Brunei"

#: gettext.php:44
msgid "{{name}} must be a subdivision code of Angola"
msgstr "{{name}} doit être un secteur de Angola"

#: gettext.php:45
msgid "{{name}} must be not a subdivision code of Angola"
msgstr "{{name}} ne doit pas être un secteur de Angola"

#: gettext.php:46
msgid "{{name}} must be a subdivision code of Costa Rica"
msgstr "{{name}} doit être un secteur de Costa Rica"

#: gettext.php:47
msgid "{{name}} must be not a subdivision code of Costa Rica"
msgstr "{{name}} ne doit pas être un secteur de Costa Rica"

#: gettext.php:48
msgid "{{name}} must be a subdivision code of Czech Republic"
msgstr "{{name}} doit être un secteur de Czech Republic"

#: gettext.php:49
msgid "{{name}} must be not a subdivision code of Czech Republic"
msgstr "{{name}} ne doit pas être un secteur de Czech Republic"

#: gettext.php:50
msgid "{{name}} must be a subdivision code of Italy"
msgstr "{{name}} doit être un secteur de Italy"

#: gettext.php:51
msgid "{{name}} must be not a subdivision code of Italy"
msgstr "{{name}} ne doit pas être un secteur de Italy"

#: gettext.php:52
msgid "{{name}} must be a subdivision code of Croatia"
msgstr "{{name}} doit être un secteur de Croatia"

#: gettext.php:53
msgid "{{name}} must be not a subdivision code of Croatia"
msgstr "{{name}} ne doit pas être un secteur de Croatia"

#: gettext.php:54
msgid "{{name}} must be a subdivision code of Slovenia"
msgstr "{{name}} doit être un secteur de Slovenia"

#: gettext.php:55
msgid "{{name}} must be not a subdivision code of Slovenia"
msgstr "{{name}} ne doit pas être un secteur de Slovenia"

#: gettext.php:56
msgid "{{name}} must be a subdivision code of French Southern Territories"
msgstr "{{name}} doit être un secteur de French Southern Territories"

#: gettext.php:57
msgid "{{name}} must be not a subdivision code of French Southern Territories"
msgstr "{{name}} ne doit pas être un secteur de French Southern Territories"

#: gettext.php:58
msgid "{{name}} must be a subdivision code of U.S. Virgin Islands"
msgstr "{{name}} doit être un secteur de U.S. Virgin Islands"

#: gettext.php:59
msgid "{{name}} must be not a subdivision code of U.S. Virgin Islands"
msgstr "{{name}} ne doit pas être un secteur de U.S. Virgin Islands"

#: gettext.php:60
msgid "{{name}} must be a subdivision code of Serbia And Montenegro"
msgstr "{{name}} doit être un secteur de Serbia And Montenegro"

#: gettext.php:61
msgid "{{name}} must be not a subdivision code of Serbia And Montenegro"
msgstr "{{name}} ne doit pas être un secteur de Serbia And Montenegro"

#: gettext.php:62
msgid "{{name}} must be a subdivision code of Hong Kong"
msgstr "{{name}} doit être un secteur de Hong Kong"

#: gettext.php:63
msgid "{{name}} must be not a subdivision code of Hong Kong"
msgstr "{{name}} ne doit pas être un secteur de Hong Kong"

#: gettext.php:64
msgid "{{name}} must be a subdivision code of Greece"
msgstr "{{name}} doit être un secteur de Greece"

#: gettext.php:65
msgid "{{name}} must be not a subdivision code of Greece"
msgstr "{{name}} ne doit pas être un secteur de Greece"

#: gettext.php:66
msgid "{{name}} must be a subdivision code of Ethiopia"
msgstr "{{name}} doit être un secteur de Ethiopia"

#: gettext.php:67
msgid "{{name}} must be not a subdivision code of Ethiopia"
msgstr "{{name}} ne doit pas être un secteur de Ethiopia"

#: gettext.php:68
msgid "{{name}} must be a subdivision code of Bangladesh"
msgstr "{{name}} doit être un secteur de Bangladesh"

#: gettext.php:69
msgid "{{name}} must be not a subdivision code of Bangladesh"
msgstr "{{name}} ne doit pas être un secteur de Bangladesh"

#: gettext.php:70
msgid "{{name}} must be a subdivision code of Egypt"
msgstr "{{name}} doit être un secteur de Egypt"

#: gettext.php:71
msgid "{{name}} must be not a subdivision code of Egypt"
msgstr "{{name}} ne doit pas être un secteur de Egypt"

#: gettext.php:72
msgid "{{name}} must be a subdivision code of Central African Republic"
msgstr "{{name}} doit être un secteur de Central African Republic"

#: gettext.php:73
msgid "{{name}} must be not a subdivision code of Central African Republic"
msgstr "{{name}} ne doit pas être un secteur de Central African Republic"

#: gettext.php:74
msgid "{{name}} must be a subdivision code of Sierra Leone"
msgstr "{{name}} doit être un secteur de Sierra Leone"

#: gettext.php:75
msgid "{{name}} must be not a subdivision code of Sierra Leone"
msgstr "{{name}} ne doit pas être un secteur de Sierra Leone"

#: gettext.php:76
msgid "{{name}} must be a subdivision code of Mexico"
msgstr "{{name}} doit être un secteur de Mexico"

#: gettext.php:77
msgid "{{name}} must be not a subdivision code of Mexico"
msgstr "{{name}} ne doit pas être un secteur de Mexico"

#: gettext.php:78
msgid "{{name}} must be a subdivision code of Turkey"
msgstr "{{name}} doit être un secteur de Turkey"

#: gettext.php:79
msgid "{{name}} must be not a subdivision code of Turkey"
msgstr "{{name}} ne doit pas être un secteur de Turkey"

#: gettext.php:80
msgid "{{name}} must be a subdivision code of Heard Island and McDonald Islands"
msgstr "{{name}} doit être un secteur de Heard Island and McDonald Islands"

#: gettext.php:81
msgid "{{name}} must be not a subdivision code of Heard Island and McDonald Islands"
msgstr "{{name}} ne doit pas être un secteur de Heard Island and McDonald Islands"

#: gettext.php:82
msgid "{{name}} must be a subdivision code of Nepal"
msgstr "{{name}} doit être un secteur de Nepal"

#: gettext.php:83
msgid "{{name}} must be not a subdivision code of Nepal"
msgstr "{{name}} ne doit pas être un secteur de Nepal"

#: gettext.php:84
msgid "{{name}} must be a subdivision code of Montenegro"
msgstr "{{name}} doit être un secteur de Montenegro"

#: gettext.php:85
msgid "{{name}} must be not a subdivision code of Montenegro"
msgstr "{{name}} ne doit pas être un secteur de Montenegro"

#: gettext.php:86
msgid "{{name}} must be a subdivision code of Tanzania"
msgstr "{{name}} doit être un secteur de Tanzania"

#: gettext.php:87
msgid "{{name}} must be not a subdivision code of Tanzania"
msgstr "{{name}} ne doit pas être un secteur de Tanzania"

#: gettext.php:88
msgid "{{name}} must be a subdivision code of Kosovo"
msgstr "{{name}} doit être un secteur de Kosovo"

#: gettext.php:89
msgid "{{name}} must be not a subdivision code of Kosovo"
msgstr "{{name}} ne doit pas être un secteur de Kosovo"

#: gettext.php:90
msgid "{{name}} must be a subdivision code of Bahamas"
msgstr "{{name}} doit être un secteur de Bahamas"

#: gettext.php:91
msgid "{{name}} must be not a subdivision code of Bahamas"
msgstr "{{name}} ne doit pas être un secteur de Bahamas"

#: gettext.php:92
msgid "{{name}} must be a subdivision code of Lithuania"
msgstr "{{name}} doit être un secteur de Lithuania"

#: gettext.php:93
msgid "{{name}} must be not a subdivision code of Lithuania"
msgstr "{{name}} ne doit pas être un secteur de Lithuania"

#: gettext.php:94
msgid "{{name}} must be a subdivision code of Zimbabwe"
msgstr "{{name}} doit être un secteur de Zimbabwe"

#: gettext.php:95
msgid "{{name}} must be not a subdivision code of Zimbabwe"
msgstr "{{name}} ne doit pas être un secteur de Zimbabwe"

#: gettext.php:96
msgid "{{name}} must be a subdivision code of Tuvalu"
msgstr "{{name}} doit être un secteur de Tuvalu"

#: gettext.php:97
msgid "{{name}} must be not a subdivision code of Tuvalu"
msgstr "{{name}} ne doit pas être un secteur de Tuvalu"

#: gettext.php:98
msgid "{{name}} must be a subdivision code of U.S. Minor Outlying Islands"
msgstr "{{name}} doit être un secteur de U.S. Minor Outlying Islands"

#: gettext.php:99
msgid "{{name}} must be not a subdivision code of U.S. Minor Outlying Islands"
msgstr "{{name}} ne doit pas être un secteur de U.S. Minor Outlying Islands"

#: gettext.php:100
msgid "{{name}} must be a subdivision code of Pitcairn Islands"
msgstr "{{name}} doit être un secteur de Pitcairn Islands"

#: gettext.php:101
msgid "{{name}} must be not a subdivision code of Pitcairn Islands"
msgstr "{{name}} ne doit pas être un secteur de Pitcairn Islands"

#: gettext.php:102
msgid "{{name}} must be a subdivision code of Belarus"
msgstr "{{name}} doit être un secteur de Belarus"

#: gettext.php:103
msgid "{{name}} must be not a subdivision code of Belarus"
msgstr "{{name}} ne doit pas être un secteur de Belarus"

#: gettext.php:104
msgid "{{name}} must be a subdivision code of Senegal"
msgstr "{{name}} doit être un secteur de Senegal"

#: gettext.php:105
msgid "{{name}} must be not a subdivision code of Senegal"
msgstr "{{name}} ne doit pas être un secteur de Senegal"

#: gettext.php:106
msgid "{{name}} must be a subdivision code of Vanuatu"
msgstr "{{name}} doit être un secteur de Vanuatu"

#: gettext.php:107
msgid "{{name}} must be not a subdivision code of Vanuatu"
msgstr "{{name}} ne doit pas être un secteur de Vanuatu"

#: gettext.php:108
msgid "{{name}} must be a subdivision code of Myanmar [Burma]"
msgstr "{{name}} doit être un secteur de Myanmar [Burma]"

#: gettext.php:109
msgid "{{name}} must be not a subdivision code of Myanmar [Burma]"
msgstr "{{name}} ne doit pas être un secteur de Myanmar [Burma]"

#: gettext.php:110
msgid "{{name}} must be a subdivision code of Guatemala"
msgstr "{{name}} doit être un secteur de Guatemala"

#: gettext.php:111
msgid "{{name}} must be not a subdivision code of Guatemala"
msgstr "{{name}} ne doit pas être un secteur de Guatemala"

#: gettext.php:112
msgid "{{name}} must be a subdivision code of Maldives"
msgstr "{{name}} doit être un secteur de Maldives"

#: gettext.php:113
msgid "{{name}} must be not a subdivision code of Maldives"
msgstr "{{name}} ne doit pas être un secteur de Maldives"

#: gettext.php:114
msgid "{{name}} must be a subdivision code of Grenada"
msgstr "{{name}} doit être un secteur de Grenada"

#: gettext.php:115
msgid "{{name}} must be not a subdivision code of Grenada"
msgstr "{{name}} ne doit pas être un secteur de Grenada"

#: gettext.php:116
msgid "{{name}} must be a subdivision code of Antarctica"
msgstr "{{name}} doit être un secteur de Antarctica"

#: gettext.php:117
msgid "{{name}} must be not a subdivision code of Antarctica"
msgstr "{{name}} ne doit pas être un secteur de Antarctica"

#: gettext.php:118
msgid "{{name}} must be a subdivision code of San Marino"
msgstr "{{name}} doit être un secteur de San Marino"

#: gettext.php:119
msgid "{{name}} must be not a subdivision code of San Marino"
msgstr "{{name}} ne doit pas être un secteur de San Marino"

#: gettext.php:120
msgid "{{name}} must be a subdivision code of Bahrain"
msgstr "{{name}} doit être un secteur de Bahrain"

#: gettext.php:121
msgid "{{name}} must be not a subdivision code of Bahrain"
msgstr "{{name}} ne doit pas être un secteur de Bahrain"

#: gettext.php:122
msgid "{{name}} must be a subdivision code of Romania"
msgstr "{{name}} doit être un secteur de Romania"

#: gettext.php:123
msgid "{{name}} must be not a subdivision code of Romania"
msgstr "{{name}} ne doit pas être un secteur de Romania"

#: gettext.php:124
msgid "{{name}} must be a subdivision code of Sweden"
msgstr "{{name}} doit être un secteur de Sweden"

#: gettext.php:125
msgid "{{name}} must be not a subdivision code of Sweden"
msgstr "{{name}} ne doit pas être un secteur de Sweden"

#: gettext.php:126
msgid "{{name}} must be a subdivision code of Mauritius"
msgstr "{{name}} doit être un secteur de Mauritius"

#: gettext.php:127
msgid "{{name}} must be not a subdivision code of Mauritius"
msgstr "{{name}} ne doit pas être un secteur de Mauritius"

#: gettext.php:128
msgid "{{name}} must be a subdivision code of Israel"
msgstr "{{name}} doit être un secteur de Israel"

#: gettext.php:129
msgid "{{name}} must be not a subdivision code of Israel"
msgstr "{{name}} ne doit pas être un secteur de Israel"

#: gettext.php:130
msgid "{{name}} must be a subdivision code of Denmark"
msgstr "{{name}} doit être un secteur de Denmark"

#: gettext.php:131
msgid "{{name}} must be not a subdivision code of Denmark"
msgstr "{{name}} ne doit pas être un secteur de Denmark"

#: gettext.php:132
msgid "{{name}} must be a subdivision code of Comoros"
msgstr "{{name}} doit être un secteur de Comoros"

#: gettext.php:133
msgid "{{name}} must be not a subdivision code of Comoros"
msgstr "{{name}} ne doit pas être un secteur de Comoros"

#: gettext.php:134
msgid "{{name}} must be a subdivision code of Madagascar"
msgstr "{{name}} doit être un secteur de Madagascar"

#: gettext.php:135
msgid "{{name}} must be not a subdivision code of Madagascar"
msgstr "{{name}} ne doit pas être un secteur de Madagascar"

#: gettext.php:136
msgid "{{name}} must be a subdivision code of Samoa"
msgstr "{{name}} doit être un secteur de Samoa"

#: gettext.php:137
msgid "{{name}} must be not a subdivision code of Samoa"
msgstr "{{name}} ne doit pas être un secteur de Samoa"

#: gettext.php:138
msgid "{{name}} must be a subdivision code of Norway"
msgstr "{{name}} doit être un secteur de Norway"

#: gettext.php:139
msgid "{{name}} must be not a subdivision code of Norway"
msgstr "{{name}} ne doit pas être un secteur de Norway"

#: gettext.php:140
msgid "{{name}} must be a subdivision code of Georgia"
msgstr "{{name}} doit être un secteur de Georgia"

#: gettext.php:141
msgid "{{name}} must be not a subdivision code of Georgia"
msgstr "{{name}} ne doit pas être un secteur de Georgia"

#: gettext.php:142
msgid "{{name}} must be a subdivision code of Palau"
msgstr "{{name}} doit être un secteur de Palau"

#: gettext.php:143
msgid "{{name}} must be not a subdivision code of Palau"
msgstr "{{name}} ne doit pas être un secteur de Palau"

#: gettext.php:144
msgid "{{name}} must be a subdivision code of British Virgin Islands"
msgstr "{{name}} doit être un secteur de British Virgin Islands"

#: gettext.php:145
msgid "{{name}} must be not a subdivision code of British Virgin Islands"
msgstr "{{name}} ne doit pas être un secteur de British Virgin Islands"

#: gettext.php:146
msgid "{{name}} must be a subdivision code of Netherlands"
msgstr "{{name}} doit être un secteur de Netherlands"

#: gettext.php:147
msgid "{{name}} must be not a subdivision code of Netherlands"
msgstr "{{name}} ne doit pas être un secteur de Netherlands"

#: gettext.php:148
msgid "{{name}} must be a subdivision code of Cook Islands"
msgstr "{{name}} doit être un secteur de Cook Islands"

#: gettext.php:149
msgid "{{name}} must be not a subdivision code of Cook Islands"
msgstr "{{name}} ne doit pas être un secteur de Cook Islands"

#: gettext.php:150
msgid "{{name}} must be a subdivision code of Saudi Arabia"
msgstr "{{name}} doit être un secteur de Saudi Arabia"

#: gettext.php:151
msgid "{{name}} must be not a subdivision code of Saudi Arabia"
msgstr "{{name}} ne doit pas être un secteur de Saudi Arabia"

#: gettext.php:152
msgid "{{name}} must be a subdivision code of Saint Helena"
msgstr "{{name}} doit être un secteur de Saint Helena"

#: gettext.php:153
msgid "{{name}} must be not a subdivision code of Saint Helena"
msgstr "{{name}} ne doit pas être un secteur de Saint Helena"

#: gettext.php:154
msgid "{{name}} must be a subdivision code of Taiwan"
msgstr "{{name}} doit être un secteur de Taiwan"

#: gettext.php:155
msgid "{{name}} must be not a subdivision code of Taiwan"
msgstr "{{name}} ne doit pas être un secteur de Taiwan"

#: gettext.php:156
msgid "{{name}} must be a subdivision code of Qatar"
msgstr "{{name}} doit être un secteur de Qatar"

#: gettext.php:157
msgid "{{name}} must be not a subdivision code of Qatar"
msgstr "{{name}} ne doit pas être un secteur de Qatar"

#: gettext.php:158
msgid "{{name}} must be a subdivision code of Niger"
msgstr "{{name}} doit être un secteur de Niger"

#: gettext.php:159
msgid "{{name}} must be not a subdivision code of Niger"
msgstr "{{name}} ne doit pas être un secteur de Niger"

#: gettext.php:160
msgid "{{name}} must be a subdivision code of North Korea"
msgstr "{{name}} doit être un secteur de North Korea"

#: gettext.php:161
msgid "{{name}} must be not a subdivision code of North Korea"
msgstr "{{name}} ne doit pas être un secteur de North Korea"

#: gettext.php:162
msgid "{{name}} must be a subdivision code of Trinidad and Tobago"
msgstr "{{name}} doit être un secteur de Trinidad and Tobago"

#: gettext.php:163
msgid "{{name}} must be not a subdivision code of Trinidad and Tobago"
msgstr "{{name}} ne doit pas être un secteur de Trinidad and Tobago"

#: gettext.php:164
msgid "{{name}} must be a subdivision code of Cuba"
msgstr "{{name}} doit être un secteur de Cuba"

#: gettext.php:165
msgid "{{name}} must be not a subdivision code of Cuba"
msgstr "{{name}} ne doit pas être un secteur de Cuba"

#: gettext.php:166
msgid "{{name}} must be a subdivision code of Guernsey"
msgstr "{{name}} doit être un secteur de Guernsey"

#: gettext.php:167
msgid "{{name}} must be not a subdivision code of Guernsey"
msgstr "{{name}} ne doit pas être un secteur de Guernsey"

#: gettext.php:168
msgid "{{name}} must be a subdivision code of Dominica"
msgstr "{{name}} doit être un secteur de Dominica"

#: gettext.php:169
msgid "{{name}} must be not a subdivision code of Dominica"
msgstr "{{name}} ne doit pas être un secteur de Dominica"

#: gettext.php:170
msgid "{{name}} must be a subdivision code of Chad"
msgstr "{{name}} doit être un secteur de Chad"

#: gettext.php:171
msgid "{{name}} must be not a subdivision code of Chad"
msgstr "{{name}} ne doit pas être un secteur de Chad"

#: gettext.php:172
msgid "{{name}} must be a subdivision code of Bhutan"
msgstr "{{name}} doit être un secteur de Bhutan"

#: gettext.php:173
msgid "{{name}} must be not a subdivision code of Bhutan"
msgstr "{{name}} ne doit pas être un secteur de Bhutan"

#: gettext.php:174
msgid "{{name}} must be a subdivision code of Benin"
msgstr "{{name}} doit être un secteur de Benin"

#: gettext.php:175
msgid "{{name}} must be not a subdivision code of Benin"
msgstr "{{name}} ne doit pas être un secteur de Benin"

#: gettext.php:176
msgid "{{name}} must be a subdivision code of Bonaire"
msgstr "{{name}} doit être un secteur de Bonaire"

#: gettext.php:177
msgid "{{name}} must be not a subdivision code of Bonaire"
msgstr "{{name}} ne doit pas être un secteur de Bonaire"

#: gettext.php:178
msgid "{{name}} must be a subdivision code of Montserrat"
msgstr "{{name}} doit être un secteur de Montserrat"

#: gettext.php:179
msgid "{{name}} must be not a subdivision code of Montserrat"
msgstr "{{name}} ne doit pas être un secteur de Montserrat"

#: gettext.php:180
msgid "{{name}} must be a subdivision code of Netherlands Antilles"
msgstr "{{name}} doit être un secteur de Netherlands Antilles"

#: gettext.php:181
msgid "{{name}} must be not a subdivision code of Netherlands Antilles"
msgstr "{{name}} ne doit pas être un secteur de Netherlands Antilles"

#: gettext.php:182
msgid "{{name}} must be a subdivision code of Papua New Guinea"
msgstr "{{name}} doit être un secteur de Papua New Guinea"

#: gettext.php:183
msgid "{{name}} must be not a subdivision code of Papua New Guinea"
msgstr "{{name}} ne doit pas être un secteur de Papua New Guinea"

#: gettext.php:184
msgid "{{name}} must be a subdivision code of Malta"
msgstr "{{name}} doit être un secteur de Malta"

#: gettext.php:185
msgid "{{name}} must be not a subdivision code of Malta"
msgstr "{{name}} ne doit pas être un secteur de Malta"

#: gettext.php:186
msgid "{{name}} must be a subdivision code of Hungary"
msgstr "{{name}} doit être un secteur de Hungary"

#: gettext.php:187
msgid "{{name}} must be not a subdivision code of Hungary"
msgstr "{{name}} ne doit pas être un secteur de Hungary"

#: gettext.php:188
msgid "{{name}} must be a subdivision code of Macedonia"
msgstr "{{name}} doit être un secteur de Macedonia"

#: gettext.php:189
msgid "{{name}} must be not a subdivision code of Macedonia"
msgstr "{{name}} ne doit pas être un secteur de Macedonia"

#: gettext.php:190
msgid "{{name}} must be a subdivision code of Fiji"
msgstr "{{name}} doit être un secteur de Fiji"

#: gettext.php:191
msgid "{{name}} must be not a subdivision code of Fiji"
msgstr "{{name}} ne doit pas être un secteur de Fiji"

#: gettext.php:192
msgid "{{name}} must be a subdivision code of Sri Lanka"
msgstr "{{name}} doit être un secteur de Sri Lanka"

#: gettext.php:193
msgid "{{name}} must be not a subdivision code of Sri Lanka"
msgstr "{{name}} ne doit pas être un secteur de Sri Lanka"

#: gettext.php:194
msgid "{{name}} must be a subdivision code of Mongolia"
msgstr "{{name}} doit être un secteur de Mongolia"

#: gettext.php:195
msgid "{{name}} must be not a subdivision code of Mongolia"
msgstr "{{name}} ne doit pas être un secteur de Mongolia"

#: gettext.php:196
msgid "{{name}} must be a subdivision code of Ecuador"
msgstr "{{name}} doit être un secteur de Ecuador"

#: gettext.php:197
msgid "{{name}} must be not a subdivision code of Ecuador"
msgstr "{{name}} ne doit pas être un secteur de Ecuador"

#: gettext.php:198
msgid "{{name}} must be a subdivision code of Tajikistan"
msgstr "{{name}} doit être un secteur de Tajikistan"

#: gettext.php:199
msgid "{{name}} must be not a subdivision code of Tajikistan"
msgstr "{{name}} ne doit pas être un secteur de Tajikistan"

#: gettext.php:200
msgid "{{name}} must be a subdivision code of Réunion"
msgstr "{{name}} doit être un secteur de Réunion"

#: gettext.php:201
msgid "{{name}} must be not a subdivision code of Réunion"
msgstr "{{name}} ne doit pas être un secteur de Réunion"

#: gettext.php:202
msgid "{{name}} must be a subdivision code of Switzerland"
msgstr "{{name}} doit être un secteur de Switzerland"

#: gettext.php:203
msgid "{{name}} must be not a subdivision code of Switzerland"
msgstr "{{name}} ne doit pas être un secteur de Switzerland"

#: gettext.php:204
msgid "{{name}} must be a subdivision code of Saint Pierre and Miquelon"
msgstr "{{name}} doit être un secteur de Saint Pierre and Miquelon"

#: gettext.php:205
msgid "{{name}} must be not a subdivision code of Saint Pierre and Miquelon"
msgstr "{{name}} ne doit pas être un secteur de Saint Pierre and Miquelon"

#: gettext.php:206
msgid "{{name}} must be a subdivision code of United Kingdom"
msgstr "{{name}} doit être un secteur de United Kingdom"

#: gettext.php:207
msgid "{{name}} must be not a subdivision code of United Kingdom"
msgstr "{{name}} ne doit pas être un secteur de United Kingdom"

#: gettext.php:208
msgid "{{name}} must be a subdivision code of Isle of Man"
msgstr "{{name}} doit être un secteur de Isle of Man"

#: gettext.php:209
msgid "{{name}} must be not a subdivision code of Isle of Man"
msgstr "{{name}} ne doit pas être un secteur de Isle of Man"

#: gettext.php:210
msgid "{{name}} must be a subdivision code of Slovakia"
msgstr "{{name}} doit être un secteur de Slovakia"

#: gettext.php:211
msgid "{{name}} must be not a subdivision code of Slovakia"
msgstr "{{name}} ne doit pas être un secteur de Slovakia"

#: gettext.php:212
msgid "{{name}} must be a subdivision code of Anguilla"
msgstr "{{name}} doit être un secteur de Anguilla"

#: gettext.php:213
msgid "{{name}} must be not a subdivision code of Anguilla"
msgstr "{{name}} ne doit pas être un secteur de Anguilla"

#: gettext.php:214
msgid "{{name}} must be a subdivision code of Monaco"
msgstr "{{name}} doit être un secteur de Monaco"

#: gettext.php:215
msgid "{{name}} must be not a subdivision code of Monaco"
msgstr "{{name}} ne doit pas être un secteur de Monaco"

#: gettext.php:216
msgid "{{name}} must be a subdivision code of Syria"
msgstr "{{name}} doit être un secteur de Syria"

#: gettext.php:217
msgid "{{name}} must be not a subdivision code of Syria"
msgstr "{{name}} ne doit pas être un secteur de Syria"

#: gettext.php:218
msgid "{{name}} must be a subdivision code of Sudan"
msgstr "{{name}} doit être un secteur de Sudan"

#: gettext.php:219
msgid "{{name}} must be not a subdivision code of Sudan"
msgstr "{{name}} ne doit pas être un secteur de Sudan"

#: gettext.php:220
msgid "{{name}} must be a subdivision code of Tunisia"
msgstr "{{name}} doit être un secteur de Tunisia"

#: gettext.php:221
msgid "{{name}} must be not a subdivision code of Tunisia"
msgstr "{{name}} ne doit pas être un secteur de Tunisia"

#: gettext.php:222
msgid "{{name}} must be a subdivision code of Honduras"
msgstr "{{name}} doit être un secteur de Honduras"

#: gettext.php:223
msgid "{{name}} must be not a subdivision code of Honduras"
msgstr "{{name}} ne doit pas être un secteur de Honduras"

#: gettext.php:224
msgid "{{name}} must be a subdivision code of Cameroon"
msgstr "{{name}} doit être un secteur de Cameroon"

#: gettext.php:225
msgid "{{name}} must be not a subdivision code of Cameroon"
msgstr "{{name}} ne doit pas être un secteur de Cameroon"

#: gettext.php:226
msgid "{{name}} must be a subdivision code of Nauru"
msgstr "{{name}} doit être un secteur de Nauru"

#: gettext.php:227
msgid "{{name}} must be not a subdivision code of Nauru"
msgstr "{{name}} ne doit pas être un secteur de Nauru"

#: gettext.php:228
msgid "{{name}} must be a subdivision code of Saint Lucia"
msgstr "{{name}} doit être un secteur de Saint Lucia"

#: gettext.php:229
msgid "{{name}} must be not a subdivision code of Saint Lucia"
msgstr "{{name}} ne doit pas être un secteur de Saint Lucia"

#: gettext.php:230
msgid "{{name}} must be a subdivision code of Andorra"
msgstr "{{name}} doit être un secteur de Andorra"

#: gettext.php:231
msgid "{{name}} must be not a subdivision code of Andorra"
msgstr "{{name}} ne doit pas être un secteur de Andorra"

#: gettext.php:232
msgid "{{name}} must be a subdivision code of Philippines"
msgstr "{{name}} doit être un secteur de Philippines"

#: gettext.php:233
msgid "{{name}} must be not a subdivision code of Philippines"
msgstr "{{name}} ne doit pas être un secteur de Philippines"

#: gettext.php:234
msgid "{{name}} must be a subdivision code of Bermuda"
msgstr "{{name}} doit être un secteur de Bermuda"

#: gettext.php:235
msgid "{{name}} must be not a subdivision code of Bermuda"
msgstr "{{name}} ne doit pas être un secteur de Bermuda"

#: gettext.php:236
msgid "{{name}} must be a subdivision code of East Timor"
msgstr "{{name}} doit être un secteur de East Timor"

#: gettext.php:237
msgid "{{name}} must be not a subdivision code of East Timor"
msgstr "{{name}} ne doit pas être un secteur de East Timor"

#: gettext.php:238
msgid "{{name}} must be a subdivision code of Bolivia"
msgstr "{{name}} doit être un secteur de Bolivia"

#: gettext.php:239
msgid "{{name}} must be not a subdivision code of Bolivia"
msgstr "{{name}} ne doit pas être un secteur de Bolivia"

#: gettext.php:240
msgid "{{name}} must be a subdivision code of Saint Martin"
msgstr "{{name}} doit être un secteur de Saint Martin"

#: gettext.php:241
msgid "{{name}} must be not a subdivision code of Saint Martin"
msgstr "{{name}} ne doit pas être un secteur de Saint Martin"

#: gettext.php:242
msgid "{{name}} must be a subdivision code of Algeria"
msgstr "{{name}} doit être un secteur de Algeria"

#: gettext.php:243
msgid "{{name}} must be not a subdivision code of Algeria"
msgstr "{{name}} ne doit pas être un secteur de Algeria"

#: gettext.php:244
msgid "{{name}} must be a subdivision code of Turks and Caicos Islands"
msgstr "{{name}} doit être un secteur de Turks and Caicos Islands"

#: gettext.php:245
msgid "{{name}} must be not a subdivision code of Turks and Caicos Islands"
msgstr "{{name}} ne doit pas être un secteur de Turks and Caicos Islands"

#: gettext.php:246
msgid "{{name}} must be a subdivision code of Wallis and Futuna"
msgstr "{{name}} doit être un secteur de Wallis and Futuna"

#: gettext.php:247
msgid "{{name}} must be not a subdivision code of Wallis and Futuna"
msgstr "{{name}} ne doit pas être un secteur de Wallis and Futuna"

#: gettext.php:248
msgid "{{name}} must be a subdivision code of Micronesia"
msgstr "{{name}} doit être un secteur de Micronesia"

#: gettext.php:249
msgid "{{name}} must be not a subdivision code of Micronesia"
msgstr "{{name}} ne doit pas être un secteur de Micronesia"

#: gettext.php:250
msgid "{{name}} must be a subdivision code of Malawi"
msgstr "{{name}} doit être un secteur de Malawi"

#: gettext.php:251
msgid "{{name}} must be not a subdivision code of Malawi"
msgstr "{{name}} ne doit pas être un secteur de Malawi"

#: gettext.php:252
msgid "{{name}} must be a subdivision code of Latvia"
msgstr "{{name}} doit être un secteur de Latvia"

#: gettext.php:253
msgid "{{name}} must be not a subdivision code of Latvia"
msgstr "{{name}} ne doit pas être un secteur de Latvia"

#: gettext.php:254
msgid "{{name}} must be a subdivision code of Puerto Rico"
msgstr "{{name}} doit être un secteur de Puerto Rico"

#: gettext.php:255
msgid "{{name}} must be not a subdivision code of Puerto Rico"
msgstr "{{name}} ne doit pas être un secteur de Puerto Rico"

#: gettext.php:256
msgid "{{name}} must be a subdivision code of Dominican Republic"
msgstr "{{name}} doit être un secteur de Dominican Republic"

#: gettext.php:257
msgid "{{name}} must be not a subdivision code of Dominican Republic"
msgstr "{{name}} ne doit pas être un secteur de Dominican Republic"

#: gettext.php:258
msgid "{{name}} must be a subdivision code of Belize"
msgstr "{{name}} doit être un secteur de Belize"

#: gettext.php:259
msgid "{{name}} must be not a subdivision code of Belize"
msgstr "{{name}} ne doit pas être un secteur de Belize"

#: gettext.php:260
msgid "{{name}} must be a subdivision code of Canada"
msgstr "{{name}} doit être un secteur de Canada"

#: gettext.php:261
msgid "{{name}} must be not a subdivision code of Canada"
msgstr "{{name}} ne doit pas être un secteur de Canada"

#: gettext.php:262
msgid "{{name}} must be a subdivision code of Thailand"
msgstr "{{name}} doit être un secteur de Thailand"

#: gettext.php:263
msgid "{{name}} must be not a subdivision code of Thailand"
msgstr "{{name}} ne doit pas être un secteur de Thailand"

#: gettext.php:264
msgid "{{name}} must be a subdivision code of Albania"
msgstr "{{name}} doit être un secteur de Albania"

#: gettext.php:265
msgid "{{name}} must be not a subdivision code of Albania"
msgstr "{{name}} ne doit pas être un secteur de Albania"

#: gettext.php:266
msgid "{{name}} must be a subdivision code of Djibouti"
msgstr "{{name}} doit être un secteur de Djibouti"

#: gettext.php:267
msgid "{{name}} must be not a subdivision code of Djibouti"
msgstr "{{name}} ne doit pas être un secteur de Djibouti"

#: gettext.php:268
msgid "{{name}} must be a subdivision code of Nicaragua"
msgstr "{{name}} doit être un secteur de Nicaragua"

#: gettext.php:269
msgid "{{name}} must be not a subdivision code of Nicaragua"
msgstr "{{name}} ne doit pas être un secteur de Nicaragua"

#: gettext.php:270
msgid "{{name}} must be a subdivision code of Equatorial Guinea"
msgstr "{{name}} doit être un secteur de Equatorial Guinea"

#: gettext.php:271
msgid "{{name}} must be not a subdivision code of Equatorial Guinea"
msgstr "{{name}} ne doit pas être un secteur de Equatorial Guinea"

#: gettext.php:272
msgid "{{name}} must be a subdivision code of Iran"
msgstr "{{name}} doit être un secteur de Iran"

#: gettext.php:273
msgid "{{name}} must be not a subdivision code of Iran"
msgstr "{{name}} ne doit pas être un secteur de Iran"

#: gettext.php:274
msgid "{{name}} must be a subdivision code of Germany"
msgstr "{{name}} doit être un secteur de Germany"

#: gettext.php:275
msgid "{{name}} must be not a subdivision code of Germany"
msgstr "{{name}} ne doit pas être un secteur de Germany"

#: gettext.php:276
msgid "{{name}} must be a subdivision code of Bulgaria"
msgstr "{{name}} doit être un secteur de Bulgaria"

#: gettext.php:277
msgid "{{name}} must be not a subdivision code of Bulgaria"
msgstr "{{name}} ne doit pas être un secteur de Bulgaria"

#: gettext.php:278
msgid "{{name}} must be a subdivision code of Gambia"
msgstr "{{name}} doit être un secteur de Gambia"

#: gettext.php:279
msgid "{{name}} must be not a subdivision code of Gambia"
msgstr "{{name}} ne doit pas être un secteur de Gambia"

#: gettext.php:280
msgid "{{name}} must be a subdivision code of Cocos [Keeling] Islands"
msgstr "{{name}} doit être un secteur de Cocos [Keeling] Islands"

#: gettext.php:281
msgid "{{name}} must be not a subdivision code of Cocos [Keeling] Islands"
msgstr "{{name}} ne doit pas être un secteur de Cocos [Keeling] Islands"

#: gettext.php:282
msgid "{{name}} must be a subdivision code of Lebanon"
msgstr "{{name}} doit être un secteur de Lebanon"

#: gettext.php:283
msgid "{{name}} must be not a subdivision code of Lebanon"
msgstr "{{name}} ne doit pas être un secteur de Lebanon"

#: gettext.php:284
msgid "{{name}} must be a subdivision code of Colombia"
msgstr "{{name}} doit être un secteur de Colombia"

#: gettext.php:285
msgid "{{name}} must be not a subdivision code of Colombia"
msgstr "{{name}} ne doit pas être un secteur de Colombia"

#: gettext.php:286
msgid "{{name}} must be a subdivision code of Tokelau"
msgstr "{{name}} doit être un secteur de Tokelau"

#: gettext.php:287
msgid "{{name}} must be not a subdivision code of Tokelau"
msgstr "{{name}} ne doit pas être un secteur de Tokelau"

#: gettext.php:288
msgid "{{name}} must be a subdivision code of Aruba"
msgstr "{{name}} doit être un secteur de Aruba"

#: gettext.php:289
msgid "{{name}} must be not a subdivision code of Aruba"
msgstr "{{name}} ne doit pas être un secteur de Aruba"

#: gettext.php:290
msgid "{{name}} must be a subdivision code of Jamaica"
msgstr "{{name}} doit être un secteur de Jamaica"

#: gettext.php:291
msgid "{{name}} must be not a subdivision code of Jamaica"
msgstr "{{name}} ne doit pas être un secteur de Jamaica"

#: gettext.php:292
msgid "{{name}} must be a subdivision code of Svalbard and Jan Mayen"
msgstr "{{name}} doit être un secteur de Svalbard and Jan Mayen"

#: gettext.php:293
msgid "{{name}} must be not a subdivision code of Svalbard and Jan Mayen"
msgstr "{{name}} ne doit pas être un secteur de Svalbard and Jan Mayen"

#: gettext.php:294
msgid "{{name}} must be a subdivision code of Chile"
msgstr "{{name}} doit être un secteur de Chile"

#: gettext.php:295
msgid "{{name}} must be not a subdivision code of Chile"
msgstr "{{name}} ne doit pas être un secteur de Chile"

#: gettext.php:296
msgid "{{name}} must be a subdivision code of Poland"
msgstr "{{name}} doit être un secteur de Poland"

#: gettext.php:297
msgid "{{name}} must be not a subdivision code of Poland"
msgstr "{{name}} ne doit pas être un secteur de Poland"

#: gettext.php:298
msgid "{{name}} must be a subdivision code of Mayotte"
msgstr "{{name}} doit être un secteur de Mayotte"

#: gettext.php:299
msgid "{{name}} must be not a subdivision code of Mayotte"
msgstr "{{name}} ne doit pas être un secteur de Mayotte"

#: gettext.php:300
msgid "{{name}} must be a subdivision code of Jordan"
msgstr "{{name}} doit être un secteur de Jordan"

#: gettext.php:301
msgid "{{name}} must be not a subdivision code of Jordan"
msgstr "{{name}} ne doit pas être un secteur de Jordan"

#: gettext.php:302
msgid "{{name}} must be a subdivision code of Luxembourg"
msgstr "{{name}} doit être un secteur de Luxembourg"

#: gettext.php:303
msgid "{{name}} must be not a subdivision code of Luxembourg"
msgstr "{{name}} ne doit pas être un secteur de Luxembourg"

#: gettext.php:304
msgid "{{name}} must be a subdivision code of Ghana"
msgstr "{{name}} doit être un secteur de Ghana"

#: gettext.php:305
msgid "{{name}} must be not a subdivision code of Ghana"
msgstr "{{name}} ne doit pas être un secteur de Ghana"

#: gettext.php:306
msgid "{{name}} must be a subdivision code of Cambodia"
msgstr "{{name}} doit être un secteur de Cambodia"

#: gettext.php:307
msgid "{{name}} must be not a subdivision code of Cambodia"
msgstr "{{name}} ne doit pas être un secteur de Cambodia"

#: gettext.php:308
msgid "{{name}} must be a subdivision code of Saint Vincent and the Grenadines"
msgstr "{{name}} doit être un secteur de Saint Vincent and the Grenadines"

#: gettext.php:309
msgid "{{name}} must be not a subdivision code of Saint Vincent and the Grenadines"
msgstr "{{name}} ne doit pas être un secteur de Saint Vincent and the Grenadines"

#: gettext.php:310
msgid "{{name}} must be a subdivision code of El Salvador"
msgstr "{{name}} doit être un secteur de El Salvador"

#: gettext.php:311
msgid "{{name}} must be not a subdivision code of El Salvador"
msgstr "{{name}} ne doit pas être un secteur de El Salvador"

#: gettext.php:312
msgid "{{name}} must be a subdivision code of Western Sahara"
msgstr "{{name}} doit être un secteur de Western Sahara"

#: gettext.php:313
msgid "{{name}} must be not a subdivision code of Western Sahara"
msgstr "{{name}} ne doit pas être un secteur de Western Sahara"

#: gettext.php:314
msgid "{{name}} must be a subdivision code of Mali"
msgstr "{{name}} doit être un secteur de Mali"

#: gettext.php:315
msgid "{{name}} must be not a subdivision code of Mali"
msgstr "{{name}} ne doit pas être un secteur de Mali"

#: gettext.php:316
msgid "{{name}} must be a subdivision code of Antigua and Barbuda"
msgstr "{{name}} doit être un secteur de Antigua and Barbuda"

#: gettext.php:317
msgid "{{name}} must be not a subdivision code of Antigua and Barbuda"
msgstr "{{name}} ne doit pas être un secteur de Antigua and Barbuda"

#: gettext.php:318
msgid "{{name}} must be a subdivision code of Ukraine"
msgstr "{{name}} doit être un secteur de Ukraine"

#: gettext.php:319
msgid "{{name}} must be not a subdivision code of Ukraine"
msgstr "{{name}} ne doit pas être un secteur de Ukraine"

#: gettext.php:320
msgid "{{name}} must be a subdivision code of Vatican City"
msgstr "{{name}} doit être un secteur de Vatican City"

#: gettext.php:321
msgid "{{name}} must be not a subdivision code of Vatican City"
msgstr "{{name}} ne doit pas être un secteur de Vatican City"

#: gettext.php:322
msgid "{{name}} must be a subdivision code of Saint Kitts and Nevis"
msgstr "{{name}} doit être un secteur de Saint Kitts and Nevis"

#: gettext.php:323
msgid "{{name}} must be not a subdivision code of Saint Kitts and Nevis"
msgstr "{{name}} ne doit pas être un secteur de Saint Kitts and Nevis"

#: gettext.php:324
msgid "{{name}} must be a subdivision code of New Caledonia"
msgstr "{{name}} doit être un secteur de New Caledonia"

#: gettext.php:325
msgid "{{name}} must be not a subdivision code of New Caledonia"
msgstr "{{name}} ne doit pas être un secteur de New Caledonia"

#: gettext.php:326
msgid "{{name}} must be a subdivision code of Republic of the Congo"
msgstr "{{name}} doit être un secteur de Republic of the Congo"

#: gettext.php:327
msgid "{{name}} must be not a subdivision code of Republic of the Congo"
msgstr "{{name}} ne doit pas être un secteur de Republic of the Congo"

#: gettext.php:328
msgid "{{name}} must be a subdivision code of São Tomé and Príncipe"
msgstr "{{name}} doit être un secteur de São Tomé and Príncipe"

#: gettext.php:329
msgid "{{name}} must be not a subdivision code of São Tomé and Príncipe"
msgstr "{{name}} ne doit pas être un secteur de São Tomé and Príncipe"

#: gettext.php:330
msgid "{{name}} must be a subdivision code of Cyprus"
msgstr "{{name}} doit être un secteur de Cyprus"

#: gettext.php:331
msgid "{{name}} must be not a subdivision code of Cyprus"
msgstr "{{name}} ne doit pas être un secteur de Cyprus"

#: gettext.php:332
msgid "{{name}} must be a subdivision code of Kuwait"
msgstr "{{name}} doit être un secteur de Kuwait"

#: gettext.php:333
msgid "{{name}} must be not a subdivision code of Kuwait"
msgstr "{{name}} ne doit pas être un secteur de Kuwait"

#: gettext.php:334
msgid "{{name}} must be a subdivision code of Burundi"
msgstr "{{name}} doit être un secteur de Burundi"

#: gettext.php:335
msgid "{{name}} must be not a subdivision code of Burundi"
msgstr "{{name}} ne doit pas être un secteur de Burundi"

#: gettext.php:336
msgid "{{name}} must be a subdivision code of Eritrea"
msgstr "{{name}} doit être un secteur de Eritrea"

#: gettext.php:337
msgid "{{name}} must be not a subdivision code of Eritrea"
msgstr "{{name}} ne doit pas être un secteur de Eritrea"

#: gettext.php:338
msgid "{{name}} must be a subdivision code of Sint Maarten"
msgstr "{{name}} doit être un secteur de Sint Maarten"

#: gettext.php:339
msgid "{{name}} must be not a subdivision code of Sint Maarten"
msgstr "{{name}} ne doit pas être un secteur de Sint Maarten"

#: gettext.php:340
msgid "{{name}} must be a subdivision code of Paraguay"
msgstr "{{name}} doit être un secteur de Paraguay"

#: gettext.php:341
msgid "{{name}} must be not a subdivision code of Paraguay"
msgstr "{{name}} ne doit pas être un secteur de Paraguay"

#: gettext.php:342
msgid "{{name}} must be a subdivision code of Democratic Republic of the Congo"
msgstr "{{name}} doit être un secteur de Democratic Republic of the Congo"

#: gettext.php:343
msgid "{{name}} must be not a subdivision code of Democratic Republic of the Congo"
msgstr "{{name}} ne doit pas être un secteur de Democratic Republic of the Congo"

#: gettext.php:344
msgid "{{name}} must be a subdivision code of Cape Verde"
msgstr "{{name}} doit être un secteur de Cape Verde"

#: gettext.php:345
msgid "{{name}} must be not a subdivision code of Cape Verde"
msgstr "{{name}} ne doit pas être un secteur de Cape Verde"

#: gettext.php:346
msgid "{{name}} must be a subdivision code of India"
msgstr "{{name}} doit être un secteur de India"

#: gettext.php:347
msgid "{{name}} must be not a subdivision code of India"
msgstr "{{name}} ne doit pas être un secteur de India"

#: gettext.php:348
msgid "{{name}} must be a subdivision code of Niue"
msgstr "{{name}} doit être un secteur de Niue"

#: gettext.php:349
msgid "{{name}} must be not a subdivision code of Niue"
msgstr "{{name}} ne doit pas être un secteur de Niue"

#: gettext.php:350
msgid "{{name}} must be a subdivision code of Gibraltar"
msgstr "{{name}} doit être un secteur de Gibraltar"

#: gettext.php:351
msgid "{{name}} must be not a subdivision code of Gibraltar"
msgstr "{{name}} ne doit pas être un secteur de Gibraltar"

#: gettext.php:352
msgid "{{name}} must be a subdivision code of China"
msgstr "{{name}} doit être un secteur de China"

#: gettext.php:353
msgid "{{name}} must be not a subdivision code of China"
msgstr "{{name}} ne doit pas être un secteur de China"

#: gettext.php:354
msgid "{{name}} must be a subdivision code of Saint Barthélemy"
msgstr "{{name}} doit être un secteur de Saint Barthélemy"

#: gettext.php:355
msgid "{{name}} must be not a subdivision code of Saint Barthélemy"
msgstr "{{name}} ne doit pas être un secteur de Saint Barthélemy"

#: gettext.php:356
msgid "{{name}} must be a subdivision code of Azerbaijan"
msgstr "{{name}} doit être un secteur de Azerbaijan"

#: gettext.php:357
msgid "{{name}} must be not a subdivision code of Azerbaijan"
msgstr "{{name}} ne doit pas être un secteur de Azerbaijan"

#: gettext.php:358
msgid "{{name}} must be a subdivision code of Lesotho"
msgstr "{{name}} doit être un secteur de Lesotho"

#: gettext.php:359
msgid "{{name}} must be not a subdivision code of Lesotho"
msgstr "{{name}} ne doit pas être un secteur de Lesotho"

#: gettext.php:360
msgid "{{name}} must be a subdivision code of Falkland Islands"
msgstr "{{name}} doit être un secteur de Falkland Islands"

#: gettext.php:361
msgid "{{name}} must be not a subdivision code of Falkland Islands"
msgstr "{{name}} ne doit pas être un secteur de Falkland Islands"

#: gettext.php:362
msgid "{{name}} must be a subdivision code of Tonga"
msgstr "{{name}} doit être un secteur de Tonga"

#: gettext.php:363
msgid "{{name}} must be not a subdivision code of Tonga"
msgstr "{{name}} ne doit pas être un secteur de Tonga"

#: gettext.php:364
msgid "{{name}} must be a subdivision code of British Indian Ocean Territory"
msgstr "{{name}} doit être un secteur de British Indian Ocean Territory"

#: gettext.php:365
msgid "{{name}} must be not a subdivision code of British Indian Ocean Territory"
msgstr "{{name}} ne doit pas être un secteur de British Indian Ocean Territory"

#: gettext.php:366
msgid "{{name}} must be a subdivision code of New Zealand"
msgstr "{{name}} doit être un secteur de New Zealand"

#: gettext.php:367
msgid "{{name}} must be not a subdivision code of New Zealand"
msgstr "{{name}} ne doit pas être un secteur de New Zealand"

#: gettext.php:368
msgid "{{name}} must be a subdivision code of Northern Mariana Islands"
msgstr "{{name}} doit être un secteur de Northern Mariana Islands"

#: gettext.php:369
msgid "{{name}} must be not a subdivision code of Northern Mariana Islands"
msgstr "{{name}} ne doit pas être un secteur de Northern Mariana Islands"

#: gettext.php:370
msgid "{{name}} must be a subdivision code of Belgium"
msgstr "{{name}} doit être un secteur de Belgium"

#: gettext.php:371
msgid "{{name}} must be not a subdivision code of Belgium"
msgstr "{{name}} ne doit pas être un secteur de Belgium"

#: gettext.php:372
msgid "{{name}} must be a subdivision code of Kazakhstan"
msgstr "{{name}} doit être un secteur de Kazakhstan"

#: gettext.php:373
msgid "{{name}} must be not a subdivision code of Kazakhstan"
msgstr "{{name}} ne doit pas être un secteur de Kazakhstan"

#: gettext.php:374
msgid "{{name}} must be a subdivision code of Macao"
msgstr "{{name}} doit être un secteur de Macao"

#: gettext.php:375
msgid "{{name}} must be not a subdivision code of Macao"
msgstr "{{name}} ne doit pas être un secteur de Macao"

#: gettext.php:376
msgid "{{name}} must be a subdivision code of France"
msgstr "{{name}} doit être un secteur de France"

#: gettext.php:377
msgid "{{name}} must be not a subdivision code of France"
msgstr "{{name}} ne doit pas être un secteur de France"

#: gettext.php:378
msgid "{{name}} must be a subdivision code of Malaysia"
msgstr "{{name}} doit être un secteur de Malaysia"

#: gettext.php:379
msgid "{{name}} must be not a subdivision code of Malaysia"
msgstr "{{name}} ne doit pas être un secteur de Malaysia"

#: gettext.php:380
msgid "{{name}} must be a subdivision code of Japan"
msgstr "{{name}} doit être un secteur de Japan"

#: gettext.php:381
msgid "{{name}} must be not a subdivision code of Japan"
msgstr "{{name}} ne doit pas être un secteur de Japan"

#: gettext.php:382
msgid "{{name}} must be a subdivision code of Seychelles"
msgstr "{{name}} doit être un secteur de Seychelles"

#: gettext.php:383
msgid "{{name}} must be not a subdivision code of Seychelles"
msgstr "{{name}} ne doit pas être un secteur de Seychelles"

#: gettext.php:384
msgid "{{name}} must be a subdivision code of Portugal"
msgstr "{{name}} doit être un secteur de Portugal"

#: gettext.php:385
msgid "{{name}} must be not a subdivision code of Portugal"
msgstr "{{name}} ne doit pas être un secteur de Portugal"

#: gettext.php:386
msgid "{{name}} must be a subdivision code of Swaziland"
msgstr "{{name}} doit être un secteur de Swaziland"

#: gettext.php:387
msgid "{{name}} must be not a subdivision code of Swaziland"
msgstr "{{name}} ne doit pas être un secteur de Swaziland"

#: gettext.php:388
msgid "{{name}} must be a subdivision code of Guinea-Bissau"
msgstr "{{name}} doit être un secteur de Guinea-Bissau"

#: gettext.php:389
msgid "{{name}} must be not a subdivision code of Guinea-Bissau"
msgstr "{{name}} ne doit pas être un secteur de Guinea-Bissau"

#: gettext.php:390
msgid "{{name}} must be a subdivision code of Ireland"
msgstr "{{name}} doit être un secteur de Ireland"

#: gettext.php:391
msgid "{{name}} must be not a subdivision code of Ireland"
msgstr "{{name}} ne doit pas être un secteur de Ireland"

#: gettext.php:392
msgid "{{name}} must be a subdivision code of Guinea"
msgstr "{{name}} doit être un secteur de Guinea"

#: gettext.php:393
msgid "{{name}} must be not a subdivision code of Guinea"
msgstr "{{name}} ne doit pas être un secteur de Guinea"

#: gettext.php:394
msgid "{{name}} must be a subdivision code of Togo"
msgstr "{{name}} doit être un secteur de Togo"

#: gettext.php:395
msgid "{{name}} must be not a subdivision code of Togo"
msgstr "{{name}} ne doit pas être un secteur de Togo"

#: gettext.php:396
msgid "{{name}} must be a subdivision code of Libya"
msgstr "{{name}} doit être un secteur de Libya"

#: gettext.php:397
msgid "{{name}} must be not a subdivision code of Libya"
msgstr "{{name}} ne doit pas être un secteur de Libya"

#: gettext.php:398
msgid "{{name}} must be a subdivision code of Panama"
msgstr "{{name}} doit être un secteur de Panama"

#: gettext.php:399
msgid "{{name}} must be not a subdivision code of Panama"
msgstr "{{name}} ne doit pas être un secteur de Panama"

#: gettext.php:400
msgid "{{name}} must be a subdivision code of Turkmenistan"
msgstr "{{name}} doit être un secteur de Turkmenistan"

#: gettext.php:401
msgid "{{name}} must be not a subdivision code of Turkmenistan"
msgstr "{{name}} ne doit pas être un secteur de Turkmenistan"

#: gettext.php:402
msgid "{{name}} must be a subdivision code of Jersey"
msgstr "{{name}} doit être un secteur de Jersey"

#: gettext.php:403
msgid "{{name}} must be not a subdivision code of Jersey"
msgstr "{{name}} ne doit pas être un secteur de Jersey"

#: gettext.php:404
msgid "{{name}} must be a subdivision code of Serbia"
msgstr "{{name}} doit être un secteur de Serbia"

#: gettext.php:405
msgid "{{name}} must be not a subdivision code of Serbia"
msgstr "{{name}} ne doit pas être un secteur de Serbia"

#: gettext.php:406
msgid "{{name}} must be a subdivision code of Bouvet Island"
msgstr "{{name}} doit être un secteur de Bouvet Island"

#: gettext.php:407
msgid "{{name}} must be not a subdivision code of Bouvet Island"
msgstr "{{name}} ne doit pas être un secteur de Bouvet Island"

#: gettext.php:408
msgid "{{name}} must be a subdivision code of Russia"
msgstr "{{name}} doit être un secteur de Russia"

#: gettext.php:409
msgid "{{name}} must be not a subdivision code of Russia"
msgstr "{{name}} ne doit pas être un secteur de Russia"

#: gettext.php:410
msgid "{{name}} must be a subdivision code of Palestine"
msgstr "{{name}} doit être un secteur de Palestine"

#: gettext.php:411
msgid "{{name}} must be not a subdivision code of Palestine"
msgstr "{{name}} ne doit pas être un secteur de Palestine"

#: gettext.php:412
msgid "{{name}} must be a subdivision code of Nigeria"
msgstr "{{name}} doit être un secteur de Nigeria"

#: gettext.php:413
msgid "{{name}} must be not a subdivision code of Nigeria"
msgstr "{{name}} ne doit pas être un secteur de Nigeria"

#: gettext.php:414
msgid "{{name}} must be a subdivision code of Zambia"
msgstr "{{name}} doit être un secteur de Zambia"

#: gettext.php:415
msgid "{{name}} must be not a subdivision code of Zambia"
msgstr "{{name}} ne doit pas être un secteur de Zambia"

#: gettext.php:416
msgid "{{name}} must be a subdivision code of Guyana"
msgstr "{{name}} doit être un secteur de Guyana"

#: gettext.php:417
msgid "{{name}} must be not a subdivision code of Guyana"
msgstr "{{name}} ne doit pas être un secteur de Guyana"

#: gettext.php:418
msgid "{{name}} must be a subdivision code of Australia"
msgstr "{{name}} doit être un secteur de Australia"

#: gettext.php:419
msgid "{{name}} must be not a subdivision code of Australia"
msgstr "{{name}} ne doit pas être un secteur de Australia"

#: gettext.php:420
msgid "{{name}} must be a subdivision code of Singapore"
msgstr "{{name}} doit être un secteur de Singapore"

#: gettext.php:421
msgid "{{name}} must be not a subdivision code of Singapore"
msgstr "{{name}} ne doit pas être un secteur de Singapore"

#: gettext.php:422
msgid "{{name}} must be a subdivision code of Vietnam"
msgstr "{{name}} doit être un secteur de Vietnam"

#: gettext.php:423
msgid "{{name}} must be not a subdivision code of Vietnam"
msgstr "{{name}} ne doit pas être un secteur de Vietnam"

#: gettext.php:424
msgid "{{name}} must be a subdivision code of Liberia"
msgstr "{{name}} doit être un secteur de Liberia"

#: gettext.php:425
msgid "{{name}} must be not a subdivision code of Liberia"
msgstr "{{name}} ne doit pas être un secteur de Liberia"

#: gettext.php:426
msgid "{{name}} must be a subdivision code of Curacao"
msgstr "{{name}} doit être un secteur de Curacao"

#: gettext.php:427
msgid "{{name}} must be not a subdivision code of Curacao"
msgstr "{{name}} ne doit pas être un secteur de Curacao"

#: gettext.php:428
msgid "{{name}} must be a subdivision code of Guadeloupe"
msgstr "{{name}} doit être un secteur de Guadeloupe"

#: gettext.php:429
msgid "{{name}} must be not a subdivision code of Guadeloupe"
msgstr "{{name}} ne doit pas être un secteur de Guadeloupe"

#: gettext.php:430
msgid "{{name}} must be a subdivision code of Kyrgyzstan"
msgstr "{{name}} doit être un secteur de Kyrgyzstan"

#: gettext.php:431
msgid "{{name}} must be not a subdivision code of Kyrgyzstan"
msgstr "{{name}} ne doit pas être un secteur de Kyrgyzstan"

#: gettext.php:432
msgid "{{name}} must be a subdivision code of Suriname"
msgstr "{{name}} doit être un secteur de Suriname"

#: gettext.php:433
msgid "{{name}} must be not a subdivision code of Suriname"
msgstr "{{name}} ne doit pas être un secteur de Suriname"

#: gettext.php:434
msgid "{{name}} must be a subdivision code of Solomon Islands"
msgstr "{{name}} doit être un secteur de Solomon Islands"

#: gettext.php:435
msgid "{{name}} must be not a subdivision code of Solomon Islands"
msgstr "{{name}} ne doit pas être un secteur de Solomon Islands"

#: gettext.php:436
msgid "{{name}} must be a subdivision code of Faroe Islands"
msgstr "{{name}} doit être un secteur de Faroe Islands"

#: gettext.php:437
msgid "{{name}} must be not a subdivision code of Faroe Islands"
msgstr "{{name}} ne doit pas être un secteur de Faroe Islands"

#: gettext.php:438
msgid "{{name}} must be a subdivision code of Moldova"
msgstr "{{name}} doit être un secteur de Moldova"

#: gettext.php:439
msgid "{{name}} must be not a subdivision code of Moldova"
msgstr "{{name}} ne doit pas être un secteur de Moldova"

#: gettext.php:440
msgid "{{name}} must be a subdivision code of Estonia"
msgstr "{{name}} doit être un secteur de Estonia"

#: gettext.php:441
msgid "{{name}} must be not a subdivision code of Estonia"
msgstr "{{name}} ne doit pas être un secteur de Estonia"

#: gettext.php:442
msgid "{{name}} must be a subdivision code of South Georgia and the South Sandwich Islands"
msgstr "{{name}} doit être un secteur de South Georgia and the South Sandwich Islands"

#: gettext.php:443
msgid "{{name}} must be not a subdivision code of South Georgia and the South Sandwich Islands"
msgstr "{{name}} ne doit pas être un secteur de South Georgia and the South Sandwich Islands"

#: gettext.php:444
msgid "{{name}} must be a subdivision code of Austria"
msgstr "{{name}} doit être un secteur de Austria"

#: gettext.php:445
msgid "{{name}} must be not a subdivision code of Austria"
msgstr "{{name}} ne doit pas être un secteur de Austria"

#: gettext.php:446
msgid "{{name}} must be a subdivision code of Botswana"
msgstr "{{name}} doit être un secteur de Botswana"

#: gettext.php:447
msgid "{{name}} must be not a subdivision code of Botswana"
msgstr "{{name}} ne doit pas être un secteur de Botswana"

#: gettext.php:448
msgid "{{name}} must be a subdivision code of Mauritania"
msgstr "{{name}} doit être un secteur de Mauritania"

#: gettext.php:449
msgid "{{name}} must be not a subdivision code of Mauritania"
msgstr "{{name}} ne doit pas être un secteur de Mauritania"

#: gettext.php:450
msgid "{{name}} must be a subdivision code of Haiti"
msgstr "{{name}} doit être un secteur de Haiti"

#: gettext.php:451
msgid "{{name}} must be not a subdivision code of Haiti"
msgstr "{{name}} ne doit pas être un secteur de Haiti"

#: gettext.php:452
msgid "{{name}} must be a subdivision code of Somalia"
msgstr "{{name}} doit être un secteur de Somalia"

#: gettext.php:453
msgid "{{name}} must be not a subdivision code of Somalia"
msgstr "{{name}} ne doit pas être un secteur de Somalia"

#: gettext.php:454
msgid "{{name}} must be a subdivision code of South Sudan"
msgstr "{{name}} doit être un secteur de South Sudan"

#: gettext.php:455
msgid "{{name}} must be not a subdivision code of South Sudan"
msgstr "{{name}} ne doit pas être un secteur de South Sudan"

#: gettext.php:456
msgid "{{name}} must be a subdivision code of Venezuela"
msgstr "{{name}} doit être un secteur de Venezuela"

#: gettext.php:457
msgid "{{name}} must be not a subdivision code of Venezuela"
msgstr "{{name}} ne doit pas être un secteur de Venezuela"

#: gettext.php:458
msgid "{{name}} must be a subdivision code of Christmas Island"
msgstr "{{name}} doit être un secteur de Christmas Island"

#: gettext.php:459
msgid "{{name}} must be not a subdivision code of Christmas Island"
msgstr "{{name}} ne doit pas être un secteur de Christmas Island"

#: gettext.php:460
msgid "{{name}} must be a subdivision code of Indonesia"
msgstr "{{name}} doit être un secteur de Indonesia"

#: gettext.php:461
msgid "{{name}} must be not a subdivision code of Indonesia"
msgstr "{{name}} ne doit pas être un secteur de Indonesia"

#: gettext.php:462
msgid "{{name}} must be a subdivision code of Yemen"
msgstr "{{name}} doit être un secteur de Yemen"

#: gettext.php:463
msgid "{{name}} must be not a subdivision code of Yemen"
msgstr "{{name}} ne doit pas être un secteur de Yemen"

#: gettext.php:464
msgid "{{name}} must be a subdivision code of Gabon"
msgstr "{{name}} doit être un secteur de Gabon"

#: gettext.php:465
msgid "{{name}} must be not a subdivision code of Gabon"
msgstr "{{name}} ne doit pas être un secteur de Gabon"

#: gettext.php:466
msgid "{{name}} must be a subdivision code of American Samoa"
msgstr "{{name}} doit être un secteur de American Samoa"

#: gettext.php:467
msgid "{{name}} must be not a subdivision code of American Samoa"
msgstr "{{name}} ne doit pas être un secteur de American Samoa"

#: gettext.php:468
msgid "{{name}} must be a subdivision code of Cayman Islands"
msgstr "{{name}} doit être un secteur de Cayman Islands"

#: gettext.php:469
msgid "{{name}} must be not a subdivision code of Cayman Islands"
msgstr "{{name}} ne doit pas être un secteur de Cayman Islands"

#: gettext.php:470
msgid "{{name}} must be a subdivision code of Namibia"
msgstr "{{name}} doit être un secteur de Namibia"

#: gettext.php:471
msgid "{{name}} must be not a subdivision code of Namibia"
msgstr "{{name}} ne doit pas être un secteur de Namibia"

#: gettext.php:472
msgid "{{name}} must be a subdivision code of French Polynesia"
msgstr "{{name}} doit être un secteur de French Polynesia"

#: gettext.php:473
msgid "{{name}} must be not a subdivision code of French Polynesia"
msgstr "{{name}} ne doit pas être un secteur de French Polynesia"

#: gettext.php:474
msgid "{{name}} must be a subdivision code of Burkina Faso"
msgstr "{{name}} doit être un secteur de Burkina Faso"

#: gettext.php:475
msgid "{{name}} must be not a subdivision code of Burkina Faso"
msgstr "{{name}} ne doit pas être un secteur de Burkina Faso"

#: gettext.php:476
msgid "{{name}} must be a subdivision code of Laos"
msgstr "{{name}} doit être un secteur de Laos"

#: gettext.php:477
msgid "{{name}} must be not a subdivision code of Laos"
msgstr "{{name}} ne doit pas être un secteur de Laos"

#: gettext.php:478
msgid "{{name}} must be a subdivision code of Kiribati"
msgstr "{{name}} doit être un secteur de Kiribati"

#: gettext.php:479
msgid "{{name}} must be not a subdivision code of Kiribati"
msgstr "{{name}} ne doit pas être un secteur de Kiribati"

#: gettext.php:480
msgid "{{name}} must be a subdivision code of Guam"
msgstr "{{name}} doit être un secteur de Guam"

#: gettext.php:481
msgid "{{name}} must be not a subdivision code of Guam"
msgstr "{{name}} ne doit pas être un secteur de Guam"

#: gettext.php:482
msgid "{{name}} must be a subdivision code of Rwanda"
msgstr "{{name}} doit être un secteur de Rwanda"

#: gettext.php:483
msgid "{{name}} must be not a subdivision code of Rwanda"
msgstr "{{name}} ne doit pas être un secteur de Rwanda"

#: gettext.php:484
msgid "{{name}} must be a subdivision code of United States"
msgstr "{{name}} doit être un secteur de United States"

#: gettext.php:485
msgid "{{name}} must be not a subdivision code of United States"
msgstr "{{name}} ne doit pas être un secteur de United States"

#: gettext.php:486
msgid "{{name}} must be a subdivision code of French Guiana"
msgstr "{{name}} doit être un secteur de French Guiana"

#: gettext.php:487
msgid "{{name}} must be not a subdivision code of French Guiana"
msgstr "{{name}} ne doit pas être un secteur de French Guiana"

#: gettext.php:488
msgid "{{name}} must be a subdivision code of Marshall Islands"
msgstr "{{name}} doit être un secteur de Marshall Islands"

#: gettext.php:489
msgid "{{name}} must be not a subdivision code of Marshall Islands"
msgstr "{{name}} ne doit pas être un secteur de Marshall Islands"

#: gettext.php:490
msgid "{{name}} must be a subdivision code of Brazil"
msgstr "{{name}} doit être un secteur de Brazil"

#: gettext.php:491
msgid "{{name}} must be not a subdivision code of Brazil"
msgstr "{{name}} ne doit pas être un secteur de Brazil"

#: gettext.php:492
msgid "{{name}} must be a subdivision code of Uganda"
msgstr "{{name}} doit être un secteur de Uganda"

#: gettext.php:493
msgid "{{name}} must be not a subdivision code of Uganda"
msgstr "{{name}} ne doit pas être un secteur de Uganda"

#: gettext.php:494
msgid "{{name}} must be a subdivision code of Pakistan"
msgstr "{{name}} doit être un secteur de Pakistan"

#: gettext.php:495
msgid "{{name}} must be not a subdivision code of Pakistan"
msgstr "{{name}} ne doit pas être un secteur de Pakistan"

#: gettext.php:496
msgid "{{name}} must be a subdivision code of Norfolk Island"
msgstr "{{name}} doit être un secteur de Norfolk Island"

#: gettext.php:497
msgid "{{name}} must be not a subdivision code of Norfolk Island"
msgstr "{{name}} ne doit pas être un secteur de Norfolk Island"

#: gettext.php:498
msgid "{{name}} must be a subdivision code of Peru"
msgstr "{{name}} doit être un secteur de Peru"

#: gettext.php:499
msgid "{{name}} must be not a subdivision code of Peru"
msgstr "{{name}} ne doit pas être un secteur de Peru"

#: gettext.php:500
msgid "{{name}} must be a subdivision code of South Korea"
msgstr "{{name}} doit être un secteur de South Korea"

#: gettext.php:501
msgid "{{name}} must be not a subdivision code of South Korea"
msgstr "{{name}} ne doit pas être un secteur de South Korea"

#: gettext.php:502
msgid "{{name}} must be a subdivision code of Bosnia and Herzegovina"
msgstr "{{name}} doit être un secteur de Bosnia and Herzegovina"

#: gettext.php:503
msgid "{{name}} must be not a subdivision code of Bosnia and Herzegovina"
msgstr "{{name}} ne doit pas être un secteur de Bosnia and Herzegovina"

#: gettext.php:504
msgid "{{name}} must be a subdivision code of Iceland"
msgstr "{{name}} doit être un secteur de Iceland"

#: gettext.php:505
msgid "{{name}} must be not a subdivision code of Iceland"
msgstr "{{name}} ne doit pas être un secteur de Iceland"

#: gettext.php:506
msgid "{{name}} must be a subdivision code of Argentina"
msgstr "{{name}} doit être un secteur de Argentina"

#: gettext.php:507
msgid "{{name}} must be not a subdivision code of Argentina"
msgstr "{{name}} ne doit pas être un secteur de Argentina"

#: gettext.php:508
msgid "{{name}} must be a subdivision code of Armenia"
msgstr "{{name}} doit être un secteur de Armenia"

#: gettext.php:509
msgid "{{name}} must be not a subdivision code of Armenia"
msgstr "{{name}} ne doit pas être un secteur de Armenia"

#: gettext.php:510
msgid "{{name}} must be a subdivision code of Spain"
msgstr "{{name}} doit être un secteur de Spain"

#: gettext.php:511
msgid "{{name}} must be not a subdivision code of Spain"
msgstr "{{name}} ne doit pas être un secteur de Spain"

#: gettext.php:512
msgid "{{name}} must be a subdivision code of Kenya"
msgstr "{{name}} doit être un secteur de Kenya"

#: gettext.php:513
msgid "{{name}} must be not a subdivision code of Kenya"
msgstr "{{name}} ne doit pas être un secteur de Kenya"

#: gettext.php:514
msgid "{{name}} must be a subdivision code of Liechtenstein"
msgstr "{{name}} doit être un secteur de Liechtenstein"

#: gettext.php:515
msgid "{{name}} must be not a subdivision code of Liechtenstein"
msgstr "{{name}} ne doit pas être un secteur de Liechtenstein"

#: gettext.php:516
msgid "{{name}} must be a subdivision code of South Africa"
msgstr "{{name}} doit être un secteur de South Africa"

#: gettext.php:517
msgid "{{name}} must be not a subdivision code of South Africa"
msgstr "{{name}} ne doit pas être un secteur de South Africa"

#: gettext.php:518
msgid "{{name}} must be a subdivision code of Greenland"
msgstr "{{name}} doit être un secteur de Greenland"

#: gettext.php:519
msgid "{{name}} must be not a subdivision code of Greenland"
msgstr "{{name}} ne doit pas être un secteur de Greenland"

#: gettext.php:520
msgid "{{name}} must be a subdivision code of Uzbekistan"
msgstr "{{name}} doit être un secteur de Uzbekistan"

#: gettext.php:521
msgid "{{name}} must be not a subdivision code of Uzbekistan"
msgstr "{{name}} ne doit pas être un secteur de Uzbekistan"

#: gettext.php:522
msgid "{{name}} must be a subdivision code of Finland"
msgstr "{{name}} doit être un secteur de Finland"

#: gettext.php:523
msgid "{{name}} must be not a subdivision code of Finland"
msgstr "{{name}} ne doit pas être un secteur de Finland"

#: gettext.php:524
msgid "{{name}} must be a subdivision code of Martinique"
msgstr "{{name}} doit être un secteur de Martinique"

#: gettext.php:525
msgid "{{name}} must be not a subdivision code of Martinique"
msgstr "{{name}} ne doit pas être un secteur de Martinique"

#: gettext.php:526
msgid "{{name}} must be a subdivision code of Uruguay"
msgstr "{{name}} doit être un secteur de Uruguay"

#: gettext.php:527
msgid "{{name}} must be not a subdivision code of Uruguay"
msgstr "{{name}} ne doit pas être un secteur de Uruguay"

#: gettext.php:528
msgid "{{name}} must be a subdivision code of Barbados"
msgstr "{{name}} doit être un secteur de Barbados"

#: gettext.php:529
msgid "{{name}} must be not a subdivision code of Barbados"
msgstr "{{name}} ne doit pas être un secteur de Barbados"

#: gettext.php:530
msgid "{{name}} must be a subdivision code of Afghanistan"
msgstr "{{name}} doit être un secteur de Afghanistan"

#: gettext.php:531
msgid "{{name}} must be not a subdivision code of Afghanistan"
msgstr "{{name}} ne doit pas être un secteur de Afghanistan"

#: gettext.php:532
msgid "{{name}} must be a subdivision code of United Arab Emirates"
msgstr "{{name}} doit être un secteur de United Arab Emirates"

#: gettext.php:533
msgid "{{name}} must be not a subdivision code of United Arab Emirates"
msgstr "{{name}} ne doit pas être un secteur de United Arab Emirates"

#: gettext.php:534
msgid "{{name}} must be a subdivision code of Oman"
msgstr "{{name}} doit être un secteur de Oman"

#: gettext.php:535
msgid "{{name}} must be not a subdivision code of Oman"
msgstr "{{name}} ne doit pas être un secteur de Oman"

#: gettext.php:536
msgid "{{name}} must be a subdivision code of Morocco"
msgstr "{{name}} doit être un secteur de Morocco"

#: gettext.php:537
msgid "{{name}} must be not a subdivision code of Morocco"
msgstr "{{name}} ne doit pas être un secteur de Morocco"

#: gettext.php:538
msgid "{{name}} must be a subdivision code of Iraq"
msgstr "{{name}} doit être un secteur de Iraq"

#: gettext.php:539
msgid "{{name}} must be not a subdivision code of Iraq"
msgstr "{{name}} ne doit pas être un secteur de Iraq"

#: gettext.php:540
msgid "{{name}} must be a subdivision code of Åland"
msgstr "{{name}} doit être un secteur de Åland"

#: gettext.php:541
msgid "{{name}} must be not a subdivision code of Åland"
msgstr "{{name}} ne doit pas être un secteur de Åland"

#: gettext.php:542
msgid "{{name}} must be a subdivision code of Mozambique"
msgstr "{{name}} doit être un secteur de Mozambique"

#: gettext.php:543
msgid "{{name}} must be not a subdivision code of Mozambique"
msgstr "{{name}} ne doit pas être un secteur de Mozambique"

#: gettext.php:544
msgid "{{name}} must contain only space characters"
msgstr "{{name}} ne doit contenir que des espaces"

#: gettext.php:545
msgid "{{name}} must contain only space characters and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des espaces et \"{{additionalChars}}\""

#: gettext.php:546
msgid "{{name}} must not contain space characters"
msgstr "{{name}} ne doit contenir aucun espace"

#: gettext.php:547
msgid "{{name}} must not contain space characters or \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir aucun espace ni \"{{additionalChars}}\""

#: gettext.php:548
msgid "{{name}} must be a valid image"
msgstr "{{name}} doit être une image valide"

#: gettext.php:549
msgid "{{name}} must not be a valid image"
msgstr "{{name}} ne doit pas être une image valide"

#: gettext.php:550
msgid "{{name}} must be a BIC"
msgstr "{{name}} doit être un numéro BIC"

#: gettext.php:551
msgid "{{name}} must not be a BIC"
msgstr "{{name}} ne doit pas être un numéro BIC"

#: gettext.php:552
msgid "{{name}} must be a hex RGB color"
msgstr "{{name}} doit être une couleur RVB héxadecimal"

#: gettext.php:553
msgid "{{name}} must not be a hex RGB color"
msgstr "{{name}} ne doit pas être une couleur RVB héxadecimal"

#: gettext.php:554
msgid "At least {{howMany}} of the {{failed}} required rules must pass for {{name}}"
msgstr "Au moins {{howMany}} sur {{failed}} règles requises doivent être validées pour {{name}}"

#: gettext.php:555
msgid "At least {{howMany}} of the {{failed}} required rules must pass for {{name}}, only {{passed}} passed."
msgstr "Au moins {{howMany}} sur {{failed}} règles requises doivent être validées pour {{name}}, seulement {{passed}} l'ont été"

#: gettext.php:556
msgid "At least {{howMany}} of the {{failed}} required rules must not pass for {{name}}"
msgstr "Au moins {{howMany}} sur {{failed}} règles requises doivent être invalides pour {{name}}"

#: gettext.php:557
msgid "At least {{howMany}} of the {{failed}} required rules must not pass for {{name}}, only {{passed}} passed."
msgstr "Au moins {{howMany}} sur {{failed}} règles requises doivent être invalides pour {{name}}, seulement {{passed}} l'ont été"

#: gettext.php:558
msgid "{{name}} must be less than {{interval}}"
msgstr "{{name}} doit être inférieur à {{interval}}"

#: gettext.php:559
msgid "{{name}} must be less than or equal to {{interval}}"
msgstr "{{name}} doit être inférieur ou égal à {{interval}}"

#: gettext.php:560
msgid "{{name}} must not be less than {{interval}}"
msgstr "{{name}} ne doit pas être inférieur à {{interval}}"

#: gettext.php:561
msgid "{{name}} must not be less than or equal to {{interval}}"
msgstr "{{name}} ne doit pas être inférieur ou égal à {{interval}}"

#: gettext.php:562
msgid "{{name}} must be a callable"
msgstr "{{name}} doit être de type callable"

#: gettext.php:563
msgid "{{name}} must not be a callable"
msgstr "{{name}} ne doit pas être de type callable"

#: gettext.php:564
msgid "{{name}} must not contain whitespace"
msgstr "{{name}} ne doit contenir aucun caractère d'espacement"

#: gettext.php:565
msgid "{{name}} must not not contain whitespace"
msgstr "{{name}} ne doit pas ne pas contenir de caractère d'espacement"

#: gettext.php:566 gettext.php:606 gettext.php:743
msgid "All of the required rules must pass for {{name}}"
msgstr "Toutes les règles requises doivent être validées pour {{name}}"

#: gettext.php:567 gettext.php:607 gettext.php:744
msgid "These rules must pass for {{name}}"
msgstr "Ces règles doivent être validée pour {{name}}"

#: gettext.php:568
msgid "None of there rules must pass for {{name}}"
msgstr "Aucune de ces règles ne doit être validée pour {{name}}"

#: gettext.php:569 gettext.php:609 gettext.php:747
msgid "These rules must not pass for {{name}}"
msgstr "Ces règles ne doivent pas être validées pour {{name}}"

#: gettext.php:570
msgid "{{name}} must be a file"
msgstr "{{name}} doit être un fichier"

#: gettext.php:571
msgid "{{name}} must not be a file"
msgstr "{{name}} ne doit pas être un fichier"

#: gettext.php:572
msgid "Attribute {{name}} must be present"
msgstr "L'attribut {{name}} doit être présent"

#: gettext.php:573
msgid "Attribute {{name}} must be valid"
msgstr "L'attribut {{name}} doit être valide"

#: gettext.php:574
msgid "Attribute {{name}} must not be present"
msgstr "L'attribut {{name}} ne doit pas être présent"

#: gettext.php:575
msgid "Attribute {{name}} must not validate"
msgstr "L'attribut {{name}} ne doit pas être valide"

#: gettext.php:576
msgid "{{name}} must be a float number"
msgstr "{{name}} doit être un chiffre à virgule"

#: gettext.php:577
msgid "{{name}} must not be a float number"
msgstr "{{name}} ne doit pas être un chiffre à virgule"

#: gettext.php:578
msgid "{{name}} must be an uploaded file"
msgstr "{{name}} doit être un fichier téléversé"

#: gettext.php:579
msgid "{{name}} must not be an uploaded file"
msgstr "{{name}} ne doit pas être un fichier téléversé"

#: gettext.php:580
msgid "{{name}} must be an executable file"
msgstr "{{name}} doit être un fichier exécutable"

#: gettext.php:581
msgid "{{name}} must not be an executable file"
msgstr "{{name}} ne doit pas être un fichier exécutable"

#: gettext.php:582
msgid "{{name}} must be between {{minValue}} and {{maxValue}}"
msgstr "{{name}} doit être compris entre {{minValue}} et {{maxValue}}"

#: gettext.php:583
msgid "{{name}}  must be greater than {{minValue}}"
msgstr "{name}} doit être supérieur à {{minValue}}"

#: gettext.php:584
msgid "{{name}} must be lower than {{maxValue}}"
msgstr "{{name}} doit être inférieur à {{maxValue}}"

#: gettext.php:585
msgid "{{name}} must not be between {{minValue}} and {{maxValue}}"
msgstr "{{name}} ne doit pas être compris entre {{minValue}} et {{maxValue}}"

#: gettext.php:586
msgid "{{name}}  must not be greater than {{minValue}}"
msgstr "{name}} ne doit pas être supérieur à {{minValue}}"

#: gettext.php:587
msgid "{{name}} must not be lower than {{maxValue}}"
msgstr "{{name}} ne doit pas être inférieur à {{maxValue}}"

#: gettext.php:588
msgid "{{name}} must be an instance of {{instanceName}}"
msgstr "{{name}} doit être une instance de {{instanceName}}"

#: gettext.php:589
msgid "{{name}} must not be an instance of {{instanceName}}"
msgstr "{{name}} ne doit pas être une instance de {{instanceName}}"

#: gettext.php:590
msgid "{{name}} must be between {{minSize}} and {{maxSize}}"
msgstr "{{name}} doit être compris entre {{minSize}} and {{maxSize}}"

#: gettext.php:591
msgid "{{name}} must be greater than {{minSize}}"
msgstr "{{name}} doit être supérieur à {{minSize}}"

#: gettext.php:592
msgid "{{name}} must be lower than {{maxSize}}"
msgstr "{{name}} doit être inférieur à {{maxSize}}"

#: gettext.php:593
msgid "{{name}} must not be between {{minSize}} and {{maxSize}}"
msgstr "{{name}} ne doit pas être compris entre {{minSize}} and {{maxSize}}"

#: gettext.php:594
msgid "{{name}} must not be greater than {{minSize}}"
msgstr "{{name}} ne doit pas être supérieur à {{minSize}}"

#: gettext.php:595
msgid "{{name}} must not be lower than {{maxSize}}"
msgstr "{{name}} ne doit pas être inférieur à {{maxSize}}"

#: gettext.php:596
msgid "{{name}} must be a valid PESEL"
msgstr "{{name}} doit être un PESEL valide"

#: gettext.php:597
msgid "{{name}} must not be a valid PESEL"
msgstr "{{name}} ne doit pas être un PESEL valide"

#: gettext.php:598
msgid "{{name}} must contain only vowels"
msgstr "{{name}} ne doit contenir que des voyelles"

#: gettext.php:599
msgid "{{name}} must contain only vowels and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des voyelles et \"{{additionalChars}}\""

#: gettext.php:600
msgid "{{name}} must not contain vowels"
msgstr "{name}} ne doit contenir aucune voyelle"

#: gettext.php:601
msgid "{{name}} must not contain vowels or \"{{additionalChars}}\""
msgstr "{name}} ne doit contenir aucune voyelle ni \"{{additionalChars}}\""

#: gettext.php:602
msgid "Each item in {{name}} must be valid"
msgstr "Chaque élément dans {{name}} doit être valide"

#: gettext.php:603
msgid "Each item in {{name}} must not validate"
msgstr "Chaque élément dans {{name}} doit être invalide"

#: gettext.php:604
msgid "{{name}} must be a valid NFe access key"
msgstr "{{name}} doit être une clé d'accès NFe valide"

#: gettext.php:605
msgid "{{name}} must not be a valid NFe access key"
msgstr "{{name}} ne doit pas être une clé d'accès NFe valide"

#: gettext.php:608 gettext.php:701 gettext.php:746
msgid "None of these rules must pass for {{name}}"
msgstr "Aucune de ces règles ne doit être validée pour {{name}}"

#: gettext.php:610
msgid "{{name}} must be a valid date"
msgstr "{{name}} doit être une date valide"

#: gettext.php:611
msgid "{{name}} must be a valid date. Sample format: {{format}}"
msgstr "{{name}} doit être une date valide. Format : {{format}}"

#: gettext.php:612
msgid "{{name}} must not be a valid date"
msgstr "{{name}} ne doit pas être une date valide"

#: gettext.php:613
msgid "{{name}} must not be a valid date in the format {{format}}"
msgstr "{{name}} ne doit pas être une date valide au format {{format}}"

#: gettext.php:615 gettext.php:691
msgid "Key {{name}} must be present"
msgstr "La clé {{name}} doit être présente"

#: gettext.php:616
msgid "Key {{name}} must be valid"
msgstr "La clé {{name}} doit être valide"

#: gettext.php:617 gettext.php:693
msgid "Key {{name}} must not be present"
msgstr "La clé {{name}} ne doit pas être présente"

#: gettext.php:618
msgid "Key {{name}} must not be valid"
msgstr "La clé {{name}} ne doit pas être valide"

#: gettext.php:619
msgid "{{name}} must be a valid CNPJ number"
msgstr "{{name}} doit être un numéro CNPJ valide"

#: gettext.php:620
msgid "{{name}} must not be a valid CNPJ number"
msgstr "{{name}} ne doit pas être un numéro CNPJ valide"

#: gettext.php:621
msgid "{{name}} must be an URL"
msgstr "{{name}} doit être une URL"

#: gettext.php:622
msgid "{{name}} must not be an URL"
msgstr "{{name}} ne doit pas être une URL"

#: gettext.php:623
msgid "{{name}} must start with ({{startValue}})"
msgstr "{{name}} doit démarrer par ({{startValue}})"

#: gettext.php:624
msgid "{{name}} must not start with ({{startValue}})"
msgstr "{{name}} ne doit pas démarrer par ({{startValue}})"

#: gettext.php:625
msgid "{{name}} is not considered as \"False\""
msgstr "{{name}} n'est pas considéré \"False\""

#: gettext.php:626
msgid "{{name}} is considered as \"False\""
msgstr "{{name}} est considéré \"False\""

#: gettext.php:627
msgid "{{name}} must be {{type}}"
msgstr "{{name}} doit être {{type}}"

#: gettext.php:628
msgid "{{name}} must not be {{type}}"
msgstr "{{name}} ne doit pas être {{type}}"

#: gettext.php:629
msgid "{{name}} must have {{mimetype}} mimetype"
msgstr "{{name}} doit avoir un mimetype {{mimetype}}"

#: gettext.php:630
msgid "{{name}} must not have {{mimetype}} mimetype"
msgstr "{name}} ne doit pas avoir un mimetype {{mimetype}}"

#: gettext.php:631
msgid "{{name}} must be of the type array"
msgstr "{{name}} doit être de type array"

#: gettext.php:632
msgid "{{name}} must not be of the type array"
msgstr "{{name}} ne doit pas être de type array"

#: gettext.php:633
msgid "{{name}} must be a BSN"
msgstr "{{name}} doit être un BSN"

#: gettext.php:634
msgid "{{name}} must not be a BSN"
msgstr "{{name}} ne doit pas être un BSN"

#: gettext.php:635
msgid "{{name}} must be a boolean"
msgstr "{{name}} doit être un booléen"

#: gettext.php:636
msgid "{{name}} must not be a boolean"
msgstr "{{name}} ne doit pas être un booléen"

#: gettext.php:637 gettext.php:821
msgid "The value must not be optional"
msgstr "La valeur ne doit pas être optionnelle"

#: gettext.php:638 gettext.php:822
msgid "{{name}} must not be optional"
msgstr "{{name}} ne doit pas être optionnelle"

#: gettext.php:639 gettext.php:819
msgid "The value must be optional"
msgstr "La valeur doit être optionnelle"

#: gettext.php:640 gettext.php:820
msgid "{{name}} must be optional"
msgstr "{{name}} doit être optionnel"

#: gettext.php:641
msgid "{{name}} must be a scalar value"
msgstr "{{name}} doit être une valeur scalaire"

#: gettext.php:642
msgid "{{name}} must not be a scalar value"
msgstr "{{name}} ne doit pas être une valeur scalaire"

#: gettext.php:643
msgid "{{name}} must be a valid CNH number"
msgstr "{{name}} doit être un numéro CNH valide"

#: gettext.php:644
msgid "{{name}} must not be a valid CNH number"
msgstr "{{name}} ne doit pas être un numéro CNH valide"

#: gettext.php:645
msgid "{{name}} must be a german BIC"
msgstr "{{name}} doit être un BIC allemand"

#: gettext.php:646
msgid "{{name}} must not be a german BIC"
msgstr "{{name}} ne doit pas être un BIC allemand"

#: gettext.php:647
msgid "{{name}} must be a german bank"
msgstr "{{name}} doit être une banque allemande"

#: gettext.php:648
msgid "{{name}} must not be a german bank"
msgstr "{{name}} ne doit pas être une banque allemande"

#: gettext.php:649
msgid "{{name}} must be a german bank account"
msgstr "{{name}} doit être un compte bancaire allemand"

#: gettext.php:650
msgid "{{name}} must not be a german bank account"
msgstr "{{name}} ne doit pas être un compte bancaire allemand"

#: gettext.php:651
msgid "{{name}} must be a valid Polish Identity Card number"
msgstr "{{name}} doit être un numéro de carte d'identité Polonais valide"

#: gettext.php:652
msgid "{{name}} must not be a valid Polish Identity Card number"
msgstr "{{name}} ne doit pas être un numéro de carte d'identité Polonais valide"

#: gettext.php:653
msgid "{{name}} must be in the {{charset}} charset"
msgstr "{{name}} doit être dans le charset {{charset}}"

#: gettext.php:654
msgid "{{name}} must not be in the {{charset}} charset"
msgstr "{{name}} ne doit pas être dans le charset {{charset}}"

#: gettext.php:655
msgid "{{name}} must have {{extension}} extension"
msgstr "{{name}} doit avoir l'extension {{extension}}"

#: gettext.php:656
msgid "{{name}} must not have {{extension}} extension"
msgstr "{{name}}ne doit pas avoir l'extension {{extension}}"

#: gettext.php:657
msgid "{{name}} must be a valid Identity Card number for {{countryCode}}"
msgstr "{{name}} doit être un numéro de carte d'identité valide pour {{countryCode}}"

#: gettext.php:658
msgid "{{name}} must not be a valid Identity Card number for {{countryCode}}"
msgstr "{{name}} ne doit pas être un numéro de carte d'identité valide pour {{countryCode}}"

#: gettext.php:659
msgid "{{name}} must be an array"
msgstr "{{name}} doit être un tableau"

#: gettext.php:660
msgid "{{name}} must not be an array"
msgstr "{{name}} ne doit pas être un tableau"

#: gettext.php:661
msgid "{{name}} must contain only graphical characters"
msgstr "{{name}} ne doit contenir que que des caractères graphiques"

#: gettext.php:662
msgid "{{name}} must contain only graphical characters and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des caractères graphiques et \"{{additionalChars}}\""

#: gettext.php:663
msgid "{{name}} must not contain graphical characters"
msgstr "{{name}} ne doit contenir aucun caractère graphique"

#: gettext.php:664
msgid "{{name}} must not contain graphical characters or \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir aucjn caractères graphiques ni \"{{additionalChars}}\""

#: gettext.php:665
msgid "{{name}} must be a version"
msgstr "{{name}} doit être une version"

#: gettext.php:666
msgid "{{name}} must not be a version"
msgstr "{{name}} ne doit pas être une version"

#: gettext.php:667
msgid "{{name}} must contain only consonants"
msgstr "{{name}} ne doit contenir que des consonnes"

#: gettext.php:668
msgid "{{name}} must contain only consonants and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des consonnes et \"{{additionalChars}}\""

#: gettext.php:669
msgid "{{name}} must not contain consonants"
msgstr "{name}} ne doit contenir aucune consonne"

#: gettext.php:670
msgid "{{name}} must not contain consonants or \"{{additionalChars}}\""
msgstr "{name}} ne doit contenir aucune consonne ni \"{{additionalChars}}\""

#: gettext.php:671
msgid "{{name}} must be a valid subdivision code for {{countryCode}}"
msgstr "{{name}} doit être un secteur valide de {{countryCode}}"

#: gettext.php:672
msgid "{{name}} must not be a valid subdivision code for {{countryCode}}"
msgstr "{{name}} ne doit pas être un secteur valide de {{countryCode}}"

#: gettext.php:673 gettext.php:782
msgid "{{name}} is always invalid"
msgstr "{name}} est toujours invalide"

#: gettext.php:674
msgid "{{name}} is not valid"
msgstr "{name}} n'est pas valide"

#: gettext.php:675 gettext.php:781
msgid "{{name}} is always valid"
msgstr "{name}} est toujours valide"

#: gettext.php:676
msgid "{{name}} is valid"
msgstr "{name}} est valide"

#: gettext.php:677
msgid "The value must not be empty"
msgstr "La valeur ne doit pas être vide"

#: gettext.php:678
msgid "{{name}} must not be empty"
msgstr "{{name}} ne doit pas être"

#: gettext.php:679
msgid "The value must be empty"
msgstr "La valeur ne doit pas être vide"

#: gettext.php:680
msgid "{{name}} must be empty"
msgstr "{{name}} doit être vide"

#: gettext.php:681
msgid "{{name}} must be a symbolic link"
msgstr "{{name}} doit être un lien symbolique"

#: gettext.php:682
msgid "{{name}} must not be a symbolic link"
msgstr "{{name}} ne doit pas être un lien symbolique"

#: gettext.php:683
msgid "{{name}} must be a valid Credit Card number"
msgstr "{{name}} doit être un numéro de carte de crédit valide"

#: gettext.php:684
msgid "{{name}} must not be a valid Credit Card number"
msgstr "{{name}} ne doit pas être un numéro de carte de crédit valide"

#: gettext.php:685
msgid "{{name}} must be a resource"
msgstr "{{name}} doit être une ressource"

#: gettext.php:686
msgid "{{name}} must not be a resource"
msgstr "{{name}} ne doit pas être une ressource"

#: gettext.php:687
msgid "{{name}} must be greater than {{interval}}"
msgstr "{{name}} doit être supérieur à {{interval}}"

#: gettext.php:688
msgid "{{name}} must be greater than or equal to {{interval}}"
msgstr "{{name}} doit être supérieur ou égal à {{interval}}"

#: gettext.php:689
msgid "{{name}} must not be greater than {{interval}}"
msgstr "{{name}} ne doit pas être supérieur à {{interval}}"

#: gettext.php:690
msgid "{{name}} must not be greater than or equal to {{interval}}"
msgstr "{{name}} ne doit pas être supérieur ou égal à {{interval}}"

#: gettext.php:692
msgid "{{baseKey}} must be valid to validate {{comparedKey}}"
msgstr "{{baseKey}} doit être valide pour valider {{comparedKey}}"

#: gettext.php:694
msgid "{{baseKey}} must not be valid to validate {{comparedKey}}"
msgstr "{{baseKey}} ne doit pas être valide pour valider {{comparedKey}}"

#: gettext.php:695
msgid "{{name}} must be a valid perfect square"
msgstr "{{name}} doit être un carré parfait"

#: gettext.php:696
msgid "{{name}} must not be a valid perfect square"
msgstr "{{name}} ne doit pas être un carré parfait"

#: gettext.php:697
msgid "{{name}} must be readable"
msgstr "{{name}} doit être lisible"

#: gettext.php:698
msgid "{{name}} must not be readable"
msgstr "{{name}} ne doit pas être lisible"

#: gettext.php:699
msgid "{{name}} must be a valid CPF number"
msgstr "{{name}} doit être un numéro CPF valide"

#: gettext.php:700
msgid "{{name}} must not be a valid CPF number"
msgstr "{{name}} ne doit pas être un numéro CPF valide"

#: gettext.php:702
msgid "All of these rules must pass for {{name}}"
msgstr "Toutes les règles doivent passer pour {{name}}"

#: gettext.php:703
msgid "{{name}} must be writable"
msgstr "{{name}} doit être accessible en écriture"

#: gettext.php:704
msgid "{{name}} must not be writable"
msgstr "{{name}} ne doit pas être accessible en écriture"

#: gettext.php:705
msgid "{{name}} must be countable"
msgstr "{{name}} doit être dénombrable"

#: gettext.php:706
msgid "{{name}} must not be countable"
msgstr "{{name}} ne doit pas être dénombrable"

#: gettext.php:707 gettext.php:731
msgid "{{name}} must be valid"
msgstr "{{name}} doit être valide"

#: gettext.php:708 gettext.php:732
msgid "{{name}} must not be valid"
msgstr "{{name}} ne doit pas être valide"

#: gettext.php:709
msgid "At least one of these rules must pass for {{name}}"
msgstr "Au moins une de ces règles doivent être validées pour {{name}}"

#: gettext.php:710
msgid "At least one of these rules must not pass for {{name}}"
msgstr "Au moins une de ces règles doivent être invalidées pour {{name}}"

#: gettext.php:711
msgid "{{name}} must be a valid top-level domain name"
msgstr "{{name}} doit être un nom de domaine valide de premier niveau"

#: gettext.php:712
msgid "{{name}} must not be a valid top-level domain name"
msgstr "{{name}} ne doit pas être un nom de domaine valide de premier niveau"

#: gettext.php:713
msgid "{{name}} must be a valid language"
msgstr "{{name}} doit être un langage valide"

#: gettext.php:714
msgid "{{name}} must not be a valid language"
msgstr "{{name}} ne doit pas être un langage valide"

#: gettext.php:715
msgid "{{name}} must validate against {{regex}}"
msgstr "{{name}} doit être validé par {{regex}}"

#: gettext.php:716
msgid "{{name}} must not validate against {{regex}}"
msgstr "{{name}} ne doit pas être validé par {{regex}}"

#: gettext.php:717
msgid "{{name}} must be an odd number"
msgstr "{{name}} doit être un nombre impair"

#: gettext.php:718
msgid "{{name}} must not be an odd number"
msgstr "{{name}} ne doit pas être un nombre impair"

#: gettext.php:719
msgid "{{name}} must be between {{minAge}} and {{maxAge}} years ago"
msgstr "{{name}} doit être compris entre {{minAge}} and {{maxAge}} ans"

#: gettext.php:720
msgid "{{name}} must be lower than {{minAge}} years ago"
msgstr "{{name}} doit être inférieur à {{minAge}}"

#: gettext.php:721
msgid "{{name}} must be greater than {{maxAge}} years ago"
msgstr "{{name}} doit être supérieur à {{maxAge}}"

#: gettext.php:722
msgid "{{name}} must not be between {{minAge}} and {{maxAge}} years ago"
msgstr "{{name}} ne doit pas être compris entre {{minAge}} and {{maxAge}} ans"

#: gettext.php:723
msgid "{{name}} must not be lower than {{minAge}} years ago"
msgstr "{{name}} ne doit pas être inférieur à {{minAge}}"

#: gettext.php:724
msgid "{{name}} must not be greater than {{maxAge}} years ago"
msgstr "{{name}} ne doit pas être supérieur à {{maxAge}}"

#: gettext.php:725
msgid "{{name}} must contain only letters (a-z) and digits (0-9)"
msgstr "{{name}} ne doit contenir que des lettres (a-z) et des chiffres (0-9)"

#: gettext.php:726
msgid "{{name}} must contain only letters (a-z), digits (0-9) and {{additionalChars}}"
msgstr "{{name}} ne doit contenir que des lettres (a-z) et des chiffres (0-9) et {{additionalChars}}"

#: gettext.php:727
msgid "{{name}} must not contain letters (a-z) or digits (0-9)"
msgstr "{{name}} ne doit contenir aucune lettre (a-z) ni chiffre (0-9)"

#: gettext.php:728
msgid "{{name}} must not contain letters (a-z), digits (0-9) or {{additionalChars}}"
msgstr "{{name}} ne doit contenir aucune lettre (a-z), chiffre (0-9) ou {{additionalChars}}"

#: gettext.php:729
msgid "{{name}} must be a valid currency"
msgstr "{{name}} doit être une devise valide"

#: gettext.php:730
msgid "{{name}} must not be a valid currency"
msgstr "{{name}} ne doit pas être une devise valide"

#: gettext.php:733
msgid "{{name}} must contain the value \"{{containsValue}}\""
msgstr "{{name}} doit contenir la valeur \"{{containsValue}}\""

#: gettext.php:734
msgid "{{name}} must not contain the value \"{{containsValue}}\""
msgstr "{{name}} ne doit pas contenir la valeur \"{{containsValue}}\""

#: gettext.php:735
msgid "{{name}} is not considered as \"Yes\""
msgstr "{{name}} n'est pas considéré comme \"Yes\""

#: gettext.php:736
msgid "{{name}} is considered as \"Yes\""
msgstr "{{name}} est considéré comme \"Yes\""

#: gettext.php:737
msgid "{{name}} must be an infinite number"
msgstr "{{name}} doit être un nombre infini"

#: gettext.php:738
msgid "{{name}} must not be an infinite number"
msgstr "{{name}} ne doit pas être un nombre infini"

#: gettext.php:739
msgid "{{name}} must be a valid prime number"
msgstr "{{name}} doit être un nombre premier valide"

#: gettext.php:740
msgid "{{name}} must not be a valid prime number"
msgstr "{{name}} ne doit pas être un nombre premier valide"

#: gettext.php:741
msgid "{{name}} must be a valid telephone number"
msgstr "{{name}} doit être un numéro de téléphone valide"

#: gettext.php:742
msgid "{{name}} must not be a valid telephone number"
msgstr "{{name}} ne doit pas être un numéro de téléphone valide"

#: gettext.php:745
msgid "Must have keys {{keys}}"
msgstr "Doit posséder les clés {{keys}}"

#: gettext.php:748
msgid "Must not have keys {{keys}}"
msgstr "Ne doit pas posséder les clés {{keys}}"

#: gettext.php:749
msgid "{{name}} must be a string"
msgstr "{{name}} doit être une chaîne de caractères"

#: gettext.php:750
msgid "{{name}} must not be string"
msgstr "{{name}} ne doit pas être une chaîne de caractères"

#: gettext.php:751
msgid "No items were found for key chain {{name}}"
msgstr "Aucun élément n'a été trouvé dans la key-chain {{name}}"

#: gettext.php:752
msgid "Key chain {{name}} is not valid"
msgstr "La key-chain {{name}} n'est pas valide"

#: gettext.php:753
msgid "Items for key chain {{name}} must not be present"
msgstr "Les éléments pour la key-chain {{name}} ne doivent pas être présent"

#: gettext.php:754
msgid "Key chain {{name}} must not be valid"
msgstr "La key-chain {{name}} ne doit pas être valide"

#: gettext.php:755
msgid "{{name}} must be numeric"
msgstr "{{name}} doit être numérique"

#: gettext.php:756
msgid "{{name}} must not be numeric"
msgstr "{{name}} ne doit pas être numérique"

#: gettext.php:757
msgid "{{name}} must be of the type integer"
msgstr "{{name}} doit être de type integer"

#: gettext.php:758
msgid "{{name}} must not be of the type integer"
msgstr "{{name}} ne doit pas être de type integer"

#: gettext.php:759
msgid "{{name}} must be positive"
msgstr "{{name}} doit être positif"

#: gettext.php:760
msgid "{{name}} must not be positive"
msgstr "{{name}} ne doit pas être positif"

#: gettext.php:761
msgid "{{name}} must be a valid video URL"
msgstr "{{name}} doit être une URL de vidéo valide"

#: gettext.php:762
msgid "{{name}} must be a valid {{service}} video URL"
msgstr "{{name}} doit être une URL de vidéo {{service}} validee"

#: gettext.php:763
msgid "{{name}} must not be a valid video URL"
msgstr "{{name}} ne doit pas être une URL de vidéo validee"

#: gettext.php:764
msgid "{{name}} must not be a valid {{service}} video URL"
msgstr "{{name}} ne doit pas être une URL de vidéo {{service}} validee"

#: gettext.php:765
msgid "{{name}} must contain only control characters"
msgstr "{{name}} ne doit contenir que des caractères de contrôle"

#: gettext.php:766
msgid "{{name}} must contain only control characters and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des caractères de contrôle et \"{{additionalChars}}\""

#: gettext.php:767
msgid "{{name}} must not contain control characters"
msgstr "{{name}} ne doit contenir aucun caractère de contrôle et \"{{additionalChars}}\""

#: gettext.php:768
msgid "{{name}} must not contain control characters or \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des caractères de contrôle et \"{{additionalChars}}\""

#: gettext.php:769
msgid "{{name}} is not considered as \"No\""
msgstr "{{name}} n'est pas considéré comme \"No\""

#: gettext.php:770
msgid "{{name}} is considered as \"No\""
msgstr "{{name}} est considéré comme \"No\""

#: gettext.php:771
msgid "{{name}} must be multiple of {{multipleOf}}"
msgstr "{{name}} doit être un multiple de {{multipleOf}}"

#: gettext.php:772
msgid "{{name}} must not be multiple of {{multipleOf}}"
msgstr "{{name}} ne doit pas être un multiple de {{multipleOf}}"

#: gettext.php:773
msgid "{{name}} must be an even number"
msgstr "{{name}} doit être un nombre pair"

#: gettext.php:774
msgid "{{name}} must not be an even number"
msgstr "{{name}} ne doit pas être un nombre pair"

#: gettext.php:775
msgid "{{name}} must be a valid domain"
msgstr "{{name}} doit être un domaine valide"

#: gettext.php:776
msgid "{{name}} must not be a valid domain"
msgstr "{{name}} ne doit pas être un domaine valide"

#: gettext.php:777
msgid "{{name}} must be a directory"
msgstr "{{name}} doit être un répertoire"

#: gettext.php:778
msgid "{{name}} must not be a directory"
msgstr "{{name}} ne doit pas être un répertoire"

#: gettext.php:779
msgid "{{name}} must be a valid mac address"
msgstr "{{name}} doit être une adresse MAC valide"

#: gettext.php:780
msgid "{{name}} must not be a valid mac address"
msgstr "{{name}} ne doit pas être une adresse MAC valide"

#: gettext.php:783
msgid "{{name}} must contain only digits (0-9)"
msgstr "{{name}} ne doit contenir que des chiffres (0-9) "

#: gettext.php:784
msgid "{{name}} must contain only digits (0-9) and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des chiffres (0-9) et \"{{additionalChars}}\""

#: gettext.php:785
msgid "{{name}} must not contain digits (0-9)"
msgstr "{{name}} ne doit contenir aucun chiffre (0-9)"

#: gettext.php:786
msgid "{{name}} must not contain digits (0-9) or \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir aucun chiffre (0-9) ni \"{{additionalChars}}\""

#: gettext.php:787
msgid "{{name}} must be uppercase"
msgstr "{{name}} doit être en majuscule"

#: gettext.php:788
msgid "{{name}} must not be uppercase"
msgstr "{{name}} ne doit pas être en majuscule"

#: gettext.php:789
msgid "The value must not be blank"
msgstr "La valeur ne doit pas être vide"

#: gettext.php:790
msgid "{{name}} must not be blank"
msgstr "{{name}} ne doit pas être vide"

#: gettext.php:791
msgid "The value must be blank"
msgstr "La valeur doit être vide"

#: gettext.php:792
msgid "{{name}} must be blank"
msgstr "{{name}} doit être vide"

#: gettext.php:793
msgid "{{name}} must be valid email"
msgstr "{{name}} doit être une adresse email valide"

#: gettext.php:794
msgid "{{name}} must not be an email"
msgstr "{{name}} ne doit pas être une adresse email valide"

#: gettext.php:795
msgid "{{name}} must be an IP address"
msgstr "{{name}} doit être une adresse IP"

#: gettext.php:796
msgid "{{name}} must be an IP address in the {{range}} range"
msgstr "{{name}} doit être une adresse IP dans la rangée {{range}}"

#: gettext.php:797
msgid "{{name}} must not be an IP address"
msgstr "{{name}} ne doit pas être une adresse IP"

#: gettext.php:798
msgid "{{name}} must not be an IP address in the {{range}} range"
msgstr "{{name}} ne doit pas être une adresse IP dans la rangée {{range}}"

#: gettext.php:799
msgid "{{name}} must be negative"
msgstr "{{name}} doit être négatif"

#: gettext.php:800
msgid "{{name}} must not be negative"
msgstr "{{name}} ne doit pas être négatif"

#: gettext.php:801
msgid "{{name}} must be of the type float"
msgstr "{{name}} doit être de type float"

#: gettext.php:802
msgid "{{name}} must not be of the type float"
msgstr "{{name}} ne doit pas être de type float"

#: gettext.php:803
msgid "{{name}} must be a finite number"
msgstr "{{name}} doit être un nombre fini"

#: gettext.php:804
msgid "{{name}} must not be a finite number"
msgstr "{{name}} ne doit pas être un nombre fini"

#: gettext.php:805
msgid "{{name}} must be a valid country"
msgstr "{{name}} doit être un pays valide"

#: gettext.php:806
msgid "{{name}} must not be a valid country"
msgstr "{{name}} ne doit pas être un pays valide"

#: gettext.php:807
msgid "{{name}} must have a length between {{minValue}} and {{maxValue}}"
msgstr "{{name}} doit avoir une longueur entre {{minValue}} et {{maxValue}}"

#: gettext.php:808
msgid "{{name}} must have a length greater than {{minValue}}"
msgstr "{{name}} doit avoir une longueur supérieur à {{minValue}}"

#: gettext.php:809
msgid "{{name}} must have a length lower than {{maxValue}}"
msgstr "{{name}} doit avoir une longueur inférieure à {{maxValue}}"

#: gettext.php:810
msgid "{{name}} must not have a length between {{minValue}} and {{maxValue}}"
msgstr "{{name}} ne doit pas avoir une longueur entre {{minValue}} et {{maxValue}}"

#: gettext.php:811
msgid "{{name}} must not have a length greater than {{minValue}}"
msgstr "{{name}} ne doit pas avoir une longueur supérieur à {{minValue}}"

#: gettext.php:812
msgid "{{name}} must not have a length lower than {{maxValue}}"
msgstr "{{name}} ne doit pas avoir une longueur inférieure à {{maxValue}}"

#: gettext.php:813
msgid "The age must be {{age}} years or more."
msgstr "L'âge doit être {{age}} ans ou plus"

#: gettext.php:814
msgid "The age must not be {{age}} years or more."
msgstr "L'âge ne doit pas être plus de {{age}} ans "

#: gettext.php:815
msgid "{{name}} must be a valid IMEI"
msgstr "{{name}} doit être un numéro IMEI valide"

#: gettext.php:816
msgid "{{name}} must not be a valid IMEI"
msgstr "{{name}} ne doit pas être un numéro IMEI valide"

#: gettext.php:817
msgid "{{name}} must end with ({{endValue}})"
msgstr "{{name}} doit finir par ({{endValue}})"

#: gettext.php:818
msgid "{{name}} must not end with ({{endValue}})"
msgstr "{{name}} ne doit pas finir par ({{endValue}})"

#: gettext.php:823
msgid "{{name}} must be a valid JSON string"
msgstr "{{name}} doit être une chaîne JSON valide"

#: gettext.php:824
msgid "{{name}} must not be a valid JSON string"
msgstr "{{name}} ne doit pas être une chaîne JSON valide"

#: gettext.php:825
msgid "{{name}} is not considered as \"True\""
msgstr "{{name}} n'est pas considéré comme \"True\""

#: gettext.php:826
msgid "{{name}} is considered as \"True\""
msgstr "{{name}} est considéré comme \"True\""

#: gettext.php:827
msgid "{{name}} must be in {{haystack}}"
msgstr "{{name}} doit être dans {{haystack}}"

#: gettext.php:828
msgid "{{name}} must not be in {{haystack}}"
msgstr "{{name}} ne doit pas être dans {{haystack}}"

#: gettext.php:829
msgid "{{name}} must be a factor of {{dividend}}"
msgstr "{{name}} doit être un facteur de {{dividend}}"

#: gettext.php:830
msgid "{{name}} must not be a factor of {{dividend}}"
msgstr "{{name}} ne doit pas être un facteur de {{dividend}}"

#: gettext.php:831
msgid "{{name}} must be lowercase"
msgstr "{{name}} doit être en minuscules"

#: gettext.php:832
msgid "{{name}} must not be lowercase"
msgstr "{{name}} ne doit pas être en minuscules"

#: gettext.php:833
msgid "{{name}} must contain only punctuation characters"
msgstr "{{name}} ne doit contenir que des caractères de ponctuation"

#: gettext.php:834
msgid "{{name}} must contain only punctuation characters and \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir que des caractères de ponctuation et \"{{additionalChars}}\""

#: gettext.php:835
msgid "{{name}} must not contain punctuation characters"
msgstr "{{name}} ne doit contenir aucun caractère de ponctuation"

#: gettext.php:836
msgid "{{name}} must not contain punctuation characters or \"{{additionalChars}}\""
msgstr "{{name}} ne doit contenir aucun caractère de ponctuation ni \"{{additionalChars}}\""

#: gettext.php:837
msgid "{{name}} must be a boolean value"
msgstr "{{name}} doit être une valeur booléenne"

#: gettext.php:838
msgid "{{name}} must not be a boolean value"
msgstr "{{name}} ne doit pas être une valeur booléenne"

#: gettext.php:839
msgid "{{name}} must be a bank"
msgstr "{{name}} doit être une banque"

#: gettext.php:840
msgid "{{name}} must not be a bank"
msgstr "{{name}} ne doit pas être une banque"
*/